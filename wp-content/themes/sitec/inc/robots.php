<?php
// robots.txt virtual
add_filter('robots_txt', function($output, $public){
	$lines = [];
	$lines[] = 'User-agent: *';
	if ( defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local' ) {
		$lines[] = 'Disallow: /';
	} else {
		$lines[] = 'Allow: /';
	}
	$site_url = home_url('/');
	$lines[] = 'Sitemap: ' . trailingslashit($site_url) . 'sitemap.xml';
	return implode("\n", $lines);
}, 10, 2);


