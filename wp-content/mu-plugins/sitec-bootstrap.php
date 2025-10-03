<?php
/*
Plugin Name: SITEC Bootstrap
Description: Activa tema, crea páginas base, activa homepage y permalinks en primera carga.
*/

add_action('admin_init', function(){
	if (!current_user_can('manage_options')) return;
	$done = get_option('sitec_bootstrap_done');
	if ($done) return;

	// Activar tema sitec si existe
	$theme = 'sitec';
	$themes = wp_get_themes();
	if (isset($themes[$theme])) {
		switch_theme($theme);
	}

	// Crear páginas base si faltan
	$home = get_page_by_title('Inicio');
	if (!$home) {
		$home_id = wp_insert_post(['post_title'=>'Inicio','post_type'=>'page','post_status'=>'publish']);
		if (!is_wp_error($home_id)) { update_option('page_on_front', $home_id); update_option('show_on_front','page'); }
	}

	// Fijar estructura de permalinks
	if (get_option('permalink_structure') !== '/%postname%/') {
		update_option('permalink_structure','/%postname%/');
		flush_rewrite_rules();
	}

	update_option('sitec_bootstrap_done', 1);
});


