<?php
// Endpoint protegido por nonce para crear contenido demo
add_action('admin_init', function(){
	if (!current_user_can('manage_options')) return;
	if (!isset($_GET['sitec_seed'])) return;
	check_admin_referer('sitec_seed_action');

	// Helper: actualizar o crear por título
	$upsert = function($post_type, $title, $content = '', $excerpt = ''){
		$exists = get_page_by_title($title, OBJECT, $post_type);
		$args = [
			'post_title'   => $title,
			'post_type'    => $post_type,
			'post_status'  => 'publish',
			'post_content' => $content,
			'post_excerpt' => $excerpt ?: wp_trim_words(wp_strip_all_tags($content), 40, '…')
		];
		if ($exists && !is_wp_error($exists)) {
			$args['ID'] = $exists->ID;
			return wp_update_post($args);
		}
		return wp_insert_post($args);
	};

	// Crear páginas base si no existen
	$pages = [
		['title' => 'Inicio', 'template' => 'front-page.php', 'option' => 'page_on_front'],
		['title' => 'Nosotros', 'template' => 'page-about.php', 'content' =>
			"<h2>Más de 20 Años Construyendo el México Tecnológico del Futuro</h2>".
			"<p>SITEC S.A. de C.V. es una empresa mexicana líder en soluciones integrales de ingeniería, seguridad electrónica y telecomunicaciones. Desde 2003, hemos sido el socio tecnológico de confianza para instituciones gubernamentales y empresas privadas que requieren infraestructuras robustas y de clase mundial.</p>".
			"<h3>Misión</h3><p>Transformar desafíos tecnológicos en ventajas competitivas sostenibles mediante innovación, servicio excepcional y excelencia operativa.</p>".
			"<h3>Visión</h3><p>Ser el integrador tecnológico más confiable de México, reconocido por proyectos que establecen nuevos estándares de calidad, seguridad e innovación.</p>".
			"<h3>Valores</h3><ul><li>Excelencia Técnica</li><li>Integridad</li><li>Innovación</li><li>Compromiso</li><li>Responsabilidad Social</li></ul>".
			"<h3>Hitos</h3><ul>".
			"<li><strong>2003</strong>: Fundación en Chilpancingo, primeros proyectos eléctricos.</li>".
			"<li><strong>2008</strong>: Expansión a telecomunicaciones, certificación ISO 9001.</li>".
			"<li><strong>2012</strong>: Primeros proyectos gubernamentales; oficina CDMX.</li>".
			"<li><strong>2015</strong>: AXIS Solution Partner; proyectos a gran escala.</li>".
			"<li><strong>2018</strong>: Contrato SEDENA; centro de soporte 24/7.</li>".
			"<li><strong>2020</strong>: Soluciones con IA y data centers modulares.</li>".
			"<li><strong>2022–2023</strong>: Guardia Nacional (4 estados), INE (infraestructura electoral), AXIS Gold Partner.</li>".
			"<li><strong>2024–2025</strong>: 500+ proyectos, energía solar, IoT y ciudades inteligentes.</li></ul>".
			"<h3>Certificaciones y Membresías</h3><ul>".
			"<li>ISO 9001:2015, ISO 27001:2013</li><li>AXIS Solution Partner Gold, Cisco Registered</li><li>Panduit Certified Installer, Ubiquiti Elite</li><li>Fluke Networks CCTT, FIDE Instalador Certificado</li><li>CANIETI, CANITEC, Clúster de Seguridad EDOMEX</li></ul>".
			"<h3>Presencia Nacional</h3><p>15+ estados: Guerrero, CDMX, EDOMEX, Hidalgo, Jalisco, Zacatecas, Morelos, Michoacán, Puebla, Oaxaca, Veracruz, Querétaro, Guanajuato, Nuevo León, Baja California.</p>".
			"<h3>Métricas</h3><ul><li>500+ proyectos</li><li>100+ clientes activos</li><li>100+ colaboradores</li><li>98% satisfacción</li><li>99.5% SLA en mantenimiento</li><li>$450M+ MXN (2020–2024)</li></ul>"],
		['title' => 'Contacto', 'template' => 'page-contact.php', 'content' => "Conéctese con Nuestros Expertos: Su Proyecto Comienza Aquí\n\nRespuesta garantizada en menos de 2 horas hábiles. Consultoría inicial sin costo."],
	];
	foreach ($pages as $p) {
		$exists = get_page_by_title($p['title']);
		if (!$exists) {
			$id = wp_insert_post([
				'post_title' => $p['title'], 'post_type' => 'page', 'post_status' => 'publish', 'post_content' => ($p['content'] ?? '')
			]);
			if (!is_wp_error($id)) {
				if (!empty($p['template'])) update_post_meta($id, '_wp_page_template', $p['template']);
				if (!empty($p['option']) && $p['option'] === 'page_on_front') { update_option('page_on_front', $id); update_option('show_on_front', 'page'); }
			}
		} else {
			if (!empty($p['content'])) {
				wp_update_post(['ID' => $exists->ID, 'post_content' => $p['content']]);
			}
			if (!empty($p['template'])) update_post_meta($exists->ID, '_wp_page_template', $p['template']);
			if (!empty($p['option']) && $p['option'] === 'page_on_front') { update_option('page_on_front', $exists->ID); update_option('show_on_front', 'page'); }
		}
	}

	// Servicios con contenido extenso y títulos optimizados
	$service_entries = [
		[
			'old' => 'Seguridad Avanzada',
			'title' => 'Seguridad Inteligente con IA: Protección Proactiva 24/7',
			'content' =>
				"<p>Transformamos la seguridad reactiva en inteligencia predictiva. Sistemas basados en IA que analizan comportamientos, detectan anomalías y alertan antes de incidentes críticos. Tecnología AXIS + plataformas VMS de última generación.</p>".
				"<h3>Soluciones Detalladas</h3>".
				"<h4>1) Centros de Comando C4</h4><ul><li>Videowall 4K con múltiples fuentes</li><li>VMS profesional integrado</li><li>Analítica de video en tiempo real</li><li>Integración con sistemas de emergencia</li><li><strong>Desde:</strong> $850,000 MXN — <strong>Tiempo:</strong> 4–8 semanas</li></ul>".
				"<h4>2) Videovigilancia Inteligente</h4><ul><li>Cámaras AXIS con visión térmica (-40°C)</li><li>LPR 98% precisión</li><li>Intrusión perimetral</li><li>Almacenamiento híbrido (90 días)</li><li><strong>Desde:</strong> $3,500 MXN por cámara — <strong>Tiempo:</strong> 1–3 semanas</li></ul>".
				"<h4>3) Control de Acceso Biométrico</h4><ul><li>Facial touchless y huella ultrasónica</li><li>Integración con RH/nómina</li><li>Reportes asistencia</li><li><strong>Desde:</strong> $18,000 MXN por punto — <strong>Tiempo:</strong> 3–7 días</li></ul>".
				"<h4>4) Protección Perimetral</h4><ul><li>Sensores doble tecnología</li><li>Cerca eléctrica monitorizada</li><li>Integración con iluminación/sirenas</li><li><strong>Desde:</strong> $450 MXN por metro — <strong>Tiempo:</strong> 2–4 semanas</li></ul>".
				"<h4>5) Drones de Vigilancia IoT</h4><ul><li>Rutas programables</li><li>Cámara 4K nocturna</li><li>Detección térmica</li><li><strong>Desde:</strong> $180,000 MXN — <strong>Capacitación:</strong> 5 días</li></ul>".
				"<h4>6) Automatización de Edificios</h4><ul><li>Iluminación, HVAC, persianas</li><li>Sensores de ocupación</li><li>Integración Alexa/Google</li><li><strong>Desde:</strong> $85,000 MXN por piso — <strong>Tiempo:</strong> 2–3 semanas</li></ul>".
				"<h3>Certificaciones y Cumplimiento</h3><ul><li>ISO 9001:2015</li><li>AXIS Solution Partner Gold</li><li>NOM-001-SEDE</li></ul>",
			'cta' => ['Solicite su Cotización Personalizada', '/contacto']
		],
		[
			'old' => 'Telecomunicaciones y Redes',
			'title' => 'Conectividad de Nueva Generación: Infraestructura 5G-Ready',
			'content' =>
				"<p>Diseñamos e implementamos infraestructuras de red que soportan la transformación digital: del cableado certificado a enlaces inalámbricos de alta capacidad.</p>".
				"<h3>Soluciones Detalladas</h3>".
				"<h4>1) Cableado Estructurado</h4><ul><li>Cat 6A/7 hasta 10Gbps</li><li>Fibra MM/SM</li><li>Certificación Fluke</li><li>Garantía 25 años</li><li><strong>Desde:</strong> $280 MXN por punto</li></ul>".
				"<h4>2) Radiocomunicación Profesional</h4><ul><li>DMR/P25 analógico/digital</li><li>Encriptación</li><li><strong>Desde:</strong> $8,500 MXN por radio — <strong>Red:</strong> $450,000 MXN</li></ul>".
				"<h4>3) Redes WiFi Empresariales</h4><ul><li>APs Ubiquiti/Cisco alta densidad</li><li>Indoor/outdoor</li><li>Gestión en nube</li><li>Portal cautivo</li><li><strong>Desde:</strong> $12,000 MXN por AP — <strong>Tiempo:</strong> 1–2 semanas</li></ul>".
				"<h4>4) Enlaces Inalámbricos</h4><ul><li>PtP hasta 100km / PtMP</li><li>Mesh</li><li>Hasta 1.7Gbps</li><li><strong>Desde:</strong> $45,000 MXN — <strong>Tiempo:</strong> 3–5 días</li></ul>".
				"<h4>5) Rastreo de Flotillas</h4><ul><li>Monitoreo 24/7</li><li>Geocercas</li><li>Alertas</li><li><strong>Desde:</strong> $3,200 MXN + $450/mes</li></ul>".
				"<h4>6) Data Centers Modulares</h4><ul><li>Racks con PDU</li><li>Climatización precisión</li><li>UPS autonomía</li><li>Detección/supresión incendios</li><li><strong>Desde:</strong> $380,000 MXN (10 racks) — <strong>Tiempo:</strong> 4–6 semanas</li></ul>".
				"<h3>Certificaciones</h3><ul><li>Fluke Networks CCTT</li><li>Ubiquiti Elite</li><li>Panduit Certified</li></ul>",
			'cta' => ['Optimice su Red Hoy', '/contacto']
		],
		[
			'old' => 'Energía Sostenible',
			'title' => 'Energía Inteligente: Eficiencia que Reduce Costos Hasta 60%',
			'content' =>
				"<p>Proyectos de electrificación bajo NOM vigentes con enfoque en sostenibilidad y ahorro. Desde instalaciones industriales hasta sistemas solares con ROI garantizado.</p>".
				"<h3>Soluciones Detalladas</h3>".
				"<h4>1) Instalaciones Eléctricas Certificadas</h4><ul><li>NOM-001-SEDE-2012</li><li>Acometidas MT/BT</li><li>Tableros con protecciones</li><li>Tierra física certificada</li><li><strong>Desde:</strong> $850 MXN por salida</li></ul>".
				"<h4>2) Iluminación LED Inteligente</h4><ul><li>Retrofit a LED</li><li>Sensores y fotoceldas</li><li>Control DMX</li><li>Integración IoT</li><li><strong>Ahorro:</strong> hasta 75% — <strong>ROI:</strong> 18–24 meses — <strong>Desde:</strong> $1,800 por luminaria</li></ul>".
				"<h4>3) Iluminación Arquitectónica</h4><ul><li>RGB dinámico</li><li>Jardines/fuentes</li><li>Control DMX</li><li><strong>Desde:</strong> $650 por metro — <strong>Diseño:</strong> 1–2 semanas</li></ul>".
				"<h4>4) Sistemas Solares Fotovoltaicos</h4><ul><li>Paneles 400W+</li><li>Inversores híbridos</li><li>Estructuras certificadas</li><li>Monitoreo tiempo real</li><li><strong>Desde:</strong> $18,500 MXN/kWp — <strong>ROI:</strong> 4–6 años — <strong>Ahorro:</strong> 90–95%</li><li><strong>Garantías:</strong> 25 años paneles / 10 años inversores</li></ul>".
				"<h3>Beneficios Fiscales</h3><ul><li>Deducción inmediata 100% (solar)</li><li>Depreciación acelerada</li></ul>",
			'cta' => ['Calcule su Ahorro Solar', '/contacto']
		],
		[
			'old' => 'Consultoría Estratégica',
			'title' => 'Asesoría Estratégica: Su Socio en Transformación Tecnológica',
			'content' =>
				"<p>Planificamos, diseñamos y supervisamos proyectos tecnológicos complejos para maximizar retorno operativo y estratégico.</p>".
				"<h3>Servicios</h3>".
				"<h4>1) Auditoría y Diagnóstico</h4><ul><li>Evaluación de infraestructura</li><li>Vulnerabilidades</li><li>Roadmap priorizado</li><li><strong>Inversión:</strong> $35,000 MXN — <strong>Entregable:</strong> reporte ejecutivo</li></ul>".
				"<h4>2) Proyectos Llave en Mano</h4><ul><li>Ingeniería de detalle</li><li>Especificaciones</li><li>Presupuesto</li><li><strong>Inversión:</strong> 8–12% valor del proyecto — <strong>Tiempo:</strong> 2–4 semanas</li></ul>".
				"<h4>3) Gestión de Proyectos (PMO)</h4><ul><li>PM dedicado</li><li>Seguimiento semanal</li><li>Control de costos/tiempos</li><li>Gestión de cambios — <strong>Inversión:</strong> 10–15% valor</li></ul>".
				"<h4>4) Certificaciones y Cumplimiento</h4><ul><li>CFE, dictámenes, RETIE (si aplica)</li><li>Manuales O&M</li><li><strong>Desde:</strong> $25,000 MXN</li></ul>".
				"<h4>5) Capacitación Técnica</h4><ul><li>Operación y mantenimiento</li><li>Respuesta a incidentes</li><li>Certificaciones (AXIS, Cisco)</li><li><strong>Desde:</strong> $15,000 MXN (10 personas) — <strong>2–5 días</strong></li></ul>",
			'cta' => ['Programe su Consulta Gratuita de 45 Minutos', '/contacto']
		],
	];

	// Upsert servicios: intenta actualizar por título antiguo; si no existe, crea por el nuevo
	foreach ($service_entries as $svc) {
		$exists_old = get_page_by_title($svc['old'], OBJECT, 'service');
		$exists_new = get_page_by_title($svc['title'], OBJECT, 'service');
		if ($exists_old && !is_wp_error($exists_old)) {
			$id = wp_update_post(['ID'=>$exists_old->ID,'post_title'=>$svc['title'],'post_content'=>$svc['content'],'post_excerpt'=>wp_trim_words(wp_strip_all_tags($svc['content']), 40, '…')]);
		} elseif ($exists_new && !is_wp_error($exists_new)) {
			$id = wp_update_post(['ID'=>$exists_new->ID,'post_content'=>$svc['content'],'post_excerpt'=>wp_trim_words(wp_strip_all_tags($svc['content']), 40, '…')]);
		} else {
			$id = $upsert('service', $svc['title'], $svc['content']);
		}
		if (function_exists('update_field') && $id && !is_wp_error($id)) {
			@update_field('cta_label', $svc['cta'][0], $id);
			@update_field('cta_url', home_url($svc['cta'][1]), $id);
		}
	}

	// Casos demo
	// Casos con contenido extendido
	$case_entries = [
		[
			'title' => 'Guardia Nacional — Modernización de Infraestructura',
			'aliases' => ['Guardia Nacional'],
			'content' =>
				"<h2>Modernización de Infraestructura de Seguridad y Comunicaciones</h2>".
				"<p><strong>Cliente:</strong> Guardia Nacional (SSPC) — <strong>Sector:</strong> Seguridad Pública — <strong>Alcance:</strong> 4 estados (Guerrero, Hidalgo, Jalisco, Zacatecas) — <strong>Año:</strong> 2022–2023 — <strong>Inversión:</strong> $47.5M MXN</p>".
				"<h3>Desafío</h3><ul><li>Comunicaciones interrumpidas en operativos</li><li>Zonas sin cobertura de vigilancia</li><li>Capacitación deficiente</li><li>Enlaces poco confiables en zonas remotas</li></ul>".
				"<h3>Solución</h3><ol>".
				"<li><strong>Videovigilancia</strong>: 450+ cámaras AXIS con IA, LPR, intrusión, grabación 90 días y C4 por estado.</li>".
				"<li><strong>Red de Datos</strong>: 28km Cat6A, backbone de fibra, VSAT en 12 sedes, failover &lt;30s.</li>".
                "<li><strong>Aulas Inteligentes</strong>: 16 aulas con VC HD, pantallas 86&quot;, audio pro, e-learning.</li>".
				"<li><strong>Radiocomunicación</strong>: P25 cifrado, 280 radios portátiles + 64 móviles, 8 repetidoras.</li></ol>".
				"<h3>Resultados</h3><ul><li>30% menos tiempos de respuesta</li><li>99.7% uptime de red</li><li>100% cobertura en áreas críticas</li><li>Cero brechas perimetrales en 18 meses</li><li>500+ elementos capacitados</li><li>40% menos costos de mantenimiento</li></ul>".
				"<p><em>Testimonial:</em> “Integración superior y cumplimiento de plazos; capacidades operativas mejoradas.” — Cmdt. Roberto Martínez</p>",
		],
		[
			'title' => 'SEDENA — Control de Acceso Biométrico Santa Lucía',
			'aliases' => ['SEDENA Santa Lucía','SEDENA - BASE MILITAR SANTA LUCÍA'],
			'content' =>
				"<h2>Sistema Integral de Control de Acceso Biométrico</h2>".
				"<p><strong>Cliente:</strong> SEDENA — <strong>Ubicación:</strong> Base Aérea Militar Santa Lucía — <strong>Año:</strong> 2023 — <strong>Inversión:</strong> $12.8M MXN</p>".
				"<h3>Solución</h3><ul><li>24 torniquetes biométricos</li><li>Facial + huella + RFID</li><li>8 carriles vehiculares con LPR</li><li>Gestión central con backup</li><li>Integración con RH/nómina y alertas</li><li>Perimetral: 120 cámaras térmicas y visibles con IA</li></ul>".
				"<h3>Resultados</h3><ul><li>8,500 personas/día en ~4s</li><li>99.98% precisión biométrica</li><li>Cero accesos no autorizados (14 meses)</li><li>75% menos tiempo en reportes</li><li>Cumplimiento 100% protocolos</li></ul>".
				"<p><em>Testimonial:</em> “Opera 24/7 sin interrupciones y con estándares internacionales.” — Gral. Luis A. García</p>",
		],
		[
			'title' => 'INE — Infraestructura de Elecciones Digitales 2024',
			'aliases' => ['INE'],
			'content' =>
				"<h2>Red Segura para Proceso Electoral 2024</h2>".
				"<p><strong>Alcance:</strong> 15 estados — <strong>Año:</strong> 2023–2024 — <strong>Inversión:</strong> $28.3M MXN — <strong>Despliegue:</strong> 300 ubicaciones</p>".
				"<h3>Solución</h3><ul><li>Red modular con enlaces 4G/5G de respaldo y VPN segura</li><li>Monitoreo 24/7</li><li>Videovigilancia temporal y control de acceso</li><li>Data centers modulares (15)</li></ul>".
				"<h3>Resultados</h3><ul><li>100% disponibilidad en días críticos</li><li>Cero incidentes de seguridad</li><li>300 sitios en 45 días</li><li>98.5% transmisión exitosa</li></ul>",
		],
		// Mini-cards (resumen)
		['title'=>'Centro Comercial Plaza Milenium','aliases'=>[],'content'=>'<p>180 cámaras AXIS + LED + WiFi. <strong>45% menos incidentes</strong>, ROI 2.1 años.</p>'],
		['title'=>'Hospital General de Acapulco','aliases'=>[],'content'=>'<p>Electrificación + solar 150kWp + UPS. <strong>68% ahorro energético</strong>.</p>'],
		['title'=>'Universidad Tecnológica del Valle','aliases'=>[],'content'=>'<p>WiFi campus + acceso + CCTV. <strong>3,500 usuarios concurrentes</strong>, 99.5% uptime.</p>'],
		['title'=>'Hotel Fiesta Americana','aliases'=>[],'content'=>'<p>WiFi y seguridad (300 hab.). <strong>45% menos incidentes</strong>, 70% ahorro energético.</p>'],
	];

	foreach ($case_entries as $ce) {
		$found_id = 0;
		if (!empty($ce['aliases'])) {
			foreach ($ce['aliases'] as $al) {
				$ex = get_page_by_title($al, OBJECT, 'case_study');
				if ($ex && !is_wp_error($ex)) { $found_id = (int)$ex->ID; break; }
			}
		}
		if (!$found_id) {
			$ex2 = get_page_by_title($ce['title'], OBJECT, 'case_study');
			if ($ex2 && !is_wp_error($ex2)) { $found_id = (int)$ex2->ID; }
		}
		if ($found_id) {
			wp_update_post(['ID'=>$found_id,'post_title'=>$ce['title'],'post_content'=>$ce['content'],'post_excerpt'=>wp_trim_words(wp_strip_all_tags($ce['content']), 40, '…')]);
		} else {
			$upsert('case_study', $ce['title'], $ce['content']);
		}
	}

	// Testimonios demo
	$tests = [
		['Gerente de Operaciones, Hotel Cancún', '“El equipo de SITEC no solo implementó tecnología, sino que mejoró la experiencia de nuestros huéspedes. La conectividad y seguridad superaron expectativas.”'],
		['Administrador, Condominio CDMX', '“Gracias a SITEC, nuestro condominio redujo en un 35% los costos operativos y los residentes se sienten más seguros.”'],
		['Director, Plaza Milenium', '“Con SITEC logramos reducir incidentes en un 45% y mejorar la satisfacción de los clientes.”'],
	];
	foreach ($tests as $t) { $upsert('testimonial', $t[0], $t[1], $t[1]); }

	// Blog/Resources
	$blog_posts = [
		['Tendencias en Smart Buildings', 'Un resumen de las principales tendencias en edificios inteligentes para desarrolladores y hotelería.'],
		['Checklist de Energía Sostenible en Residenciales', 'Lista práctica para evaluar y mejorar la eficiencia energética en desarrollos residenciales.'],
	];
	foreach ($blog_posts as $bp) { $upsert('post', $bp[0], $bp[1], $bp[1]); }

    // KPIs Home (ACF repeater)
    if (function_exists('update_field')) {
        $front_id = (int) get_option('page_on_front');
        if ($front_id) {
            $kpis = [
                ['label' => '60% ahorro'],
                ['label' => '99.9% uptime'],
                ['label' => '+500 proyectos'],
            ];
            @update_field('kpis', $kpis, $front_id);
        }
    }

	// Menús (principal y footer)
	$locations = get_theme_mod('nav_menu_locations');
	if (!is_array($locations)) { $locations = []; }

	// Crear o tomar menús
	$primary_menu_id = 0; $footer_menu_id = 0;
	$primary_menu = wp_get_nav_menu_object('Principal');
	if (!$primary_menu) { $primary_menu_id = wp_create_nav_menu('Principal'); } else { $primary_menu_id = (int) $primary_menu->term_id; }
	$footer_menu = wp_get_nav_menu_object('Footer');
	if (!$footer_menu) { $footer_menu_id = wp_create_nav_menu('Footer'); } else { $footer_menu_id = (int) $footer_menu->term_id; }

	// Asignar ubicaciones si no están
	$locs = get_nav_menu_locations();
	if ( empty($locs['primary']) ) { $locs['primary'] = $primary_menu_id; }
	if ( empty($locs['footer']) )  { $locs['footer']  = $footer_menu_id; }
	set_theme_mod('nav_menu_locations', $locs);

	// Agregar ítems comunes
	function sitec_normalize_url($u){ $u = trailingslashit($u); return strtolower($u); }
	function sitec_seed_menu_item($menu_id, $title, $url) {
		if (!$menu_id) return;
		$items = wp_get_nav_menu_items($menu_id) ?: [];
		$u_new = sitec_normalize_url($url);
		foreach ($items as $it) {
			$u_old = sitec_normalize_url($it->url ?: '');
			if ($u_old === $u_new || trim(wp_strip_all_tags($it->title)) === trim($title)) {
				return; // ya existe
			}
		}
		wp_update_nav_menu_item($menu_id, 0, [
			'menu-item-title'  => $title,
			'menu-item-url'    => $url,
			'menu-item-status' => 'publish'
		]);
	}

	function sitec_dedupe_menu($menu_id){
		$items = wp_get_nav_menu_items($menu_id) ?: [];
		$seen = [];
		foreach ($items as $it) {
			$key = sitec_normalize_url($it->url ?: '') . '|' . trim(wp_strip_all_tags($it->title));
			if (isset($seen[$key])) {
				// eliminar duplicado
				wp_delete_post($it->ID, true);
			} else {
				$seen[$key] = true;
			}
		}
	}

	$home_id  = (int) get_option('page_on_front');
	$about    = get_page_by_title('Nosotros');
	$contact  = get_page_by_title('Contacto');
	$home_url = $home_id ? get_permalink($home_id) : home_url('/');
	$about_url = $about ? get_permalink($about) : home_url('/nosotros');
	$contact_url = $contact ? get_permalink($contact) : home_url('/contacto');

	// Ítems
	sitec_seed_menu_item($primary_menu_id, 'Inicio', $home_url);
	sitec_seed_menu_item($primary_menu_id, 'Servicios', home_url('/services'));
	sitec_seed_menu_item($primary_menu_id, 'Casos de Éxito', home_url('/cases'));
	sitec_seed_menu_item($primary_menu_id, 'Blog', home_url('/blog'));
	sitec_seed_menu_item($primary_menu_id, 'Nosotros', $about_url);
	sitec_seed_menu_item($primary_menu_id, 'Contacto', $contact_url);

	// Footer links
	sitec_seed_menu_item($footer_menu_id, 'Aviso de Privacidad', home_url('/privacy-policy'));
	sitec_seed_menu_item($footer_menu_id, 'Términos de Servicio', home_url('/terms'));
	sitec_seed_menu_item($footer_menu_id, 'Contacto', $contact_url);

	// Deduplicar por si el seed se ejecutó previamente
	sitec_dedupe_menu($primary_menu_id);
	sitec_dedupe_menu($footer_menu_id);

	wp_safe_redirect( admin_url('index.php?sitec_seed_done=1') );
	exit;
});

// Helper para sacar URL del seed con nonce
function sitec_get_seed_url(){
	return wp_nonce_url( admin_url('index.php?sitec_seed=1'), 'sitec_seed_action');
}

// Aviso en admin para ejecutar seeding si falta contenido
add_action('admin_notices', function(){
    if (!current_user_can('manage_options')) return;
    $url = esc_url( sitec_get_seed_url() );
    echo '<div class="notice notice-info"><p>Actualizar contenido real (Home, Servicios, Casos, Testimonios, Blog). <a class="button button-primary" href="'.$url.'">Aplicar contenido</a></p></div>';
});


