<?php get_header(); ?>
<main id="single" class="py-16 md:py-20">
	<div class="mx-auto max-w-3xl px-4">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('prose prose-slate max-w-none'); ?>>
			<header class="mb-8">
				<h1 class="text-3xl md:text-4xl font-bold leading-tight"><?php the_title(); ?></h1>
				<p class="mt-2 text-slate-500 text-sm">Por <?php the_author(); ?> — <?php echo get_the_date(); ?></p>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="mt-6"><?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); ?></div>
				<?php endif; ?>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
		<?php endwhile; endif; ?>
	</div>
</main>
<?php get_footer(); ?>


