<?php
/**
 * Vastu 2026 Glass Theme Functions
 *
 * @package Vastu_2026_Glass
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue parent and child theme styles
 */
function vastu_2026_glass_enqueue_styles() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'vastu-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Enqueue parent theme stylesheet
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme( 'astra' )->get( 'Version' )
    );

    // Enqueue child theme stylesheet
    wp_enqueue_style(
        'vastu-2026-glass-style',
        get_stylesheet_uri(),
        array( 'astra-parent-style', 'vastu-google-fonts' ),
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'vastu_2026_glass_enqueue_styles' );

/**
 * Enqueue custom JavaScript
 */
function vastu_2026_glass_enqueue_scripts() {
    wp_enqueue_script(
        'vastu-2026-glass-main',
        get_stylesheet_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );

    // Localize script with WhatsApp data
    wp_localize_script( 'vastu-2026-glass-main', 'vastuData', array(
        'whatsappNumber' => apply_filters( 'vastu_whatsapp_number', '919828088678' ),
        'whatsappMessage' => apply_filters( 'vastu_whatsapp_message', 'Hello! I would like to get my Energy Report.' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'vastu_2026_glass_enqueue_scripts' );

/**
 * Register the Bento Grid Shortcode
 */
function register_bento_shortcode() {
    add_shortcode( 'modern_bento_home', 'render_modern_bento_home' );
}
add_action( 'init', 'register_bento_shortcode' );

/**
 * Render the Modern Bento Home Grid
 *
 * @return string HTML output for the bento grid
 */
function render_modern_bento_home() {
    // Get the latest blog post
    $recent_posts = wp_get_recent_posts( array(
        'numberposts' => 1,
        'post_status' => 'publish',
    ) );

    $latest_post_title = '';
    $latest_post_link = '#';

    if ( ! empty( $recent_posts ) ) {
        $latest_post_title = esc_html( $recent_posts[0]['post_title'] );
        $latest_post_link = esc_url( get_permalink( $recent_posts[0]['ID'] ) );
    }

    // Hero background image - Use local asset or fallback
    $hero_bg_url = get_stylesheet_directory_uri() . '/assets/images/hero-desktop.webp';

    // WhatsApp configuration
    $whatsapp_number = apply_filters( 'vastu_whatsapp_number', '919828088678' );
    $whatsapp_message = apply_filters( 'vastu_whatsapp_message', 'Hello! I would like to get my Energy Report.' );
    $whatsapp_url = 'https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode( $whatsapp_message );

    ob_start();
    ?>
    <section class="bento-grid" aria-label="Homepage Feature Grid">
        
        <!-- Hero Item (Spans 2 columns) -->
        <article class="bento-item bento-item--hero glass-card" style="background-image: url('<?php echo esc_url( $hero_bg_url ); ?>');">
            <div class="hero-content">
                <h2>Transform Your Space, Transform Your Life</h2>
                <p>Discover the ancient wisdom of Vastu Shastra combined with modern Feng Shui principles for harmonious living.</p>
                <a href="<?php echo esc_url( $whatsapp_url ); ?>" class="btn-primary" target="_blank" rel="noopener noreferrer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Get Energy Report
                </a>
            </div>
        </article>

        <!-- Wisdom Item (Latest Blog Post) -->
        <article class="bento-item bento-item--wisdom glass-card">
            <span class="wisdom-label">Latest Wisdom</span>
            <h3>From Our Blog</h3>
            <?php if ( ! empty( $latest_post_title ) ) : ?>
                <p class="post-title">
                    <a href="<?php echo $latest_post_link; ?>">
                        <?php echo $latest_post_title; ?>
                    </a>
                </p>
            <?php else : ?>
                <p class="post-title">Explore our collection of Vastu and Feng Shui insights.</p>
            <?php endif; ?>
        </article>

        <!-- Contact Item (WhatsApp Trigger) -->
        <div id="whatsapp-trigger" class="bento-item bento-item--contact glass-card" onclick="window.open('<?php echo esc_js( $whatsapp_url ); ?>', '_blank')" role="button" tabindex="0" aria-label="Contact us on WhatsApp">
            <svg class="whatsapp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            <h3>Chat With Us</h3>
            <p>Get instant consultation</p>
        </div>

    </section>
    <?php
    return ob_get_clean();
}

/**
 * Add theme support features
 */
function vastu_2026_glass_theme_support() {
    // Add support for responsive embeds
    add_theme_support( 'responsive-embeds' );
    
    // Add support for wide alignment
    add_theme_support( 'align-wide' );
    
    // Add support for editor styles
    add_theme_support( 'editor-styles' );
    
    // Add custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'vastu_2026_glass_theme_support' );

/**
 * Register custom widget area for bento sidebar
 */
function vastu_2026_glass_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Bento Sidebar', 'vastu-2026-glass' ),
        'id'            => 'bento-sidebar',
        'description'   => __( 'Add widgets here to appear in the bento grid area.', 'vastu-2026-glass' ),
        'before_widget' => '<div id="%1$s" class="bento-item bento-item--widget glass-card %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'vastu_2026_glass_widgets_init' );

/**
 * Allow filtering of WhatsApp number
 *
 * @param string $number Default WhatsApp number
 * @return string
 */
function vastu_set_whatsapp_number( $number ) {
    // Override this in your site's options or a custom plugin
    return get_option( 'vastu_whatsapp_number', $number );
}
add_filter( 'vastu_whatsapp_number', 'vastu_set_whatsapp_number' );

/**
 * Add preconnect for Google Fonts performance
 */
function vastu_2026_glass_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'vastu_2026_glass_preconnect_fonts', 1 );
