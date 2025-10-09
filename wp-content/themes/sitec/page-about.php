<?php /* Template Name: Nosotros */ ?>
<?php get_header(); ?>
<main id="page-about" class="py-16 md:py-20">
	<div class="mx-auto max-w-7xl px-4">
		<header class="mb-10">
			<?php
			$title = 'Más de 20 Años Impulsando el Futuro Tecnológico de México';
			$intro  = 'En SITEC construimos tranquilidad y valor para tus desarrollos. +500 proyectos entregados, +100 clientes activos, 98% de satisfacción.';
			if ( function_exists('get_field') ) {
				$custom_title = trim((string) get_field('about_title'));
				$custom_intro  = trim((string) get_field('about_intro'));
				if ($custom_title !== '') { $title = $custom_title; }
				if ($custom_intro !== '')  { $intro  = $custom_intro; }
			}
			?>
			<h1 class="text-3xl md:text-4xl font-bold leading-tight"><?php echo esc_html($title); ?></h1>
			<p class="mt-3 text-slate-600"><?php echo esc_html($intro); ?></p>

			<!-- Métricas destacadas -->
			<?php
			$metrics = null;
			if ( function_exists('have_rows') && have_rows('about_metrics') ) {
				$metrics = [];
				while ( have_rows('about_metrics') ) { the_row();
					$val = trim((string) get_sub_field('value'));
					$lab = trim((string) get_sub_field('label'));
					if ($val !== '' || $lab !== '') { $metrics[] = [$val,$lab]; }
				}
			}
			?>
			<div class="mt-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
				<?php if ($metrics): foreach ($metrics as [$v,$l]): ?>
				<div class="rounded-lg border border-slate-200 p-4 text-center">
					<p class="text-2xl font-bold"><?php echo esc_html($v ?: ''); ?></p>
					<p class="text-sm text-slate-600"><?php echo esc_html($l ?: ''); ?></p>
				</div>
				<?php endforeach; else: ?>
				<div class="rounded-lg border border-slate-200 p-4 text-center"><p class="text-2xl font-bold">500+</p><p class="text-sm text-slate-600">Proyectos</p></div>
				<div class="rounded-lg border border-slate-200 p-4 text-center"><p class="text-2xl font-bold">100+</p><p class="text-sm text-slate-600">Clientes activos</p></div>
				<div class="rounded-lg border border-slate-200 p-4 text-center"><p class="text-2xl font-bold">100+</p><p class="text-sm text-slate-600">Colaboradores</p></div>
				<div class="rounded-lg border border-slate-200 p-4 text-center"><p class="text-2xl font-bold">98%</p><p class="text-sm text-slate-600">Satisfacción</p></div>
				<div class="rounded-lg border border-slate-200 p-4 text-center"><p class="text-2xl font-bold">99.5%</p><p class="text-sm text-slate-600">SLA Mantenimiento</p></div>
				<div class="rounded-lg border border-slate-200 p-4 text-center"><p class="text-2xl font-bold">$450M+</p><p class="text-sm text-slate-600">MXN 2020–2024</p></div>
				<?php endif; ?>
			</div>
		</header>
		<section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
			<?php
			$values = null;
			if ( function_exists('have_rows') && have_rows('about_values') ) {
				$values = [];
				while ( have_rows('about_values') ) { the_row();
					$vt = trim((string) get_sub_field('title'));
					$vx = trim((string) get_sub_field('text'));
					if ($vt !== '' || $vx !== '') { $values[] = [$vt,$vx]; }
				}
			}
			?>
			<?php if ($values): foreach ($values as [$t,$x]): ?>
			<div class="rounded-xl border border-slate-200 p-6">
				<h2 class="font-semibold"><?php echo esc_html($t ?: ''); ?></h2>
				<p class="mt-2 text-slate-600"><?php echo esc_html($x ?: ''); ?></p>
			</div>
			<?php endforeach; else: ?>
			<div class="rounded-xl border border-slate-200 p-6"><h2 class="font-semibold">Excelencia Técnica</h2><p class="mt-2 text-slate-600">Soluciones robustas, escalables y con mejores prácticas.</p></div>
			<div class="rounded-xl border border-slate-200 p-6"><h2 class="font-semibold">Integridad</h2><p class="mt-2 text-slate-600">Transparencia, cumplimiento y servicio honesto.</p></div>
			<div class="rounded-xl border border-slate-200 p-6"><h2 class="font-semibold">Innovación</h2><p class="mt-2 text-slate-600">Tecnología al servicio del negocio con impacto real.</p></div>
			<div class="rounded-xl border border-slate-200 p-6"><h2 class="font-semibold">Compromiso</h2><p class="mt-2 text-slate-600">Acompañamiento total y cumplimiento en tiempos y calidad.</p></div>
			<div class="rounded-xl border border-slate-200 p-6"><h2 class="font-semibold">Responsabilidad Social</h2><p class="mt-2 text-slate-600">Impacto positivo y operación con ética y sostenibilidad.</p></div>
			<?php endif; ?>
		</section>
		<section class="mt-10 prose prose-slate max-w-none">
			<?php
			$about_body = '';
			if ( function_exists('get_field') ) {
				$about_body = (string) get_field('about_body');
			}
			if ($about_body !== '') {
				echo wp_kses_post($about_body);
			} else {
				while ( have_posts() ) : the_post(); the_content(); endwhile;
			}
			?>
		</section>
	</div>
</main>
<?php get_footer(); ?>


