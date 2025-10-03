<?php
/**
 * Integraciones: GTM (GA4 vía contenedor) y Chat (Crisp/Tawk)
 * Lectura de IDs por: constante, opción WP, o ACF Options (si existe).
 */

function sitec_get_option_value($keys) {
	foreach ($keys as $key) {
		if (defined($key) && constant($key)) {
			return constant($key);
		}
	}
	// Intentar leer desde opciones de WP
	foreach ($keys as $key) {
		$opt = get_option(strtolower($key));
		if (!empty($opt)) return $opt;
	}
	// Intentar ACF options
	if (function_exists('get_field')) {
		foreach ($keys as $key) {
			$val = get_field(strtolower($key), 'option');
			if (!empty($val)) return $val;
		}
	}
	return '';
}

// --- Google Tag Manager ---
function sitec_get_gtm_id() {
	$opt = sitec_get_option_value(['gtm_container_id','GTM_CONTAINER_ID', 'SITEc_GTM_ID', 'GTM_ID']);
	return $opt;
}

add_action('wp_head', function(){
	$gtm = sitec_get_gtm_id();
	if (!$gtm) return;
	// Respetar consentimiento si existe
	if ( function_exists('__return_false') ) {
		$consent = '';
		if ( isset($_COOKIE['sitec_consent']) ) { $consent = $_COOKIE['sitec_consent']; }
		if ( empty($consent) && isset($_SERVER['HTTP_DNT']) && $_SERVER['HTTP_DNT'] === '1' ) { return; }
		if ( $consent && $consent !== 'granted' ) { return; }
	}
	// Resource hints
	echo "<link rel=\"preconnect\" href=\"https://www.googletagmanager.com\" crossorigin>\n";
	echo "<link rel=\"dns-prefetch\" href=\"//www.googletagmanager.com\">\n";
	echo "\n<!-- Google Tag Manager -->\n";
	echo "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','" . esc_js($gtm) . "');</script>\n";
	echo "<!-- End Google Tag Manager -->\n";
}, 0);

add_action('wp_body_open', function(){
	$gtm = sitec_get_gtm_id();
	if (!$gtm) return;
	$consent = isset($_COOKIE['sitec_consent']) ? $_COOKIE['sitec_consent'] : '';
	if ($consent && $consent !== 'granted') return;
	echo "\n<!-- Google Tag Manager (noscript) -->\n";
	echo "<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=" . esc_attr($gtm) . "\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\n";
	echo "<!-- End Google Tag Manager (noscript) -->\n";
}, 0);

// --- Chat: Crisp ---
function sitec_get_crisp_id() {
	return sitec_get_option_value(['crisp_website_id','CRISP_WEBSITE_ID', 'SITEc_CRISP_ID']);
}

add_action('wp_footer', function(){
	$crisp = sitec_get_crisp_id();
	if (!$crisp) return;
	$consent = isset($_COOKIE['sitec_consent']) ? $_COOKIE['sitec_consent'] : '';
	if ($consent && $consent !== 'granted') return;
	// resource hints
	echo "<link rel=\"preconnect\" href=\"https://client.crisp.chat\" crossorigin>\n";
	echo "<link rel=\"dns-prefetch\" href=\"//client.crisp.chat\">\n";
	echo "\n<!-- Crisp Chat -->\n";
	echo "<script>window.$crisp=[];window.CRISP_WEBSITE_ID='" . esc_js($crisp) . "';(function(){var d=document;s=d.createElement('script');s.src='https://client.crisp.chat/l.js';s.async=1;d.getElementsByTagName('head')[0].appendChild(s);})();</script>\n";
	// Eventos hacia dataLayer
	echo "<script>window.dataLayer=window.dataLayer||[];window.$crisp=window.$crisp||[];window.$crisp.push(['on','chat:opened',function(){dataLayer.push({event:'chat_open'});}]);window.$crisp.push(['on','message:sent',function(){dataLayer.push({event:'chat_message_sent'});}]);window.$crisp.push(['on','session:survey:finished',function(){dataLayer.push({event:'chat_csatsubmitted'});}]);</script>\n";
	echo "<!-- /Crisp Chat -->\n";
}, 20);

// --- Chat: Tawk (opcional) ---

function sitec_get_tawk_ids() {
	$prop = sitec_get_option_value(['tawk_property_id','TAWK_PROPERTY_ID', 'SITEc_TAWK_PROPERTY']);
	$wid  = sitec_get_option_value(['tawk_widget_id','TAWK_WIDGET_ID', 'SITEc_TAWK_WIDGET']);
	return [$prop, $wid];
}

add_action('wp_footer', function(){
	list($prop, $wid) = sitec_get_tawk_ids();
	if (!$prop || !$wid) return;
	$consent = isset($_COOKIE['sitec_consent']) ? $_COOKIE['sitec_consent'] : '';
	if ($consent && $consent !== 'granted') return;
	// Si existen IDs de Tawk, lo cargamos (tendrá prioridad sobre Crisp si ambos existen por orden de hook)
	echo "\n<!-- Tawk.to -->\n";
	echo "<script type=\"text/javascript\">var Tawk_API=Tawk_API||{},Tawk_LoadStart=new Date();(function(){var s1=document.createElement('script'),s0=document.getElementsByTagName('script')[0];s1.async=true;s1.src='https://embed.tawk.to/" . esc_js($prop) . "/" . esc_js($wid) . "';s1.charset='UTF-8';s1.setAttribute('crossorigin','*');s0.parentNode.insertBefore(s1,s0);})();</script>\n";
	echo "<script>window.dataLayer=window.dataLayer||[];window.Tawk_API=window.Tawk_API||{};Tawk_API.onChatStarted=function(){dataLayer.push({event:'chat_open'});};Tawk_API.onChatMessageAgent=function(){dataLayer.push({event:'chat_message_sent'});};</script>\n";
	echo "<!-- /Tawk.to -->\n";
}, 19);

// Botón flotante WhatsApp (opcional)
function sitec_get_whatsapp_phone() {
	return sitec_get_option_value(['sitec_wa_phone','SITEc_WA_PHONE', 'WHATSAPP_PHONE']);
}

add_action('wp_footer', function(){
	$phone = preg_replace('/\D+/', '', sitec_get_whatsapp_phone());
	if (!$phone) return;
	$url = 'https://wa.me/' . $phone . '?text=' . rawurlencode('Hola, quiero información para mi proyecto inmobiliario.');
	echo '<a href="' . esc_url($url) . '" class="fixed bottom-4 right-4 z-50 rounded-full bg-emerald-500 text-white px-5 py-3 shadow-lg hover:bg-emerald-600">WhatsApp</a>';
}, 10);


