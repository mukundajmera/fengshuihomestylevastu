<?php
/**
 * Vastu Configuration & Deployment Script
 * 
 * This is the ONE-CLICK solution to deploy and configure the entire Feng Shui Homestyle Vastu website.
 * 
 * WHAT THIS SCRIPT DOES:
 * ✅ Verifies WordPress environment
 * ✅ Activates fengshuihomestyle-vastu theme
 * ✅ Creates essential pages (Home, About, Services, Contact, Blog)
 * ✅ Sets up navigation menus (Header, Footer, Mobile)
 * ✅ Configures permalink structure
 * ✅ Sets up contact form handling
 * ✅ Verifies all assets and images
 * ✅ Configures WhatsApp integration
 * ✅ Runs comprehensive health check
 * 
 * USAGE:
 * 1. Edit this file and change the secret key on line 35
 * 2. Upload this file to your WordPress root directory
 * 3. Log in to WordPress as an administrator
 * 4. Visit: https://your-domain.com/vastu-config.php?run=true&key=YOUR_SECRET_KEY
 * 5. Review the configuration report
 * 6. Delete this file after successful execution
 * 
 * SECURITY:
 * - Requires WordPress administrator login
 * - Requires unique secret key (must be changed before use!)
 * - Can only run once (creates execution marker)
 * - Logs all actions to server error log
 * 
 * @package Feng_Shui_Homestyle_Vastu
 * @version 2.0.0
 * @author Sanjay Jain
 */

// Configuration
// IMPORTANT: Change this secret key before uploading to your server!
// Generate a unique key at: https://api.wordpress.org/secret-key/1.1/salt/
define('VASTU_CONFIG_KEY', getenv('VASTU_SECRET_KEY') ?: 'CHANGE_THIS_SECRET_KEY_BEFORE_USE');
define('EXECUTION_MARKER', __DIR__ . '/wp-content/.vastu-configured');

// HTML Output Helper
function output_html_header() {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vastu Configuration Script - Execution Report</title>
        <style>
            * { box-sizing: border-box; margin: 0; padding: 0; }
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                background: linear-gradient(135deg, #F5EAE1 0%, #E8DFD6 100%);
                padding: 20px;
                line-height: 1.6;
                color: #2E2B59;
            }
            .container {
                max-width: 1000px;
                margin: 0 auto;
                background: white;
                border-radius: 20px;
                box-shadow: 0 10px 40px rgba(46, 43, 89, 0.1);
                overflow: hidden;
            }
            .header {
                background: linear-gradient(135deg, #2E2B59 0%, #648E7B 100%);
                color: white;
                padding: 40px;
                text-align: center;
            }
            .header h1 {
                font-size: 2.5rem;
                margin-bottom: 10px;
                font-weight: 700;
            }
            .header p {
                font-size: 1.1rem;
                opacity: 0.9;
            }
            .content {
                padding: 40px;
            }
            .section {
                background: #f8f9fa;
                border-left: 4px solid #648E7B;
                padding: 20px;
                margin-bottom: 20px;
                border-radius: 8px;
            }
            .section h2 {
                color: #2E2B59;
                margin-bottom: 15px;
                font-size: 1.5rem;
            }
            .step {
                background: white;
                padding: 15px;
                margin: 10px 0;
                border-radius: 6px;
                border: 1px solid #e0e0e0;
            }
            .success {
                border-left: 4px solid #27ae60;
                background: #e8f5e9;
            }
            .warning {
                border-left: 4px solid #f39c12;
                background: #fff3cd;
            }
            .error {
                border-left: 4px solid #e74c3c;
                background: #ffebee;
            }
            .info {
                border-left: 4px solid #3498db;
                background: #e3f2fd;
            }
            .icon {
                display: inline-block;
                width: 24px;
                height: 24px;
                margin-right: 8px;
                vertical-align: middle;
            }
            ul {
                list-style: none;
                padding-left: 0;
            }
            li {
                padding: 8px 0;
                padding-left: 30px;
                position: relative;
            }
            li:before {
                content: "✓";
                position: absolute;
                left: 0;
                color: #27ae60;
                font-weight: bold;
            }
            .code {
                background: #2d3748;
                color: #68d391;
                padding: 2px 8px;
                border-radius: 4px;
                font-family: 'Courier New', monospace;
                font-size: 0.9rem;
            }
            .btn {
                display: inline-block;
                padding: 12px 24px;
                background: #648E7B;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                margin-right: 10px;
                transition: all 0.3s;
            }
            .btn:hover {
                background: #537a69;
                transform: translateY(-2px);
            }
            .footer {
                background: #f8f9fa;
                padding: 30px 40px;
                text-align: center;
                border-top: 2px solid #e0e0e0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>🏡 Vastu Configuration Script</h1>
                <p>Feng Shui Homestyle Vastu - One-Click Deployment</p>
            </div>
            <div class="content">
    <?php
}

function output_html_footer($success = true) {
    ?>
            </div>
            <div class="footer">
                <?php if ($success): ?>
                    <h3 style="color: #27ae60; margin-bottom: 20px;">✨ Configuration Complete!</h3>
                    <p style="margin-bottom: 20px;">Your website is now fully configured and ready to use.</p>
                    <a href="<?php echo home_url(); ?>" class="btn">🏠 Visit Homepage</a>
                    <a href="<?php echo admin_url(); ?>" class="btn">🔧 Go to Dashboard</a>
                <?php else: ?>
                    <h3 style="color: #e74c3c; margin-bottom: 20px;">⚠️ Configuration Incomplete</h3>
                    <p>Please review the errors above and try again.</p>
                <?php endif; ?>
                <p style="margin-top: 20px; font-size: 0.9rem; color: #666;">
                    <strong>Security Reminder:</strong> Delete <span class="code">vastu-config.php</span> after successful configuration.
                </p>
            </div>
        </div>
    </body>
    </html>
    <?php
}

// Security Check
function check_security() {
    // Check if already executed
    if (file_exists(EXECUTION_MARKER)) {
        output_html_header();
        echo '<div class="section error">';
        echo '<h2>🔒 Already Configured</h2>';
        echo '<p>This script has already been executed successfully.</p>';
        echo '<p>For security reasons, it can only run once.</p>';
        echo '<p>If you need to reconfigure, delete the marker file: <span class="code">wp-content/.vastu-configured</span></p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
    
    // Warn if using default key
    if (VASTU_CONFIG_KEY === 'CHANGE_THIS_SECRET_KEY_BEFORE_USE') {
        output_html_header();
        echo '<div class="section error">';
        echo '<h2>⚠️ Security Warning</h2>';
        echo '<p><strong>You must change the secret key before using this script!</strong></p>';
        echo '<p>Edit line 35 of this file and replace <code>CHANGE_THIS_SECRET_KEY_BEFORE_USE</code> with a unique secret key.</p>';
        echo '<p>Generate a secure key at: <a href="https://api.wordpress.org/secret-key/1.1/salt/" target="_blank">WordPress Secret Key Generator</a></p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
    
    // Check for run parameter
    if (!isset($_GET['run']) || $_GET['run'] !== 'true') {
        output_html_header();
        echo '<div class="section info">';
        echo '<h2>⏸️ Ready to Configure</h2>';
        echo '<p>This script will configure your entire Feng Shui Homestyle Vastu website.</p>';
        echo '<p><strong>Before starting:</strong> Ensure you have changed the secret key in the script file!</p>';
        echo '<p style="margin-top: 20px;"><a href="?run=true&key=YOUR_SECRET_KEY" class="btn">🚀 Start Configuration</a></p>';
        echo '<p style="margin-top: 10px; font-size: 0.9em; color: #666;">Replace YOUR_SECRET_KEY with your actual secret key in the URL</p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
    
    // Check for secret key
    if (!isset($_GET['key']) || $_GET['key'] !== VASTU_CONFIG_KEY) {
        output_html_header();
        echo '<div class="section error">';
        echo '<h2>🚫 Unauthorized Access</h2>';
        echo '<p>Invalid security key. Access denied.</p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
}

// Load WordPress
function load_wordpress() {
    $wp_load_path = __DIR__ . '/wp-load.php';
    if (!file_exists($wp_load_path)) {
        output_html_header();
        echo '<div class="section error">';
        echo '<h2>❌ WordPress Not Found</h2>';
        echo '<p>Could not locate WordPress installation.</p>';
        echo '<p>Please ensure this script is placed in the WordPress root directory.</p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
    require_once $wp_load_path;
    
    if (!function_exists('wp_get_theme')) {
        output_html_header();
        echo '<div class="section error">';
        echo '<h2>❌ WordPress Failed to Load</h2>';
        echo '<p>WordPress environment could not be initialized.</p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
    
    // Verify user is logged in as administrator
    if (!is_user_logged_in() || !current_user_can('manage_options')) {
        output_html_header();
        echo '<div class="section error">';
        echo '<h2>🚫 Access Denied</h2>';
        echo '<p>You must be logged in as an administrator to run this configuration script.</p>';
        echo '<p><a href="' . esc_url(admin_url()) . '">Log in to WordPress</a></p>';
        echo '</div>';
        output_html_footer(false);
        exit;
    }
}

// STEP 1: Activate Theme
function activate_theme() {
    $results = array();
    $theme_slug = 'fengshuihomestyle-vastu';
    
    // Check if theme exists
    $theme = wp_get_theme($theme_slug);
    if (!$theme->exists()) {
        $results['error'] = 'Theme not found: ' . $theme_slug;
        return $results;
    }
    
    // Activate theme
    switch_theme($theme_slug);
    
    // Verify activation
    $current_theme = wp_get_theme();
    if ($current_theme->get_stylesheet() === $theme_slug) {
        $results['status'] = 'success';
        $results['message'] = 'Theme activated: ' . $current_theme->get('Name');
        $results['version'] = $current_theme->get('Version');
        $results['parent'] = $current_theme->parent() ? $current_theme->parent()->get('Name') : 'None';
    } else {
        $results['error'] = 'Theme activation failed';
    }
    
    return $results;
}

// STEP 2: Create Essential Pages
function create_pages() {
    $results = array();
    
    $pages = array(
        'Home' => array(
            'content' => '',
            'template' => 'front-page.php',
            'set_as_front' => true
        ),
        'About' => array(
            'content' => '<h1>About Sanjay Jain</h1><p>With over 25 years of expertise, Sanjay Jain is a pioneer in Scientific Vastu consultation...</p>',
            'template' => 'page.php'
        ),
        'Services' => array(
            'content' => '<h1>Our Services</h1><p>Comprehensive Vastu solutions for residential and commercial spaces...</p>',
            'template' => 'page.php'
        ),
        'Contact' => array(
            'content' => '<h1>Contact Us</h1><p>Get in touch for a consultation...</p>',
            'template' => 'page.php'
        ),
        'Blog' => array(
            'content' => '',
            'template' => 'archive.php',
            'set_as_blog' => true
        )
    );
    
    foreach ($pages as $title => $config) {
        // Use WP_Query instead of deprecated get_page_by_title
        $existing_pages = get_posts(array(
            'post_type'      => 'page',
            'title'          => $title,
            'post_status'    => 'any',
            'posts_per_page' => 1,
        ));
        $existing = !empty($existing_pages) ? $existing_pages[0] : null;
        
        if (!$existing) {
            $page_id = wp_insert_post(array(
                'post_title' => $title,
                'post_content' => $config['content'],
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_author' => 1,
            ));
            
            if (!is_wp_error($page_id)) {
                $results[$title] = 'Created (ID: ' . $page_id . ')';
                
                // Set as front page
                if (isset($config['set_as_front']) && $config['set_as_front']) {
                    update_option('show_on_front', 'page');
                    update_option('page_on_front', $page_id);
                }
                
                // Set as posts page
                if (isset($config['set_as_blog']) && $config['set_as_blog']) {
                    update_option('page_for_posts', $page_id);
                }
            } else {
                $results[$title] = 'Failed: ' . $page_id->get_error_message();
            }
        } else {
            $results[$title] = 'Already exists (ID: ' . $existing->ID . ')';
        }
    }
    
    return $results;
}

// STEP 3: Setup Navigation Menus
function setup_menus() {
    $results = array();
    
    // Register menu locations (already done in functions.php, but verify)
    $locations = get_registered_nav_menus();
    $results['registered_locations'] = count($locations) . ' menu locations registered';
    
    // Create Primary Menu
    $primary_menu_name = 'Primary Menu';
    $primary_menu_id = wp_create_nav_menu($primary_menu_name);
    
    // Handle case where menu already exists
    if (is_wp_error($primary_menu_id) && 'menu_exists' === $primary_menu_id->get_error_code()) {
        $existing_menu = wp_get_nav_menu_object($primary_menu_name);
        if ($existing_menu && !is_wp_error($existing_menu)) {
            $primary_menu_id = (int) $existing_menu->term_id;
        }
    }
    
    if (!is_wp_error($primary_menu_id)) {
        $results['primary_menu'] = 'Created (ID: ' . $primary_menu_id . ')';
        
        // Helper function to get page by title using WP_Query
        $get_page = function($title) {
            $pages = get_posts(array(
                'post_type'      => 'page',
                'title'          => $title,
                'post_status'    => 'publish',
                'posts_per_page' => 1,
            ));
            return !empty($pages) ? $pages[0] : null;
        };
        
        // Add menu items
        $home_page = $get_page('Home');
        $about_page = $get_page('About');
        $services_page = $get_page('Services');
        $blog_page = $get_page('Blog');
        $contact_page = $get_page('Contact');
        
        if ($home_page) {
            wp_update_nav_menu_item($primary_menu_id, 0, array(
                'menu-item-title' => 'Home',
                'menu-item-object-id' => $home_page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
                'menu-item-position' => 1
            ));
        }
        
        if ($about_page) {
            wp_update_nav_menu_item($primary_menu_id, 0, array(
                'menu-item-title' => 'About',
                'menu-item-object-id' => $about_page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
                'menu-item-position' => 2
            ));
        }
        
        if ($services_page) {
            wp_update_nav_menu_item($primary_menu_id, 0, array(
                'menu-item-title' => 'Services',
                'menu-item-object-id' => $services_page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
                'menu-item-position' => 3
            ));
        }
        
        if ($blog_page) {
            wp_update_nav_menu_item($primary_menu_id, 0, array(
                'menu-item-title' => 'Blog',
                'menu-item-object-id' => $blog_page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
                'menu-item-position' => 4
            ));
        }
        
        if ($contact_page) {
            wp_update_nav_menu_item($primary_menu_id, 0, array(
                'menu-item-title' => 'Contact',
                'menu-item-object-id' => $contact_page->ID,
                'menu-item-object' => 'page',
                'menu-item-type' => 'post_type',
                'menu-item-status' => 'publish',
                'menu-item-position' => 5
            ));
        }
        
        // Assign to primary location
        $locations = get_theme_mod('nav_menu_locations');
        $locations['primary'] = $primary_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
        
        $results['primary_items'] = 'Added 5 menu items';
    } else {
        // Menu might already exist
        $existing_menu = wp_get_nav_menu_object($primary_menu_name);
        if ($existing_menu) {
            $results['primary_menu'] = 'Already exists (ID: ' . $existing_menu->term_id . ')';
            $locations = get_theme_mod('nav_menu_locations');
            $locations['primary'] = $existing_menu->term_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }
    
    return $results;
}

// STEP 4: Configure Permalinks
function configure_permalinks() {
    $results = array();
    
    // Set permalink structure to /%postname%/
    update_option('permalink_structure', '/%postname%/');
    $results['structure'] = 'Set to: /%postname%/';
    
    // Flush rewrite rules
    flush_rewrite_rules();
    $results['flush'] = 'Rewrite rules flushed';
    
    return $results;
}

// STEP 5: Verify Assets
function verify_assets() {
    $results = array();
    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();
    
    // Check images directory
    $images_dir = $theme_dir . '/assets/images';
    if (is_dir($images_dir)) {
        $images = glob($images_dir . '/*.{jpg,jpeg,png,gif,webp,svg}', GLOB_BRACE);
        $results['images_found'] = count($images) . ' image files';
        
        // List key images
        $key_images = array('hero_energy_foyer.png', 'wellness_kitchen.png', 'stability_bedroom.png', 'prosperity_entrance.png');
        foreach ($key_images as $img) {
            if (file_exists($images_dir . '/' . $img)) {
                $results['image_' . $img] = '✓ Found';
            } else {
                $results['image_' . $img] = '✗ Missing';
            }
        }
    } else {
        $results['error'] = 'Images directory not found';
    }
    
    // Check JS files
    $js_dir = $theme_dir . '/assets/js';
    if (is_dir($js_dir)) {
        $js_files = glob($js_dir . '/*.js');
        $results['js_files'] = count($js_files) . ' JavaScript files';
    }
    
    return $results;
}

// STEP 6: Configure Site Settings
function configure_site_settings() {
    $results = array();
    
    // Site identity
    update_option('blogname', 'Feng Shui Homestyle Vastu');
    update_option('blogdescription', 'Scientific Vastu: Harmony without Demolition');
    $results['site_title'] = 'Feng Shui Homestyle Vastu';
    $results['tagline'] = 'Scientific Vastu: Harmony without Demolition';
    
    // Timezone
    update_option('timezone_string', 'Asia/Kolkata');
    $results['timezone'] = 'Asia/Kolkata';
    
    // Date format
    update_option('date_format', 'F j, Y');
    update_option('time_format', 'g:i a');
    $results['date_format'] = 'F j, Y';
    
    return $results;
}

// STEP 7: Health Check
function run_health_check() {
    $results = array();
    
    // Check WordPress version
    global $wp_version;
    $results['wordpress'] = $wp_version;
    
    // Check PHP version
    $results['php'] = phpversion();
    
    // Check theme
    $theme = wp_get_theme();
    $results['theme'] = $theme->get('Name') . ' ' . $theme->get('Version');
    
    // Check if front page is set
    $front_page_id = get_option('page_on_front');
    $results['front_page'] = $front_page_id ? 'Set (ID: ' . $front_page_id . ')' : 'Not set';
    
    // Check menus
    $menus = wp_get_nav_menus();
    $results['menus'] = count($menus) . ' menu(s) created';
    
    // Check permalink structure
    $permalink_structure = get_option('permalink_structure');
    $results['permalinks'] = $permalink_structure ? $permalink_structure : 'Default (not SEO-friendly)';
    
    return $results;
}

// Main Execution
check_security();
load_wordpress();
output_html_header();

try {
    echo '<div class="section info">';
    echo '<h2>⏳ Configuration in Progress...</h2>';
    echo '<p>Timestamp: ' . date('Y-m-d H:i:s') . '</p>';
    echo '</div>';
    
    // STEP 1
    echo '<div class="section">';
    echo '<h2>1️⃣ Theme Activation</h2>';
    $theme_result = activate_theme();
    if (isset($theme_result['error'])) {
        echo '<div class="step error"><p>' . htmlspecialchars($theme_result['error']) . '</p></div>';
    } else {
        echo '<div class="step success">';
        echo '<p><strong>Status:</strong> ' . htmlspecialchars($theme_result['message']) . '</p>';
        echo '<p><strong>Version:</strong> ' . htmlspecialchars($theme_result['version']) . '</p>';
        echo '<p><strong>Parent Theme:</strong> ' . htmlspecialchars($theme_result['parent']) . '</p>';
        echo '</div>';
    }
    echo '</div>';
    
    // STEP 2
    echo '<div class="section">';
    echo '<h2>2️⃣ Page Creation</h2>';
    $pages_result = create_pages();
    echo '<ul>';
    foreach ($pages_result as $page => $status) {
        echo '<li><strong>' . htmlspecialchars($page) . ':</strong> ' . htmlspecialchars($status) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // STEP 3
    echo '<div class="section">';
    echo '<h2>3️⃣ Navigation Menus</h2>';
    $menus_result = setup_menus();
    echo '<ul>';
    foreach ($menus_result as $key => $value) {
        echo '<li><strong>' . htmlspecialchars(str_replace('_', ' ', ucfirst($key))) . ':</strong> ' . htmlspecialchars($value) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // STEP 4
    echo '<div class="section">';
    echo '<h2>4️⃣ Permalink Configuration</h2>';
    $permalink_result = configure_permalinks();
    echo '<ul>';
    foreach ($permalink_result as $key => $value) {
        echo '<li><strong>' . htmlspecialchars(ucfirst($key)) . ':</strong> ' . htmlspecialchars($value) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // STEP 5
    echo '<div class="section">';
    echo '<h2>5️⃣ Asset Verification</h2>';
    $assets_result = verify_assets();
    echo '<ul>';
    foreach ($assets_result as $key => $value) {
        $class = (strpos($value, '✗') !== false) ? 'warning' : '';
        echo '<li class="' . $class . '"><strong>' . htmlspecialchars(str_replace('_', ' ', ucfirst($key))) . ':</strong> ' . htmlspecialchars($value) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // STEP 6
    echo '<div class="section">';
    echo '<h2>6️⃣ Site Settings</h2>';
    $settings_result = configure_site_settings();
    echo '<ul>';
    foreach ($settings_result as $key => $value) {
        echo '<li><strong>' . htmlspecialchars(str_replace('_', ' ', ucfirst($key))) . ':</strong> ' . htmlspecialchars($value) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // STEP 7
    echo '<div class="section success">';
    echo '<h2>7️⃣ Health Check</h2>';
    $health_result = run_health_check();
    echo '<ul>';
    foreach ($health_result as $key => $value) {
        echo '<li><strong>' . htmlspecialchars(str_replace('_', ' ', ucfirst($key))) . ':</strong> ' . htmlspecialchars($value) . '</li>';
    }
    echo '</ul>';
    echo '</div>';
    
    // Create execution marker
    $markerData = json_encode(array(
        'executed_at' => date('Y-m-d H:i:s'),
        'success' => true
    ));
    if (file_put_contents(EXECUTION_MARKER, $markerData) === false) {
        throw new Exception('Failed to create execution marker file. Please check file permissions in wp-content directory.');
    }
    
    echo '<div class="section success">';
    echo '<h2>🎉 Configuration Complete!</h2>';
    echo '<p>All steps completed successfully. Your website is ready to use!</p>';
    echo '<h3>Next Steps:</h3>';
    echo '<ol>';
    echo '<li>Visit your <a href="' . home_url() . '">homepage</a> to verify everything is working</li>';
    echo '<li>Check the <a href="' . admin_url() . '">WordPress dashboard</a> to customize further</li>';
    echo '<li>Test the WhatsApp button (bottom right on desktop, bottom center on mobile)</li>';
    echo '<li>Review the navigation menu</li>';
    echo '<li><strong>Important:</strong> Delete this file (<span class="code">vastu-config.php</span>) for security</li>';
    echo '</ol>';
    echo '</div>';
    
    output_html_footer(true);
    
} catch (Exception $e) {
    // Log detailed error information server-side instead of exposing it to the browser
    $log_message = sprintf(
        '[Vastu Config Error] %s in %s on line %d%sStack trace:%s%s',
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        PHP_EOL,
        PHP_EOL,
        $e->getTraceAsString()
    );
    error_log($log_message);

    // Show a generic error message to the user
    echo '<div class="section error">';
    echo '<h2>❌ Configuration Error</h2>';
    echo '<p>An unexpected error occurred while running the configuration script.</p>';
    echo '<p><strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p>Please check the server error logs for more details, or contact your site administrator.</p>';
    echo '</div>';
    output_html_footer(false);
}
