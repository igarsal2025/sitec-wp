<?php
// Página de ajustes SITEC: IDs, Tracking, SMTP, reCAPTCHA

add_action('admin_menu', function(){
	add_options_page(
		__('Ajustes SITEC', 'sitec'),
		__('Ajustes SITEC', 'sitec'),
		'manage_options',
		'sitec-settings',
		'sitec_render_settings_page'
	);
});

add_action('admin_init', function(){
	$opts = [
		'gtm_container_id',
		'crisp_website_id', 'tawk_property_id', 'tawk_widget_id', 'sitec_wa_phone',
		'google_site_verification',
		'smtp_host','smtp_port','smtp_secure','smtp_user','smtp_pass','smtp_from','smtp_from_name',
		'recaptcha_site_key','recaptcha_secret_key'
	];
	foreach ($opts as $opt) {
		register_setting('sitec_settings', $opt, [ 'type' => 'string', 'sanitize_callback' => 'sanitize_text_field' ]);
	}

	add_settings_section('sitec_ids', __('IDs e Integraciones', 'sitec'), '__return_false', 'sitec-settings');
	$fields_ids = [
		['gtm_container_id','GTM Container ID (GTM-XXXXXXX)'],
		['crisp_website_id','Crisp Website ID'],
		['tawk_property_id','Tawk Property ID'],
		['tawk_widget_id','Tawk Widget ID'],
		['sitec_wa_phone','WhatsApp Business (solo dígitos, e.g. 5215555555555)'],
		['google_site_verification','Google Site Verification (Search Console)']
	];
	foreach ($fields_ids as [$name,$label]) {
		add_settings_field($name, esc_html($label), function() use ($name){ sitec_text_field($name); }, 'sitec-settings', 'sitec_ids');
	}

	add_settings_section('sitec_smtp', __('SMTP', 'sitec'), '__return_false', 'sitec-settings');
	$fields_smtp = [
		['smtp_host','SMTP Host'],
		['smtp_port','SMTP Port'],
		['smtp_secure','SMTP Secure (tls/ssl)'],
		['smtp_user','SMTP User'],
		['smtp_pass','SMTP Pass (se guarda en texto plano)'],
		['smtp_from','From Email'],
		['smtp_from_name','From Name']
	];
	foreach ($fields_smtp as [$name,$label]) {
		add_settings_field($name, esc_html($label), function() use ($name){ sitec_text_field($name, strpos($name,'pass')!==false ? 'password':'text'); }, 'sitec-settings', 'sitec_smtp');
	}

	add_settings_section('sitec_recaptcha', __('reCAPTCHA v3', 'sitec'), '__return_false', 'sitec-settings');
	$fields_rc = [
		['recaptcha_site_key','Site Key'],
		['recaptcha_secret_key','Secret Key']
	];
	foreach ($fields_rc as [$name,$label]) {
		add_settings_field($name, esc_html($label), function() use ($name){ sitec_text_field($name); }, 'sitec-settings', 'sitec_recaptcha');
	}
});

function sitec_text_field($name, $type='text'){
	$value = esc_attr( get_option($name,'') );
	echo '<input type="'.$type.'" name="'.$name.'" id="'.$name.'" class="regular-text" value="'.$value.'" />';
}

function sitec_render_settings_page(){
	if (!current_user_can('manage_options')) return;
	?>
	<div class="wrap">
		<h1><?php esc_html_e('Ajustes SITEC','sitec'); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields('sitec_settings'); ?>
			<?php do_settings_sections('sitec-settings'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}


