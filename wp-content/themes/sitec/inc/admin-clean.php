<?php
// Limpieza de consola en admin: desregistrar assets de Kubio fuera de sus pantallas
add_action('admin_enqueue_scripts', function(){
	if ( ! is_admin() ) return;
	if ( ! function_exists('get_current_screen') ) return;
	$screen = get_current_screen();
	// Si estamos en pantallas propias del plugin Kubio, no tocar
	$blocklist = [ 'kubio', 'kubio_page', 'toplevel_page_kubio' ];
	foreach ($blocklist as $slug) {
		if ( $screen && ( false !== strpos((string) $screen->id, $slug) ) ) {
			return;
		}
	}

	global $wp_scripts, $wp_styles;
	if ( $wp_scripts && is_array($wp_scripts->queue) ) {
		foreach ( (array) $wp_scripts->queue as $handle ) {
			if ( false !== strpos($handle, 'kubio') ) {
				wp_dequeue_script($handle);
				wp_deregister_script($handle);
			}
		}
	}
	if ( $wp_styles && is_array($wp_styles->queue) ) {
		foreach ( (array) $wp_styles->queue as $handle ) {
			if ( false !== strpos($handle, 'kubio') ) {
				wp_dequeue_style($handle);
				wp_deregister_style($handle);
			}
		}
	}
}, 100);


