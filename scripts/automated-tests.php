<?php
/**
 * Automated Testing Script for WordPress Website
 * 
 * Performs comprehensive automated tests including:
 * - Template file existence checks
 * - Post type registration validation
 * - Navigation menu checks
 * - Image loading tests
 * - SEO meta tag validation
 * - Performance checks
 * - Responsive design validation
 * 
 * Usage: wp eval-file scripts/automated-tests.php
 * Or: php scripts/automated-tests.php
 * 
 * @package Feng_Shui_Homestyle_Vastu
 */

// Bootstrap WordPress if not already loaded
if (!defined('ABSPATH')) {
    require_once dirname(dirname(__FILE__)) . '/wp-load.php';
}

class AutomatedTests
{
    private $results = array();
    private $theme_path;
    
    public function __construct()
    {
        $this->theme_path = get_stylesheet_directory();
        $this->results = array(
            'passed' => 0,
            'failed' => 0,
            'warnings' => 0,
            'tests' => array(),
        );
    }
    
    /**
     * Run all tests
     */
    public function run_all_tests()
    {
        echo "========================================\n";
        echo "🧪 WordPress Automated Tests\n";
        echo "========================================\n\n";
        
        $this->test_template_files();
        $this->test_post_types();
        $this->test_navigation_menus();
        $this->test_image_loading();
        $this->test_seo_meta_tags();
        $this->test_responsive_design();
        $this->test_performance();
        $this->test_security();
        
        $this->display_results();
    }
    
    /**
     * Test template files existence
     */
    private function test_template_files()
    {
        echo "📄 Testing Template Files...\n";
        
        $required_templates = array(
            'index.php' => 'Main template',
            'style.css' => 'Stylesheet',
            'functions.php' => 'Functions file',
            'front-page.php' => 'Homepage template',
            'page.php' => 'Page template',
            'single.php' => 'Single post template',
            'archive.php' => 'Archive template',
            'search.php' => 'Search template',
            '404.php' => 'Error page template',
        );
        
        foreach ($required_templates as $file => $desc) {
            $file_path = $this->theme_path . '/' . $file;
            if (file_exists($file_path)) {
                $this->pass("$desc exists: $file");
            } else {
                $this->fail("$desc missing: $file");
            }
        }
        
        echo "\n";
    }
    
    /**
     * Test custom post types
     */
    private function test_post_types()
    {
        echo "📦 Testing Custom Post Types...\n";
        
        $required_post_types = array('service', 'testimonial');
        
        foreach ($required_post_types as $post_type) {
            if (post_type_exists($post_type)) {
                $this->pass("Post type '$post_type' is registered");
                
                // Check if it has archive
                $post_type_obj = get_post_type_object($post_type);
                if ($post_type_obj->has_archive) {
                    $this->pass("Post type '$post_type' has archive enabled");
                } else {
                    $this->warning("Post type '$post_type' archive disabled (may be intentional)");
                }
            } else {
                $this->fail("Post type '$post_type' is not registered");
            }
        }
        
        echo "\n";
    }
    
    /**
     * Test navigation menus
     */
    private function test_navigation_menus()
    {
        echo "🧭 Testing Navigation Menus...\n";
        
        $required_menus = array('primary', 'footer', 'mobile-menu');
        $registered_menus = get_registered_nav_menus();
        
        foreach ($required_menus as $menu) {
            if (isset($registered_menus[$menu])) {
                $this->pass("Menu location '$menu' is registered");
            } else {
                $this->fail("Menu location '$menu' is not registered");
            }
        }
        
        echo "\n";
    }
    
    /**
     * Test image loading
     */
    private function test_image_loading()
    {
        echo "🖼️  Testing Image Loading...\n";
        
        $image_dir = $this->theme_path . '/assets/images/';
        
        if (is_dir($image_dir)) {
            $this->pass("Images directory exists");
            
            // Check for common images
            $common_images = array(
                'hero-serene-living-space.webp',
            );
            
            foreach ($common_images as $image) {
                $image_path = $image_dir . $image;
                if (file_exists($image_path)) {
                    $size = filesize($image_path);
                    $size_kb = round($size / 1024, 2);
                    
                    if ($size_kb > 200) {
                        $this->warning("Image '$image' is large: {$size_kb}KB (recommend <200KB)");
                    } else {
                        $this->pass("Image '$image' size OK: {$size_kb}KB");
                    }
                } else {
                    $this->warning("Common image not found: $image (may not be used)");
                }
            }
        } else {
            $this->fail("Images directory not found");
        }
        
        echo "\n";
    }
    
    /**
     * Test SEO meta tags
     */
    private function test_seo_meta_tags()
    {
        echo "🔍 Testing SEO Meta Tags...\n";
        
        // Check if meta tags function exists
        if (function_exists('fengshuihomestyle_vastu_custom_meta_tags')) {
            $this->pass("Custom meta tags function exists");
        } else {
            $this->fail("Custom meta tags function not found");
        }
        
        // Check for sitemap
        $sitemap_path = ABSPATH . 'sitemap.xml';
        if (file_exists($sitemap_path)) {
            $this->pass("XML sitemap exists");
        } else {
            $this->warning("XML sitemap not found (run: wp eval-file scripts/generate-sitemap.php)");
        }
        
        // Check robots.txt
        $robots_path = ABSPATH . 'robots.txt';
        if (file_exists($robots_path)) {
            $this->pass("robots.txt exists");
        } else {
            $this->warning("robots.txt not found (recommended for SEO)");
        }
        
        echo "\n";
    }
    
    /**
     * Test responsive design
     */
    private function test_responsive_design()
    {
        echo "📱 Testing Responsive Design...\n";
        
        $style_css = $this->theme_path . '/style.css';
        
        if (file_exists($style_css)) {
            $content = file_get_contents($style_css);
            
            // Count media queries
            $media_query_count = preg_match_all('/@media/i', $content);
            
            if ($media_query_count > 10) {
                $this->pass("Responsive CSS found: $media_query_count media queries");
            } else {
                $this->warning("Limited responsive CSS: $media_query_count media queries");
            }
            
            // Check for common breakpoints
            $breakpoints = array(
                '768px' => 'Tablet',
                '1024px' => 'Desktop',
            );
            
            foreach ($breakpoints as $bp => $device) {
                if (strpos($content, $bp) !== false) {
                    $this->pass("$device breakpoint ($bp) found");
                } else {
                    $this->warning("$device breakpoint ($bp) not found");
                }
            }
        } else {
            $this->fail("style.css not found");
        }
        
        echo "\n";
    }
    
    /**
     * Test performance optimizations
     */
    private function test_performance()
    {
        echo "⚡ Testing Performance Optimizations...\n";
        
        // Check for lazy loading
        if (function_exists('fengshuihomestyle_vastu_add_lazy_loading_to_images')) {
            $this->pass("Lazy loading function exists");
        } else {
            $this->warning("Lazy loading function not found");
        }
        
        // Check for optimization functions
        $functions_php = $this->theme_path . '/functions.php';
        if (file_exists($functions_php)) {
            $content = file_get_contents($functions_php);
            
            if (strpos($content, 'wp_enqueue_style') !== false) {
                $this->pass("CSS enqueue found");
            } else {
                $this->warning("CSS enqueue not found (may use parent theme)");
            }
            
            if (strpos($content, 'wp_enqueue_script') !== false) {
                $this->pass("JS enqueue found");
            } else {
                $this->warning("JS enqueue not found (may not be needed)");
            }
            
            // Check for performance optimizations
            if (strpos($content, 'remove_action') !== false) {
                $this->pass("WordPress optimization found (remove_action)");
            }
        }
        
        echo "\n";
    }
    
    /**
     * Test security measures
     */
    private function test_security()
    {
        echo "🔒 Testing Security...\n";
        
        $functions_php = $this->theme_path . '/functions.php';
        if (file_exists($functions_php)) {
            $content = file_get_contents($functions_php);
            
            // Check for ABSPATH check
            if (strpos($content, "defined('ABSPATH')") !== false || strpos($content, 'defined("ABSPATH")') !== false) {
                $this->pass("ABSPATH security check found");
            } else {
                $this->fail("ABSPATH security check missing");
            }
            
            // Check for sanitization functions
            if (strpos($content, 'esc_') !== false || strpos($content, 'sanitize_') !== false) {
                $this->pass("Data sanitization found");
            } else {
                $this->warning("Data sanitization may be missing");
            }
        }
        
        echo "\n";
    }
    
    /**
     * Helper methods
     */
    private function pass($message)
    {
        $this->results['passed']++;
        $this->results['tests'][] = array('status' => 'pass', 'message' => $message);
        echo "  ✅ $message\n";
    }
    
    private function fail($message)
    {
        $this->results['failed']++;
        $this->results['tests'][] = array('status' => 'fail', 'message' => $message);
        echo "  ❌ $message\n";
    }
    
    private function warning($message)
    {
        $this->results['warnings']++;
        $this->results['tests'][] = array('status' => 'warning', 'message' => $message);
        echo "  ⚠️  $message\n";
    }
    
    /**
     * Display final results
     */
    private function display_results()
    {
        echo "========================================\n";
        echo "📊 Test Results Summary\n";
        echo "========================================\n\n";
        
        $total = $this->results['passed'] + $this->results['failed'] + $this->results['warnings'];
        
        echo "Total Tests: $total\n";
        echo "Passed: " . $this->results['passed'] . " ✅\n";
        echo "Failed: " . $this->results['failed'] . " ❌\n";
        echo "Warnings: " . $this->results['warnings'] . " ⚠️\n\n";
        
        if ($this->results['failed'] > 0) {
            echo "Status: ❌ FAILED - Please fix issues above\n";
        } elseif ($this->results['warnings'] > 0) {
            echo "Status: ⚠️  PASSED WITH WARNINGS\n";
        } else {
            echo "Status: ✅ ALL TESTS PASSED\n";
        }
        
        echo "========================================\n";
    }
}

// Run tests
$tests = new AutomatedTests();
$tests->run_all_tests();
