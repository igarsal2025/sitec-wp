<?php
$kpis = [];
if ( function_exists('have_rows') && function_exists('get_field') && have_rows('kpis', get_option('page_on_front')) ) {
	while ( have_rows('kpis', get_option('page_on_front')) ) { the_row();
		$label = trim((string) get_sub_field('label'));
		if ($label !== '') { $kpis[] = $label; }
	}
}
if (empty($kpis)) { $kpis = ['60% ahorro', '99.9% uptime', '+500 proyectos']; }
?>
<section class="relative overflow-hidden bg-slate-900 text-white">
	<div class="absolute inset-0 bg-gradient-to-tr from-slate-900 via-slate-800/70 to-transparent"></div>
	<div class="relative mx-auto max-w-7xl px-4 py-20 md:py-28">
		<div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
			<div class="md:col-span-7">
				<h1 class="text-3xl md:text-5xl font-bold leading-tight">
					Ingeniería que Conecta y Protege a México
				</h1>
				<p class="mt-4 text-slate-200 md:text-lg">
					Más de 20 años transformando infraestructuras críticas con tecnología de vanguardia. Soluciones integrales en seguridad, telecomunicaciones y energía respaldadas por proyectos con Guardia Nacional, SEDENA e INE.
				</p>
				<div class="mt-6 flex flex-col sm:flex-row gap-3">
					<a href="<?php echo esc_url( get_permalink( get_page_by_path('contacto') ) ?: home_url('/contacto') ); ?>" class="inline-flex items-center justify-center rounded-md bg-emerald-500 px-5 py-3 font-medium text-white hover:bg-emerald-600">Consultoría Gratuita</a>
					<a href="#casos" class="inline-flex items-center justify-center rounded-md border border-white/30 px-5 py-3 font-medium text-white hover:bg-white/10">Ver Proyectos Destacados</a>
				</div>
			</div>
			<div class="md:col-span-5">
				<div class="grid grid-cols-3 gap-3 md:gap-4">
					<?php foreach ($kpis as $kpi): ?>
					<div class="rounded-lg bg-white/10 px-3 py-3 text-center text-sm md:text-base"><?php echo esc_html($kpi); ?></div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>


