<?php
/**
 * Feng Shui Homestyle Vastu Child Theme Functions
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Enqueue parent and child theme styles
 */
function fengshuihomestyle_vastu_enqueue_styles() {
    // Enqueue parent theme style
    wp_enqueue_style( 'astra-theme-css', get_template_directory_uri() . '/style.css', array(), ASTRA_THEME_VERSION );
    
    // Enqueue child theme style
    wp_enqueue_style( 
        'fengshuihomestyle-vastu-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-theme-css' ),
        wp_get_theme()->get( 'Version' )
    );
    
    // Enqueue custom JavaScript
    wp_enqueue_script(
        'fengshuihomestyle-vastu-script',
        get_stylesheet_directory_uri() . '/assets/js/custom.js',
        array( 'jquery' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'fengshuihomestyle_vastu_enqueue_styles', 15 );

/**
 * Add custom body classes
 */
function fengshuihomestyle_vastu_body_classes( $classes ) {
    $classes[] = 'digital-zen';
    $classes[] = 'feng-shui-theme';
    return $classes;
}
add_filter( 'body_class', 'fengshuihomestyle_vastu_body_classes' );

/**
 * Register custom navigation menus
 */
function fengshuihomestyle_vastu_register_menus() {
    register_nav_menus( array(
        'mobile-menu' => __( 'Mobile Menu', 'fengshuihomestyle-vastu' ),
    ) );
}
add_action( 'init', 'fengshuihomestyle_vastu_register_menus' );

/**
 * Customize Astra theme settings
 */
function fengshuihomestyle_vastu_theme_defaults( $defaults ) {
    $defaults['font-family-h1'] = "'Cinzel', serif";
    $defaults['font-family-h2'] = "'Cinzel', serif";
    $defaults['font-family-h3'] = "'Cinzel', serif";
    $defaults['font-family-body'] = "'Lato', sans-serif";
    return $defaults;
}
add_filter( 'astra_theme_defaults', 'fengshuihomestyle_vastu_theme_defaults' );

/**
 * Add support for featured images
 */
add_theme_support( 'post-thumbnails' );

/**
 * Add custom image sizes for the theme
 */
add_image_size( 'hero-image', 1920, 1080, true );
add_image_size( 'service-card', 600, 400, true );
add_image_size( 'energy-diagram', 800, 600, false );

/**
 * Disable Astra page title on front page
 */
function fengshuihomestyle_vastu_disable_page_title( $defaults ) {
    if ( is_front_page() ) {
        return false;
    }
    return $defaults;
}
add_filter( 'astra_the_title_enabled', 'fengshuihomestyle_vastu_disable_page_title' );

/**
 * Add custom meta tags for SEO
 */
function fengshuihomestyle_vastu_custom_meta_tags() {
    if ( is_front_page() ) {
        echo '<meta name="description" content="Scientific Vastu & Feng Shui Consultations. 100% Remote. 0% Demolition. Over 25 years of expert guidance by Sanjay Jain.">' . "\n";
        echo '<meta name="keywords" content="Vastu Shastra, Feng Shui, Remote Consultation, AutoCAD Floor Plan, Satellite Mapping, Sanjay Jain">' . "\n";
        echo '<meta property="og:title" content="Feng Shui Homestyle Vastu - Harmonize Your Space, Transform Your Life">' . "\n";
        echo '<meta property="og:description" content="Scientific Vastu: Harmony without Demolition. Remote consultations using True North Satellite Mapping and AutoCAD Floor Plan Analysis.">' . "\n";
        echo '<meta property="og:type" content="website">' . "\n";
    }
}
add_action( 'wp_head', 'fengshuihomestyle_vastu_custom_meta_tags' );

/**
 * Preload critical fonts for performance
 */
function fengshuihomestyle_vastu_preload_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'fengshuihomestyle_vastu_preload_fonts', 1 );

/**
 * Add WhatsApp chat widget
 */
function fengshuihomestyle_vastu_whatsapp_widget() {
    $phone_number = '+919810143516'; // Update with actual WhatsApp number
    $message = urlencode( 'Hello! I would like to book a Vastu consultation.' );
    ?>
    <div class="whatsapp-widget cta-sticky">
        <a href="https://wa.me/<?php echo esc_attr( $phone_number ); ?>?text=<?php echo esc_attr( $message ); ?>" 
           class="cta-primary whatsapp-cta" 
           target="_blank" 
           rel="noopener noreferrer">
            📱 Book Your WhatsApp Audit
        </a>
    </div>
    <?php
}
add_action( 'wp_footer', 'fengshuihomestyle_vastu_whatsapp_widget' );

/**
 * Register custom widget areas
 */
function fengshuihomestyle_vastu_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Hero Section', 'fengshuihomestyle-vastu' ),
        'id'            => 'hero-section',
        'description'   => __( 'Add widgets for the hero section', 'fengshuihomestyle-vastu' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'fengshuihomestyle_vastu_widgets_init' );

/**
 * Optimize performance - Remove unnecessary scripts and styles
 */
function fengshuihomestyle_vastu_optimize_performance() {
    // Remove emoji scripts for better performance
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
    // Remove WordPress version from head
    remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'fengshuihomestyle_vastu_optimize_performance' );
