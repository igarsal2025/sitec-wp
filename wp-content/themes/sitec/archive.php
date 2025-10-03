<?php get_header(); ?>
<main id="archive" class="py-16 md:py-20">
	<div class="mx-auto max-w-7xl px-4">
		<header class="mb-8">
			<h1 class="text-3xl font-semibold"><?php the_archive_title(); ?></h1>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="mt-2 text-slate-600"><?php the_archive_description(); ?></div>
			<?php endif; ?>
		</header>
		<?php if ( have_posts() ) : ?>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class('rounded-xl border border-slate-200 p-6 shadow-sm'); ?>>
				<?php if ( has_post_thumbnail() ) the_post_thumbnail('large', ['class' => 'w-full h-48 object-cover rounded-md']); ?>
				<h2 class="mt-4 font-semibold text-lg"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<p class="mt-2 text-slate-600"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<a class="mt-4 inline-flex text-emerald-600 hover:text-emerald-700" href="<?php the_permalink(); ?>">Leer más</a>
			</article>
			<?php endwhile; ?>
		</div>
		<div class="mt-8"><?php the_posts_pagination(); ?></div>
		<?php else: ?>
		<p class="text-slate-600">No hay publicaciones aún.</p>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>


