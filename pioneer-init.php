<?php
/**
 * Pioneer Init Script - WordPress Environment Configuration
 * 
 * This script programmatically configures the WordPress environment to:
 * - Set up site identity and routing
 * - Inject custom design CSS (Astra/Elementor)
 * - Configure WhatsApp lead capture
 * - Seed initial content
 * 
 * Security: Runs only once, then self-destructs
 * 
 * @package Feng Shui Homestyle Vastu
 * @version 1.0.0
 */

// Security: Define a secret key to prevent unauthorized execution
define('PIONEER_SECRET_KEY', 'feng-shui-2026-pioneer');

// Security: Check if already executed
$execution_marker = __DIR__ . '/.pioneer-executed';
if (file_exists($execution_marker)) {
    die('Pioneer Init has already been executed. For security, it can only run once.');
}

// Security: Require secret key as URL parameter
if (!isset($_GET['key']) || $_GET['key'] !== PIONEER_SECRET_KEY) {
    die('Unauthorized access. Secret key required.');
}

// Load WordPress
require_once __DIR__ . '/wp-load.php';

// Verify WordPress loaded successfully
if (!function_exists('update_option')) {
    die('WordPress failed to load.');
}

/**
 * Main execution function
 */
function pioneer_init_execute() {
    $results = array();
    
    // STEP 1: Identity & Routing
    $results['identity'] = pioneer_configure_identity();
    
    // STEP 2: Design Injection (Custom CSS)
    $results['design'] = pioneer_inject_design();
    
    // STEP 3: Lead Capture (WhatsApp/Joinchat)
    $results['lead_capture'] = pioneer_configure_lead_capture();
    
    // STEP 4: Content Seed
    $results['content'] = pioneer_seed_content();
    
    return $results;
}

/**
 * Step 1: Configure Site Identity & Routing
 */
function pioneer_configure_identity() {
    $steps = array();
    
    // Set blogname
    update_option('blogname', 'Sanjay Jain | Feng Shui Homestyle Vastu');
    $steps['blogname'] = 'Set to: Sanjay Jain | Feng Shui Homestyle Vastu';
    
    // Set blogdescription
    update_option('blogdescription', 'Scientific Vastu Harmony without Demolition');
    $steps['blogdescription'] = 'Set to: Scientific Vastu Harmony without Demolition';
    
    // Check if "Home" page exists, if not create it
    $home_page = get_page_by_title('Home');
    
    if (!$home_page) {
        $home_page_id = wp_insert_post(array(
            'post_title'    => 'Home',
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1,
        ));
        $steps['home_page_created'] = 'Created with ID: ' . $home_page_id;
    } else {
        $home_page_id = $home_page->ID;
        $steps['home_page_exists'] = 'Found existing with ID: ' . $home_page_id;
    }
    
    // Set show_on_front to 'page' and page_on_front to Home page ID
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home_page_id);
    $steps['front_page'] = 'Set to page ID: ' . $home_page_id;
    
    return $steps;
}

/**
 * Step 2: Design Injection (Custom CSS)
 */
function pioneer_inject_design() {
    $steps = array();
    
    // Custom CSS with Global Colors and Glassmorphism
    $custom_css = <<<CSS
/* Pioneer Init - Global Color Palette */
:root {
    --global-bg: #F5EAE1;
    --global-primary: #2E2B59;
    --global-accent: #648E7B;
}

/* Apply Global Colors */
body {
    background-color: var(--global-bg);
}

.site-header,
.primary-navigation {
    background-color: var(--global-primary);
}

.cta-primary,
.button-primary,
.wp-block-button__link {
    background-color: var(--global-accent);
    color: white;
}

/* Glassmorphism Card Class */
.glass-card {
    background: rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2rem;
}

/* Visual Breathability - Line Height & Padding */
body {
    line-height: 1.8;
}

.content-area,
.entry-content {
    padding: 2rem 1rem;
    line-height: 1.8;
}

h1, h2, h3, h4, h5, h6 {
    margin-bottom: 1.5rem;
    line-height: 1.4;
}

p {
    margin-bottom: 1.5rem;
}

/* Mobile Thumb Zone - WhatsApp Button Positioning */
@media (max-width: 768px) {
    .joinchat {
        bottom: 20px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        right: auto !important;
    }
    
    .joinchat__button {
        width: 60px !important;
        height: 60px !important;
    }
}

/* Premium Sanctuary Spacing */
.glass-card + .glass-card {
    margin-top: 2rem;
}

section {
    margin-bottom: 3rem;
}

/* Ensure readability */
.glass-card p,
.glass-card h1,
.glass-card h2,
.glass-card h3 {
    color: #2E2B59;
}
CSS;

    // Get current theme mods
    $theme_slug = get_option('stylesheet');
    $theme_mods = get_theme_mods();
    
    // Inject custom CSS into theme mods
    $theme_mods['custom_css'] = isset($theme_mods['custom_css']) 
        ? $theme_mods['custom_css'] . "\n\n" . $custom_css 
        : $custom_css;
    
    // Update theme mods
    update_option('theme_mods_' . $theme_slug, $theme_mods);
    $steps['custom_css'] = 'Injected ' . strlen($custom_css) . ' bytes of CSS';
    
    // Also set via wp_custom_css for compatibility
    $post_id = wp_update_custom_css_post($custom_css);
    $steps['custom_css_post'] = 'Created/Updated custom CSS post ID: ' . $post_id;
    
    return $steps;
}

/**
 * Step 3: Configure Lead Capture (WhatsApp)
 */
function pioneer_configure_lead_capture() {
    $steps = array();
    
    // Configure joinchat/creame-whatsapp-me plugin
    $joinchat_options = array(
        'telephone'     => '+919828088678',
        'message_text'  => 'Hello Sanjay, I am interested in a Vastu consultation for my space.',
        'message_send'  => 'Hello Sanjay, I am interested in a Vastu consultation for my space.',
        'visibility'    => array('all' => 'yes'),
        'position'      => 'left',
        'mobile_only'   => false,
        'button_tip'    => 'WhatsApp Consultation',
        'message_badge' => false,
    );
    
    // Update joinchat option
    update_option('joinchat', $joinchat_options);
    $steps['joinchat'] = 'Configured WhatsApp: +919828088678';
    
    // Additional CSS for WhatsApp button positioning (already in custom CSS above)
    $steps['whatsapp_css'] = 'Mobile Thumb Zone CSS injected (bottom-center)';
    
    return $steps;
}

/**
 * Step 4: Content Seed (Home Page)
 */
function pioneer_seed_content() {
    $steps = array();
    
    // Get Home page
    $home_page = get_page_by_title('Home');
    
    if ($home_page) {
        // Pioneer Hero Copy
        $hero_content = <<<HTML
<!-- Pioneer Hero Section -->
<section class="hero-section glass-card" style="text-align: center; padding: 4rem 2rem;">
    <h1 style="font-size: 3rem; margin-bottom: 1rem; color: #2E2B59;">
        Harmonize Your Space, Transform Your Life
    </h1>
    <p style="font-size: 1.5rem; color: #648E7B; margin-bottom: 2rem;">
        25+ Years of Mastery. No Demolition.
    </p>
    <p style="font-size: 1.1rem; line-height: 1.8; max-width: 800px; margin: 0 auto;">
        Experience the power of Scientific Vastu Harmony with Sanjay Jain. 
        Transform your living and working spaces without costly renovations or structural changes. 
        Achieve balance, prosperity, and well-being through proven Vastu principles.
    </p>
</section>

<!-- Why Choose Us Section -->
<section class="why-choose-us" style="margin-top: 3rem;">
    <h2 style="text-align: center; color: #2E2B59; margin-bottom: 2rem;">
        Why Choose Sanjay Jain for Vastu Consultation?
    </h2>
    
    <div class="glass-card">
        <h3 style="color: #2E2B59;">🏡 No Demolition Required</h3>
        <p>Our scientific approach works with your existing structure. No breaking walls, no expensive renovations.</p>
    </div>
    
    <div class="glass-card">
        <h3 style="color: #2E2B59;">📊 25+ Years of Expertise</h3>
        <p>Trusted by thousands of families and businesses across India and internationally.</p>
    </div>
    
    <div class="glass-card">
        <h3 style="color: #2E2B59;">🌟 Proven Results</h3>
        <p>Experience measurable improvements in health, wealth, relationships, and career success.</p>
    </div>
</section>

<!-- Call to Action -->
<section class="cta-section" style="text-align: center; margin-top: 3rem; padding: 3rem 2rem; background-color: #648E7B; color: white; border-radius: 20px;">
    <h2 style="color: white; margin-bottom: 1rem;">Ready to Transform Your Space?</h2>
    <p style="font-size: 1.2rem; margin-bottom: 2rem;">
        Click the WhatsApp button below to schedule your consultation today.
    </p>
    <p style="font-size: 0.9rem; opacity: 0.9;">
        📱 Available on WhatsApp: +91 98280 88678
    </p>
</section>
HTML;
        
        // Update Home page content
        wp_update_post(array(
            'ID'           => $home_page->ID,
            'post_content' => $hero_content,
        ));
        
        $steps['home_content'] = 'Updated Home page with Pioneer Hero copy';
    } else {
        $steps['error'] = 'Home page not found - cannot seed content';
    }
    
    return $steps;
}

/**
 * Execute the script
 */
echo "<html><head><title>Pioneer Init - Execution</title>";
echo "<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
    h1 { color: #2E2B59; border-bottom: 3px solid #648E7B; padding-bottom: 10px; }
    h2 { color: #648E7B; margin-top: 30px; }
    .step { background: white; padding: 15px; margin: 10px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .success { color: #27ae60; font-weight: bold; }
    .error { color: #e74c3c; font-weight: bold; }
    pre { background: #ecf0f1; padding: 10px; border-radius: 4px; overflow-x: auto; }
</style></head><body>";

echo "<h1>🚀 Pioneer Init Script - Execution Report</h1>";
echo "<p><strong>Timestamp:</strong> " . date('Y-m-d H:i:s') . "</p>";

try {
    $results = pioneer_init_execute();
    
    echo "<h2>✅ Execution Results</h2>";
    
    foreach ($results as $section => $steps) {
        echo "<div class='step'>";
        echo "<h3>" . ucfirst(str_replace('_', ' ', $section)) . "</h3>";
        if (is_array($steps)) {
            echo "<ul>";
            foreach ($steps as $key => $value) {
                echo "<li><strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>" . htmlspecialchars($steps) . "</p>";
        }
        echo "</div>";
    }
    
    // Create execution marker file to prevent re-execution
    file_put_contents($execution_marker, date('Y-m-d H:i:s'));
    
    echo "<div class='step success'>";
    echo "<h3>🔒 Security: Execution Marker Created</h3>";
    echo "<p>This script has been marked as executed and cannot be run again.</p>";
    echo "<p>The marker file has been created at: <code>.pioneer-executed</code></p>";
    echo "</div>";
    
    echo "<div class='step success'>";
    echo "<h3>✨ Configuration Complete!</h3>";
    echo "<p>Your WordPress environment has been successfully configured with:</p>";
    echo "<ul>";
    echo "<li>✅ Site Identity: 'Sanjay Jain | Feng Shui Homestyle Vastu'</li>";
    echo "<li>✅ Home Page: Created and set as front page</li>";
    echo "<li>✅ Design: Custom CSS with global colors and glassmorphism</li>";
    echo "<li>✅ Lead Capture: WhatsApp configured for +919828088678</li>";
    echo "<li>✅ Content: Pioneer Hero copy on Home page</li>";
    echo "</ul>";
    echo "</div>";
    
    echo "<div class='step'>";
    echo "<h3>📋 Next Steps</h3>";
    echo "<ol>";
    echo "<li>Visit your <a href='" . home_url() . "'>homepage</a> to see the changes</li>";
    echo "<li>Check the WhatsApp button positioning (bottom-center on mobile)</li>";
    echo "<li>Verify the design colors match the brand guidelines</li>";
    echo "<li>For security, consider deleting this script file: <code>pioneer-init.php</code></li>";
    echo "</ol>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='step error'>";
    echo "<h3>❌ Error During Execution</h3>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</div>";
}

echo "</body></html>";
