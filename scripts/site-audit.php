<?php
/**
 * WordPress Site Audit Script
 * 
 * Scans theme files for common issues:
 * - Broken image references
 * - Missing wp_enqueue calls
 * - Hardcoded URLs vs dynamic URLs
 * - CSS media query coverage
 * - Missing WordPress template files
 *
 * Usage: wp eval-file scripts/site-audit.php
 * Or run directly: php scripts/site-audit.php (requires WordPress bootstrap)
 */

// Bootstrap WordPress if not already loaded
if (!defined('ABSPATH')) {
    require_once dirname(__DIR__) . '/wp-load.php';
}

class SiteAuditTool
{
    private $theme_path;
    private $theme_uri;
    private $issues = array();
    private $stats = array(
        'total_files_scanned' => 0,
        'broken_images' => 0,
        'hardcoded_urls' => 0,
        'missing_enqueues' => 0,
    );

    public function __construct()
    {
        $this->theme_path = get_stylesheet_directory();
        $this->theme_uri = get_stylesheet_directory_uri();
    }

    /**
     * Run complete site audit
     */
    public function run_audit()
    {
        echo "========================================\n";
        echo "WordPress Site Audit - Feng Shui Homestyle Vastu\n";
        echo "========================================\n\n";

        $this->check_template_files();
        $this->scan_image_references();
        $this->check_enqueue_usage();
        $this->check_hardcoded_urls();
        $this->check_responsive_css();
        $this->display_summary();
    }

    /**
     * Check for missing WordPress template files
     */
    private function check_template_files()
    {
        echo "📄 Checking Template Files...\n";
        echo "----------------------------\n";

        $required_templates = array(
            'index.php' => 'Main template file',
            'style.css' => 'Theme stylesheet',
            'functions.php' => 'Theme functions',
        );

        $recommended_templates = array(
            'header.php' => 'Header template',
            'footer.php' => 'Footer template',
            'page.php' => 'Page template',
            'single.php' => 'Single post template',
            'archive.php' => 'Archive template',
            'search.php' => 'Search results template',
            '404.php' => 'Error page template',
            'front-page.php' => 'Front page template',
        );

        foreach ($required_templates as $file => $desc) {
            $exists = file_exists($this->theme_path . '/' . $file);
            $parent_exists = file_exists(get_template_directory() . '/' . $file);
            
            if ($exists) {
                echo "  ✅ $file - $desc (Child Theme)\n";
            } elseif ($parent_exists) {
                echo "  ℹ️  $file - $desc (Parent Theme)\n";
            } else {
                echo "  ❌ $file - $desc (MISSING)\n";
                $this->issues[] = "Missing required template: $file";
            }
        }

        echo "\nRecommended Templates:\n";
        foreach ($recommended_templates as $file => $desc) {
            $exists = file_exists($this->theme_path . '/' . $file);
            $parent_exists = file_exists(get_template_directory() . '/' . $file);
            
            if ($exists) {
                echo "  ✅ $file - $desc (Child Theme)\n";
            } elseif ($parent_exists) {
                echo "  ℹ️  $file - $desc (Parent Theme)\n";
            } else {
                echo "  ⚠️  $file - $desc (Using parent/fallback)\n";
            }
        }

        echo "\n";
    }

    /**
     * Scan for broken image references
     */
    private function scan_image_references()
    {
        echo "🖼️  Scanning Image References...\n";
        echo "----------------------------\n";

        $php_files = $this->get_php_files();
        $css_files = glob($this->theme_path . '/*.css');
        
        $all_files = array_merge($php_files, $css_files ?: array());

        foreach ($all_files as $file) {
            $this->stats['total_files_scanned']++;
            $content = file_get_contents($file);
            $lines = explode("\n", $content);
            $relative_path = str_replace($this->theme_path . '/', '', $file);

            // Check for hardcoded image paths (bad practice)
            $patterns = array(
                '/src=["\']\/(?!wp-content)([^"\']*\.(jpg|jpeg|png|gif|webp|svg))["\']/' => 'Hardcoded absolute path',
                '/src=["\'](?!http|\/|<?php)([^"\']*\.(jpg|jpeg|png|gif|webp|svg))["\']/' => 'Relative path without WordPress function',
                '/url\(["\']?\/(?!wp-content)([^"\']*\.(jpg|jpeg|png|gif|webp|svg))["\']?\)/' => 'CSS hardcoded absolute path',
            );

            foreach ($patterns as $pattern => $issue_type) {
                foreach ($lines as $line_num => $line) {
                    if (preg_match($pattern, $line, $matches)) {
                        echo "  ⚠️  $relative_path:$line_num - $issue_type\n";
                        echo "     Found: " . trim($matches[0]) . "\n";
                        $this->stats['broken_images']++;
                        $this->issues[] = "$relative_path:$line_num - $issue_type: " . trim($matches[0]);
                    }
                }
            }
        }

        if ($this->stats['broken_images'] === 0) {
            echo "  ✅ No hardcoded image paths found!\n";
        }

        echo "\n";
    }

    /**
     * Check for proper wp_enqueue usage
     */
    private function check_enqueue_usage()
    {
        echo "📦 Checking Enqueue Usage...\n";
        echo "----------------------------\n";

        $functions_file = $this->theme_path . '/functions.php';
        
        if (!file_exists($functions_file)) {
            echo "  ❌ functions.php not found\n\n";
            return;
        }

        $content = file_get_contents($functions_file);

        // Check for enqueue actions
        $has_enqueue_action = preg_match('/add_action\s*\(\s*["\']wp_enqueue_scripts["\']/i', $content);
        $has_enqueue_style = preg_match('/wp_enqueue_style\s*\(/i', $content);
        $has_enqueue_script = preg_match('/wp_enqueue_script\s*\(/i', $content);

        if ($has_enqueue_action) {
            echo "  ✅ wp_enqueue_scripts action registered\n";
        } else {
            echo "  ⚠️  wp_enqueue_scripts action not found\n";
            $this->issues[] = "Missing wp_enqueue_scripts action in functions.php";
            $this->stats['missing_enqueues']++;
        }

        if ($has_enqueue_style) {
            echo "  ✅ wp_enqueue_style() found\n";
        } else {
            echo "  ⚠️  wp_enqueue_style() not found\n";
            $this->issues[] = "Missing wp_enqueue_style() in functions.php";
            $this->stats['missing_enqueues']++;
        }

        if ($has_enqueue_script) {
            echo "  ✅ wp_enqueue_script() found\n";
        } else {
            echo "  ℹ️  wp_enqueue_script() not found (may not be needed)\n";
        }

        // Check for inline styles/scripts in templates (bad practice)
        $template_files = $this->get_php_files();
        foreach ($template_files as $file) {
            $content = file_get_contents($file);
            $relative_path = str_replace($this->theme_path . '/', '', $file);
            
            if (preg_match('/<link[^>]*rel=["\']stylesheet["\'][^>]*>/i', $content)) {
                echo "  ⚠️  $relative_path - Contains inline <link> tag (should use wp_enqueue_style)\n";
                $this->issues[] = "$relative_path - Inline <link> tag found";
            }
            
            if (preg_match('/<script[^>]*src=/i', $content)) {
                echo "  ⚠️  $relative_path - Contains inline <script> tag (should use wp_enqueue_script)\n";
                $this->issues[] = "$relative_path - Inline <script> tag found";
            }
        }

        echo "\n";
    }

    /**
     * Check for hardcoded URLs
     */
    private function check_hardcoded_urls()
    {
        echo "🔗 Checking for Hardcoded URLs...\n";
        echo "----------------------------\n";

        $php_files = $this->get_php_files();
        $site_url_patterns = array(
            '/https?:\/\/honeydew-cormorant-288039\.hostingersite\.com/i',
            '/https?:\/\/fengshuihomestylevastu\.com/i',
            '/https?:\/\/localhost/i',
        );

        foreach ($php_files as $file) {
            $content = file_get_contents($file);
            $lines = explode("\n", $content);
            $relative_path = str_replace($this->theme_path . '/', '', $file);

            foreach ($site_url_patterns as $pattern) {
                foreach ($lines as $line_num => $line) {
                    if (preg_match($pattern, $line, $matches)) {
                        echo "  ⚠️  $relative_path:" . ($line_num + 1) . " - Hardcoded URL: " . $matches[0] . "\n";
                        $this->stats['hardcoded_urls']++;
                        $this->issues[] = "$relative_path:" . ($line_num + 1) . " - Hardcoded URL: " . $matches[0];
                    }
                }
            }
        }

        if ($this->stats['hardcoded_urls'] === 0) {
            echo "  ✅ No hardcoded site URLs found!\n";
        } else {
            echo "\n  💡 Tip: Use home_url(), site_url(), or get_permalink() instead\n";
        }

        echo "\n";
    }

    /**
     * Check responsive CSS media queries
     */
    private function check_responsive_css()
    {
        echo "📱 Checking Responsive Design...\n";
        echo "----------------------------\n";

        $style_file = $this->theme_path . '/style.css';
        
        if (!file_exists($style_file)) {
            echo "  ❌ style.css not found\n\n";
            return;
        }

        $content = file_get_contents($style_file);

        // Check for viewport meta tag in header
        $header_file = $this->theme_path . '/header.php';
        $parent_header = get_template_directory() . '/header.php';
        
        $has_viewport = false;
        if (file_exists($header_file)) {
            $header_content = file_get_contents($header_file);
            $has_viewport = preg_match('/name=["\']viewport["\']/i', $header_content);
        } elseif (file_exists($parent_header)) {
            $header_content = file_get_contents($parent_header);
            $has_viewport = preg_match('/name=["\']viewport["\']/i', $header_content);
        }

        if ($has_viewport) {
            echo "  ✅ Viewport meta tag found\n";
        } else {
            echo "  ⚠️  Viewport meta tag not found in header.php\n";
            $this->issues[] = "Missing viewport meta tag for responsive design";
        }

        // Check for media queries
        $breakpoints = array(
            '/min-width:\s*768px/' => 'Tablet (768px+)',
            '/min-width:\s*1024px/' => 'Desktop (1024px+)',
            '/max-width:\s*767px/' => 'Mobile (max 767px)',
            '/min-width:\s*1440px/' => 'Large Desktop (1440px+)',
        );

        echo "\n  Media Query Coverage:\n";
        foreach ($breakpoints as $pattern => $desc) {
            if (preg_match($pattern, $content)) {
                echo "  ✅ $desc\n";
            } else {
                echo "  ⚠️  $desc - Not found\n";
            }
        }

        // Count total media queries
        $media_query_count = preg_match_all('/@media/i', $content);
        echo "\n  Total @media queries: $media_query_count\n";

        echo "\n";
    }

    /**
     * Display audit summary
     */
    private function display_summary()
    {
        echo "========================================\n";
        echo "📊 Audit Summary\n";
        echo "========================================\n\n";

        echo "Statistics:\n";
        echo "  • Files Scanned: {$this->stats['total_files_scanned']}\n";
        echo "  • Broken/Hardcoded Images: {$this->stats['broken_images']}\n";
        echo "  • Hardcoded URLs: {$this->stats['hardcoded_urls']}\n";
        echo "  • Missing Enqueues: {$this->stats['missing_enqueues']}\n";
        echo "  • Total Issues: " . count($this->issues) . "\n\n";

        if (count($this->issues) === 0) {
            echo "✅ No critical issues found! Your theme is well-structured.\n\n";
        } else {
            echo "⚠️  Issues that need attention:\n";
            echo "--------------------------------\n";
            foreach (array_slice($this->issues, 0, 20) as $issue) {
                echo "  • $issue\n";
            }
            
            if (count($this->issues) > 20) {
                echo "\n  ... and " . (count($this->issues) - 20) . " more issues\n";
            }
            
            echo "\n";
        }

        echo "========================================\n";
        echo "Audit Complete!\n";
        echo "========================================\n";
    }

    /**
     * Get all PHP files in theme
     */
    private function get_php_files()
    {
        $files = array();
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->theme_path)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }
}

// Run the audit
$audit = new SiteAuditTool();
$audit->run_audit();
