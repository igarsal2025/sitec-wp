<?php
// Metadatos básicos y JSON-LD mínimo (Organization/WebSite/Breadcrumb/Article)

add_action('wp_head', function(){
	$verify = trim((string) get_option('google_site_verification'));
	if ($verify) {
		echo '<meta name="google-site-verification" content="' . esc_attr($verify) . '" />' . "\n";
	}
	// OG básicos
	echo "\n<meta property=\"og:site_name\" content=\"" . esc_attr(get_bloginfo('name')) . "\">\n";
	echo "<meta property=\"og:type\" content=\"website\">\n";
	if (is_singular()) {
		echo "<meta property=\"og:title\" content=\"" . esc_attr(get_the_title()) . "\">\n";
		$desc = get_the_excerpt() ?: get_bloginfo('description');
		echo "<meta property=\"og:description\" content=\"" . esc_attr(wp_strip_all_tags($desc)) . "\">\n";
		$u = get_permalink(); echo "<meta property=\"og:url\" content=\"" . esc_url($u) . "\">\n";
	}

	// JSON-LD Organization + Website
	$org = [
		'@context' => 'https://schema.org',
		'@type' => 'Organization',
		'name' => get_bloginfo('name'),
		'url'  => home_url('/'),
	];
	$web = [
		'@context' => 'https://schema.org',
		'@type' => 'WebSite',
		'name' => get_bloginfo('name'),
		'url'  => home_url('/'),
		'potentialAction' => [
			'@type' => 'SearchAction',
			'target' => home_url('/?s={search_term_string}'),
			'query-input' => 'required name=search_term_string'
		]
	];
	echo '<script type="application/ld+json">' . wp_json_encode($org) . '</script>' . "\n";
	echo '<script type="application/ld+json">' . wp_json_encode($web) . '</script>' . "\n";

	// robots meta (noindex en entornos locales si se desea)
	if ( defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local' ) {
		echo "<meta name=\"robots\" content=\"noindex,nofollow\">\n";
	}

	// Breadcrumbs minimalistas
	if (!is_front_page()) {
		$items = [ [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Inicio', 'item' => home_url('/') ] ];
		if (is_archive()) {
			$items[] = [ '@type' => 'ListItem', 'position' => 2, 'name' => get_the_archive_title(), 'item' => get_post_type_archive_link(get_post_type()) ];
		}
		if (is_singular()) {
			$items[] = [ '@type' => 'ListItem', 'position' => 2, 'name' => get_the_title(), 'item' => get_permalink() ];
		}
		$breadcrumb = [ '@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items ];
		echo '<script type="application/ld+json">' . wp_json_encode($breadcrumb) . '</script>' . "\n";
	}

	// Article (para posts del blog)
	if (is_single() && get_post_type() === 'post') {
		$article = [
			'@context' => 'https://schema.org', '@type' => 'Article',
			'headline' => get_the_title(), 'datePublished' => get_the_date(DATE_W3C), 'dateModified' => get_the_modified_date(DATE_W3C),
			'author' => [ '@type' => 'Person', 'name' => get_the_author() ],
			'publisher' => [ '@type' => 'Organization', 'name' => get_bloginfo('name') ],
			'mainEntityOfPage' => get_permalink()
		];
		echo '<script type="application/ld+json">' . wp_json_encode($article) . '</script>' . "\n";
	}
});


