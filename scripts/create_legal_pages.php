<?php
// Creador idempotente de páginas legales y blog.
// Ejecutar vía: php -d detect_unicode=0 scripts/create_legal_pages.php

require_once __DIR__ . '/../wp-load.php';
// Asegurar carga completa de WP
if (!function_exists('wp_insert_post')) {
    require_once __DIR__ . '/../wp-blog-header.php';
}

function ensure_page($title, $slug, $content = '', $set_option = '') {
    $existing = get_page_by_path($slug) ?: get_page_by_title($title);
    if ($existing && !is_wp_error($existing)) {
        // Normalizar slug en caso de título diferente
        wp_update_post(['ID' => $existing->ID, 'post_name' => sanitize_title($slug)]);
        $page_id = (int)$existing->ID;
    } else {
        $page_id = wp_insert_post([
            'post_title'   => $title,
            'post_name'    => sanitize_title($slug),
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_content' => $content,
        ]);
    }
    if (!is_wp_error($page_id) && $page_id) {
        if ($set_option === 'page_for_posts') {
            update_option('page_for_posts', $page_id);
        }
        if ($set_option === 'page_on_front') {
            update_option('page_on_front', $page_id);
            update_option('show_on_front', 'page');
        }
    }
    return (int)$page_id;
}

$blog_id    = ensure_page('Blog', 'blog', '', 'page_for_posts');
$privacy_id = ensure_page('Aviso de Privacidad', 'privacy-policy', 'Esta es la página de aviso de privacidad. Actualice el contenido conforme a sus políticas.');
$terms_id   = ensure_page('Términos de Servicio', 'terms', 'Esta es la página de términos de servicio. Actualice el contenido con sus condiciones.');

// Salida simple
header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'blog_id' => $blog_id,
    'privacy_id' => $privacy_id,
    'terms_id' => $terms_id,
    'blog_url' => $blog_id ? get_permalink($blog_id) : null,
    'privacy_url' => $privacy_id ? get_permalink($privacy_id) : null,
    'terms_url' => $terms_id ? get_permalink($terms_id) : null,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
exit;
 
