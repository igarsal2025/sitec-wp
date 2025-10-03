<?php /* Template Name: Nosotros */ ?>
<?php get_header(); ?>
<main id="page-about" class="py-16 md:py-20">
	<div class="mx-auto max-w-7xl px-4">
		<header class="mb-10">
			<h1 class="text-3xl md:text-4xl font-bold leading-tight">Más de 20 Años Impulsando el Futuro Tecnológico de México</h1>
			<p class="mt-3 text-slate-600">En SITEC construimos tranquilidad y valor para tus desarrollos. +500 proyectos entregados, +100 clientes activos, 98% de satisfacción.</p>
		</header>
		<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
			<div class="rounded-xl border border-slate-200 p-6">
				<h2 class="font-semibold">Excelencia Técnica</h2>
				<p class="mt-2 text-slate-600">Soluciones robustas, escalables y con mejores prácticas.</p>
			</div>
			<div class="rounded-xl border border-slate-200 p-6">
				<h2 class="font-semibold">Integridad</h2>
				<p class="mt-2 text-slate-600">Transparencia, cumplimiento y servicio honesto.</p>
			</div>
			<div class="rounded-xl border border-slate-200 p-6">
				<h2 class="font-semibold">Innovación</h2>
				<p class="mt-2 text-slate-600">Tecnología al servicio del negocio con impacto real.</p>
			</div>
		</section>
		<section class="mt-10">
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		</section>
	</div>
</main>
<?php get_footer(); ?>


