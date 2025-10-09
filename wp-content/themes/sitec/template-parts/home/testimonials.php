<?php
$q = new WP_Query([
	'post_type' => 'testimonial',
	'posts_per_page' => 3,
]);
?>
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4">
        <?php
        $testimonials_heading = 'Testimonios';
        if ( function_exists('get_field') ) {
        	$custom = trim((string) get_field('testimonials_heading', get_option('page_on_front')));
        	if ($custom !== '') { $testimonials_heading = $custom; }
        }
        ?>
        <h2 class="text-2xl md:text-3xl font-semibold"><?php echo esc_html($testimonials_heading); ?></h2>
		<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
			<?php if ($q->have_posts()): while ($q->have_posts()): $q->the_post(); ?>
            <article class="rounded-xl border border-slate-200 p-6 shadow-sm">
                <?php if (function_exists('get_field')):
                $photo = get_field('photo');
                if (is_array($photo) && !empty($photo['url'])): ?>
                <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt'] ?? ''); ?>" class="mb-3 h-16 w-16 rounded-full object-cover" />
                <?php endif; endif; ?>
				<blockquote class="text-slate-700">“<?php echo esc_html(get_the_excerpt()); ?>”</blockquote>
				<p class="mt-4 font-semibold"><?php the_title(); ?></p>
				<?php if (function_exists('get_field')): ?>
				<p class="text-slate-500 text-sm"><?php echo esc_html(get_field('author_role')); ?> — <?php echo esc_html(get_field('company')); ?></p>
				<?php endif; ?>
			</article>
			<?php endwhile; wp_reset_postdata(); else: ?>
			<p class="text-slate-600">Pronto añadiremos testimonios.</p>
			<?php endif; ?>
		</div>
	</div>
</section>


