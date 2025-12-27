<?php
/**
 * Automated Link Validator for WordPress
 * 
 * Checks all internal and external links across the website for:
 * - Broken links (404 errors)
 * - Slow-loading links (timeout issues)
 * - Redirect chains
 * - External link status
 * 
 * Usage: wp eval-file scripts/link-validator.php
 * Or: php scripts/link-validator.php
 * 
 * @package Feng_Shui_Homestyle_Vastu
 */

// Bootstrap WordPress if not already loaded
if (!defined('ABSPATH')) {
    require_once dirname(dirname(__FILE__)) . '/wp-load.php';
}

class LinkValidator
{
    private $results = array();
    private $checked_urls = array();
    private $timeout = 10; // seconds
    
    public function __construct()
    {
        $this->results = array(
            'total_links' => 0,
            'broken_links' => array(),
            'slow_links' => array(),
            'redirect_links' => array(),
            'valid_links' => 0,
        );
    }
    
    /**
     * Run complete link validation
     */
    public function run_validation()
    {
        echo "========================================\n";
        echo "WordPress Link Validator\n";
        echo "========================================\n\n";
        
        echo "🔍 Scanning website for links...\n\n";
        
        // Get all posts and pages
        $content_to_check = $this->get_all_content();
        
        // Extract and validate links
        foreach ($content_to_check as $item) {
            $this->validate_content_links($item);
        }
        
        // Display results
        $this->display_results();
    }
    
    /**
     * Get all content to check (posts, pages, services)
     */
    private function get_all_content()
    {
        $content = array();
        
        // Get all posts
        $posts = get_posts(array(
            'post_type' => array('post', 'page', 'service'),
            'post_status' => 'publish',
            'numberposts' => -1,
        ));
        
        foreach ($posts as $post) {
            $content[] = array(
                'id' => $post->ID,
                'title' => $post->post_title,
                'url' => get_permalink($post->ID),
                'content' => $post->post_content,
                'type' => $post->post_type,
            );
        }
        
        return $content;
    }
    
    /**
     * Validate links in content
     */
    private function validate_content_links($item)
    {
        // Extract all links from content
        preg_match_all('/<a[^>]+href=["\'](.*?)["\']/', $item['content'], $matches);
        
        if (empty($matches[1])) {
            return;
        }
        
        foreach ($matches[1] as $url) {
            // Skip anchors and javascript
            if (strpos($url, '#') === 0 || strpos($url, 'javascript:') === 0) {
                continue;
            }
            
            // Convert relative URLs to absolute
            if (strpos($url, 'http') !== 0) {
                $url = home_url($url);
            }
            
            // Skip if already checked
            if (isset($this->checked_urls[$url])) {
                continue;
            }
            
            $this->results['total_links']++;
            $this->check_link($url, $item);
        }
    }
    
    /**
     * Check individual link
     */
    private function check_link($url, $source_item)
    {
        $this->checked_urls[$url] = true;
        
        echo "Checking: " . substr($url, 0, 60) . "...\r";
        
        $start_time = microtime(true);
        
        // Use WordPress HTTP API
        $response = wp_remote_head($url, array(
            'timeout' => $this->timeout,
            'redirection' => 5,
            'sslverify' => false,
        ));
        
        $elapsed_time = microtime(true) - $start_time;
        
        // Check for errors
        if (is_wp_error($response)) {
            $this->results['broken_links'][] = array(
                'url' => $url,
                'source' => $source_item['title'],
                'source_url' => $source_item['url'],
                'error' => $response->get_error_message(),
            );
            return;
        }
        
        $status_code = wp_remote_retrieve_response_code($response);
        
        // Check status code
        if ($status_code >= 400) {
            $this->results['broken_links'][] = array(
                'url' => $url,
                'source' => $source_item['title'],
                'source_url' => $source_item['url'],
                'status' => $status_code,
            );
        } elseif ($status_code >= 300 && $status_code < 400) {
            // Redirect detected
            $this->results['redirect_links'][] = array(
                'url' => $url,
                'source' => $source_item['title'],
                'source_url' => $source_item['url'],
                'status' => $status_code,
            );
            $this->results['valid_links']++;
        } else {
            $this->results['valid_links']++;
        }
        
        // Check for slow links (over 3 seconds)
        if ($elapsed_time > 3) {
            $this->results['slow_links'][] = array(
                'url' => $url,
                'source' => $source_item['title'],
                'source_url' => $source_item['url'],
                'time' => round($elapsed_time, 2),
            );
        }
    }
    
    /**
     * Display validation results
     */
    private function display_results()
    {
        echo "\n\n";
        echo "========================================\n";
        echo "📊 Validation Results\n";
        echo "========================================\n\n";
        
        echo "Total Links Checked: " . $this->results['total_links'] . "\n";
        echo "Valid Links: " . $this->results['valid_links'] . "\n";
        echo "Broken Links: " . count($this->results['broken_links']) . "\n";
        echo "Redirect Links: " . count($this->results['redirect_links']) . "\n";
        echo "Slow Links: " . count($this->results['slow_links']) . "\n\n";
        
        // Display broken links
        if (!empty($this->results['broken_links'])) {
            echo "❌ Broken Links:\n";
            echo "----------------\n";
            foreach ($this->results['broken_links'] as $link) {
                echo "  URL: " . $link['url'] . "\n";
                echo "  Source: " . $link['source'] . " (" . $link['source_url'] . ")\n";
                if (isset($link['status'])) {
                    echo "  Status: " . $link['status'] . "\n";
                } else {
                    echo "  Error: " . $link['error'] . "\n";
                }
                echo "\n";
            }
        }
        
        // Display redirect links
        if (!empty($this->results['redirect_links'])) {
            echo "🔄 Redirect Links (Consider updating to final URL):\n";
            echo "---------------------------------------------------\n";
            foreach ($this->results['redirect_links'] as $link) {
                echo "  URL: " . $link['url'] . "\n";
                echo "  Source: " . $link['source'] . "\n";
                echo "  Status: " . $link['status'] . "\n\n";
            }
        }
        
        // Display slow links
        if (!empty($this->results['slow_links'])) {
            echo "🐌 Slow Links (>3 seconds):\n";
            echo "---------------------------\n";
            foreach ($this->results['slow_links'] as $link) {
                echo "  URL: " . $link['url'] . "\n";
                echo "  Load Time: " . $link['time'] . "s\n";
                echo "  Source: " . $link['source'] . "\n\n";
            }
        }
        
        // Summary
        echo "========================================\n";
        if (empty($this->results['broken_links'])) {
            echo "✅ All links are valid!\n";
        } else {
            echo "⚠️  Please fix broken links above.\n";
        }
        echo "========================================\n";
    }
}

// Run validation
$validator = new LinkValidator();
$validator->run_validation();
