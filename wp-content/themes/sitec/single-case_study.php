<?php get_header(); ?>
<main id="single-case" class="py-16 md:py-20">
	<div class="mx-auto max-w-7xl px-4">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('prose prose-slate max-w-none'); ?>>
			<header class="mb-8">
				<h1 class="text-3xl md:text-4xl font-bold leading-tight"><?php the_title(); ?></h1>
				<div class="mt-2 text-slate-600 text-sm">
					<?php $terms = get_the_terms(get_the_ID(), 'sector');
					if ( $terms && ! is_wp_error($terms) ) {
						$names = wp_list_pluck($terms, 'name');
						echo esc_html( implode(', ', $names) );
					} elseif ( function_exists('get_field') ) {
						echo esc_html( (string) get_field('sector_text') );
					}
					?>
				</div>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mt-6"><?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?></div>
				<?php endif; ?>
			</header>
			<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
				<div class="lg:col-span-2 entry-content">
					<?php the_content(); ?>
					<?php if ( function_exists('have_rows') && have_rows('results') ) : ?>
						<h2 class="mt-10">Resultados</h2>
						<ul class="mt-4 list-disc pl-6">
							<?php while ( have_rows('results') ) : the_row(); $item = trim((string) get_sub_field('item')); if ($item): ?>
							<li><?php echo esc_html($item); ?></li>
							<?php endif; endwhile; ?>
						</ul>
					<?php endif; ?>
				</div>
				<aside class="lg:col-span-1">
					<?php if ( function_exists('have_rows') && have_rows('images') ) : ?>
						<div class="grid grid-cols-2 gap-3">
							<?php while ( have_rows('images') ) : the_row(); $img = get_sub_field('image'); if ($img): ?>
								<img class="w-full h-32 object-cover rounded-md" src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt'] ?? ''); ?>">
							<?php endif; endwhile; ?>
						</div>
					<?php endif; ?>
				</aside>
			</div>
		</article>
		<?php endwhile; endif; ?>
	</div>
</main>
<?php get_footer(); ?>


