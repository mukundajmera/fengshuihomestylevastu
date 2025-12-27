<?php
/**
 * Feng Shui Homestyle Vastu Child Theme Functions
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Load SEO Schema Generator (Entity Graph Engine)
require_once get_stylesheet_directory() . '/inc/seo-schema.php';

/**
 * Enqueue parent and child theme styles
 */
function fengshuihomestyle_vastu_enqueue_styles()
{
    // Enqueue parent theme style
    wp_enqueue_style('astra-theme-css', get_template_directory_uri() . '/style.css', array(), ASTRA_THEME_VERSION);

    // Enqueue Google Fonts with font-display: swap for performance
    wp_enqueue_style(
        'fengshuihomestyle-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Lato:wght@300;400;700&display=swap',
        array(),
        null
    );

    // Enqueue child theme style
    wp_enqueue_style(
        'fengshuihomestyle-vastu-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('astra-theme-css', 'fengshuihomestyle-google-fonts'),
        wp_get_theme()->get('Version')
    );

    // Enqueue custom JavaScript
    wp_enqueue_script(
        'fengshuihomestyle-vastu-script',
        get_stylesheet_directory_uri() . '/assets/js/custom.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'fengshuihomestyle_vastu_enqueue_styles', 15);

/**
 * Add custom body classes
 */
function fengshuihomestyle_vastu_body_classes($classes)
{
    $classes[] = 'digital-zen';
    $classes[] = 'feng-shui-theme';
    return $classes;
}
add_filter('body_class', 'fengshuihomestyle_vastu_body_classes');

/**
 * Register custom navigation menus
 */
function fengshuihomestyle_vastu_register_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu (Header)', 'fengshuihomestyle-vastu'),
        'footer' => __('Footer Menu', 'fengshuihomestyle-vastu'),
        'mobile-menu' => __('Mobile Menu', 'fengshuihomestyle-vastu'),
    ));
}
add_action('init', 'fengshuihomestyle_vastu_register_menus');

/**
 * Custom walker for responsive navigation menu
 */
class Mobile_Walker_Nav_Menu extends Walker_Nav_Menu
{
    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        $classes = array('sub-menu');
        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= "{$n}{$indent}<ul$class_names data-depth=\"{$depth}\">{$n}";
    }
}

/**
 * Register custom post types
 */
function fengshuihomestyle_vastu_register_post_types()
{
    // Services Custom Post Type
    register_post_type('service', array(
        'labels' => array(
            'name' => __('Services', 'fengshuihomestyle-vastu'),
            'singular_name' => __('Service', 'fengshuihomestyle-vastu'),
            'add_new' => __('Add New Service', 'fengshuihomestyle-vastu'),
            'add_new_item' => __('Add New Service', 'fengshuihomestyle-vastu'),
            'edit_item' => __('Edit Service', 'fengshuihomestyle-vastu'),
            'new_item' => __('New Service', 'fengshuihomestyle-vastu'),
            'view_item' => __('View Service', 'fengshuihomestyle-vastu'),
            'search_items' => __('Search Services', 'fengshuihomestyle-vastu'),
            'not_found' => __('No services found', 'fengshuihomestyle-vastu'),
            'not_found_in_trash' => __('No services found in trash', 'fengshuihomestyle-vastu'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'services'),
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-admin-multisite',
        'menu_position' => 5,
        'capability_type' => 'post',
        'hierarchical' => false,
    ));

    // Testimonials Custom Post Type
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'fengshuihomestyle-vastu'),
            'singular_name' => __('Testimonial', 'fengshuihomestyle-vastu'),
            'add_new' => __('Add New Testimonial', 'fengshuihomestyle-vastu'),
            'add_new_item' => __('Add New Testimonial', 'fengshuihomestyle-vastu'),
            'edit_item' => __('Edit Testimonial', 'fengshuihomestyle-vastu'),
            'new_item' => __('New Testimonial', 'fengshuihomestyle-vastu'),
            'view_item' => __('View Testimonial', 'fengshuihomestyle-vastu'),
            'search_items' => __('Search Testimonials', 'fengshuihomestyle-vastu'),
            'not_found' => __('No testimonials found', 'fengshuihomestyle-vastu'),
            'not_found_in_trash' => __('No testimonials found in trash', 'fengshuihomestyle-vastu'),
        ),
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-star-filled',
        'menu_position' => 6,
        'capability_type' => 'post',
        'hierarchical' => false,
    ));
}
add_action('init', 'fengshuihomestyle_vastu_register_post_types');

/**
 * Customize Astra theme settings
 */
function fengshuihomestyle_vastu_theme_defaults($defaults)
{
    $defaults['font-family-h1'] = "'Cinzel', serif";
    $defaults['font-family-h2'] = "'Cinzel', serif";
    $defaults['font-family-h3'] = "'Cinzel', serif";
    $defaults['font-family-body'] = "'Lato', sans-serif";
    return $defaults;
}
add_filter('astra_theme_defaults', 'fengshuihomestyle_vastu_theme_defaults');

/**
 * Add support for featured images
 */
add_theme_support('post-thumbnails');

/**
 * Add custom image sizes for the theme
 */
add_image_size('hero-image', 1920, 1080, true);
add_image_size('service-card', 600, 400, true);
add_image_size('energy-diagram', 800, 600, false);

/**
 * Disable Astra page title on front page
 */
function fengshuihomestyle_vastu_disable_page_title($defaults)
{
    if (is_front_page()) {
        return false;
    }
    return $defaults;
}
add_filter('astra_the_title_enabled', 'fengshuihomestyle_vastu_disable_page_title');

/**
 * Add custom meta tags for SEO
 */
function fengshuihomestyle_vastu_custom_meta_tags()
{
    // Critical viewport meta tag for responsive design
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">' . "\n";
    
    // Robots meta tag for SEO control
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    
    // Canonical URL
    $canonical_url = is_front_page() ? home_url('/') : get_permalink();
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
    
    if (is_front_page()) {
        echo '<meta name="description" content="Expert Feng Shui and Vastu consultancy services. Harmonize your living and workspace with ancient wisdom for prosperity, health, and peace. 25+ years experience. Free consultation available.">' . "\n";
        echo '<meta name="keywords" content="Feng Shui consultant, Vastu Shastra, Remote Consultation, Home Energy, Office Vastu, AutoCAD Floor Plan, Satellite Mapping, Sanjay Jain">' . "\n";
        
        // Open Graph meta tags for social sharing
        echo '<meta property="og:title" content="Feng Shui Homestyle Vastu - Harmonize Your Space, Transform Your Life">' . "\n";
        echo '<meta property="og:description" content="Scientific Vastu: Harmony without Demolition. Remote consultations using True North Satellite Mapping and AutoCAD Floor Plan Analysis.">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">' . "\n";
        
        // OG Image for WhatsApp/LinkedIn preview
        $og_image = get_stylesheet_directory_uri() . '/assets/images/hero_energy_foyer.png';
        echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
        echo '<meta property="og:image:alt" content="Feng Shui Homestyle Vastu - Scientific Space Harmonization">' . "\n";
        
        // Twitter Card meta tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="Feng Shui Homestyle Vastu - Harmonize Your Space">' . "\n";
        echo '<meta name="twitter:description" content="Scientific Vastu: Harmony without Demolition. 25+ years of expertise.">' . "\n";
        echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";
    }
    
    // Enhanced meta tags for singular posts and pages
    if (is_singular() && !is_front_page()) {
        global $post;
        
        // Generate description from post content
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words(strip_tags($post->post_content), 30);
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
        
        // Open Graph tags for posts/pages
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . ' - Feng Shui Homestyle Vastu">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        echo '<meta property="og:site_name" content="Feng Shui Homestyle Vastu">' . "\n";
        
        // OG Image from featured image or fallback
        if (has_post_thumbnail()) {
            $og_image = get_the_post_thumbnail_url(null, 'large');
            echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        } else {
            $og_image = get_stylesheet_directory_uri() . '/assets/images/hero_energy_foyer.png';
            echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        }
        
        // Article specific tags
        if (is_single()) {
            echo '<meta property="article:published_time" content="' . esc_attr(get_the_date('c')) . '">' . "\n";
            echo '<meta property="article:modified_time" content="' . esc_attr(get_the_modified_date('c')) . '">' . "\n";
            echo '<meta property="article:author" content="Sanjay Jain">' . "\n";
        }
        
        // Twitter Card tags
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
        if (has_post_thumbnail()) {
            echo '<meta name="twitter:image" content="' . esc_url(get_the_post_thumbnail_url(null, 'large')) . '">' . "\n";
        }
    }
}
add_action('wp_head', 'fengshuihomestyle_vastu_custom_meta_tags', 1);

/**
 * Preload critical resources for performance (fonts and LCP images)
 */
function fengshuihomestyle_vastu_preload_critical_resources()
{
    // Preconnect to Google Fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    
    // Preload hero image for LCP optimization on the front page
    if (is_front_page()) {
        echo '<link rel="preload" as="image" href="' . esc_url(get_stylesheet_directory_uri() . '/assets/images/hero_energy_foyer.png') . '" fetchpriority="high">' . "\n";
    }
}
add_action('wp_head', 'fengshuihomestyle_vastu_preload_critical_resources', 0);

/**
 * Remove unnecessary WordPress features for better performance
 */
function fengshuihomestyle_vastu_remove_unnecessary_features()
{
    // Remove WordPress version from head (already done in optimize_performance)
    remove_action('wp_head', 'wp_generator');
    
    // Remove Windows Live Writer manifest link
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove Really Simple Discovery (RSD) link
    remove_action('wp_head', 'rsd_link');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    
    // Remove REST API link (if not needed for front-end)
    // remove_action('wp_head', 'rest_output_link_wp_head', 10);
}
add_action('init', 'fengshuihomestyle_vastu_remove_unnecessary_features');

/**
 * Add WhatsApp chat widget
 */
function fengshuihomestyle_vastu_whatsapp_widget()
{
    $phone_number = '+919828088678'; // Sanjay Jain's WhatsApp number
    $message = urlencode('Hello Sanjay, I would like to consult regarding my space.');
    ?>
    <div class="whatsapp-widget cta-sticky">
        <a href="https://wa.me/<?php echo esc_attr($phone_number); ?>?text=<?php echo esc_attr($message); ?>"
            class="cta-primary whatsapp-cta" target="_blank" rel="noopener noreferrer">
            📱 Chat with Sanjay Jain
        </a>
    </div>
    <?php
}
add_action('wp_footer', 'fengshuihomestyle_vastu_whatsapp_widget');

/**
 * Register custom widget areas
 */
function fengshuihomestyle_vastu_widgets_init()
{
    register_sidebar(array(
        'name' => __('Hero Section', 'fengshuihomestyle-vastu'),
        'id' => 'hero-section',
        'description' => __('Add widgets for the hero section', 'fengshuihomestyle-vastu'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'fengshuihomestyle_vastu_widgets_init');

/**
 * Optimize performance - Remove unnecessary scripts and styles
 */
function fengshuihomestyle_vastu_optimize_performance()
{
    // Remove emoji scripts for better performance
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');

    // Remove WordPress version from head
    remove_action('wp_head', 'wp_generator');
}
add_action('init', 'fengshuihomestyle_vastu_optimize_performance');

/**
 * Add Vary: User-Agent header to prevent mobile/desktop caching conflicts
 * Critical for wp_is_mobile() based adaptive rendering
 * 
 * Note: This header may reduce cache efficiency with some CDNs and caching plugins
 * as it creates separate cache entries for each User-Agent string. However, it's
 * necessary to prevent desktop HTML from being served to mobile users when using
 * wp_is_mobile() for adaptive rendering. Consider CSS-only responsive design or
 * JavaScript-based device detection for future iterations to improve cache hit rates.
 */
function vastu_add_vary_user_agent_header()
{
    if (!is_admin()) {
        header('Vary: User-Agent');
    }
}
add_action('send_headers', 'vastu_add_vary_user_agent_header');

/**
 * Generate dynamic alt text for featured images and background images
 * Improves accessibility and SEO
 *
 * @param string $context The context where the image is used (e.g., 'hero', 'card', 'gallery')
 * @param int|null $post_id Optional post ID for context-aware alt text
 * @return string Generated alt text
 */
function vastu_generate_alt_text($context = 'default', $post_id = null)
{
    $site_name = get_bloginfo('name');
    $site_suffix = $site_name !== '' ? ' - ' . $site_name : '';
    
    $alt_texts = [
        'hero' => 'Serene living space designed with Vastu Shastra and Feng Shui principles' . $site_suffix,
        'hero-mobile' => 'Harmonious home interior showcasing Vastu energy flow' . $site_suffix,
        'hero-desktop' => 'Professional Vastu consultation space with balanced energy' . $site_suffix,
        'kitchen' => 'Vibrant kitchen aligned with Vastu Fire element for family wellness',
        'bedroom' => 'Peaceful bedroom with Vastu South-West stability for relationships',
        'entrance' => 'Minimalist entrance foyer optimized for wealth and abundance',
        'office' => 'Modern office space with Vastu energy optimization for productivity',
        'retail' => 'Retail space designed for customer flow and sales excellence',
        'factory' => 'Industrial facility with Vastu operational flow optimization',
        'default' => 'Vastu and Feng Shui harmonized space' . $site_suffix,
    ];
    
    if ($post_id && has_post_thumbnail($post_id)) {
        $existing_alt = get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true);
        if (!empty($existing_alt)) {
            return esc_attr($existing_alt);
        }
    }
    
    return isset($alt_texts[$context]) ? esc_attr($alt_texts[$context]) : esc_attr($alt_texts['default']);
}

/**
 * Optimized image output helper
 * 
 * Outputs an image tag with proper WordPress paths, lazy loading, and alt text.
 *
 * @param string $image_name The image filename (e.g., 'hero-image.webp')
 * @param string $alt_text Optional custom alt text
 * @param string $loading Optional loading attribute ('lazy' or 'eager')
 * @param string $size Optional image size ('thumbnail', 'medium', 'large', 'full')
 * @param array  $additional_attrs Optional additional HTML attributes
 */
function optimized_image($image_name, $alt_text = '', $loading = 'lazy', $size = 'full', $additional_attrs = array())
{
    $image_url = get_stylesheet_directory_uri() . '/assets/images/' . $image_name;
    
    // If no alt text provided, use empty string for decorative images
    $alt_attr = !empty($alt_text) ? 'alt="' . esc_attr($alt_text) . '"' : 'alt=""';
    
    // Build additional attributes string
    $attrs_string = '';
    foreach ($additional_attrs as $key => $value) {
        $attrs_string .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
    }
    
    // Output the image tag with optimizations
    echo '<img src="' . esc_url($image_url) . '" ' . $alt_attr . ' loading="' . esc_attr($loading) . '" decoding="async"' . $attrs_string . '>';
}

/**
 * Add lazy loading to images in content
 */
function fengshuihomestyle_vastu_add_lazy_loading_to_images($content)
{
    // Add loading="lazy" to images in the content that don't already have it
    $content = preg_replace('/<img((?![^>]*loading=)[^>]*)>/i', '<img$1 loading="lazy">', $content);
    return $content;
}
add_filter('the_content', 'fengshuihomestyle_vastu_add_lazy_loading_to_images');

/**
 * ========================================
 * Smart Asset Loader - Core Web Vitals Engine
 * ========================================
 * Optimizes FCP/LCP by deferring non-critical assets
 * and implementing interaction-based script hydration.
 */

/**
 * De-queue non-critical styles and scripts
 */
function vastu_smart_asset_loader()
{
    // Remove WordPress Block Library CSS (save ~50KB)
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // WooCommerce blocks if present

    // Remove Global Styles (Gutenberg inline CSS)
    wp_dequeue_style('global-styles');

    // Remove Classic Theme Styles
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'vastu_smart_asset_loader', 100);

/**
 * Remove emoji scripts and DNS prefetch (additional ~50KB savings)
 */
function vastu_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Remove DNS prefetch for emoji CDN
    add_filter('wp_resource_hints', function ($urls, $relation_type) {
        if ($relation_type === 'dns-prefetch') {
            $urls = array_filter($urls, function ($url) {
                return strpos($url, 'https://s.w.org/images/core/emoji/') === false;
            });
        }
        return $urls;
    }, 10, 2);
}
add_action('init', 'vastu_disable_emojis');

/**
 * Add defer attribute to non-critical scripts
 */
function vastu_defer_scripts($tag, $handle, $src)
{
    // Scripts to defer for better FCP
    $defer_scripts = [
        'vastu-compass-js',
        'vastu-kua-engine',
        'fengshuihomestyle-vastu-script',
        'comment-reply',
    ];

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src=', ' defer src=', $tag);
    }

    return $tag;
}
add_filter('script_loader_tag', 'vastu_defer_scripts', 10, 3);

/**
 * Add preconnect hints for critical third-party origins
 */
function vastu_add_resource_hints()
{
    // Preconnect to Google Fonts (already present but ensuring priority)
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";

    // DNS prefetch for WhatsApp API
    echo '<link rel="dns-prefetch" href="https://wa.me">' . "\n";
}
add_action('wp_head', 'vastu_add_resource_hints', 1);

/**
 * Inject interaction-based script hydration
 * Heavy scripts load ONLY after user interaction (mousemove/touchstart)
 */
function vastu_interaction_hydration()
{
    // Define heavy scripts to lazy load after interaction
    $heavy_scripts = [
        'vastu-compass' => get_stylesheet_directory_uri() . '/assets/js/vastu-compass.js',
    ];

    // Only output if we have scripts to hydrate
    if (empty($heavy_scripts)) {
        return;
    }

    $scripts_json = wp_json_encode($heavy_scripts);
    ?>
    <script id="vastu-interaction-hydration">
        (function () {
            'use strict';

            var hydrated = false;
            var heavyScripts = <?php echo $scripts_json; ?>;

            function loadHeavyScripts() {
                if (hydrated) return;
                hydrated = true;

                // Remove event listeners after first interaction
                ['mousemove', 'touchstart', 'scroll', 'keydown'].forEach(function (evt) {
                    window.removeEventListener(evt, loadHeavyScripts, { passive: true });
                });

                // Load each heavy script dynamically
                Object.keys(heavyScripts).forEach(function (handle) {
                    var script = document.createElement('script');
                    script.src = heavyScripts[handle];
                    script.defer = true;
                    script.id = handle + '-hydrated';
                    document.body.appendChild(script);
                });

                // Dispatch custom event for components that depend on hydration
                window.dispatchEvent(new CustomEvent('vastu-hydrated'));
            }

            // Attach listeners for user interaction
            ['mousemove', 'touchstart', 'scroll', 'keydown'].forEach(function (evt) {
                window.addEventListener(evt, loadHeavyScripts, { once: true, passive: true });
            });

            // Fallback: Load after 5 seconds if no interaction
            setTimeout(loadHeavyScripts, 5000);
        })();
    </script>
    <?php
}
add_action('wp_footer', 'vastu_interaction_hydration', 5);

/**
 * Optimize image loading attributes
 * Adds decoding="async" to all images and loading="lazy" for below-fold images
 */
function vastu_optimize_image_attributes($attr, $attachment, $size)
{
    // Add async decoding to all images
    $attr['decoding'] = 'async';

    // Keep loading="lazy" for non-hero images (WordPress 5.5+ default)
    // Hero images should use loading="eager" set inline in template
    if (!isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'vastu_optimize_image_attributes', 10, 3);

/**
 * Add fetchpriority="high" to LCP images (hero images)
 */
function vastu_lcp_image_priority($content)
{
    // Look for hero/featured images and add fetchpriority
    $content = preg_replace(
        '/<img([^>]*class="[^"]*hero[^"]*"[^>]*)>/i',
        '<img$1 fetchpriority="high">',
        $content
    );

    return $content;
}
add_filter('the_content', 'vastu_lcp_image_priority', 99);

/**
 * Register deferred Kua Engine script
 */
function vastu_register_kua_engine()
{
    wp_register_script(
        'vastu-kua-engine',
        get_stylesheet_directory_uri() . '/assets/js/kua-engine.js',
        [],
        wp_get_theme()->get('Version'),
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'vastu_register_kua_engine');

/**
 * Calculate reading time for blog posts
 */
function fengshuihomestyle_vastu_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute

    return $reading_time;
}

/**
 * Track post views for popular posts widget
 */
function fengshuihomestyle_vastu_set_post_views($post_id)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

/**
 * Hook to track views on single posts
 */
function fengshuihomestyle_vastu_track_post_views($post_id)
{
    if (!is_single()) {
        return;
    }

    if (empty($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    fengshuihomestyle_vastu_set_post_views($post_id);
}
add_action('wp_head', 'fengshuihomestyle_vastu_track_post_views');

/**
 * Register blog categories for pillar-cluster content
 */
function fengshuihomestyle_vastu_register_blog_categories()
{
    // Check if categories already exist before creating
    $categories = array(
        'Directional Mastery' => 'Articles on the 8 cardinal directions and 5 elements in Vastu',
        'Solutions & Remedies' => 'Practical Vastu solutions for wealth, health, harmony, and career',
        'Remote Vastu' => 'Scientific and remote Vastu consultation methods',
    );

    foreach ($categories as $cat_name => $cat_desc) {
        if (!term_exists($cat_name, 'category')) {
            wp_insert_term(
                $cat_name,
                'category',
                array(
                    'description' => $cat_desc,
                    'slug' => sanitize_title($cat_name),
                )
            );
        }
    }
}
add_action('after_setup_theme', 'fengshuihomestyle_vastu_register_blog_categories');

/**
 * DEPRECATED: Legacy schema markup - Now handled by Vastu_Schema_Generator class
 * @see inc/seo-schema.php for the new Entity Graph SEO Engine
 * Keeping commented for reference during migration.
 *
function fengshuihomestyle_vastu_schema_markup()
{
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Feng Shui Homestyle Vastu',
            'image' => get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg',
            '@id' => home_url(),
            'url' => home_url(),
            'telephone' => '+919828088678',
            'priceRange' => '$$',
            'address' => array(
                '@type' => 'PostalAddress',
                'addressCountry' => 'IN',
                'addressRegion' => 'Global Remote Services',
            ),
            'geo' => array(
                '@type' => 'GeoCoordinates',
                'latitude' => 28.6139,
                'longitude' => 77.2090,
            ),
            'openingHoursSpecification' => array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => array(
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                    'Saturday',
                ),
                'opens' => '09:00',
                'closes' => '18:00',
            ),
            'founder' => array(
                '@type' => 'Person',
                'name' => 'Sanjay Jain',
                'jobTitle' => 'Senior Vastu & Feng Shui Consultant',
                'description' => 'Top-rated Vastu Shastra and Feng Shui consultant with 25+ years of experience in remote scientific consultations.',
                'knowsAbout' => array(
                    'Vastu Shastra',
                    'Feng Shui',
                    'Scientific Remote Consultation',
                    'AutoCAD Floor Plan Analysis',
                    'Satellite Mapping',
                    'Energy Alignment',
                    'Five Elements Theory',
                ),
            ),
            'aggregateRating' => array(
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => '10000',
                'bestRating' => '5',
                'worstRating' => '1',
            ),
            'description' => 'Expert Vastu & Feng Shui consultations for residential and commercial spaces. 100% Remote consultations using True North Satellite Mapping and AutoCAD Floor Plan Analysis. Over 25 years of mastery with 10,000+ success stories. Zero demolition required.',
            'areaServed' => array(
                array(
                    '@type' => 'City',
                    'name' => 'Jaipur',
                ),
                array(
                    '@type' => 'City',
                    'name' => 'Mumbai',
                ),
                array(
                    '@type' => 'City',
                    'name' => 'Delhi',
                ),
                array(
                    '@type' => 'City',
                    'name' => 'Bangalore',
                ),
                array(
                    '@type' => 'City',
                    'name' => 'Dubai',
                ),
                array(
                    '@type' => 'City',
                    'name' => 'Singapore',
                ),
                array(
                    '@type' => 'City',
                    'name' => 'London',
                ),
                array(
                    '@type' => 'Country',
                    'name' => 'India',
                ),
                array(
                    '@type' => 'Country',
                    'name' => 'United Arab Emirates',
                ),
                array(
                    '@type' => 'Country',
                    'name' => 'Singapore',
                ),
                array(
                    '@type' => 'Country',
                    'name' => 'United Kingdom',
                ),
                array(
                    '@type' => 'Country',
                    'name' => 'United States',
                ),
            ),
            'hasOfferCatalog' => array(
                '@type' => 'OfferCatalog',
                'name' => 'Vastu & Feng Shui Services',
                'itemListElement' => array(
                    array(
                        '@type' => 'Offer',
                        'itemOffered' => array(
                            '@type' => 'Service',
                            'name' => 'Residential Vastu Consultation',
                            'description' => 'Complete home energy analysis for health, wealth, and harmony',
                        ),
                    ),
                    array(
                        '@type' => 'Offer',
                        'itemOffered' => array(
                            '@type' => 'Service',
                            'name' => 'Commercial Vastu Consultation',
                            'description' => 'Business space optimization for enhanced productivity and profitability',
                        ),
                    ),
                    array(
                        '@type' => 'Offer',
                        'itemOffered' => array(
                            '@type' => 'Service',
                            'name' => 'Remote Scientific Vastu Audit',
                            'description' => '100% remote consultation using satellite mapping and AutoCAD analysis',
                        ),
                    ),
                ),
            ),
            'slogan' => 'Scientific Vastu: Harmony without Demolition',
            'knowsLanguage' => array('English', 'Hindi'),
        );

        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
// add_action('wp_head', 'fengshuihomestyle_vastu_schema_markup');
*/

/**
 * Add Legacy Counter section before footer
 * Phase 3: Trust & Proliferation Engine
 */
function fengshuihomestyle_vastu_legacy_counter()
{
    ?>
    <!-- LEGACY COUNTER - Phase 3 Trust Engine -->
    <section class="legacy-counter-section">
        <div class="legacy-counter-container">
            <div class="legacy-item" data-aos="fade-up" data-aos-delay="100">
                <div class="legacy-icon">⚡</div>
                <div class="legacy-number trust-counter">25</div>
                <div class="legacy-suffix">+ Years</div>
                <div class="legacy-label">Of Mastery</div>
            </div>

            <div class="legacy-divider"></div>

            <div class="legacy-item" data-aos="fade-up" data-aos-delay="200">
                <div class="legacy-icon">👨‍👩‍👧‍👦</div>
                <div class="legacy-number trust-counter">10,000</div>
                <div class="legacy-suffix">+</div>
                <div class="legacy-label">Families Aligned</div>
            </div>

            <div class="legacy-divider"></div>

            <div class="legacy-item" data-aos="fade-up" data-aos-delay="300">
                <div class="legacy-icon">✓</div>
                <div class="legacy-number">100</div>
                <div class="legacy-suffix">%</div>
                <div class="legacy-label">No-Demolition Guarantee</div>
            </div>
        </div>

        <div class="legacy-tagline">
            <p>Transforming Spaces. Preserving Structures. Creating Harmony.</p>
        </div>
    </section>
    <?php
}
add_action('astra_footer_before', 'fengshuihomestyle_vastu_legacy_counter');

/**
 * ========================================
 * WhatsApp Lead Engine - Vastu 2026
 * ========================================
 */

// Define the primary WhatsApp number
if (!defined('VASTU_PHONE')) {
    define('VASTU_PHONE', '919828088678');
}

/**
 * Generate dynamic WhatsApp link based on intent
 *
 * @param string $intent The consultation intent (e.g., 'home', 'office', 'general').
 * @return string The complete WhatsApp URL with pre-filled message.
 */
function vastu_get_wa_link($intent = 'general')
{
    $phone = VASTU_PHONE;

    // Intent-based message templates
    $messages = array(
        'home' => 'Hi Sanjay, I need a Home Vastu check. I would like to schedule a consultation for my residence.',
        'office' => 'Hi Sanjay, I need an Office Vastu check. I would like to optimize my workspace for success.',
        'factory' => 'Hi Sanjay, I need a Factory/Industrial Vastu check. Please help me align my production space.',
        'shop' => 'Hi Sanjay, I need a Shop/Retail Vastu check. I want to enhance prosperity in my business.',
        'plot' => 'Hi Sanjay, I need a Plot Selection consultation. Please guide me on choosing the right land.',
        'new_home' => 'Hi Sanjay, I am building a New Home and need Vastu guidance from the planning stage.',
        'remedies' => 'Hi Sanjay, I need Vastu Remedies for my existing space without any demolition.',
        'general' => 'Hi Sanjay, I would like to consult regarding Vastu for my space. Please guide me.',
    );

    // Get the appropriate message or fall back to general
    $message = isset($messages[$intent]) ? $messages[$intent] : $messages['general'];

    // URL encode the message
    $encoded_message = rawurlencode($message);

    // Construct and return the WhatsApp URL
    return 'https://wa.me/' . $phone . '?text=' . $encoded_message;
}

/**
 * Add Mobile Sticky Bar - "Thumb Zone" Optimization
 * Only renders on mobile devices for optimal UX
 */
function vastu_add_mobile_sticky_bar()
{
    // Only show on mobile devices
    if (!wp_is_mobile()) {
        return;
    }

    $wa_link = vastu_get_wa_link('general');
    ?>
    <!-- Vastu Mobile Sticky Bar - Thumb Zone CTA -->
    <div class="vastu-mobile-sticky-bar">
        <a href="<?php echo esc_url($wa_link); ?>" target="_blank" rel="noopener noreferrer">
            <!-- WhatsApp SVG Icon -->
            <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
            </svg>
            <span class="bar-text">Chat with Sanjay</span>
            <span class="online-indicator">
                <span class="online-dot"></span>
                Online
            </span>
        </a>
    </div>
    <?php
}
add_action('wp_footer', 'vastu_add_mobile_sticky_bar');

/**
 * ========================================
 * Wisdom Gallery Shortcode - Vastu 2026
 * ========================================
 * Usage: [vastu_wisdom_gallery]
 */
function vastu_wisdom_gallery_shortcode()
{
    ob_start();
    get_template_part('parts/wisdom-gallery');
    return ob_get_clean();
}
add_shortcode('vastu_wisdom_gallery', 'vastu_wisdom_gallery_shortcode');

/**
 * ========================================
 * Vastu Compass - Gyroscope Utility
 * ========================================
 * Loads compass overlay and sensor script on mobile devices only.
 */
function vastu_load_compass_assets()
{
    // Only load on mobile devices
    if (!wp_is_mobile()) {
        return;
    }

    // Include the compass overlay template part
    get_template_part('parts/compass-overlay');

    // Enqueue the compass JavaScript
    wp_enqueue_script(
        'vastu-compass-js',
        get_stylesheet_directory_uri() . '/assets/js/vastu-compass.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true // Load in footer
    );
}
add_action('wp_footer', 'vastu_load_compass_assets');

/**
 * ========================================
 * Contact Form Handler
 * ========================================
 * Handles contact form submissions with proper sanitization and validation
 */
function fengshuihomestyle_vastu_handle_contact_form()
{
    // Ensure the form is only processed on POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    
    if (!isset($_POST['submit_contact']) || !isset($_POST['contact_form_nonce'])) {
        return;
    }
    
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_submit')) {
        wp_die('Security check failed. Please try again.');
    }
    
    // Sanitize and validate inputs
    $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    
    // Validate required fields
    $errors = array();
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email) || !is_email($email)) {
        $errors[] = 'Valid email is required';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    }
    
    // If there are errors, redirect with error message
    if (!empty($errors)) {
        $error_message = implode(', ', $errors);
        $redirect_url = wp_get_referer();
        // Validate referrer and fall back to a safe internal URL to prevent open redirects
        $safe_base_url = wp_validate_redirect($redirect_url, home_url('/contact'));
        wp_safe_redirect(add_query_arg(array('contact' => 'error', 'msg' => urlencode($error_message)), $safe_base_url));
        exit;
    }
    
    // Prepare email
    $to = get_option('admin_email');
    $subject = 'New Contact Form Submission - Feng Shui Homestyle Vastu';
    
    $body = "New contact form submission:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    
    if (!empty($phone)) {
        $body .= "Phone: $phone\n";
    }
    
    $body .= "\nMessage:\n$message\n\n";
    $body .= "---\n";
    $body .= "Submitted from: " . home_url('/contact') . "\n";
    $ip_address = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : 'Unknown';
    $body .= "IP Address: " . $ip_address . "\n";
    $body .= "Time: " . current_time('mysql') . "\n";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );
    
    // Send email
    $sent = wp_mail($to, $subject, $body, $headers);
    
    // Redirect with success or error message using safe redirect
    if ($sent) {
        wp_safe_redirect(add_query_arg('contact', 'success', home_url('/contact')));
    } else {
        wp_safe_redirect(add_query_arg('contact', 'error', home_url('/contact')));
    }
    exit;
}
add_action('init', 'fengshuihomestyle_vastu_handle_contact_form');

/**
 * Display contact form messages
 */
function fengshuihomestyle_vastu_contact_form_messages()
{
    if (!is_page('contact')) {
        return;
    }
    
    if (isset($_GET['contact'])) {
        $contact_status = sanitize_text_field(wp_unslash($_GET['contact']));
        if ('success' === $contact_status) {
            echo '<div class="contact-message success">Thank you for your message! We will get back to you soon.</div>';
        } elseif ('error' === $contact_status) {
            $msg = isset($_GET['msg'])
                ? sanitize_text_field(wp_unslash($_GET['msg']))
                : 'There was an error sending your message. Please try again.';
            echo '<div class="contact-message error">' . esc_html($msg) . '</div>';
        }
    }
}
add_action('wp_footer', 'fengshuihomestyle_vastu_contact_form_messages');
