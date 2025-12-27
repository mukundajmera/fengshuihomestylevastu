<?php
/**
 * Theme Validation Script
 * 
 * Quick diagnostic tool to verify theme configuration and assets.
 * This helps identify issues before deployment.
 * 
 * USAGE: Place in WordPress root and visit: your-domain.com/validate-theme.php
 * 
 * @package Feng_Shui_Homestyle_Vastu
 */

// Load WordPress
$wp_load = __DIR__ . '/wp-load.php';
if (!file_exists($wp_load)) {
    die('WordPress not found. Place this file in WordPress root directory.');
}
require_once $wp_load;

// HTML Header
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Validation Report</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #2E2B59; border-bottom: 3px solid #648E7B; padding-bottom: 15px; }
        h2 { color: #648E7B; margin-top: 30px; }
        .check { background: #e8f5e9; border-left: 4px solid #4caf50; padding: 15px; margin: 10px 0; border-radius: 4px; }
        .warning { background: #fff3cd; border-left: 4px solid #ff9800; padding: 15px; margin: 10px 0; border-radius: 4px; }
        .error { background: #ffebee; border-left: 4px solid #f44336; padding: 15px; margin: 10px 0; border-radius: 4px; }
        .info { background: #e3f2fd; border-left: 4px solid #2196f3; padding: 15px; margin: 10px 0; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; font-weight: 600; }
        .status-ok { color: #4caf50; font-weight: bold; }
        .status-missing { color: #f44336; font-weight: bold; }
        .code { background: #f5f5f5; padding: 2px 6px; border-radius: 3px; font-family: monospace; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏡 Theme Validation Report</h1>
        <p><strong>Generated:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>

        <?php
        $errors = 0;
        $warnings = 0;
        $checks = 0;

        // Check 1: Theme Active
        echo '<h2>1. Theme Status</h2>';
        $current_theme = wp_get_theme();
        if ($current_theme->get_stylesheet() === 'fengshuihomestyle-vastu') {
            echo '<div class="check">✅ Theme <strong>fengshuihomestyle-vastu</strong> is active</div>';
            echo '<div class="info">';
            echo '<strong>Name:</strong> ' . esc_html($current_theme->get('Name')) . '<br>';
            echo '<strong>Version:</strong> ' . esc_html($current_theme->get('Version')) . '<br>';
            echo '<strong>Parent:</strong> ' . ($current_theme->parent() ? esc_html($current_theme->parent()->get('Name')) : 'None') . '<br>';
            echo '</div>';
            $checks++;
        } else {
            echo '<div class="error">❌ Wrong theme active: ' . esc_html($current_theme->get_stylesheet()) . '</div>';
            echo '<div class="warning">Expected: fengshuihomestyle-vastu</div>';
            $errors++;
        }

        // Check 2: Essential Pages
        echo '<h2>2. Essential Pages</h2>';
        $required_pages = array('Home', 'About', 'Services', 'Contact', 'Blog');
        echo '<table>';
        echo '<tr><th>Page</th><th>Status</th><th>ID</th></tr>';
        foreach ($required_pages as $page_title) {
            $page = get_page_by_title($page_title);
            if ($page) {
                echo '<tr>';
                echo '<td>' . esc_html($page_title) . '</td>';
                echo '<td class="status-ok">✓ Found</td>';
                echo '<td>' . esc_html($page->ID) . '</td>';
                echo '</tr>';
                $checks++;
            } else {
                echo '<tr>';
                echo '<td>' . esc_html($page_title) . '</td>';
                echo '<td class="status-missing">✗ Missing</td>';
                echo '<td>-</td>';
                echo '</tr>';
                $warnings++;
            }
        }
        echo '</table>';

        // Check 3: Front Page Setting
        echo '<h2>3. Front Page Configuration</h2>';
        $show_on_front = get_option('show_on_front');
        $page_on_front = get_option('page_on_front');
        if ($show_on_front === 'page' && $page_on_front) {
            $front_page = get_post($page_on_front);
            echo '<div class="check">✅ Static front page is set</div>';
            echo '<div class="info"><strong>Front Page:</strong> ' . esc_html($front_page->post_title) . ' (ID: ' . $page_on_front . ')</div>';
            $checks++;
        } else {
            echo '<div class="warning">⚠️ Front page not configured</div>';
            $warnings++;
        }

        // Check 4: Menu Configuration
        echo '<h2>4. Navigation Menus</h2>';
        $menus = wp_get_nav_menus();
        $locations = get_theme_mod('nav_menu_locations');
        
        echo '<p><strong>Registered Locations:</strong></p>';
        $registered_menus = get_registered_nav_menus();
        echo '<ul>';
        foreach ($registered_menus as $location => $description) {
            $assigned = isset($locations[$location]) ? $locations[$location] : null;
            if ($assigned) {
                $menu = wp_get_nav_menu_object($assigned);
                echo '<li>✅ <strong>' . esc_html($description) . '</strong> (' . $location . '): ' . esc_html($menu->name) . '</li>';
                $checks++;
            } else {
                echo '<li>⚠️ <strong>' . esc_html($description) . '</strong> (' . $location . '): Not assigned</li>';
                $warnings++;
            }
        }
        echo '</ul>';
        
        echo '<p><strong>Available Menus:</strong> ' . count($menus) . '</p>';
        if (count($menus) === 0) {
            echo '<div class="warning">⚠️ No menus created</div>';
            $warnings++;
        }

        // Check 5: Permalink Structure
        echo '<h2>5. Permalink Structure</h2>';
        $permalink_structure = get_option('permalink_structure');
        if ($permalink_structure && $permalink_structure !== '') {
            echo '<div class="check">✅ SEO-friendly permalinks enabled</div>';
            echo '<div class="info"><strong>Structure:</strong> <span class="code">' . esc_html($permalink_structure) . '</span></div>';
            $checks++;
        } else {
            echo '<div class="error">❌ Using default permalinks (not SEO-friendly)</div>';
            echo '<div class="warning">Go to Settings > Permalinks and select "Post name"</div>';
            $errors++;
        }

        // Check 6: Assets Verification
        echo '<h2>6. Theme Assets</h2>';
        $theme_dir = get_stylesheet_directory();
        
        // Check images
        $required_images = array(
            'hero_energy_foyer.png',
            'wellness_kitchen.png',
            'stability_bedroom.png',
            'prosperity_entrance.png',
            'success_office.png'
        );
        
        echo '<p><strong>Required Images:</strong></p>';
        echo '<table>';
        echo '<tr><th>Image File</th><th>Status</th><th>Size</th></tr>';
        foreach ($required_images as $img) {
            $img_path = $theme_dir . '/assets/images/' . $img;
            if (file_exists($img_path)) {
                $size = filesize($img_path);
                $size_kb = round($size / 1024, 1);
                echo '<tr>';
                echo '<td>' . esc_html($img) . '</td>';
                echo '<td class="status-ok">✓ Found</td>';
                echo '<td>' . $size_kb . ' KB</td>';
                echo '</tr>';
                $checks++;
            } else {
                echo '<tr>';
                echo '<td>' . esc_html($img) . '</td>';
                echo '<td class="status-missing">✗ Missing</td>';
                echo '<td>-</td>';
                echo '</tr>';
                $errors++;
            }
        }
        echo '</table>';

        // Check JS files
        echo '<p><strong>JavaScript Files:</strong></p>';
        $required_js = array(
            'custom.js',
            'vastu-compass.js'
        );
        
        echo '<table>';
        echo '<tr><th>JS File</th><th>Status</th></tr>';
        foreach ($required_js as $js) {
            $js_path = $theme_dir . '/assets/js/' . $js;
            if (file_exists($js_path)) {
                echo '<tr>';
                echo '<td>' . esc_html($js) . '</td>';
                echo '<td class="status-ok">✓ Found</td>';
                echo '</tr>';
                $checks++;
            } else {
                echo '<tr>';
                echo '<td>' . esc_html($js) . '</td>';
                echo '<td class="status-missing">✗ Missing</td>';
                echo '</tr>';
                $warnings++;
            }
        }
        echo '</table>';

        // Check 7: Site Settings
        echo '<h2>7. Site Settings</h2>';
        $site_title = get_option('blogname');
        $site_tagline = get_option('blogdescription');
        
        echo '<table>';
        echo '<tr><th>Setting</th><th>Value</th></tr>';
        echo '<tr><td>Site Title</td><td>' . esc_html($site_title) . '</td></tr>';
        echo '<tr><td>Tagline</td><td>' . esc_html($site_tagline) . '</td></tr>';
        echo '<tr><td>Timezone</td><td>' . esc_html(get_option('timezone_string')) . '</td></tr>';
        echo '<tr><td>WordPress Version</td><td>' . esc_html(get_bloginfo('version')) . '</td></tr>';
        echo '<tr><td>PHP Version</td><td>' . esc_html(phpversion()) . '</td></tr>';
        echo '</table>';

        // Check 8: Active Plugins
        echo '<h2>8. Active Plugins</h2>';
        $active_plugins = get_option('active_plugins');
        echo '<p><strong>Total Active:</strong> ' . count($active_plugins) . '</p>';
        echo '<ul>';
        foreach ($active_plugins as $plugin) {
            $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
            echo '<li>' . esc_html($plugin_data['Name']) . ' ' . esc_html($plugin_data['Version']) . '</li>';
        }
        echo '</ul>';

        // Summary
        echo '<h2>📊 Summary</h2>';
        $total_checks = $checks + $warnings + $errors;
        $success_rate = $total_checks > 0 ? round(($checks / $total_checks) * 100) : 0;
        
        echo '<table>';
        echo '<tr><th>Status</th><th>Count</th></tr>';
        echo '<tr><td>✅ Passed</td><td class="status-ok">' . $checks . '</td></tr>';
        echo '<tr><td>⚠️ Warnings</td><td style="color: #ff9800; font-weight: bold;">' . $warnings . '</td></tr>';
        echo '<tr><td>❌ Errors</td><td class="status-missing">' . $errors . '</td></tr>';
        echo '<tr><th>Success Rate</th><th>' . $success_rate . '%</th></tr>';
        echo '</table>';

        if ($errors > 0) {
            echo '<div class="error"><strong>Action Required:</strong> Please fix the errors above before deploying to production.</div>';
        } elseif ($warnings > 0) {
            echo '<div class="warning"><strong>Recommendations:</strong> Address the warnings to ensure full functionality.</div>';
        } else {
            echo '<div class="check"><strong>🎉 All Checks Passed!</strong> Your theme is properly configured and ready to use.</div>';
        }

        echo '<div class="info" style="margin-top: 30px;">';
        echo '<h3>Next Steps:</h3>';
        echo '<ol>';
        echo '<li>Review any errors or warnings above</li>';
        echo '<li>Run the <span class="code">vastu-config.php</span> script if you haven\'t already</li>';
        echo '<li>Test the website on mobile and desktop</li>';
        echo '<li>Verify WhatsApp button functionality</li>';
        echo '<li>Delete this validation script for security</li>';
        echo '</ol>';
        echo '</div>';
        ?>

        <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 2px solid #eee;">
            <p style="color: #666; font-size: 0.9em;">
                <strong>Theme Validation Script v1.0</strong><br>
                For security, delete <span class="code">validate-theme.php</span> after use
            </p>
        </div>
    </div>
</body>
</html>
