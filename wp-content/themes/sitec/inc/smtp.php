<?php
// Configurar PHPMailer desde Ajustes SITEC
add_action('phpmailer_init', function($phpmailer){
	$host = trim((string) get_option('smtp_host'));
	$port = intval(get_option('smtp_port'));
	$secure = trim((string) get_option('smtp_secure'));
	$user = trim((string) get_option('smtp_user'));
	$pass = trim((string) get_option('smtp_pass'));
	$from = trim((string) get_option('smtp_from')) ?: get_option('admin_email');
	$from_name = trim((string) get_option('smtp_from_name')) ?: get_bloginfo('name');
	if (!$host || !$user || !$pass || !$port) return;
	$phpmailer->isSMTP();
	$phpmailer->Host = $host;
	$phpmailer->Port = $port ?: 587;
	$phpmailer->SMTPAuth = true;
	$phpmailer->Username = $user;
	$phpmailer->Password = $pass;
	$phpmailer->SMTPSecure = in_array($secure, ['ssl','tls'], true) ? $secure : 'tls';
	$phpmailer->setFrom($from, $from_name);
});


