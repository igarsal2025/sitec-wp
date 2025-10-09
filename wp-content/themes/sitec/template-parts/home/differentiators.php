<?php
$items = [];
// ACF: Diferenciadores desde la página de Inicio
if ( function_exists('have_rows') && function_exists('get_field') && have_rows('differentiators', get_option('page_on_front')) ) {
while ( have_rows('differentiators', get_option('page_on_front')) ) { the_row();
	$title = trim((string) get_sub_field('title'));
	$text  = trim((string) get_sub_field('text'));
	$icon  = get_sub_field('icon');
	$icon_url = is_array($icon) && !empty($icon['url']) ? $icon['url'] : '';
	if ($title !== '' || $text !== '' || $icon_url !== '') {
		$items[] = [ 'title' => $title, 'text' => $text, 'icon' => $icon_url ];
	}
}
}
// Fallback por defecto si no hay datos en ACF
if (empty($items)) {
	$items = [
		[
			'title' => 'Expertise Comprobado en Proyectos Nacionales',
			'text' => 'Implementaciones con Guardia Nacional, confianza de SEDENA e INE, +500 proyectos y 98% satisfacción.'
		],
		[
			'title' => 'Soluciones Integrales de Extremo a Extremo',
			'text' => 'Seguridad + telecom + energía con un solo proveedor. Hasta 40% menos costos y 30% menor tiempo de implementación.'
		],
		[
			'title' => 'Tecnología de Clase Mundial',
			'text' => 'Partner Oficial AXIS. Equipamiento certificado, garantía extendida y sistemas 5G-ready escalables.'
		],
		[
			'title' => 'Soporte 24/7 y Mantenimiento Preventivo',
			'text' => 'Centro de monitoreo 365 días, atención <4h en sitio y SLA 99.5% uptime.'
		],
	];
}
?>
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-4">
        <?php
        $heading = 'Por Qué Elegir SITEC: La Ventaja Competitiva';
        if ( function_exists('get_field') ) {
        	$custom = trim((string) get_field('differentiators_heading', get_option('page_on_front')));
        	if ($custom !== '') { $heading = $custom; }
        }
        ?>
        <h2 class="text-2xl md:text-3xl font-semibold"><?php echo esc_html($heading); ?></h2>
		<div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
			<?php foreach ($items as $item): ?>
            <div class="rounded-xl border border-slate-200 p-6 shadow-sm">
                <?php if (!empty($item['icon'])): ?>
                <img src="<?php echo esc_url($item['icon']); ?>" alt="" class="mb-3 h-10 w-10 object-contain" />
                <?php endif; ?>
				<h3 class="font-semibold"><?php echo esc_html($item['title']); ?></h3>
				<p class="mt-2 text-slate-600"><?php echo esc_html($item['text']); ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>


