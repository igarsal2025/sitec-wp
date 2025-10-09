<?php
// Importa contenido real proporcionado por el usuario a Servicios, Casos y Páginas
define('WP_USE_THEMES', false);
$wp_root = dirname(__DIR__);
require $wp_root . '/wp-load.php';

if (!function_exists('wp_insert_post')) {
    fwrite(STDERR, "No se cargó WordPress.\n");
    exit(1);
}

function sitec_upsert($post_type, $title, $content = '', $excerpt = '') {
    $exists = get_page_by_title($title, OBJECT, $post_type);
    $args = [
        'post_title'   => $title,
        'post_type'    => $post_type,
        'post_status'  => 'publish',
        'post_content' => $content,
        'post_excerpt' => $excerpt ?: wp_trim_words(wp_strip_all_tags($content), 40, '…'),
    ];
    if ($exists && !is_wp_error($exists)) {
        $args['ID'] = $exists->ID;
        return wp_update_post($args);
    }
    return wp_insert_post($args);
}

// ===================== Servicios =====================
$svc_telecom = <<<'HTML'
<h2>Conectividad de Nueva Generación</h2>
<p>Diseñamos e implementamos infraestructuras de red que soportan la transformación digital, desde WiFi de alta densidad hasta enlaces punto a punto de largo alcance.</p>
<h3>3) Redes WiFi Empresariales</h3>
<ul>
  <li>Access Points Ubiquiti/Cisco de alta densidad</li>
  <li>Cobertura indoor/outdoor</li>
  <li>Gestión centralizada en la nube</li>
  <li>Hotspot con portal cautivo personalizable</li>
  <li><strong>Desde:</strong> $12,000 MXN por AP instalado</li>
  <li><strong>Implementación:</strong> 1–2 semanas</li>
  </ul>
<h3>4) Enlaces Inalámbricos de Datos</h3>
<ul>
  <li>Punto a Punto hasta 100km</li>
  <li>Multipunto con múltiples estaciones</li>
  <li>Mesh para áreas complejas</li>
  <li>Throughput hasta 1.7Gbps</li>
  <li><strong>Desde:</strong> $45,000 MXN por enlace PtP</li>
  <li><strong>Instalación:</strong> 3–5 días</li>
  </ul>
<h3>5) Rastreo GPS de Flotillas</h3>
<ul>
  <li>Monitoreo en tiempo real 24/7 y geocercas con alertas</li>
  <li>Reportes de kilometraje y consumo, botón de pánico</li>
  <li><strong>Desde:</strong> $3,200 MXN por unidad + $450/mes servicio</li>
  <li><strong>Instalación:</strong> 2 horas por vehículo</li>
  </ul>
<h3>6) Data Centers Modulares</h3>
<ul>
  <li>Racks certificados con PDU inteligente</li>
  <li>Climatización de precisión y UPS con autonomía</li>
  <li>Detección y supresión de incendios</li>
  <li><strong>Desde:</strong> $380,000 MXN (setup 10 racks)</li>
  <li><strong>Implementación:</strong> 4–6 semanas</li>
  </ul>
<h3>Certificaciones</h3>
<ul>
  <li>Fluke Networks CCTT</li>
  <li>Ubiquiti Elite Partner</li>
  <li>Panduit Certified Installer</li>
</ul>
<p><strong>CTA:</strong> Optimice su Red Hoy — Diagnóstico de Red Gratuito</p>
HTML;

$svc_energia = <<<'HTML'
<h2>Energía Inteligente: Eficiencia que Reduce Costos Hasta 60%</h2>
<p>Proyectos de electrificación bajo normativas NOM vigentes, con enfoque en sostenibilidad y reducción de consumo. Desde instalaciones industriales hasta sistemas solares con ROI garantizado.</p>
<h3>1) Instalaciones Eléctricas Certificadas</h3>
<ul>
  <li>Diseño cumpliendo NOM-001-SEDE-2012</li>
  <li>Acometidas de media y baja tensión</li>
  <li>Tableros con protecciones y tierra física</li>
  <li><strong>Desde:</strong> $850 MXN por salida eléctrica</li>
</ul>
<h3>2) Iluminación LED Inteligente</h3>
<ul>
  <li>Retrofit a LED, sensores y fotoceldas</li>
  <li>Control DMX e integración IoT</li>
  <li><strong>ROI:</strong> 18–24 meses — <strong>Ahorro:</strong> hasta 75%</li>
  <li><strong>Desde:</strong> $1,800 MXN por luminaria</li>
</ul>
<h3>3) Iluminación Arquitectónica</h3>
<ul>
  <li>RGB dinámico, jardines y fuentes</li>
  <li>Control DMX — <strong>Desde:</strong> $650 por metro</li>
  <li><strong>Diseño:</strong> 1–2 semanas</li>
</ul>
<h3>4) Sistemas Solares Fotovoltaicos</h3>
<ul>
  <li>Paneles 400W+, inversores híbridos y monitoreo</li>
  <li><strong>Desde:</strong> $18,500 MXN/kWp — <strong>ROI:</strong> 4–6 años</li>
  <li><strong>Ahorro:</strong> 90–95% — <strong>Garantía:</strong> 25/10 años</li>
</ul>
<h3>Beneficios y Cumplimiento</h3>
<ul>
  <li>FIDE, NOM-001-SEDE, proyectos autorizados por CFE</li>
  <li>Deducción inmediata 100% y depreciación acelerada</li>
</ul>
<p><strong>CTA:</strong> Calcule su Ahorro Solar — Auditoría Energética Gratuita</p>
HTML;

$svc_consult = <<<'HTML'
<h2>Asesoría Estratégica: Su Socio en Transformación Tecnológica</h2>
<p>Planificamos, diseñamos y supervisamos la ejecución de proyectos tecnológicos complejos para maximizar retorno operativo y estratégico.</p>
<h3>Servicios de Consultoría</h3>
<ol>
  <li><strong>Auditoría y Diagnóstico Tecnológico</strong>: evaluación integral. Inversión: $35,000 MXN. Entregable: reporte ejecutivo + roadmap.</li>
  <li><strong>Diseño de Proyectos Llave en Mano</strong>: ingeniería de detalle, especificaciones, presupuesto y cronograma. Inversión: 8–12% del valor.</li>
  <li><strong>Gestión de Proyectos (PMO)</strong>: PM dedicado, control de costos y tiempos. Inversión: 10–15% del valor.</li>
  <li><strong>Certificaciones y Cumplimiento</strong>: CFE, dictámenes, RETIE, manuales O&M. Desde $25,000 MXN.</li>
  <li><strong>Capacitación Técnica</strong>: operación, mantenimiento e incidentes. Desde $15,000 MXN (10 personas, 2–5 días).</li>
</ol>
<p><strong>CTA:</strong> Programe su Consulta Gratuita de 45 Minutos</p>
HTML;

sitec_upsert('service', 'Conectividad de Nueva Generación: Infraestructura 5G-Ready', $svc_telecom);
sitec_upsert('service', 'Energía Inteligente: Eficiencia que Reduce Costos Hasta 60%', $svc_energia);
sitec_upsert('service', 'Asesoría Estratégica: Su Socio en Transformación Tecnológica', $svc_consult);

// ===================== Casos de Éxito =====================
$case_gn = <<<'HTML'
<h2>Modernización de Infraestructura de Seguridad y Comunicaciones</h2>
<p><strong>Cliente:</strong> Guardia Nacional — <strong>Sector:</strong> Seguridad Pública — <strong>Alcance:</strong> 4 estados — <strong>Año:</strong> 2022–2023 — <strong>Inversión:</strong> $47.5M MXN</p>
<h3>Desafío</h3>
<ul>
  <li>Comunicaciones interrumpidas en operativos</li>
  <li>Zonas sin cobertura de vigilancia</li>
  <li>Falta de capacitación moderna</li>
  <li>Enlaces poco confiables en zonas remotas</li>
  </ul>
<h3>Solución</h3>
<ol>
  <li><strong>Videovigilancia</strong>: 450+ cámaras AXIS con IA, LPR, intrusión, retención 90 días, C4 por estado.</li>
  <li><strong>Red de Datos</strong>: 28km Cat6A, backbone de fibra, VSAT en 12 sedes, failover &lt;30s.</li>
  <li><strong>Aulas Inteligentes</strong>: 16 aulas con VC HD, pantallas 86", audio pro, e-learning.</li>
  <li><strong>Radiocomunicación</strong>: P25 cifrado, 280 radios portátiles + 64 móviles, 8 repetidoras.</li>
</ol>
<h3>Resultados</h3>
<ul>
  <li>30% reducción en tiempos de respuesta</li>
  <li>99.7% uptime de red</li>
  <li>100% cobertura en áreas críticas</li>
  <li>Cero brechas perimetrales (18 meses)</li>
  <li>500+ elementos capacitados</li>
  <li>40% menos costos de mantenimiento</li>
</ul>
HTML;

$case_sedena = <<<'HTML'
<h2>Sistema Integral de Control de Acceso Biométrico</h2>
<p><strong>Cliente:</strong> SEDENA — <strong>Ubicación:</strong> Base Aérea Militar Santa Lucía — <strong>Año:</strong> 2023 — <strong>Inversión:</strong> $12.8M MXN</p>
<h3>Solución</h3>
<ul>
  <li>24 torniquetes biométricos; facial + huella + RFID</li>
  <li>8 carriles vehiculares con LPR</li>
  <li>Gestión central con backup en tiempo real</li>
  <li>Perimetral: 120 cámaras térmicas/visibles con IA</li>
</ul>
<h3>Resultados</h3>
<ul>
  <li>8,500 personas/día en ~4s</li>
  <li>99.98% precisión biométrica</li>
  <li>Cero accesos no autorizados (14 meses)</li>
  <li>75% menos tiempo en reportes</li>
</ul>
HTML;

$case_ine = <<<'HTML'
<h2>Red Segura para Proceso Electoral 2024</h2>
<p><strong>Alcance:</strong> 15 estados — <strong>Año:</strong> 2023–2024 — <strong>Inversión:</strong> $28.3M MXN — <strong>Despliegue:</strong> 300 ubicaciones</p>
<h3>Solución</h3>
<ul>
  <li>Red modular con enlaces 4G/5G de respaldo y VPN segura</li>
  <li>Monitoreo 24/7</li>
  <li>Videovigilancia temporal y control de acceso</li>
  <li>Data centers modulares (15)</li>
</ul>
<h3>Resultados</h3>
<ul>
  <li>100% disponibilidad días críticos</li>
  <li>Cero incidentes de seguridad</li>
  <li>300 sitios en 45 días</li>
  <li>98.5% transmisión exitosa</li>
</ul>
HTML;

sitec_upsert('case_study', 'Guardia Nacional — Modernización de Infraestructura', $case_gn);
sitec_upsert('case_study', 'SEDENA — Control de Acceso Biométrico Santa Lucía', $case_sedena);
sitec_upsert('case_study', 'INE — Infraestructura de Elecciones Digitales 2024', $case_ine);

// ===================== Página Nosotros =====================
$about_content = <<<'HTML'
<h2>Más de 20 Años Construyendo el México Tecnológico del Futuro</h2>
<p>SITEC S.A. de C.V. es una empresa mexicana líder en soluciones integrales de ingeniería, seguridad electrónica y telecomunicaciones. Desde 2003, hemos sido el socio tecnológico de confianza para instituciones gubernamentales y empresas privadas.</p>
<h3>Misión</h3>
<p>Transformar los desafíos tecnológicos en ventajas competitivas sostenibles mediante innovación, servicio excepcional y excelencia operativa.</p>
<h3>Visión</h3>
<p>Ser el integrador tecnológico más confiable de México, reconocido por proyectos que establecen nuevos estándares de calidad, seguridad e innovación.</p>
<h3>Valores</h3>
<ul>
  <li>Excelencia Técnica</li>
  <li>Integridad Absoluta</li>
  <li>Innovación Continua</li>
  <li>Compromiso con el Cliente</li>
  <li>Responsabilidad Social</li>
</ul>
<h3>Hitos</h3>
<ul>
  <li>2003 – Fundación; primeros proyectos eléctricos</li>
  <li>2008 – Expansión a telecom; ISO 9001</li>
  <li>2012 – Proyectos gubernamentales; oficina CDMX</li>
  <li>2018 – Contrato SEDENA; soporte 24/7</li>
  <li>2022–2024 – GN (4 estados), INE, AXIS Gold</li>
  <li>2025 – 500+ proyectos; IoT y ciudades inteligentes</li>
  </ul>
<h3>Certificaciones y Membresías</h3>
<ul>
  <li>ISO 9001:2015, ISO 27001:2013</li>
  <li>AXIS Solution Partner Gold, Cisco Registered</li>
  <li>Panduit Certified Installer, Ubiquiti Elite</li>
  <li>Fluke Networks CCTT, FIDE Instalador Certificado</li>
  <li>CANIETI, CANITEC, Clúster de Seguridad EDOMEX</li>
</ul>
HTML;

$about = get_page_by_title('Nosotros');
if ($about) { wp_update_post(['ID' => $about->ID, 'post_content' => $about_content]); }

// ===================== Página Contacto (encabezado) =====================
$contact = get_page_by_title('Contacto');
if ($contact) {
    $contact_intro = '<p>Conéctese con Nuestros Expertos: Respuesta garantizada en menos de 2 horas hábiles.</p>';
    wp_update_post(['ID' => $contact->ID, 'post_content' => $contact_intro]);
}

echo "OK\n";



