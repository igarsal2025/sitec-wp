<?php
$front_id = (int) get_option('page_on_front');
$partners = [];
// 1) Leer desde CPT 'partner' si existe
if ( post_type_exists('partner') ) {
	$count = 12; $orderby = 'menu_order'; $order = 'ASC';
	if ( function_exists('get_field') ) {
		$c = (int) get_field('count_partners', $front_id); if ($c > 0) { $count = $c; }
		$ob = trim((string) get_field('partners_orderby', $front_id)); if ($ob !== '') { $orderby = $ob; }
		$od = trim((string) get_field('partners_order', $front_id)); if (in_array($od, ['ASC','DESC'], true)) { $order = $od; }
	}
	$q = new WP_Query([
		'post_type' => 'partner',
		'posts_per_page' => $count,
		'orderby' => $orderby,
		'order' => $order,
		'no_found_rows' => true,
		'ignore_sticky_posts' => true,
	]);
	if ($q->have_posts()) {
		while ($q->have_posts()) { $q->the_post();
			$logo = get_the_post_thumbnail_url(get_the_ID(), 'medium');
			$name = get_the_title();
			$url  = function_exists('get_field') ? trim((string) get_field('website_url', get_the_ID())) : '';
			if ($logo || $name) { $partners[] = [ 'name' => $name, 'url' => $url, 'logo' => (string) $logo ]; }
		}
		wp_reset_postdata();
	}
}
// 2) ACF lista manual (si no hay CPT)
if ( empty($partners) && function_exists('have_rows') && function_exists('get_field') && $front_id && have_rows('partners', $front_id) ) {
	while ( have_rows('partners', $front_id) ) { the_row();
		$name = trim((string) get_sub_field('name'));
		$url  = trim((string) get_sub_field('url'));
		$logo = get_sub_field('logo');
		$logo_url = is_array($logo) && !empty($logo['url']) ? $logo['url'] : '';
		if ($logo_url !== '' || $name !== '') {
			$partners[] = [ 'name' => $name, 'url' => $url, 'logo' => $logo_url ];
		}
	}
}
// Fallback de ejemplo si no hay datos cargados en ACF
if (empty($partners)) {
	$partners = [
		// Primero: UNV y Bosch
		['name' => 'UNV (Uniview)', 'url' => '', 'logo' => 'https://via.placeholder.com/200x60?text=UNV'],
		['name' => 'Bosch', 'url' => '', 'logo' => 'https://via.placeholder.com/200x60?text=Bosch'],
		// Marcas principales
		['name' => 'AXIS Communications', 'url' => 'https://www.axis.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/33/Axis_Communications_logo.svg'],
		['name' => 'Cisco', 'url' => 'https://www.cisco.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/64/Cisco_logo_blue_2016.svg'],
		['name' => 'Ubiquiti', 'url' => 'https://www.ui.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/8/8a/Ubiquiti_Networks_logo_2015.svg'],
		['name' => 'Panduit', 'url' => 'https://www.panduit.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/a/a1/Panduit_logo.svg'],
		['name' => 'Fluke Networks', 'url' => 'https://www.flukenetworks.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/8/8d/Fluke_logo.svg'],
		['name' => 'Hikvision', 'url' => 'https://www.hikvision.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Hikvision_logo.svg'],
		['name' => 'Dahua', 'url' => 'https://www.dahuasecurity.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/1/17/Dahua_Technology_logo.svg'],
		['name' => 'MikroTik', 'url' => 'https://mikrotik.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/1/1a/MikroTik_logo.svg'],
		['name' => 'APC by Schneider', 'url' => 'https://www.apc.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/1/15/APC_logo.svg'],
		['name' => 'Eaton', 'url' => 'https://www.eaton.com/', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/6/66/Eaton_Corporation_logo.svg'],
		// Al final: placeholders restantes
		['name' => 'Hytera', 'url' => '', 'logo' => 'https://via.placeholder.com/200x60?text=Hytera'],
		['name' => 'EPCOM', 'url' => '', 'logo' => 'https://via.placeholder.com/200x60?text=EPCOM'],
	];
}
?>
<?php if (!empty($partners)): ?>
<section class="py-10 md:py-12 bg-slate-50">
	<div class="mx-auto max-w-7xl px-4">
		<?php
		$heading = 'Marcas y Socios';
		if ( function_exists('get_field') ) {
			$custom = trim((string) get_field('partners_heading', $front_id));
			if ($custom !== '') { $heading = $custom; }
		}
		?>
		<h2 class="text-center text-sm font-semibold tracking-wider text-slate-500">
			<?php echo esc_html($heading); ?>
		</h2>
		<div class="sitec-partners-slider relative mt-6" data-autoplay="true" data-interval="3000">
			<div class="overflow-hidden">
				<div class="sitec-partners-track flex gap-6 items-center snap-x snap-mandatory scroll-smooth overflow-x-auto no-scrollbar" tabindex="0" role="list">
					<?php foreach ($partners as $p): ?>
						<div class="sitec-partners-slide flex-none w-1/2 sm:w-1/3 md:w-1/5 lg:w-1/6 snap-center" role="listitem">
							<div class="flex items-center justify-center">
								<?php if (!empty($p['url'])): ?>
									<a href="<?php echo esc_url($p['url']); ?>" target="_blank" rel="noopener noreferrer" class="opacity-70 hover:opacity-100 transition" aria-label="<?php echo esc_attr($p['name']); ?>">
										<?php if (!empty($p['logo'])): ?>
											<img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['name']); ?>" class="h-10 w-auto object-contain" />
										<?php else: ?>
											<span class="text-slate-600 text-sm"><?php echo esc_html($p['name']); ?></span>
										<?php endif; ?>
									</a>
								<?php else: ?>
									<?php if (!empty($p['logo'])): ?>
										<img src="<?php echo esc_url($p['logo']); ?>" alt="<?php echo esc_attr($p['name']); ?>" class="h-10 w-auto object-contain opacity-80" />
									<?php else: ?>
										<span class="text-slate-600 text-sm"><?php echo esc_html($p['name']); ?></span>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<button class="sitec-partners-prev absolute left-0 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white shadow border border-slate-200 hidden sm:inline-flex" aria-label="Anterior">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L8.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/></svg>
			</button>
			<button class="sitec-partners-next absolute right-0 top-1/2 -translate-y-1/2 p-2 rounded-full bg-white shadow border border-slate-200 hidden sm:inline-flex" aria-label="Siguiente">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 4.293a1 1 0 011.414 0L13.707 9.293a1 1 0 010 1.414L8.707 15.707a1 1 0 01-1.414-1.414L11.586 10 7.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
			</button>
		</div>
	</div>
</section>
<?php endif; ?>


