<?php get_header(); ?>
<main id="home">
<?php
// Siempre usar secciones del tema (ignorar bloques del editor)
	$front_id = (int) get_option('page_on_front');
	$show_hero = true;
	$show_differentiators = true;
	$show_services = true;
	$show_cases = true;
	$show_testimonials = true;
	$show_blog = true;
	$show_partners = true;
	if ( function_exists('get_field') ) {
		// Solo sobrescribe si el metadato existe en la portada; si no, conserva el valor por defecto
		if ($front_id && metadata_exists('post', $front_id, 'show_hero')) {
			$show_hero = (bool) get_field('show_hero', $front_id);
		}
		if ($front_id && metadata_exists('post', $front_id, 'show_differentiators')) {
			$show_differentiators = (bool) get_field('show_differentiators', $front_id);
		}
		if ($front_id && metadata_exists('post', $front_id, 'show_services')) {
			$show_services = (bool) get_field('show_services', $front_id);
		}
		if ($front_id && metadata_exists('post', $front_id, 'show_cases')) {
			$show_cases = (bool) get_field('show_cases', $front_id);
		}
		if ($front_id && metadata_exists('post', $front_id, 'show_testimonials')) {
			$show_testimonials = (bool) get_field('show_testimonials', $front_id);
		}
		if ($front_id && metadata_exists('post', $front_id, 'show_blog')) {
			$show_blog = (bool) get_field('show_blog', $front_id);
		}
		if ($front_id && metadata_exists('post', $front_id, 'show_partners')) {
			$show_partners = (bool) get_field('show_partners', $front_id);
		}
	}
	if ($show_hero) get_template_part('template-parts/home/hero');
	if ($show_differentiators) get_template_part('template-parts/home/differentiators');
	if ($show_partners) get_template_part('template-parts/home/partners');
	if ($show_services) get_template_part('template-parts/home/services');
	if ($show_cases) get_template_part('template-parts/home/cases');
	if ($show_testimonials) get_template_part('template-parts/home/testimonials');
	if ($show_blog) get_template_part('template-parts/home/blog');
?>
</main>
<?php get_footer(); ?>


