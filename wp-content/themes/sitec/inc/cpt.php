<?php

add_action('init', function () {
	// Services
	register_post_type('service', [
		'labels' => [
			'name' => __('Servicios', 'sitec'),
			'singular_name' => __('Servicio', 'sitec')
		],
		'public' => true,
		'has_archive' => true,
		'rewrite' => ['slug' => 'services'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-hammer',
		'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions']
	]);

	// Case Studies
	register_post_type('case_study', [
		'labels' => [
			'name' => __('Casos de Éxito', 'sitec'),
			'singular_name' => __('Caso de Éxito', 'sitec')
		],
		'public' => true,
		'has_archive' => true,
		'rewrite' => ['slug' => 'cases'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-chart-line',
		'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions']
	]);

	// Clients
	register_post_type('client', [
		'labels' => [
			'name' => __('Clientes', 'sitec'),
			'singular_name' => __('Cliente', 'sitec')
		],
		'public' => true,
		'has_archive' => true,
		'rewrite' => ['slug' => 'clients'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-groups',
		'supports' => ['title', 'editor', 'thumbnail', 'revisions']
	]);

	// Testimonials
	register_post_type('testimonial', [
		'labels' => [
			'name' => __('Testimonios', 'sitec'),
			'singular_name' => __('Testimonio', 'sitec')
		],
		'public' => true,
		'has_archive' => false,
		'rewrite' => ['slug' => 'testimonials'],
		'show_in_rest' => true,
		'menu_icon' => 'dashicons-format-quote',
		'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'revisions']
	]);

	// Taxonomy: Sector (for Case Studies and Clients)
	register_taxonomy('sector', ['case_study', 'client'], [
		'labels' => [
			'name' => __('Sectores', 'sitec'),
			'singular_name' => __('Sector', 'sitec')
		],
		'public' => true,
		'hierarchical' => false,
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'sector']
	]);
}, 0);


