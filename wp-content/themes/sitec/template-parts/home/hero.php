<?php
$kpis = [];
if ( function_exists('have_rows') && function_exists('get_field') && have_rows('kpis', get_option('page_on_front')) ) {
	while ( have_rows('kpis', get_option('page_on_front')) ) { the_row();
		$label = trim((string) get_sub_field('label'));
		if ($label !== '') { $kpis[] = $label; }
	}
}
if (empty($kpis)) { $kpis = ['60% ahorro', '99.9% uptime', '+500 proyectos']; }
// ACF: título, párrafo y CTAs del Hero
$front_id = (int) get_option('page_on_front');
$hero_title = '';
$hero_text = '';
$cta1_label = '';
$cta1_url = '';
$cta2_label = '';
$cta2_url = '';
if ( function_exists('get_field') ) {
	$hero_title = trim((string) get_field('hero_title', $front_id));
	$hero_text = trim((string) get_field('hero_text', $front_id));
	$cta1_label = trim((string) get_field('hero_cta_primary_label', $front_id));
	$cta1_url = trim((string) get_field('hero_cta_primary_url', $front_id));
	$cta2_label = trim((string) get_field('hero_cta_secondary_label', $front_id));
	$cta2_url = trim((string) get_field('hero_cta_secondary_url', $front_id));
}
// Imagen del hero (opcional)
$hero_image = null;
if ( function_exists('get_field') ) {
	$img = get_field('hero_image', $front_id);
	if ( is_array($img) && !empty($img['url']) ) {
		$hero_image = $img;
	}
}
// Estilo del overlay (color/opacidad)
$overlay_color = '#0f172a';
$overlay_opacity = 0.85; // 85%
if ( function_exists('get_field') ) {
	$color = trim((string) get_field('hero_overlay_color', $front_id));
	$opacity = get_field('hero_overlay_opacity', $front_id);
	if ($color !== '') { $overlay_color = $color; }
	if (is_numeric($opacity)) { $overlay_opacity = max(0, min(100, (float)$opacity)) / 100.0; }
}
// Convertir color hex a rgba con opacidad
function sitec_hex_to_rgba($hex, $alpha){
	$hex = str_replace('#','',$hex);
	if (strlen($hex)===3){ $r=hexdec(str_repeat(substr($hex,0,1),2)); $g=hexdec(str_repeat(substr($hex,1,1),2)); $b=hexdec(str_repeat(substr($hex,2,1),2)); }
	else { $r=hexdec(substr($hex,0,2)); $g=hexdec(substr($hex,2,2)); $b=hexdec(substr($hex,4,2)); }
	$alpha = is_numeric($alpha) ? $alpha : 0.85;
	return 'rgba('.$r.','.$g.','.$b.','.$alpha.')';
}
$overlay_rgba = sitec_hex_to_rgba($overlay_color, $overlay_opacity);
// Opciones de alineación, altura e imagen
$alignment = 'left';
$height = 'normal';
$img_fit = 'cover';
$img_position = 'center';
if ( function_exists('get_field') ) {
	$al = trim((string) get_field('hero_alignment', $front_id));
	$ht = trim((string) get_field('hero_height', $front_id));
	$fit = trim((string) get_field('hero_img_fit', $front_id));
	$pos = trim((string) get_field('hero_img_position', $front_id));
	if ($al !== '') { $alignment = $al; }
	if ($ht !== '') { $height = $ht; }
	if ($fit !== '') { $img_fit = $fit; }
	if ($pos !== '') { $img_position = $pos; }
}

$padding_y = 'py-20 md:py-28';
if ($height === 'compact') { $padding_y = 'py-10 md:py-16'; }
elseif ($height === 'wide') { $padding_y = 'py-28 md:py-40'; }

$text_align = $alignment === 'center' ? 'text-center' : '';
?>
<section class="relative overflow-hidden bg-slate-900 text-white">
    <div class="absolute inset-0" style="background: linear-gradient(135deg, <?php echo esc_attr($overlay_rgba); ?>, rgba(0,0,0,0.4) 70%, transparent);"></div>
    <div class="relative mx-auto max-w-7xl px-4 <?php echo esc_attr($padding_y); ?>">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <div class="md:col-span-7 <?php echo esc_attr($text_align); ?>">
				<h1 class="text-3xl md:text-5xl font-bold leading-tight">
					<?php echo esc_html($hero_title !== '' ? $hero_title : 'Ingeniería que Conecta y Protege a México'); ?>
				</h1>
				<p class="mt-4 text-slate-200 md:text-lg">
					<?php echo esc_html($hero_text !== '' ? $hero_text : 'Más de 20 años transformando infraestructuras críticas con tecnología de vanguardia. Soluciones integrales en seguridad, telecomunicaciones y energía respaldadas por proyectos con Guardia Nacional, SEDENA e INE.'); ?>
				</p>
				<div class="mt-6 flex flex-col sm:flex-row gap-3">
					<?php
					$default_cta1_label = 'Consultoría Gratuita';
					$default_cta1_url = (string) ( get_permalink( get_page_by_path('contacto') ) ?: home_url('/contacto') );
					$default_cta2_label = 'Ver Proyectos Destacados';
					$default_cta2_url = (string) ( get_post_type_archive_link('case_study') ?: home_url('/cases') );
					$cta1_label_out = $cta1_label !== '' ? $cta1_label : $default_cta1_label;
					$cta1_url_out = $cta1_url !== '' ? $cta1_url : $default_cta1_url;
					$cta2_label_out = $cta2_label !== '' ? $cta2_label : $default_cta2_label;
					$cta2_url_out = $cta2_url !== '' ? $cta2_url : $default_cta2_url;
					?>
					<a href="<?php echo esc_url( $cta1_url_out ); ?>" class="inline-flex items-center justify-center rounded-md bg-emerald-500 px-5 py-3 font-medium text-white hover:bg-emerald-600"><?php echo esc_html( $cta1_label_out ); ?></a>
					<a href="<?php echo esc_url( $cta2_url_out ); ?>" class="inline-flex items-center justify-center rounded-md border border-white/30 px-5 py-3 font-medium text-white hover:bg-white/10"><?php echo esc_html( $cta2_label_out ); ?></a>
				</div>
			</div>
            <div class="md:col-span-5">
                <?php if ($hero_image): ?>
                    <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt'] ?? ''); ?>" class="w-full h-48 md:h-72 rounded-xl shadow-xl object-<?php echo esc_attr($img_fit); ?> object-<?php echo esc_attr($img_position); ?>" />
                <?php else: ?>
                    <div class="grid grid-cols-3 gap-3 md:gap-4">
						<?php foreach ($kpis as $kpi): ?>
						<div class="rounded-lg bg-white/10 px-3 py-3 text-center text-sm md:text-base"><?php echo esc_html($kpi); ?></div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


