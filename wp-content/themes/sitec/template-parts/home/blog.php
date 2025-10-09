<?php
$count = 3;
if ( function_exists('get_field') ) {
    $c = (int) get_field('count_posts', get_option('page_on_front'));
    if ($c > 0) { $count = $c; }
}
$orderby = 'date';
$order = 'DESC';
$category_ids = [];
if ( function_exists('get_field') ) {
    $ob = trim((string) get_field('posts_orderby', get_option('page_on_front')));
    if ($ob !== '') { $orderby = $ob; }
    $od = trim((string) get_field('posts_order', get_option('page_on_front')));
    if (in_array($od, ['ASC','DESC'], true)) { $order = $od; }
    $raw_terms = get_field('posts_categories', get_option('page_on_front'));
    if (!empty($raw_terms)) {
        $category_ids = array_values(array_filter(array_map('intval', (array) $raw_terms)));
    }
}
$args = [
    'post_type' => 'post',
    'posts_per_page' => $count,
    'orderby' => $orderby,
    'order' => $order,
];
// Orden por meta si se define meta_key
if ( function_exists('get_field') ) {
    $meta_key = trim((string) get_field('posts_meta_key', get_option('page_on_front')));
    if ($meta_key !== '') {
        $args['meta_key'] = $meta_key;
        $args['orderby'] = 'meta_value';
    }
}
if (!empty($category_ids)) {
    $args['category__in'] = $category_ids;
}
$q = new WP_Query($args);
?>
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4">
        <?php
        $blog_heading = 'Insights / Blog';
        if ( function_exists('get_field') ) {
        	$custom = trim((string) get_field('blog_heading', get_option('page_on_front')));
        	if ($custom !== '') { $blog_heading = $custom; }
        }
        ?>
        <h2 class="text-2xl md:text-3xl font-semibold"><?php echo esc_html($blog_heading); ?></h2>
		<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
			<?php if ($q->have_posts()): while ($q->have_posts()): $q->the_post(); ?>
			<article class="rounded-xl border border-slate-200 p-6 shadow-sm">
				<?php if (has_post_thumbnail()) the_post_thumbnail('large', ['class' => 'w-full h-48 object-cover rounded-md']); ?>
				<h3 class="mt-4 font-semibold text-lg"><?php the_title(); ?></h3>
				<p class="mt-2 text-slate-600"><?php echo esc_html(get_the_excerpt()); ?></p>
				<a class="mt-4 inline-flex text-emerald-600 hover:text-emerald-700" href="<?php the_permalink(); ?>">Leer más</a>
			</article>
			<?php endwhile; wp_reset_postdata(); else: ?>
			<p class="text-slate-600">Pronto añadiremos artículos.</p>
			<?php endif; ?>
		</div>
	</div>
</section>


