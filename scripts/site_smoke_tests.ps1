Param(
    [Parameter(Mandatory = $true)]
    [string]$BaseUrl,

    [int]$MaxPages = 500,
    [int]$MaxDepth = 5,
    [string]$OutDir = ".\scripts\reports",
    [int]$RequestTimeoutSec = 20,
    [switch]$TestContactForm,
    [string]$ContactPath = "/contacto/"
)

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

function Write-Info([string]$message) {
    $ts = Get-Date -Format 'HH:mm:ss'
    Write-Host "[$ts] $message"
}

function HtmlEncode([string]$text) {
    if ($null -eq $text) { return '' }
    $enc = $text -replace '&', '&amp;'
    $enc = $enc -replace '<', '&lt;'
    $enc = $enc -replace '>', '&gt;'
    $enc = $enc -replace '"', '&quot;'
    $enc = $enc -replace "'", '&#39;'
    return $enc
}

function Invoke-HttpWithRetry {
    param(
        [Parameter(Mandatory=$true)][string]$Uri,
        [ValidateSet('GET','HEAD','POST')][string]$Method = 'GET',
        [hashtable]$Body = $null,
        [int]$TimeoutSec = 20,
        [int]$MaxRedirects = 10,
        [int]$MaxAttempts = 3,
        [int]$InitialDelayMs = 400
    )
    $attempt = 0
    $delay = [Math]::Max(150, $InitialDelayMs)
    $lastErr = $null
    while ($attempt -lt $MaxAttempts) {
        $attempt++
        try {
            $resp = Invoke-WebRequest -Uri $Uri -Method $Method -Body $Body -UseBasicParsing -TimeoutSec $TimeoutSec -MaximumRedirection $MaxRedirects -ErrorAction Stop
            $code = 0
            try { if ($resp.StatusCode) { $code = [int]$resp.StatusCode } elseif ($resp.BaseResponse) { $code = [int]$resp.BaseResponse.StatusCode } } catch { $code = 0 }
            if ($code -ge 500 -or $code -eq 429) {
                if ($attempt -lt $MaxAttempts) { Start-Sleep -Milliseconds $delay; $delay = [Math]::Min($delay*2, 5000); continue }
            }
            return $resp
        } catch {
            $lastErr = $_
            $code = 0
            try { if ($_.Exception.Response -and $_.Exception.Response.StatusCode) { $code = [int]$_.Exception.Response.StatusCode } } catch { $code = 0 }
            $transient = ($code -ge 500 -or $code -eq 429 -or $code -eq 0)
            if ($attempt -lt $MaxAttempts -and $transient) { Start-Sleep -Milliseconds $delay; $delay = [Math]::Min($delay*2, 6000); continue }
            throw
        }
    }
    if ($lastErr) { throw $lastErr }
}

function Test-ContactFormSubmission {
    param(
        [string]$baseUrl,
        [string]$contactPath,
        [int]$timeoutSec
    )

    $result = [PSCustomObject]@{ Performed = $false; StatusCode = 0; Error = ''; RedirectUrl = ''; ElapsedMs = 0 }
    try {
        $contactUrl = (Ensure-TrailingSlash $baseUrl) + ($contactPath.TrimStart('/'))
        $session = New-Object Microsoft.PowerShell.Commands.WebRequestSession
        $ua = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124 Safari/537.36'
        $commonHeaders = @{ 'User-Agent' = $ua; 'Accept' = 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'; 'Accept-Language' = 'es-MX,es;q=0.9,en;q=0.8' }
        $sw = [System.Diagnostics.Stopwatch]::StartNew()
        $resp = Invoke-WebRequest -Uri $contactUrl -UseBasicParsing -TimeoutSec $timeoutSec -WebSession $session -Headers $commonHeaders -MaximumRedirection 5
        $sw.Stop()
        if (-not $resp -or -not $resp.Content) { $result.Error = 'Sin contenido de formulario'; return $result }

        # Extraer nonce
        $m = [regex]::Match($resp.Content, 'name="sitec_contact_nonce"\s+value="([^"]+)"', 'IgnoreCase')
        if (-not $m.Success) { $result.Error = 'No se encontró nonce'; return $result }
        $nonce = $m.Groups[1].Value

        $postUrl = (Ensure-TrailingSlash $baseUrl) + 'wp-admin/admin-post.php'
        $formBody = @{
            'action'                = 'sitec_contact_submit'
            'sitec_contact_nonce'   = $nonce
            'name'                  = 'Prueba Automática'
            'email'                 = 'pruebas+sitec@example.com'
            'phone'                 = '+52 555 000 0000'
            'sector'                = 'Otro'
            'urgency'               = 'Solo requiero información'
            'message'               = 'Mensaje de prueba automatizada del crawler.'
            'privacy'               = '1'
        }

        $postHeaders = $commonHeaders.Clone()
        $postHeaders['Referer'] = $contactUrl
        $postHeaders['Origin'] = (Ensure-TrailingSlash $baseUrl).TrimEnd('/')
        $sw2 = [System.Diagnostics.Stopwatch]::StartNew()
        $postResp = Invoke-WebRequest -Uri $postUrl -Method Post -Body $formBody -UseBasicParsing -TimeoutSec $timeoutSec -MaximumRedirection 5 -ErrorAction Stop -WebSession $session -Headers $postHeaders
        $sw2.Stop()
        $sc = 0
        try { if ($postResp.StatusCode) { $sc = [int]$postResp.StatusCode } elseif ($postResp.BaseResponse) { $sc = [int]$postResp.BaseResponse.StatusCode } } catch { $sc = 0 }
        $loc = ''
        try {
            if ($postResp.BaseResponse -and $postResp.BaseResponse.ResponseUri) { $loc = [string]$postResp.BaseResponse.ResponseUri.AbsoluteUri }
            elseif ($postResp.Headers -and $postResp.Headers.Location) { $loc = [string]$postResp.Headers.Location }
        } catch { }
        $result.Performed = $true; $result.StatusCode = $sc; $result.RedirectUrl = $loc; $result.ElapsedMs = $sw2.ElapsedMilliseconds
        return $result
    } catch {
        $sc = 0
        $loc = ''
        $ex = $_.Exception
        $resp = $null
        try { $resp = $ex.Response } catch { $resp = $null }
        if ($resp) {
            try { if ($resp.StatusCode) { $sc = [int]$resp.StatusCode } } catch { $sc = 0 }
            try {
                if ($resp.ResponseUri) { $loc = [string]$resp.ResponseUri.AbsoluteUri }
                elseif ($resp.Headers -and $resp.Headers.Location) { $loc = [string]$resp.Headers.Location }
            } catch { }
        }
        $result.Performed = $true; $result.StatusCode = $sc; $result.Error = $ex.Message; $result.RedirectUrl = $loc
        return $result
    }
}

function Ensure-TrailingSlash([string]$url) {
    if ([string]::IsNullOrWhiteSpace($url)) { return $url }
    if ($url.EndsWith('/')) { return $url }
    return "$url/"
}

function Resolve-AbsoluteUrl {
    param(
        [string]$Href,
        [string]$ContextUrl
    )
    if ([string]::IsNullOrWhiteSpace($Href)) { return $null }
    if ($Href -match '^(mailto:|tel:|javascript:|data:|#)') { return $null }
    try {
        $uri = [System.Uri]::new($Href, [System.UriKind]::RelativeOrAbsolute)
        $absUri = $null
        if (-not $uri.IsAbsoluteUri) {
            $baseUri = [System.Uri]::new($ContextUrl)
            $absUri = [System.Uri]::new($baseUri, $uri)
        } else {
            $absUri = $uri
        }

        $absolute = $absUri.AbsoluteUri
        $absolute = ($absolute -split '#')[0] # strip fragment
        return $absolute
    } catch {
        return $null
    }
}

function Is-InternalUrl([string]$url, [string]$baseHost) {
    try { return ([System.Uri]$url).Host -ieq $baseHost } catch { return $false }
}

function Should-QueueAsPage([string]$url) {
    if ([string]::IsNullOrWhiteSpace($url)) { return $false }
    if ($url -match '/wp-admin|/wp-login\.php|/feed|/\?s=') { return $false }
    if ($url -match '\.(zip|rar|7z|pdf|docx?|xlsx?|pptx?|ics|mp3|mp4|avi|mov|wmv|svg)$') { return $false }
    return $true
}

function Get-UrlsFromSitemap([string]$sitemapUrl) {
    $urls = New-Object System.Collections.Generic.List[string]
    try {
        Write-Info "Descargando sitemap: $sitemapUrl"
        $resp = Invoke-HttpWithRetry -Uri $sitemapUrl -TimeoutSec $RequestTimeoutSec
        if (-not $resp -or -not $resp.Content) { return $urls }
        $xml = [xml]$resp.Content
        if ($xml.sitemapindex) {
            foreach ($node in $xml.sitemapindex.sitemap) {
                $loc = $node.loc.'#text'
                if (-not $loc) { $loc = $node.loc }
                if ($loc) { $urls.AddRange((Get-UrlsFromSitemap $loc)) }
            }
        } elseif ($xml.urlset) {
            foreach ($node in $xml.urlset.url) {
                $loc = $node.loc.'#text'
                if (-not $loc) { $loc = $node.loc }
                if ($loc) { [void]$urls.Add($loc) }
            }
        }
    } catch {
        Write-Info "No se pudo leer el sitemap ${sitemapUrl}: $($_.Exception.Message)"
    }
    return $urls
}

function Test-Http([string]$url) {
    $sw = [System.Diagnostics.Stopwatch]::StartNew()
    try {
        $resp = Invoke-HttpWithRetry -Uri $url -TimeoutSec $RequestTimeoutSec
        $sw.Stop()
        $title = $null
        try {
            if ($resp.ParsedHtml -and $resp.ParsedHtml.title) { $title = $resp.ParsedHtml.title }
            if (-not $title -and $resp.Content) {
                $m = [regex]::Match($resp.Content, '<title>(.*?)</title>', 'IgnoreCase')
                if ($m.Success) { $title = $m.Groups[1].Value }
            }
        } catch { $title = $null }
        return [PSCustomObject]@{
            Url        = $url
            StatusCode = if ($resp.StatusCode) { [int]$resp.StatusCode } elseif ($resp.BaseResponse) { [int]$resp.BaseResponse.StatusCode } else { 0 }
            Error      = ''
            LoadMs     = $sw.ElapsedMilliseconds
            Title      = $title
        }
    } catch {
        $sw.Stop()
        $status = 0
        $message = $_.Exception.Message
        if ($_.Exception.Response -and $_.Exception.Response.StatusCode) {
            try { $status = [int]$_.Exception.Response.StatusCode } catch { $status = 0 }
        }
        return [PSCustomObject]@{
            Url        = $url
            StatusCode = $status
            Error      = $message
            LoadMs     = $sw.ElapsedMilliseconds
            Title      = ''
        }
    }
}

function Extract-LinksAndAssets($response, [string]$currentUrl) {
    $links = New-Object System.Collections.Generic.List[string]
    $assets = New-Object System.Collections.Generic.List[string]
    try {
        if ($response.Links) {
            foreach ($l in $response.Links) {
                $abs = Resolve-AbsoluteUrl $l.href $currentUrl
                if ($abs) { [void]$links.Add($abs) }
            }
        }
        if ($response.Images) {
            foreach ($img in $response.Images) {
                $abs = Resolve-AbsoluteUrl $img.src $currentUrl
                if ($abs) { [void]$assets.Add($abs) }
            }
        }
        # Parse CSS and JS via regex as fallback
        if ($response.Content) {
            foreach ($m in [regex]::Matches($response.Content, '<link[^>]+href="([^"]+)"', 'IgnoreCase')) {
                $abs = Resolve-AbsoluteUrl $m.Groups[1].Value $currentUrl
                if ($abs) { [void]$assets.Add($abs) }
            }
            foreach ($m in [regex]::Matches($response.Content, '<script[^>]+src="([^"]+)"', 'IgnoreCase')) {
                $abs = Resolve-AbsoluteUrl $m.Groups[1].Value $currentUrl
                if ($abs) { [void]$assets.Add($abs) }
            }
            foreach ($m in [regex]::Matches($response.Content, '<a[^>]+href="([^"]+)"', 'IgnoreCase')) {
                $abs = Resolve-AbsoluteUrl $m.Groups[1].Value $currentUrl
                if ($abs) { [void]$links.Add($abs) }
            }
        }
    } catch { }
    return @($links, $assets)
}

# Preparación de rutas de salida
$BaseUrl = Ensure-TrailingSlash $BaseUrl
$baseUri = [System.Uri]$BaseUrl
$baseHost = $baseUri.Host
$timestamp = Get-Date -Format 'yyyyMMdd-HHmmss'
$runDir = Join-Path $OutDir $timestamp
New-Item -ItemType Directory -Force -Path $runDir | Out-Null

Write-Info "Base: $($BaseUrl) | Dominio: $($baseHost) | Límite páginas: $($MaxPages) | Profundidad: $($MaxDepth)"

# Semillas desde sitemap(s)
$seedUrls = New-Object System.Collections.Generic.List[string]
$sitemaps = @(
    ($BaseUrl + 'sitemap_index.xml'),
    ($BaseUrl + 'sitemap.xml')
)
foreach ($sm in $sitemaps) {
    $found = @(Get-UrlsFromSitemap $sm)
    if ($found -and $found.Count -gt 0) { $seedUrls.AddRange($found) }
}
if ($seedUrls.Count -eq 0) { [void]$seedUrls.Add($BaseUrl) }

# Estructuras del crawler
$queue = New-Object System.Collections.Queue
$visited = New-Object System.Collections.Generic.HashSet[string]
$depthMap = New-Object 'System.Collections.Generic.Dictionary[string,int]'

foreach ($u in $seedUrls | Select-Object -Unique) {
    $queue.Enqueue(@($u, 0))
}

$pageResults = New-Object System.Collections.Generic.List[object]
$brokenLinks = New-Object System.Collections.Generic.List[object]
$brokenAssets = New-Object System.Collections.Generic.List[object]

while ($queue.Count -gt 0 -and $visited.Count -lt $MaxPages) {
    $item = $queue.Dequeue()
    $currentUrl = [string]$item[0]
    $depth = [int]$item[1]

    if (-not (Is-InternalUrl $currentUrl $baseHost)) { continue }
    if (-not (Should-QueueAsPage $currentUrl)) { continue }

    $key = $currentUrl.TrimEnd('/').ToLowerInvariant()
    if ($visited.Contains($key)) { continue }
    [void]$visited.Add($key)
    $depthMap[$key] = $depth

    Write-Info "Probando [$($visited.Count)/$MaxPages] d$($depth): $currentUrl"

    $pageTest = $null
    $resp = $null
    try {
        $sw = [System.Diagnostics.Stopwatch]::StartNew()
        $resp = Invoke-HttpWithRetry -Uri $currentUrl -TimeoutSec $RequestTimeoutSec
        $sw.Stop()
        $title = $null
        try {
            if ($resp.ParsedHtml -and $resp.ParsedHtml.title) { $title = $resp.ParsedHtml.title }
            if (-not $title -and $resp.Content) {
                $m = [regex]::Match($resp.Content, '<title>(.*?)</title>', 'IgnoreCase')
                if ($m.Success) { $title = $m.Groups[1].Value }
            }
        } catch { $title = $null }
        $statusCode = if ($resp.StatusCode) { [int]$resp.StatusCode } elseif ($resp.BaseResponse) { [int]$resp.BaseResponse.StatusCode } else { 0 }
        $pageTest = [PSCustomObject]@{ Url = $currentUrl; StatusCode = $statusCode; Error = ''; LoadMs = $sw.ElapsedMilliseconds; Title = $title }
    } catch {
        $status = 0
        if ($_.Exception.Response -and $_.Exception.Response.StatusCode) { try { $status = [int]$_.Exception.Response.StatusCode } catch { $status = 0 } }
        $pageTest = [PSCustomObject]@{ Url = $currentUrl; StatusCode = $status; Error = $_.Exception.Message; LoadMs = 0; Title = '' }
    }
    $pageResults.Add($pageTest) | Out-Null

    # Si ok, extraer enlaces y recursos
    if ($resp -and $pageTest.StatusCode -ge 200 -and $pageTest.StatusCode -lt 400) {
        $pair = Extract-LinksAndAssets -response $resp -currentUrl $currentUrl
        $links = $pair[0]
        $assets = $pair[1]

        # Enqueue nuevos internos
        if ($depth -lt $MaxDepth) {
            foreach ($lnk in $links) {
                if ((Is-InternalUrl $lnk $baseHost) -and (Should-QueueAsPage $lnk)) {
                    $k = $lnk.TrimEnd('/').ToLowerInvariant()
                    if (-not $visited.Contains($k)) { $queue.Enqueue(@($lnk, $depth + 1)) }
                }
            }
        }

        # Verificar assets (mismo host o absolutos)
        foreach ($asset in $assets | Select-Object -Unique) {
            try {
                $ar = Invoke-HttpWithRetry -Uri $asset -Method Head -TimeoutSec $RequestTimeoutSec
                $sc = if ($ar.StatusCode) { [int]$ar.StatusCode } elseif ($ar.BaseResponse) { [int]$ar.BaseResponse.StatusCode } else { 0 }
                if ($sc -ge 400) {
                    $brokenAssets.Add([PSCustomObject]@{ FromUrl = $currentUrl; AssetUrl = $asset; StatusCode = $sc; Error = '' }) | Out-Null
                }
            } catch {
                $sc = 0
                if ($_.Exception.Response -and $_.Exception.Response.StatusCode) { try { $sc = [int]$_.Exception.Response.StatusCode } catch { $sc = 0 } }
                $brokenAssets.Add([PSCustomObject]@{ FromUrl = $currentUrl; AssetUrl = $asset; StatusCode = $sc; Error = $_.Exception.Message }) | Out-Null
            }
        }

        # Verificar enlaces internos rotos rápidamente con HEAD
        foreach ($lnk in ($links | Select-Object -Unique)) {
            if (-not (Is-InternalUrl $lnk $baseHost)) { continue }
            try {
                $lr = Invoke-HttpWithRetry -Uri $lnk -Method Head -TimeoutSec $RequestTimeoutSec
                $sc = if ($lr.StatusCode) { [int]$lr.StatusCode } elseif ($lr.BaseResponse) { [int]$lr.BaseResponse.StatusCode } else { 0 }
                if ($sc -ge 400) { $brokenLinks.Add([PSCustomObject]@{ FromUrl = $currentUrl; LinkUrl = $lnk; StatusCode = $sc; Error = '' }) | Out-Null }
            } catch {
                $sc = 0
                if ($_.Exception.Response -and $_.Exception.Response.StatusCode) { try { $sc = [int]$_.Exception.Response.StatusCode } catch { $sc = 0 } }
                $brokenLinks.Add([PSCustomObject]@{ FromUrl = $currentUrl; LinkUrl = $lnk; StatusCode = $sc; Error = $_.Exception.Message }) | Out-Null
            }
        }
    }
}

# Salida CSV
$pagesCsv = Join-Path $runDir 'pages.csv'
$brokenLinksCsv = Join-Path $runDir 'broken_links.csv'
$brokenAssetsCsv = Join-Path $runDir 'broken_assets.csv'
$pageResults | Export-Csv -NoTypeInformation -Encoding UTF8 -Path $pagesCsv
$brokenLinks | Export-Csv -NoTypeInformation -Encoding UTF8 -Path $brokenLinksCsv
$brokenAssets | Export-Csv -NoTypeInformation -Encoding UTF8 -Path $brokenAssetsCsv

# Prueba de formulario de contacto (opcional)
$contactCsv = Join-Path $runDir 'contact_form.csv'
$contactResult = $null
if ($TestContactForm.IsPresent) {
    Write-Info "Probando formulario de contacto: $ContactPath"
    $contactResult = Test-ContactFormSubmission -baseUrl $BaseUrl -contactPath $ContactPath -timeoutSec $RequestTimeoutSec
    @($contactResult) | Export-Csv -NoTypeInformation -Encoding UTF8 -Path $contactCsv
}

# Reporte HTML simple
$okCount = (@($pageResults | Where-Object { $_.StatusCode -ge 200 -and $_.StatusCode -lt 400 })).Count
$errCount = (@($pageResults | Where-Object { $_.StatusCode -ge 400 })).Count
$assetErr = $brokenAssets.Count
$linkErr = $brokenLinks.Count
if ($contactResult -eq $null) { $contactResult = [PSCustomObject]@{ Performed = $false; StatusCode = 0; Error = ''; RedirectUrl = ''; ElapsedMs = 0 } }
$_contactOk = ($contactResult.Performed -and $contactResult.StatusCode -gt 0 -and $contactResult.StatusCode -lt 400)

$html = @"
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Reporte de Pruebas Funcionales</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 24px; }
    h1 { font-size: 20px; }
    .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
    .card { border: 1px solid #ddd; padding: 12px; border-radius: 6px; }
    table { border-collapse: collapse; width: 100%; margin-top: 16px; }
    th, td { text-align: left; padding: 6px 8px; border-bottom: 1px solid #eee; }
    th { background: #fafafa; }
    .muted { color: #666; }
  </style>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="robots" content="noindex, nofollow" />
  <meta name="generated" content="$(HtmlEncode $timestamp)" />
  <meta name="base-url" content="$(HtmlEncode $BaseUrl)" />
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self' data: https:; style-src 'self' 'unsafe-inline';" />
  <script>/* no-op */</script>
  <!-- Nota: reporte estático generado por site_smoke_tests.ps1 -->
</head>
<body>
  <h1>Reporte de Pruebas Funcionales</h1>
  <p class="muted">Base: $(HtmlEncode $BaseUrl) · Fecha: $(HtmlEncode (Get-Date))</p>
  <div class="grid">
    <div class="card"><strong>Páginas OK</strong><div>$okCount</div></div>
    <div class="card"><strong>Páginas con error</strong><div>$errCount</div></div>
    <div class="card"><strong>Enlaces rotos</strong><div>$linkErr</div></div>
    <div class="card"><strong>Assets rotos</strong><div>$assetErr</div></div>
  </div>
  <h2>Prueba de formulario de contacto</h2>
  <table>
    <thead><tr><th>Ejecutada</th><th>Status</th><th>Redirect</th><th>Error</th><th>ms</th></tr></thead>
    <tbody>
      <tr><td>$(if($contactResult.Performed){'Sí'}else{'No'})</td><td>$($contactResult.StatusCode)</td><td>$(HtmlEncode ($contactResult.RedirectUrl))</td><td>$(HtmlEncode ($contactResult.Error))</td><td>$($contactResult.ElapsedMs)</td></tr>
    </tbody>
  </table>
  <h2>Top páginas con error</h2>
  <table>
    <thead><tr><th>URL</th><th>Status</th><th>Error</th></tr></thead>
    <tbody>
"@

foreach ($row in ($pageResults | Where-Object { $_.StatusCode -ge 400 } | Select-Object -First 50)) {
    $html += "    <tr><td><a href='$($row.Url)'>$(HtmlEncode ($row.Url))</a></td><td>$($row.StatusCode)</td><td>$(HtmlEncode ($row.Error))</td></tr>" + [Environment]::NewLine
}

$html += @"
    </tbody>
  </table>
  <p>Archivos CSV: <code>pages.csv</code>, <code>broken_links.csv</code>, <code>broken_assets.csv</code></p>
</body>
</html>
"@

[IO.File]::WriteAllText((Join-Path $runDir 'report.html'), $html, [Text.Encoding]::UTF8)

Write-Info "Listo. Reportes en: $runDir"


