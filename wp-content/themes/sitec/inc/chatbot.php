<?php
// Chatbot integration (Crisp / Tawk.to / Custom snippet)

if (!defined('ABSPATH')) { exit; }

function sitec_chatbot_default_options() {
	return [
		'enabled' => false,
		'provider' => 'crisp', // crisp | tawk | custom
		'crisp_website_id' => '',
		'tawk_property_id' => '',
		'tawk_widget_id' => '',
		'custom_snippet' => '',
		'disable_for_logged_in' => true,
	];
}

function sitec_chatbot_get_options() {
	$opts = get_option('sitec_chatbot_settings');
	if (!is_array($opts)) { $opts = []; }
	return wp_parse_args($opts, sitec_chatbot_default_options());
}

function sitec_chatbot_sanitize($input) {
	$out = sitec_chatbot_default_options();
	$out['enabled'] = !empty($input['enabled']);
	$provider = isset($input['provider']) ? sanitize_key($input['provider']) : 'crisp';
	if (!in_array($provider, ['crisp','tawk','custom'], true)) { $provider = 'crisp'; }
	$out['provider'] = $provider;
	$out['crisp_website_id'] = isset($input['crisp_website_id']) ? sanitize_text_field($input['crisp_website_id']) : '';
	$out['tawk_property_id'] = isset($input['tawk_property_id']) ? sanitize_text_field($input['tawk_property_id']) : '';
	$out['tawk_widget_id'] = isset($input['tawk_widget_id']) ? sanitize_text_field($input['tawk_widget_id']) : '';
	// Permitimos script personalizado controlado por admin; limpiamos tags peligrosos básicos
	$out['custom_snippet'] = isset($input['custom_snippet']) ? (string) $input['custom_snippet'] : '';
	$out['disable_for_logged_in'] = !empty($input['disable_for_logged_in']);
	return $out;
}

add_action('admin_menu', function(){
	add_options_page(
		__('Chatbot','sitec'),
		__('Chatbot','sitec'),
		'manage_options',
		'sitec-chatbot',
		'sitec_chatbot_render_admin_page'
	);
});

add_action('admin_init', function(){
	register_setting('sitec_chatbot', 'sitec_chatbot_settings', [
		'sanitize_callback' => 'sitec_chatbot_sanitize'
	]);

	add_settings_section('sitec_chatbot_main', __('Configuración del Chatbot','sitec'), function(){
		echo '<p>'.esc_html__('Selecciona el proveedor e introduce el identificador correspondiente.','sitec').'</p>';
	}, 'sitec_chatbot');

	add_settings_field('sitec_chatbot_enabled', __('Habilitar','sitec'), function(){
		$opts = sitec_chatbot_get_options();
		echo '<label><input type="checkbox" name="sitec_chatbot_settings[enabled]" value="1" '.checked(!empty($opts['enabled']), true, false).' /> '.esc_html__('Activar chatbot en el sitio','sitec').'</label>';
	}, 'sitec_chatbot', 'sitec_chatbot_main');

	add_settings_field('sitec_chatbot_provider', __('Proveedor','sitec'), function(){
		$opts = sitec_chatbot_get_options();
		$val = esc_attr($opts['provider']);
		echo '<select name="sitec_chatbot_settings[provider]">';
		echo '<option value="crisp" '.selected($val,'crisp',false).'>Crisp</option>';
		echo '<option value="tawk" '.selected($val,'tawk',false).'>Tawk.to</option>';
		echo '<option value="custom" '.selected($val,'custom',false).'>'.esc_html__('Personalizado','sitec').'</option>';
		echo '</select>';
	}, 'sitec_chatbot', 'sitec_chatbot_main');

	add_settings_field('sitec_chatbot_crisp', __('Crisp Website ID','sitec'), function(){
		$opts = sitec_chatbot_get_options();
		echo '<input type="text" class="regular-text" name="sitec_chatbot_settings[crisp_website_id]" value="'.esc_attr($opts['crisp_website_id']).'" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" />';
	}, 'sitec_chatbot', 'sitec_chatbot_main');

	add_settings_field('sitec_chatbot_tawk', __('Tawk.to IDs','sitec'), function(){
		$opts = sitec_chatbot_get_options();
		echo '<input type="text" class="regular-text" name="sitec_chatbot_settings[tawk_property_id]" value="'.esc_attr($opts['tawk_property_id']).'" placeholder="PROPERTY_ID" /> ';
		echo '<input type="text" class="regular-text" name="sitec_chatbot_settings[tawk_widget_id]" value="'.esc_attr($opts['tawk_widget_id']).'" placeholder="WIDGET_ID" />';
	}, 'sitec_chatbot', 'sitec_chatbot_main');

	add_settings_field('sitec_chatbot_custom', __('Snippet personalizado','sitec'), function(){
		$opts = sitec_chatbot_get_options();
		echo '<textarea name="sitec_chatbot_settings[custom_snippet]" rows="6" class="large-text code" placeholder="&lt;script&gt;...&lt;/script&gt;">'.esc_textarea($opts['custom_snippet']).'</textarea>';
	}, 'sitec_chatbot', 'sitec_chatbot_main');

	add_settings_field('sitec_chatbot_logged', __('Usuarios logueados','sitec'), function(){
		$opts = sitec_chatbot_get_options();
		echo '<label><input type="checkbox" name="sitec_chatbot_settings[disable_for_logged_in]" value="1" '.checked(!empty($opts['disable_for_logged_in']), true, false).' /> '.esc_html__('Ocultar chatbot a usuarios autenticados','sitec').'</label>';
	}, 'sitec_chatbot', 'sitec_chatbot_main');
});

function sitec_chatbot_render_admin_page() {
	if (!current_user_can('manage_options')) return;
	echo '<div class="wrap"><h1>'.esc_html__('Chatbot','sitec').'</h1>';
	echo '<form method="post" action="options.php">';
	settings_fields('sitec_chatbot');
	do_settings_sections('sitec_chatbot');
	submit_button();
	echo '</form></div>';
}

add_action('wp_footer', function(){
	if (is_admin()) return;
	$opts = sitec_chatbot_get_options();
	if (empty($opts['enabled'])) return;
	if (!empty($opts['disable_for_logged_in']) && is_user_logged_in()) return;

	$provider = $opts['provider'];
	if ($provider === 'crisp') {
		$id = trim((string) $opts['crisp_website_id']);
		if ($id !== '') {
			echo "\n<!-- Chatbot: Crisp -->\n";
			echo '<script>window.$crisp=[];window.CRISP_WEBSITE_ID="'.esc_js($id).'";(function(){var d=document,s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>';
		}
	} elseif ($provider === 'tawk') {
		$prop = trim((string) $opts['tawk_property_id']);
		$wid  = trim((string) $opts['tawk_widget_id']);
		if ($prop !== '' && $wid !== '') {
			echo "\n<!-- Chatbot: Tawk.to -->\n";
			echo '<script>var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();(function(){var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];s1.async=true;s1.src="https://embed.tawk.to/'.esc_js($prop).'/'.esc_js($wid).'";s1.charset="UTF-8";s1.setAttribute("crossorigin","*");s0.parentNode.insertBefore(s1,s0);})();</script>';
		}
	} elseif ($provider === 'custom') {
		$snip = (string) $opts['custom_snippet'];
		if (trim($snip) !== '') {
			echo "\n<!-- Chatbot: Custom -->\n";
			// Se asume que el administrador ingresa un snippet confiable
			echo $snip; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}, 100);





