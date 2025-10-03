<?php
// Headers de seguridad básicos desde PHP (complemento al servidor)
add_action('send_headers', function(){
	header('X-Content-Type-Options: nosniff');
	header('X-Frame-Options: SAMEORIGIN');
	header('Referrer-Policy: strict-origin-when-cross-origin');
	// HSTS solo si HTTPS
	if ( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) ) {
		header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
	}
	// CSP mínima (ajustar si se rompe algo)
	$policy = "default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com https://client.crisp.chat https://embed.tawk.to; connect-src 'self' https://region1.google-analytics.com https://client.crisp.chat https://embed.tawk.to; img-src 'self' data: https://www.googletagmanager.com https://static.crisp.chat; style-src 'self' 'unsafe-inline'; frame-src https://www.googletagmanager.com https://tawk.to https://embed.tawk.to;";
	header('Content-Security-Policy: ' . $policy);
});


