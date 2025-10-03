<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-200">
	<div class="mx-auto max-w-7xl px-4 h-16 flex items-center justify-between">
		<a class="font-semibold" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
		<nav class="hidden md:block"><?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_class'=>'flex gap-6']); ?></nav>
		<a class="ml-4 inline-flex items-center justify-center rounded-md bg-emerald-500 px-4 py-2 text-white hover:bg-emerald-600" href="<?php echo esc_url( get_permalink( get_page_by_path('contacto') ) ?: home_url('/#contacto') ); ?>">Diagnóstico</a>
	</div>
</header>


