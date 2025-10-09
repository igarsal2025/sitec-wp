<?php
$count = 4;
if ( function_exists('get_field') ) {
    $c = (int) get_field('count_services', get_option('page_on_front'));
    if ($c > 0) { $count = $c; }
}
$orderby = 'date';
$order = 'DESC';
$include_ids = [];
if ( function_exists('get_field') ) {
    $ob = trim((string) get_field('services_orderby', get_option('page_on_front')));
    if ($ob !== '') { $orderby = $ob; }
    $od = trim((string) get_field('services_order', get_option('page_on_front')));
    if (in_array($od, ['ASC','DESC'], true)) { $order = $od; }
    $raw_ids = trim((string) get_field('services_include_ids', get_option('page_on_front')));
    if ($raw_ids !== '') {
        $parts = preg_split('/[\s,]+/', $raw_ids);
        $include_ids = array_values(array_filter(array_map('intval', $parts)));
    }
}
$args = [
    'post_type' => 'service',
    'posts_per_page' => $count,
    'orderby' => $orderby,
    'order' => $order,
];
// Orden por meta si se define meta_key
if ( function_exists('get_field') ) {
    $meta_key = trim((string) get_field('services_meta_key', get_option('page_on_front')));
    if ($meta_key !== '' && empty($include_ids)) {
        $args['meta_key'] = $meta_key;
        $args['orderby'] = 'meta_value';
    }
    $service_cat_ids = get_field('services_category', get_option('page_on_front'));
    if (!empty($service_cat_ids)) {
        $args['tax_query'] = [[
            'taxonomy' => 'service_category',
            'field' => 'term_id',
            'terms' => array_values(array_filter(array_map('intval', (array) $service_cat_ids)))
        ]];
    }
    // Filtro por sector
    $service_sector_ids = get_field('services_sector', get_option('page_on_front'));
    if (!empty($service_sector_ids)) {
        $args['tax_query'] = $args['tax_query'] ?? [];
        $args['tax_query'][] = [
            'taxonomy' => 'sector',
            'field' => 'term_id',
            'terms' => array_values(array_filter(array_map('intval', (array) $service_sector_ids)))
        ];
    }
    // Filtro por clientes relacionados
    $client_ids = get_field('services_clients', get_option('page_on_front'));
    if (!empty($client_ids)) {
        $client_ids = array_values(array_filter(array_map('intval', (array) $client_ids)));
        $args['meta_query'] = [[
            'key' => 'related_clients',
            'value' => $client_ids,
            'compare' => 'IN'
        ]];
    }
}
if (!empty($include_ids)) {
    $args['post__in'] = $include_ids;
    $args['orderby'] = 'post__in';
}
$q = new WP_Query($args);
?>
<section class="py-16 md:py-20" id="servicios">
    <div class="mx-auto max-w-7xl px-4">
        <?php
        $services_heading = 'Servicios';
        if ( function_exists('get_field') ) {
        	$custom = trim((string) get_field('services_heading', get_option('page_on_front')));
        	if ($custom !== '') { $services_heading = $custom; }
        }
        ?>
        <h2 class="text-2xl md:text-3xl font-semibold"><?php echo esc_html($services_heading); ?></h2>
		<div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
			<?php if ($q->have_posts()): while ($q->have_posts()): $q->the_post(); ?>
			<article class="rounded-xl border border-slate-200 p-6 shadow-sm">
				<?php if (has_post_thumbnail()) the_post_thumbnail('medium', ['class' => 'w-full h-40 object-cover rounded-md']); ?>
				<h3 class="mt-4 font-semibold text-lg"><?php the_title(); ?></h3>
				<p class="mt-2 text-slate-600"><?php echo esc_html(get_the_excerpt()); ?></p>
				<?php if ( function_exists('get_field') ):
					$related_clients = (array) get_field('related_clients');
					$related_clients = array_values(array_filter(array_map('intval', $related_clients)));
					if (!empty($related_clients)):
				?>
				<div class="mt-3 flex items-center gap-3">
					<?php
					foreach (array_slice($related_clients, 0, 3) as $client_id) {
						$logo_url = get_the_post_thumbnail_url($client_id, 'thumbnail');
						if ($logo_url) {
							echo '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr(get_the_title($client_id)) . '" class="h-8 w-auto rounded object-contain" />';
						}
					}
					?>
				</div>
				<?php endif; endif; ?>
				<a class="mt-4 inline-flex text-emerald-600 hover:text-emerald-700" href="<?php the_permalink(); ?>">Ver detalle</a>
			</article>
			<?php endwhile; wp_reset_postdata(); else: ?>
			<p class="text-slate-600">Pronto añadiremos nuestros servicios.</p>
			<?php endif; ?>
		</div>
	</div>
</section>


