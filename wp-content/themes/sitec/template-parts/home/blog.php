<?php
$q = new WP_Query([
	'post_type' => 'post',
	'posts_per_page' => 3,
]);
?>
<section class="py-16 md:py-20">
	<div class="mx-auto max-w-7xl px-4">
		<h2 class="text-2xl md:text-3xl font-semibold">Insights / Blog</h2>
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


