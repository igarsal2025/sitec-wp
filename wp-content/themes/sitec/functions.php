<?php
add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('sitec-style', get_stylesheet_uri(), [], '0.1.0');
	$css = get_stylesheet_directory_uri() . '/assets/css/main.css';
	wp_enqueue_style('sitec-main', $css, ['sitec-style'], '0.1.0');
});

add_action('after_setup_theme', function(){
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
	register_nav_menus([
		'primary' => __('Primary Menu','sitec'),
		'footer'  => __('Footer Menu','sitec')
	]);
});

// Cargar archivos del tema
require_once get_stylesheet_directory() . '/inc/cpt.php';
if ( file_exists( get_stylesheet_directory() . '/inc/acf.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/acf.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/integrations.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/integrations.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/consent.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/consent.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/seo.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/seo.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/contact-handler.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/contact-handler.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/security.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/security.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/seed.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/seed.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/settings.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/settings.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/smtp.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/smtp.php';
}
if ( file_exists( get_stylesheet_directory() . '/inc/robots.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/robots.php';
}

// Flush rewrite al activar el tema
add_action('after_switch_theme', function(){
	flush_rewrite_rules();
});


