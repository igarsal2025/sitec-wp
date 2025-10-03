<?php
add_action('admin_post_nopriv_sitec_contact_submit', 'sitec_handle_contact');
add_action('admin_post_sitec_contact_submit', 'sitec_handle_contact');

function sitec_handle_contact() {
	if ( ! isset($_POST['sitec_contact_nonce']) || ! wp_verify_nonce($_POST['sitec_contact_nonce'], 'sitec_contact') ) {
		wp_die(__('Nonce inválido', 'sitec'));
	}

	// reCAPTCHA v3 opcional
	$site_key = trim((string) get_option('recaptcha_site_key'));
	$secret   = trim((string) get_option('recaptcha_secret_key'));
	if ($site_key && $secret && !empty($_POST['g-recaptcha-response'])) {
		$resp = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
			'body' => [ 'secret' => $secret, 'response' => sanitize_text_field($_POST['g-recaptcha-response']) ]
		]);
		$ok = false;
		if (!is_wp_error($resp)) {
			$data = json_decode(wp_remote_retrieve_body($resp), true);
			$ok = !empty($data['success']);
		}
		if (!$ok) wp_die(__('Fallo en la validación reCAPTCHA', 'sitec'));
	}

	$name    = sanitize_text_field($_POST['name'] ?? '');
	$email   = sanitize_email($_POST['email'] ?? '');
	$phone   = sanitize_text_field($_POST['phone'] ?? '');
	$company = sanitize_text_field($_POST['company'] ?? '');
	$sector  = sanitize_text_field($_POST['sector'] ?? '');
	$interest= isset($_POST['interest']) && is_array($_POST['interest']) ? array_map('sanitize_text_field', $_POST['interest']) : [];
	$budget  = sanitize_text_field($_POST['budget'] ?? '');
	$urgency = sanitize_text_field($_POST['urgency'] ?? '');
	$source  = sanitize_text_field($_POST['source'] ?? '');
	$message = sanitize_textarea_field($_POST['message'] ?? '');

	if (!$name || !$email || !$message) {
		wp_die(__('Faltan campos obligatorios', 'sitec'));
	}
	if ( empty($_POST['privacy']) ) {
		wp_die(__('Debe aceptar la política de privacidad', 'sitec'));
	}

	$to = get_option('admin_email');
	$subject = sprintf('[Contacto SITEC] %s', $name);
	$body = "Nombre: $name\nEmail: $email\nTeléfono: $phone\nEmpresa: $company\nSector: $sector\nInterés: ".implode(', ',$interest)."\nPresupuesto: $budget\nUrgencia: $urgency\nCómo nos conoció: $source\n\nMensaje:\n$message";
	$headers = [ 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email ];

	$attachments = [];
	if (!empty($_FILES['attachment']['name'])) {
		$allowed = ['pdf','doc','docx','xls','xlsx','png','jpg','jpeg','dwg','zip'];
		$ext = strtolower(pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION));
		if (!in_array($ext, $allowed, true)) {
			wp_die(__('Tipo de archivo no permitido', 'sitec'));
		}
		$upload = wp_handle_upload($_FILES['attachment'], ['test_form' => false]);
		if ( isset($upload['file']) ) {
			$attachments[] = $upload['file'];
		}
	}

	wp_mail($to, $subject, $body, $headers, $attachments);
	wp_safe_redirect( wp_get_referer() ?: home_url('/') );
	exit;
}


