<?php
// Registra grupos de campos ACF si ACF está activo.
if ( function_exists('acf_add_local_field_group') ) {

	// Grupo: Servicio
	acf_add_local_field_group([
		'key' => 'group_service_fields',
		'title' => __('Servicio - Campos', 'sitec'),
		'fields' => [
			[
				'key' => 'field_service_icon',
				'label' => __('Ícono', 'sitec'),
				'name' => 'icon',
				'type' => 'image',
				'return_format' => 'array',
			],
			[
				'key' => 'field_service_cta_label',
				'label' => __('CTA Texto', 'sitec'),
				'name' => 'cta_label',
				'type' => 'text',
			],
			[
				'key' => 'field_service_cta_url',
				'label' => __('CTA URL', 'sitec'),
				'name' => 'cta_url',
				'type' => 'url',
			],
			[
				'key' => 'field_service_related_clients',
				'label' => __('Clientes Relacionados', 'sitec'),
				'name' => 'related_clients',
				'type' => 'relationship',
				'post_type' => ['client'],
				'return_format' => 'id',
				'filters' => ['search'],
				'min' => 0,
				'max' => 0
			],
		],
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'service'
		]]],
	]);

	// Grupo: Caso de Éxito
	acf_add_local_field_group([
		'key' => 'group_case_fields',
		'title' => __('Caso de Éxito - Campos', 'sitec'),
		'fields' => [
			[
				'key' => 'field_case_sector',
				'label' => __('Sector', 'sitec'),
				'name' => 'sector_text',
				'type' => 'text',
			],
			[
				'key' => 'field_case_results',
				'label' => __('Resultados (bullets)', 'sitec'),
				'name' => 'results',
				'type' => 'repeater',
				'sub_fields' => [[
					'key' => 'field_case_result_item',
					'label' => __('Resultado', 'sitec'),
					'name' => 'item',
					'type' => 'text'
				]],
			],
			[
				'key' => 'field_case_images',
				'label' => __('Imágenes', 'sitec'),
				'name' => 'images',
				'type' => 'repeater',
				'sub_fields' => [[
					'key' => 'field_case_image_item',
					'label' => __('Imagen', 'sitec'),
					'name' => 'image',
					'type' => 'image',
					'return_format' => 'array'
				]],
			],
		],
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'case_study'
		]]],
	]);

	// Grupo: Testimonio
	acf_add_local_field_group([
		'key' => 'group_testimonial_fields',
		'title' => __('Testimonio - Campos', 'sitec'),
		'fields' => [
			[
				'key' => 'field_test_author_role',
				'label' => __('Cargo', 'sitec'),
				'name' => 'author_role',
				'type' => 'text',
			],
			[
				'key' => 'field_test_company',
				'label' => __('Empresa', 'sitec'),
				'name' => 'company',
				'type' => 'text',
			],
			[
				'key' => 'field_test_photo',
				'label' => __('Foto', 'sitec'),
				'name' => 'photo',
				'type' => 'image',
				'return_format' => 'array'
			],
		],
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'testimonial'
		]]],
	]);

	// Grupo: Partner (Socio/Marca)
	acf_add_local_field_group([
		'key' => 'group_partner_fields',
		'title' => __('Partner - Campos', 'sitec'),
		'fields' => [
			[
				'key' => 'field_partner_url',
				'label' => __('Sitio web', 'sitec'),
				'name' => 'website_url',
				'type' => 'url',
				'instructions' => __('URL oficial del socio/marca (opcional).', 'sitec'),
				'placeholder' => __('https://…', 'sitec')
			],
		],
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'partner'
		]]],
	]);

	// Grupo: KPI (opcional, para Home)
	acf_add_local_field_group([
		'key' => 'group_home_kpis',
		'title' => __('Home - KPIs', 'sitec'),
		'style' => 'seamless',
		'fields' => [
			[
				'key' => 'field_kpis',
				'label' => __('KPIs', 'sitec'),
				'name' => 'kpis',
				'type' => 'repeater',
				'instructions' => __('Añade de 1 a 6 elementos cortos (recomendado 3).', 'sitec'),
				'min' => 0,
				'max' => 6,
				'sub_fields' => [[
					'key' => 'field_kpi_label',
					'label' => __('Etiqueta', 'sitec'),
					'name' => 'label',
					'type' => 'text',
					'placeholder' => __('60% ahorro', 'sitec'),
					'maxlength' => 24
				]]
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Hero (título y párrafo)
	acf_add_local_field_group([
		'key' => 'group_home_hero',
		'title' => __('Home - Hero', 'sitec'),
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'fields' => [
			[
				'key' => 'field_hero_title',
				'label' => __('Título', 'sitec'),
				'name' => 'hero_title',
				'type' => 'text',
				'instructions' => __('Título principal del hero (recomendado 4–10 palabras).', 'sitec'),
				'placeholder' => __('Ingeniería que Conecta y Protege a México', 'sitec'),
				'maxlength' => 120,
			],
			[
				'key' => 'field_hero_text',
				'label' => __('Párrafo', 'sitec'),
				'name' => 'hero_text',
				'type' => 'textarea',
				'new_lines' => 'br'
			],
			[
				'key' => 'field_hero_image',
				'label' => __('Imagen principal', 'sitec'),
				'name' => 'hero_image',
				'type' => 'image',
				'instructions' => __('Imagen apaisada (recomendado ≥1200px de ancho). Si no cargas, se mostrarán los KPIs.', 'sitec'),
				'return_format' => 'array',
				'preview_size' => 'medium'
			],
			[
				'key' => 'field_hero_overlay_color',
				'label' => __('Color del degradado', 'sitec'),
				'name' => 'hero_overlay_color',
				'type' => 'color_picker',
				'instructions' => __('Color base del degradado sobre la imagen/fondo (por defecto: #0f172a).', 'sitec'),
				'default_value' => '#0f172a'
			],
			[
				'key' => 'field_hero_overlay_opacity',
				'label' => __('Opacidad del degradado (%)', 'sitec'),
				'name' => 'hero_overlay_opacity',
				'type' => 'number',
				'instructions' => __('0–100 (recomendado 60–90). Controla la intensidad del overlay.', 'sitec'),
				'min' => 0,
				'max' => 100,
				'step' => 5,
				'default_value' => 85
			],
			[
				'key' => 'field_hero_cta1_label',
				'label' => __('Botón 1 - Texto', 'sitec'),
				'name' => 'hero_cta_primary_label',
				'type' => 'text',
				'instructions' => __('Texto del botón principal (máx. 40 caracteres).', 'sitec'),
				'maxlength' => 40,
				'placeholder' => __('Consultoría Gratuita', 'sitec'),
			],
			[
				'key' => 'field_hero_cta1_url',
				'label' => __('Botón 1 - URL', 'sitec'),
				'name' => 'hero_cta_primary_url',
				'type' => 'url',
				'instructions' => __('URL absoluta o relativa. Ej: /contacto o https://tudominio.com/contacto', 'sitec'),
				'placeholder' => __('https://… o /contacto', 'sitec'),
			],
			[
				'key' => 'field_hero_cta2_label',
				'label' => __('Botón 2 - Texto', 'sitec'),
				'name' => 'hero_cta_secondary_label',
				'type' => 'text',
				'instructions' => __('Texto del botón secundario (máx. 40 caracteres).', 'sitec'),
				'maxlength' => 40,
				'placeholder' => __('Ver Proyectos Destacados', 'sitec'),
			],
			[
				'key' => 'field_hero_cta2_url',
				'label' => __('Botón 2 - URL', 'sitec'),
				'name' => 'hero_cta_secondary_url',
				'type' => 'url',
				'instructions' => __('URL absoluta o relativa. Ej: /cases o https://tudominio.com/cases', 'sitec'),
				'placeholder' => __('https://… o /cases', 'sitec'),
			]
			,
			[
				'key' => 'field_hero_alignment',
				'label' => __('Alineación del contenido', 'sitec'),
				'name' => 'hero_alignment',
				'type' => 'select',
				'choices' => [ 'left' => __('Izquierda','sitec'), 'center' => __('Centrado','sitec') ],
				'default_value' => 'left',
				'allow_null' => 0,
				'instructions' => __('Alineación del texto y botones dentro del Hero.', 'sitec')
			],
			[
				'key' => 'field_hero_height',
				'label' => __('Altura/espaciado vertical', 'sitec'),
				'name' => 'hero_height',
				'type' => 'select',
				'choices' => [ 'compact' => __('Compacto','sitec'), 'normal' => __('Normal','sitec'), 'wide' => __('Amplio','sitec') ],
				'default_value' => 'normal',
				'instructions' => __('Controla el alto del Hero (padding superior/inferior).', 'sitec')
			],
			[
				'key' => 'field_hero_img_fit',
				'label' => __('Imagen: ajuste', 'sitec'),
				'name' => 'hero_img_fit',
				'type' => 'select',
				'choices' => [ 'cover' => __('Cover (recorta)','sitec'), 'contain' => __('Contain (encaja)','sitec') ],
				'default_value' => 'cover',
				'instructions' => __('Cómo se adapta la imagen a su contenedor.', 'sitec')
			],
			[
				'key' => 'field_hero_img_position',
				'label' => __('Imagen: posición', 'sitec'),
				'name' => 'hero_img_position',
				'type' => 'select',
				'choices' => [ 'center' => __('Centro','sitec'), 'top' => __('Arriba','sitec'), 'bottom' => __('Abajo','sitec'), 'left' => __('Izquierda','sitec'), 'right' => __('Derecha','sitec') ],
				'default_value' => 'center'
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Diferenciadores
	acf_add_local_field_group([
		'key' => 'group_home_differentiators',
		'title' => __('Home - Diferenciadores', 'sitec'),
		'style' => 'seamless',
		'fields' => [
			[
				'key' => 'field_differentiators',
				'label' => __('Diferenciadores', 'sitec'),
				'name' => 'differentiators',
				'type' => 'repeater',
				'instructions' => __('Añade 3–6 tarjetas con un texto breve de valor.', 'sitec'),
				'min' => 0,
				'max' => 6,
				'collapsed' => 'field_diff_title',
				'sub_fields' => [
					[
						'key' => 'field_diff_icon',
						'label' => __('Ícono/Imagen', 'sitec'),
						'name' => 'icon',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'instructions' => __('PNG transparente recomendado (64x64 – 128x128).', 'sitec')
					],
					[
						'key' => 'field_diff_title',
						'label' => __('Título', 'sitec'),
						'name' => 'title',
						'type' => 'text',
						'maxlength' => 80,
						'placeholder' => __('Tecnología de Clase Mundial', 'sitec')
					],
					[
						'key' => 'field_diff_text',
						'label' => __('Texto', 'sitec'),
						'name' => 'text',
						'type' => 'textarea',
						'new_lines' => 'br'
					]
				]
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Títulos de Secciones
	acf_add_local_field_group([
		'key' => 'group_home_headings',
		'title' => __('Home - Títulos de Secciones', 'sitec'),
		'fields' => [
			[
				'key' => 'field_heading_differentiators',
				'label' => __('Título - Diferenciadores', 'sitec'),
				'name' => 'differentiators_heading',
				'type' => 'text'
			],
			[
				'key' => 'field_heading_services',
				'label' => __('Título - Servicios', 'sitec'),
				'name' => 'services_heading',
				'type' => 'text'
			],
			[
				'key' => 'field_heading_cases',
				'label' => __('Título - Casos de Éxito', 'sitec'),
				'name' => 'cases_heading',
				'type' => 'text'
			],
			[
				'key' => 'field_heading_testimonials',
				'label' => __('Título - Testimonios', 'sitec'),
				'name' => 'testimonials_heading',
				'type' => 'text'
			],
			[
				'key' => 'field_heading_blog',
				'label' => __('Título - Blog', 'sitec'),
				'name' => 'blog_heading',
				'type' => 'text'
			]
			,
			[
				'key' => 'field_heading_partners',
				'label' => __('Título - Marcas y Socios', 'sitec'),
				'name' => 'partners_heading',
				'type' => 'text'
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Cantidades
	acf_add_local_field_group([
		'key' => 'group_home_counts',
		'title' => __('Home - Cantidades', 'sitec'),
		'fields' => [
			[
				'key' => 'field_count_services',
				'label' => __('Servicios a mostrar', 'sitec'),
				'name' => 'count_services',
				'type' => 'number',
				'min' => 1,
				'max' => 12,
				'default_value' => 4
			],
			[
				'key' => 'field_count_cases',
				'label' => __('Casos a mostrar', 'sitec'),
				'name' => 'count_cases',
				'type' => 'number',
				'min' => 1,
				'max' => 12,
				'default_value' => 6
			],
			[
				'key' => 'field_count_posts',
				'label' => __('Posts del Blog a mostrar', 'sitec'),
				'name' => 'count_posts',
				'type' => 'number',
				'min' => 1,
				'max' => 12,
				'default_value' => 3
			],
			[
				'key' => 'field_count_partners',
				'label' => __('Partners a mostrar', 'sitec'),
				'name' => 'count_partners',
				'type' => 'number',
				'min' => 4,
				'max' => 24,
				'default_value' => 12
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Orden y Filtros
	acf_add_local_field_group([
		'key' => 'group_home_filters',
		'title' => __('Home - Orden y Filtros', 'sitec'),
		'fields' => [
			// Servicios
			[
				'key' => 'field_services_orderby',
				'label' => __('Servicios - Ordenar por', 'sitec'),
				'name' => 'services_orderby',
				'type' => 'select',
				'choices' => [
					'date' => __('Fecha', 'sitec'),
					'title' => __('Título', 'sitec'),
					'modified' => __('Modificado', 'sitec'),
					'menu_order' => __('Orden de menú', 'sitec'),
					'rand' => __('Aleatorio', 'sitec'),
				],
				'default_value' => 'date',
				'allow_null' => 0,
			],
			[
				'key' => 'field_services_meta_key',
				'label' => __('Servicios - Meta Key (opcional)', 'sitec'),
				'name' => 'services_meta_key',
				'type' => 'text',
				'instructions' => __('Si se define, se usará para orderby=meta_value', 'sitec')
			],
			[
				'key' => 'field_services_order',
				'label' => __('Servicios - Dirección', 'sitec'),
				'name' => 'services_order',
				'type' => 'select',
				'choices' => [ 'DESC' => 'DESC', 'ASC' => 'ASC' ],
				'default_value' => 'DESC'
			],
			[
				'key' => 'field_services_include_ids',
				'label' => __('Servicios - Incluir IDs específicos', 'sitec'),
				'name' => 'services_include_ids',
				'type' => 'text',
				'instructions' => __('Separar por comas o espacios (ej: 12, 34, 56)', 'sitec')
			],
			[
				'key' => 'field_services_category',
				'label' => __('Servicios - Filtrar por Categorías', 'sitec'),
				'name' => 'services_category',
				'type' => 'taxonomy',
				'taxonomy' => 'service_category',
				'field_type' => 'multi_select',
				'add_term' => 0,
				'return_format' => 'id'
			],
			[
				'key' => 'field_services_sector',
				'label' => __('Servicios - Filtrar por Sector', 'sitec'),
				'name' => 'services_sector',
				'type' => 'taxonomy',
				'taxonomy' => 'sector',
				'field_type' => 'multi_select',
				'add_term' => 0,
				'return_format' => 'id'
			],
			[
				'key' => 'field_services_clients',
				'label' => __('Servicios - Filtrar por Clientes relacionados', 'sitec'),
				'name' => 'services_clients',
				'type' => 'relationship',
				'post_type' => ['client'],
				'return_format' => 'id',
				'filters' => ['search'],
				'min' => 0,
				'max' => 0
			],

			// Casos de Éxito
			[
				'key' => 'field_cases_orderby',
				'label' => __('Casos - Ordenar por', 'sitec'),
				'name' => 'cases_orderby',
				'type' => 'select',
				'choices' => [
					'date' => __('Fecha', 'sitec'),
					'title' => __('Título', 'sitec'),
					'modified' => __('Modificado', 'sitec'),
					'rand' => __('Aleatorio', 'sitec'),
				],
				'default_value' => 'date',
				'allow_null' => 0,
			],
			[
				'key' => 'field_cases_meta_key',
				'label' => __('Casos - Meta Key (opcional)', 'sitec'),
				'name' => 'cases_meta_key',
				'type' => 'text',
				'instructions' => __('Si se define, se usará para orderby=meta_value', 'sitec')
			],
			[
				'key' => 'field_cases_order',
				'label' => __('Casos - Dirección', 'sitec'),
				'name' => 'cases_order',
				'type' => 'select',
				'choices' => [ 'DESC' => 'DESC', 'ASC' => 'ASC' ],
				'default_value' => 'DESC'
			],
			[
				'key' => 'field_cases_sector',
				'label' => __('Casos - Filtrar por Sector', 'sitec'),
				'name' => 'cases_sector',
				'type' => 'taxonomy',
				'taxonomy' => 'sector',
				'field_type' => 'multi_select',
				'add_term' => 0,
				'return_format' => 'id'
			],

			// Blog
			[
				'key' => 'field_posts_orderby',
				'label' => __('Blog - Ordenar por', 'sitec'),
				'name' => 'posts_orderby',
				'type' => 'select',
				'choices' => [
					'date' => __('Fecha', 'sitec'),
					'title' => __('Título', 'sitec'),
					'modified' => __('Modificado', 'sitec'),
					'rand' => __('Aleatorio', 'sitec'),
				],
				'default_value' => 'date',
				'allow_null' => 0,
			],
			[
				'key' => 'field_posts_meta_key',
				'label' => __('Blog - Meta Key (opcional)', 'sitec'),
				'name' => 'posts_meta_key',
				'type' => 'text',
				'instructions' => __('Si se define, se usará para orderby=meta_value', 'sitec')
			],
			[
				'key' => 'field_posts_order',
				'label' => __('Blog - Dirección', 'sitec'),
				'name' => 'posts_order',
				'type' => 'select',
				'choices' => [ 'DESC' => 'DESC', 'ASC' => 'ASC' ],
				'default_value' => 'DESC'
			],
			[
				'key' => 'field_posts_categories',
				'label' => __('Blog - Filtrar por Categorías', 'sitec'),
				'name' => 'posts_categories',
				'type' => 'taxonomy',
				'taxonomy' => 'category',
				'field_type' => 'multi_select',
				'add_term' => 0,
				'return_format' => 'id'
			],
			[
				'key' => 'field_partners_orderby',
				'label' => __('Partners - Ordenar por', 'sitec'),
				'name' => 'partners_orderby',
				'type' => 'select',
				'choices' => [ 'menu_order' => __('Orden manual','sitec'), 'date' => __('Fecha','sitec'), 'title' => __('Título','sitec'), 'rand' => __('Aleatorio','sitec') ],
				'default_value' => 'menu_order'
			],
			[
				'key' => 'field_partners_order',
				'label' => __('Partners - Dirección', 'sitec'),
				'name' => 'partners_order',
				'type' => 'select',
				'choices' => [ 'ASC' => 'ASC', 'DESC' => 'DESC' ],
				'default_value' => 'ASC'
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Visibilidad de Secciones
	acf_add_local_field_group([
		'key' => 'group_home_visibility',
		'title' => __('Home - Secciones visibles', 'sitec'),
		'fields' => [
			[
				'key' => 'field_show_hero',
				'label' => __('Mostrar Hero', 'sitec'),
				'name' => 'show_hero',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Hero en la portada', 'sitec'),
				'default_value' => 1
			],
			[
				'key' => 'field_show_differentiators',
				'label' => __('Mostrar Diferenciadores', 'sitec'),
				'name' => 'show_differentiators',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Diferenciadores', 'sitec'),
				'default_value' => 0
			],
			[
				'key' => 'field_show_services',
				'label' => __('Mostrar Servicios', 'sitec'),
				'name' => 'show_services',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Servicios', 'sitec'),
				'default_value' => 0
			],
			[
				'key' => 'field_show_cases',
				'label' => __('Mostrar Casos de Éxito', 'sitec'),
				'name' => 'show_cases',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Casos de Éxito', 'sitec'),
				'default_value' => 0
			],
			[
				'key' => 'field_show_testimonials',
				'label' => __('Mostrar Testimonios', 'sitec'),
				'name' => 'show_testimonials',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Testimonios', 'sitec'),
				'default_value' => 0
			],
			[
				'key' => 'field_show_blog',
				'label' => __('Mostrar Blog', 'sitec'),
				'name' => 'show_blog',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Blog', 'sitec'),
				'default_value' => 0
			]
			,
			[
				'key' => 'field_show_partners',
				'label' => __('Mostrar Marcas/Socios', 'sitec'),
				'name' => 'show_partners',
				'type' => 'true_false',
				'ui' => 1,
				'message' => __('Activar sección Marcas y Socios', 'sitec'),
				'default_value' => 1
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Home - Marcas y Socios
	acf_add_local_field_group([
		'key' => 'group_home_partners',
		'title' => __('Home - Marcas y Socios', 'sitec'),
		'fields' => [
			[
				'key' => 'field_partners',
				'label' => __('Logos de marcas/socios', 'sitec'),
				'name' => 'partners',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => __('Agregar Marca/Socio', 'sitec'),
				'sub_fields' => [
					[
						'key' => 'field_partner_logo',
						'label' => __('Logo', 'sitec'),
						'name' => 'logo',
						'type' => 'image',
						'return_format' => 'array',
						'preview_size' => 'medium'
					],
					[
						'key' => 'field_partner_name',
						'label' => __('Nombre', 'sitec'),
						'name' => 'name',
						'type' => 'text'
					],
					[
						'key' => 'field_partner_url',
						'label' => __('URL', 'sitec'),
						'name' => 'url',
						'type' => 'url',
						'placeholder' => __('https://…', 'sitec')
					]
				]
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);

	// Grupo: Nosotros - Contenido
	acf_add_local_field_group([
		'key' => 'group_about_content',
		'title' => __('Nosotros - Contenido', 'sitec'),
		'fields' => [
			[
				'key' => 'field_about_title',
				'label' => __('Título principal', 'sitec'),
				'name' => 'about_title',
				'type' => 'text',
			],
			[
				'key' => 'field_about_intro',
				'label' => __('Introducción', 'sitec'),
				'name' => 'about_intro',
				'type' => 'textarea',
				'new_lines' => 'br'
			],
			[
				'key' => 'field_about_metrics',
				'label' => __('Métricas (repeater)', 'sitec'),
				'name' => 'about_metrics',
				'type' => 'repeater',
				'sub_fields' => [
					[
						'key' => 'field_about_metric_value',
						'label' => __('Valor', 'sitec'),
						'name' => 'value',
						'type' => 'text'
					],
					[
						'key' => 'field_about_metric_label',
						'label' => __('Etiqueta', 'sitec'),
						'name' => 'label',
						'type' => 'text'
					]
				]
			],
			[
				'key' => 'field_about_values',
				'label' => __('Valores (repeater)', 'sitec'),
				'name' => 'about_values',
				'type' => 'repeater',
				'sub_fields' => [
					[
						'key' => 'field_about_value_title',
						'label' => __('Título', 'sitec'),
						'name' => 'title',
						'type' => 'text'
					],
					[
						'key' => 'field_about_value_text',
						'label' => __('Texto', 'sitec'),
						'name' => 'text',
						'type' => 'textarea',
						'new_lines' => 'br'
					]
				]
			],
			[
				'key' => 'field_about_body',
				'label' => __('Cuerpo (WYSIWYG)', 'sitec'),
				'name' => 'about_body',
				'type' => 'wysiwyg',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1
			]
		],
		'location' => [[[
			'param' => 'page_template',
			'operator' => '==',
			'value' => 'page-about.php'
		]]],
	]);

	}


