<?php
/**
 * Pioneer Visuals - FIX Script v2
 * Forces homepage display and clears all caches
 * 
 * Security: Requires GET parameter ?key=feng-shui-2026-pioneer
 */

if (!isset($_GET['key']) || $_GET['key'] !== 'feng-shui-2026-pioneer') {
    http_response_code(403);
    die('Access Denied');
}

// WordPress Bootstrap
$wp_load_paths = [
    __DIR__ . '/wp-load.php',
    __DIR__ . '/../wp-load.php',
    dirname(dirname(__DIR__)) . '/wp-load.php',
];

$wp_loaded = false;
foreach ($wp_load_paths as $path) {
    if (file_exists($path)) {
        require_once($path);
        $wp_loaded = true;
        break;
    }
}

if (!$wp_loaded) {
    die('<h1 style="color:red;">ERROR: Could not locate wp-load.php</h1>');
}

// Start output
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pioneer Fix - Homepage Configuration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .success {
            color: #28a745;
            font-weight: bold;
        }

        .warning {
            color: #ffc107;
            font-weight: bold;
        }

        .info {
            background: #e7f3ff;
            padding: 15px;
            border-left: 4px solid #2196F3;
            margin: 20px 0;
        }

        .code {
            background: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            margin: 10px 0;
        }

        hr {
            margin: 30px 0;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🔧 Pioneer Fix - Homepage Configuration</h1>

        <?php
        // STEP 1: Check current homepage settings
        echo "<h2>Step 1: Current Homepage Settings</h2>";

        $show_on_front = get_option('show_on_front');
        $page_on_front = get_option('page_on_front');

        echo "<p><strong>Show on front:</strong> " . esc_html($show_on_front) . "</p>";
        echo "<p><strong>Page on front ID:</strong> " . esc_html($page_on_front) . "</p>";

        // Get the Home page
        $home_page = get_page_by_path('home');
        if (!$home_page) {
            $home_page = get_posts(['post_type' => 'page', 'name' => 'home', 'numberposts' => 1]);
            $home_page = $home_page ? $home_page[0] : null;
        }

        if (!$home_page) {
            $home_page = get_posts(['post_type' => 'page', 'title' => 'Home', 'numberposts' => 1]);
            $home_page = $home_page ? $home_page[0] : null;
        }

        if ($home_page) {
            echo "<p class='success'>✓ Found Home page (ID: {$home_page->ID})</p>";

            // Check if it has our content
            $has_hero = strpos($home_page->post_content, 'hero-section') !== false;
            $has_png = strpos($home_page->post_content, '.png') !== false;

            echo "<p><strong>Has hero-section class:</strong> " . ($has_hero ? '✓ Yes' : '✗ No') . "</p>";
            echo "<p><strong>Uses PNG images:</strong> " . ($has_png ? '✓ Yes' : '✗ No') . "</p>";
        } else {
            echo "<p class='warning'>⚠ Could not find Home page!</p>";
        }

        echo "<hr>";

        // STEP 2: Configure WordPress to show the Home page
        echo "<h2>Step 2: Setting Homepage</h2>";

        if ($home_page && $page_on_front != $home_page->ID) {
            update_option('show_on_front', 'page');
            update_option('page_on_front', $home_page->ID);
            echo "<p class='success'>✓ Set homepage to display 'Home' page (ID: {$home_page->ID})</p>";
        } elseif ($home_page) {
            echo "<p class='success'>✓ Homepage is already set correctly</p>";
        }

        echo "<hr>";

        // STEP 3: Clear all caches
        echo "<h2>Step 3: Clearing Caches</h2>";

        // Clear WordPress object cache
        wp_cache_flush();
        echo "<p class='success'>✓ WordPress object cache cleared</p>";

        // Clear transients
        global $wpdb;
        $wpdb->query("DELETE FROM `{$wpdb->options}` WHERE `option_name` LIKE '_transient_%'");
        echo "<p class='success'>✓ WordPress transients cleared</p>";

        // Try to clear popular caching plugins
        $cleared_plugins = [];

        // LiteSpeed Cache
        if (class_exists('LiteSpeed_Cache_API')) {
            LiteSpeed_Cache_API::purge_all();
            $cleared_plugins[] = 'LiteSpeed Cache';
        }

        // WP Super Cache
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
            $cleared_plugins[] = 'WP Super Cache';
        }

        // W3 Total Cache
        if (function_exists('w3tc_flush_all')) {
            w3tc_flush_all();
            $cleared_plugins[] = 'W3 Total Cache';
        }

        // WP Rocket
        if (function_exists('rocket_clean_domain')) {
            rocket_clean_domain();
            $cleared_plugins[] = 'WP Rocket';
        }

        if (!empty($cleared_plugins)) {
            echo "<p class='success'>✓ Cleared cache plugins: " . implode(', ', $cleared_plugins) . "</p>";
        } else {
            echo "<p>No caching plugins detected</p>";
        }

        echo "<hr>";

        // STEP 4: Verify CSS injection
        echo "<h2>Step 4: Verify CSS Injection</h2>";

        $custom_css = wp_get_custom_css();
        $has_pioneer_css = strpos($custom_css, 'PIONEER VISUALS') !== false;

        echo "<p><strong>Custom CSS length:</strong> " . strlen($custom_css) . " characters</p>";
        echo "<p><strong>Has Pioneer Visuals CSS:</strong> " . ($has_pioneer_css ? '✓ Yes' : '✗ No') . "</p>";

        if (!$has_pioneer_css) {
            echo "<div class='info'><strong>Info:</strong> Pioneer Visuals CSS is not in wp_get_custom_css(). It may be in theme_mods. This is usually OK.</div>";

            // Check theme mods
            $theme_mod_css = get_theme_mod('custom_css', '');
            $has_mod_css = strpos($theme_mod_css, 'PIONEER VISUALS') !== false;
            echo "<p><strong>Has CSS in theme_mod:</strong> " . ($has_mod_css ? '✓ Yes' : '✗ No') . "</p>";
        }

        echo "<hr>";

        // STEP 5: Final instructions
        echo "<h2>✅ Final Steps</h2>";
        echo "<div class='info'>";
        echo "<ol>";
        echo "<li><strong>Clear your browser cache</strong> (Ctrl + Shift + Delete)</li>";
        echo "<li><strong>Visit your homepage in incognito/private mode:</strong><br>";
        echo "<div class='code'><a href='" . home_url() . "' target='_blank'>" . home_url() . "</a></div></li>";
        echo "<li><strong>Hard refresh</strong> the page (Ctrl + Shift + R)</li>";
        echo "<li>If images still don't appear, click the link below to see the raw page content:</li>";
        if ($home_page) {
            echo "<div class='code'><a href='" . home_url() . "?nocache=" . time() . "' target='_blank'>" . home_url() . "?nocache=" . time() . "</a></div>";
        }
        echo "</ol>";
        echo "</div>";

        echo "<hr>";

        // Debug info
        echo "<h2>📋 Debug Information</h2>";
        echo "<details>";
        echo "<summary>Click to view page content preview</summary>";
        if ($home_page) {
            echo "<div class='code'>";
            echo "<pre>" . esc_html(substr($home_page->post_content, 0, 500)) . "...</pre>";
            echo "</div>";
        }
        echo "</details>";

        echo "<p style='margin-top: 30px; text-align: center; color: #666;'>";
        echo "Deployment Time: " . date('Y-m-d H:i:s') . "<br>";
        echo "WordPress Version: " . get_bloginfo('version') . "<br>";
        echo "Active Theme: " . wp_get_theme()->get('Name');
        echo "</p>";
        ?>
    </div>
</body>

</html>
<?php
$output = ob_get_clean();
echo $output;
exit;
