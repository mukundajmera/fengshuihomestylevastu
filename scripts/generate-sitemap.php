<?php
/**
 * XML Sitemap Generator for Feng Shui Homestyle Vastu
 * 
 * Generates a basic XML sitemap for the website including:
 * - Homepage
 * - Pages
 * - Posts
 * - Services
 * - Testimonials (if public)
 * 
 * Usage: 
 * 1. Include in functions.php: require_once get_stylesheet_directory() . '/scripts/generate-sitemap.php';
 * 2. Or run manually: wp eval-file scripts/generate-sitemap.php
 * 3. Sitemap will be created at: /sitemap.xml
 * 
 * @package Feng_Shui_Homestyle_Vastu
 */

// Bootstrap WordPress if not already loaded
if (!defined('ABSPATH')) {
    require_once dirname(dirname(__FILE__)) . '/wp-load.php';
}

/**
 * Generate XML Sitemap
 */
function fengshuihomestyle_generate_xml_sitemap()
{
    // Start XML
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
    $sitemap .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n\n";

    // Homepage
    $sitemap .= "  <url>\n";
    $sitemap .= "    <loc>" . esc_url(home_url('/')) . "</loc>\n";
    $sitemap .= "    <lastmod>" . date('Y-m-d\TH:i:s+00:00') . "</lastmod>\n";
    $sitemap .= "    <changefreq>weekly</changefreq>\n";
    $sitemap .= "    <priority>1.0</priority>\n";
    $sitemap .= "  </url>\n\n";

    // Get all published pages
    $pages = get_pages(array(
        'post_status' => 'publish',
        'sort_column' => 'post_modified',
    ));

    foreach ($pages as $page) {
        $sitemap .= "  <url>\n";
        $sitemap .= "    <loc>" . esc_url(get_permalink($page->ID)) . "</loc>\n";
        $sitemap .= "    <lastmod>" . date('Y-m-d\TH:i:s+00:00', strtotime($page->post_modified)) . "</lastmod>\n";
        $sitemap .= "    <changefreq>monthly</changefreq>\n";
        $sitemap .= "    <priority>0.8</priority>\n";
        $sitemap .= "  </url>\n\n";
    }

    // Get all published posts
    $posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'modified',
        'order' => 'DESC',
    ));

    foreach ($posts as $post) {
        $sitemap .= "  <url>\n";
        $sitemap .= "    <loc>" . esc_url(get_permalink($post->ID)) . "</loc>\n";
        $sitemap .= "    <lastmod>" . date('Y-m-d\TH:i:s+00:00', strtotime($post->post_modified)) . "</lastmod>\n";
        $sitemap .= "    <changefreq>monthly</changefreq>\n";
        $sitemap .= "    <priority>0.7</priority>\n";
        
        // Add featured image if available
        if (has_post_thumbnail($post->ID)) {
            $image_url = get_the_post_thumbnail_url($post->ID, 'large');
            $sitemap .= "    <image:image>\n";
            $sitemap .= "      <image:loc>" . esc_url($image_url) . "</image:loc>\n";
            $sitemap .= "      <image:title>" . esc_html(get_the_title($post->ID)) . "</image:title>\n";
            $sitemap .= "    </image:image>\n";
        }
        
        $sitemap .= "  </url>\n\n";
    }

    // Get all published services
    $services = get_posts(array(
        'post_type' => 'service',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'modified',
        'order' => 'DESC',
    ));

    foreach ($services as $service) {
        $sitemap .= "  <url>\n";
        $sitemap .= "    <loc>" . esc_url(get_permalink($service->ID)) . "</loc>\n";
        $sitemap .= "    <lastmod>" . date('Y-m-d\TH:i:s+00:00', strtotime($service->post_modified)) . "</lastmod>\n";
        $sitemap .= "    <changefreq>monthly</changefreq>\n";
        $sitemap .= "    <priority>0.9</priority>\n";
        
        // Add featured image if available
        if (has_post_thumbnail($service->ID)) {
            $image_url = get_the_post_thumbnail_url($service->ID, 'large');
            $sitemap .= "    <image:image>\n";
            $sitemap .= "      <image:loc>" . esc_url($image_url) . "</image:loc>\n";
            $sitemap .= "      <image:title>" . esc_html(get_the_title($service->ID)) . "</image:title>\n";
            $sitemap .= "    </image:image>\n";
        }
        
        $sitemap .= "  </url>\n\n";
    }

    // Services archive page
    if (post_type_exists('service')) {
        $services_archive = get_post_type_archive_link('service');
        if ($services_archive) {
            $sitemap .= "  <url>\n";
            $sitemap .= "    <loc>" . esc_url($services_archive) . "</loc>\n";
            $sitemap .= "    <lastmod>" . date('Y-m-d\TH:i:s+00:00') . "</lastmod>\n";
            $sitemap .= "    <changefreq>weekly</changefreq>\n";
            $sitemap .= "    <priority>0.8</priority>\n";
            $sitemap .= "  </url>\n\n";
        }
    }

    // Blog archive page
    $blog_page_id = get_option('page_for_posts');
    if ($blog_page_id) {
        $sitemap .= "  <url>\n";
        $sitemap .= "    <loc>" . esc_url(get_permalink($blog_page_id)) . "</loc>\n";
        $sitemap .= "    <lastmod>" . date('Y-m-d\TH:i:s+00:00') . "</lastmod>\n";
        $sitemap .= "    <changefreq>weekly</changefreq>\n";
        $sitemap .= "    <priority>0.8</priority>\n";
        $sitemap .= "  </url>\n\n";
    }

    // Close XML
    $sitemap .= "</urlset>";

    // Write to file
    $file_path = ABSPATH . 'sitemap.xml';
    $result = file_put_contents($file_path, $sitemap);

    if ($result !== false) {
        if (defined('WP_CLI') && WP_CLI) {
            WP_CLI::success("Sitemap generated successfully at: $file_path");
        } else {
            echo "✅ Sitemap generated successfully!\n";
            echo "Location: $file_path\n";
            echo "Total URLs: " . (count($pages) + count($posts) + count($services) + 2) . "\n";
        }
        return true;
    } else {
        if (defined('WP_CLI') && WP_CLI) {
            WP_CLI::error("Failed to write sitemap file. Check file permissions.");
        } else {
            echo "❌ Failed to write sitemap file. Check file permissions.\n";
        }
        return false;
    }
}

/**
 * Automatically regenerate sitemap when posts are saved/updated
 * Note: This can be resource-intensive on high-traffic sites
 * Consider using a cron job instead for production
 */
function fengshuihomestyle_regenerate_sitemap_on_save($post_id)
{
    // Don't generate sitemap for autosaves or revisions
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (wp_is_post_revision($post_id)) {
        return;
    }
    
    // Only regenerate for published posts/pages/services
    $post_type = get_post_type($post_id);
    $allowed_types = array('post', 'page', 'service');
    
    if (in_array($post_type, $allowed_types)) {
        $post_status = get_post_status($post_id);
        if ($post_status === 'publish') {
            fengshuihomestyle_generate_xml_sitemap();
        }
    }
}

// Uncomment to enable automatic sitemap regeneration on save
// add_action('save_post', 'fengshuihomestyle_regenerate_sitemap_on_save');

// If running directly (not via functions.php), generate now
if (!function_exists('add_action')) {
    fengshuihomestyle_generate_xml_sitemap();
} else {
    // If this file is included in functions.php, you can manually trigger with:
    // fengshuihomestyle_generate_xml_sitemap();
    
    // Or uncomment to generate on theme activation
    // add_action('after_switch_theme', 'fengshuihomestyle_generate_xml_sitemap');
}
