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
		],
		'location' => [[[
			'param' => 'post_type',
			'operator' => '==',
			'value' => 'testimonial'
		]]],
	]);

	// Grupo: KPI (opcional, para Home)
	acf_add_local_field_group([
		'key' => 'group_home_kpis',
		'title' => __('Home - KPIs', 'sitec'),
		'fields' => [
			[
				'key' => 'field_kpis',
				'label' => __('KPIs', 'sitec'),
				'name' => 'kpis',
				'type' => 'repeater',
				'sub_fields' => [[
					'key' => 'field_kpi_label',
					'label' => __('Etiqueta', 'sitec'),
					'name' => 'label',
					'type' => 'text'
				]]
			]
		],
		'location' => [[[
			'param' => 'page_type',
			'operator' => '==',
			'value' => 'front_page'
		]]],
	]);
}


