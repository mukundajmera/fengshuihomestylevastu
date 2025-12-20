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
    
    // Enqueue Google Fonts
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
        array( 'astra-theme-css', 'fengshuihomestyle-google-fonts' ),
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

/**
 * Calculate reading time for blog posts
 */
function fengshuihomestyle_vastu_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 ); // Average reading speed: 200 words per minute
    
    return $reading_time;
}

/**
 * Track post views for popular posts widget
 */
function fengshuihomestyle_vastu_set_post_views( $post_id ) {
    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

/**
 * Hook to track views on single posts
 */
function fengshuihomestyle_vastu_track_post_views( $post_id ) {
    if ( ! is_single() ) {
        return;
    }
    
    if ( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    }
    
    fengshuihomestyle_vastu_set_post_views( $post_id );
}
add_action( 'wp_head', 'fengshuihomestyle_vastu_track_post_views' );

/**
 * Register blog categories for pillar-cluster content
 */
function fengshuihomestyle_vastu_register_blog_categories() {
    // Check if categories already exist before creating
    $categories = array(
        'Directional Mastery' => 'Articles on the 8 cardinal directions and 5 elements in Vastu',
        'Solutions & Remedies' => 'Practical Vastu solutions for wealth, health, harmony, and career',
        'Remote Vastu' => 'Scientific and remote Vastu consultation methods',
    );
    
    foreach ( $categories as $cat_name => $cat_desc ) {
        if ( ! term_exists( $cat_name, 'category' ) ) {
            wp_insert_term(
                $cat_name,
                'category',
                array(
                    'description' => $cat_desc,
                    'slug' => sanitize_title( $cat_name ),
                )
            );
        }
    }
}
add_action( 'after_setup_theme', 'fengshuihomestyle_vastu_register_blog_categories' );

/**
 * Add Professional Service Schema Markup (JSON-LD)
 * Phase 3: Trust & Proliferation Engine
 */
function fengshuihomestyle_vastu_schema_markup() {
    if ( is_front_page() ) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'ProfessionalService',
            'name' => 'Feng Shui Homestyle Vastu',
            'image' => get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg',
            '@id' => home_url(),
            'url' => home_url(),
            'telephone' => '+91-9810143516',
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
                'yearsInOperation' => 25,
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
        
        echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
    }
}
add_action( 'wp_head', 'fengshuihomestyle_vastu_schema_markup' );

/**
 * Add Legacy Counter section before footer
 * Phase 3: Trust & Proliferation Engine
 */
function fengshuihomestyle_vastu_legacy_counter() {
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
add_action( 'astra_footer_before', 'fengshuihomestyle_vastu_legacy_counter' );
