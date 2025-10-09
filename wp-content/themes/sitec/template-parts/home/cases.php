<?php
$count = 6;
if ( function_exists('get_field') ) {
    $c = (int) get_field('count_cases', get_option('page_on_front'));
    if ($c > 0) { $count = $c; }
}
$orderby = 'date';
$order = 'DESC';
$sector_ids = [];
if ( function_exists('get_field') ) {
    $ob = trim((string) get_field('cases_orderby', get_option('page_on_front')));
    if ($ob !== '') { $orderby = $ob; }
    $od = trim((string) get_field('cases_order', get_option('page_on_front')));
    if (in_array($od, ['ASC','DESC'], true)) { $order = $od; }
    $raw_terms = get_field('cases_sector', get_option('page_on_front'));
    if (!empty($raw_terms)) {
        $sector_ids = array_values(array_filter(array_map('intval', (array) $raw_terms)));
    }
}
$args = [
    'post_type' => 'case_study',
    'posts_per_page' => $count,
    'orderby' => $orderby,
    'order' => $order,
];
// Orden por meta si se define meta_key
if ( function_exists('get_field') ) {
    $meta_key = trim((string) get_field('cases_meta_key', get_option('page_on_front')));
    if ($meta_key !== '') {
        $args['meta_key'] = $meta_key;
        $args['orderby'] = 'meta_value';
    }
}
if (!empty($sector_ids)) {
    $args['tax_query'] = [[
        'taxonomy' => 'sector',
        'field' => 'term_id',
        'terms' => $sector_ids,
    ]];
}
$q = new WP_Query($args);
?>
<section class="py-16 md:py-20" id="casos">
    <div class="mx-auto max-w-7xl px-4">
        <?php
        $cases_heading = 'Proyectos que Transforman Infraestructuras Críticas';
        if ( function_exists('get_field') ) {
        	$custom = trim((string) get_field('cases_heading', get_option('page_on_front')));
        	if ($custom !== '') { $cases_heading = $custom; }
        }
        ?>
        <h2 class="text-2xl md:text-3xl font-semibold"><?php echo esc_html($cases_heading); ?></h2>
		<div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php if ($q->have_posts()): while ($q->have_posts()): $q->the_post(); ?>
			<article class="rounded-xl border border-slate-200 p-6 shadow-sm">
				<?php if (has_post_thumbnail()) the_post_thumbnail('large', ['class' => 'w-full h-48 object-cover rounded-md']); ?>
				<h3 class="mt-4 font-semibold text-lg"><?php the_title(); ?></h3>
				<p class="mt-2 text-slate-600"><?php echo esc_html(get_the_excerpt()); ?></p>
				<a class="mt-4 inline-flex text-emerald-600 hover:text-emerald-700" href="<?php the_permalink(); ?>">Ver caso completo</a>
			</article>
			<?php endwhile; wp_reset_postdata(); else: ?>
			<p class="text-slate-600">Pronto añadiremos casos de éxito.</p>
			<?php endif; ?>
		</div>
		<div class="mt-8 text-center">
			<a href="<?php echo esc_url( get_post_type_archive_link('case_study') ?: home_url('/cases') ); ?>" class="inline-flex items-center justify-center rounded-md border border-slate-300 px-5 py-3 font-medium text-slate-700 hover:bg-slate-50">Descubra Más Casos de Éxito</a>
		</div>
	</div>
</section>


