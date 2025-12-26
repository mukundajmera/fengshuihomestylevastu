<?php
/**
 * Pioneer Visuals - Phase 2 Deployment Script
 * Feng Shui Homestyle Vastu - Visual Integration
 * 
 * Security: Requires GET parameter ?key=feng-shui-2026-pioneer
 * 
 * @package FengShuiHomestyleVastu
 * @version 1.0.0
 */

// ============================================================================
// SECURITY LAYER
// ============================================================================

if (!isset($_GET['key']) || $_GET['key'] !== 'feng-shui-2026-pioneer') {
    http_response_code(403);
    die('Access Denied');
}

// ============================================================================
// WORDPRESS BOOTSTRAP
// ============================================================================

// Find wp-load.php - check multiple possible locations
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

// ============================================================================
// SMART ASSET DETECTION FUNCTION
// ============================================================================

/**
 * Intelligently detect the correct image base path
 * Checks multiple common locations and verifies accessibility
 * 
 * @return array ['url' => string, 'method' => string]
 */
function pioneer_detect_image_base() {
    $candidates = [
        [
            'url' => get_stylesheet_directory_uri() . '/assets/images',
            'path' => get_stylesheet_directory() . '/assets/images',
            'method' => 'Child Theme Assets'
        ],
        [
            'url' => get_template_directory_uri() . '/assets/images',
            'path' => get_template_directory() . '/assets/images',
            'method' => 'Parent Theme Assets'
        ],
        [
            'url' => home_url() . '/assets/images',
            'path' => ABSPATH . 'assets/images',
            'method' => 'Root Assets Directory'
        ],
        [
            'url' => wp_upload_dir()['baseurl'] . '/vastu-images',
            'path' => wp_upload_dir()['basedir'] . '/vastu-images',
            'method' => 'Uploads/Vastu-Images'
        ]
    ];

    // Check each candidate path
    foreach ($candidates as $candidate) {
        if (file_exists($candidate['path']) && is_dir($candidate['path'])) {
            // Verify at least one expected image exists
            $test_images = ['hero-bg.jpg', 'wellness.jpg', 'wealth.jpg', 'relationships.jpg'];
            $found_count = 0;
            
            foreach ($test_images as $img) {
                if (file_exists($candidate['path'] . '/' . $img)) {
                    $found_count++;
                }
            }
            
            if ($found_count > 0) {
                return [
                    'url' => $candidate['url'],
                    'path' => $candidate['path'],
                    'method' => $candidate['method'],
                    'images_found' => $found_count
                ];
            }
        }
    }

    // Fallback to child theme path if no images found
    return [
        'url' => get_stylesheet_directory_uri() . '/assets/images',
        'path' => get_stylesheet_directory() . '/assets/images',
        'method' => 'Default (Child Theme)',
        'images_found' => 0
    ];
}

// ============================================================================
// CONTENT GENERATION FUNCTIONS
// ============================================================================

/**
 * Generate Hero Section HTML with background image
 * 
 * @param string $img_base Base URL for images
 * @return string HTML content
 */
function pioneer_generate_hero_html($img_base) {
    return <<<HTML
<!-- Pioneer Visuals - Hero Section -->
<section class="hero-section" style="
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)), 
                url('{$img_base}/hero-bg.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding: 120px 20px;
    text-align: center;
    min-height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
">
    <div class="hero-content" style="max-width: 800px; margin: 0 auto;">
        <h1 style="
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
            color: white;
        ">
            Transform Your Space with Ancient Vastu Wisdom
        </h1>
        <p style="
            font-size: clamp(1.1rem, 2vw, 1.5rem);
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
            color: white;
            opacity: 0.95;
        ">
            Harmonize your home and business with time-tested Feng Shui principles guided by Sanjay Jain
        </p>
        <a href="#contact" class="cta-button" style="
            display: inline-block;
            background: linear-gradient(135deg, var(--accent-primary, #A8E6CF), var(--accent-secondary, #F4A261));
            color: #1a1a1a;
            padding: 18px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        " onmouseover="this.style.transform='translateY(-3px) scale(1.05)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.4)';" 
           onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.3)';">
            Get Your Energy Report
        </a>
    </div>
</section>

HTML;
}

/**
 * Generate Solution Grid HTML with image cards
 * 
 * @param string $img_base Base URL for images
 * @return string HTML content
 */
function pioneer_generate_solution_grid($img_base) {
    $solutions = [
        [
            'image' => 'wellness.jpg',
            'title' => 'Health & Wellness',
            'description' => 'Optimize energy flow for vibrant health and peaceful living spaces',
            'gradient' => 'linear-gradient(135deg, #A8E6CF, #7ECBB5)'
        ],
        [
            'image' => 'wealth.jpg',
            'title' => 'Wealth & Prosperity',
            'description' => 'Activate abundance zones to attract financial success and growth',
            'gradient' => 'linear-gradient(135deg, #F4A261, #E76F51)'
        ],
        [
            'image' => 'relationships.jpg',
            'title' => 'Love & Relationships',
            'description' => 'Harmonize relationship corners for deeper connections and harmony',
            'gradient' => 'linear-gradient(135deg, #FFD6E8, #F4A7C7)'
        ]
    ];

    $html = <<<HTML
<!-- Pioneer Visuals - Solution Grid -->
<section class="solution-grid" style="
    padding: 80px 20px;
    background: linear-gradient(180deg, #fafafa, #ffffff);
">
    <div class="container" style="max-width: 1200px; margin: 0 auto;">
        <h2 style="
            text-align: center;
            font-size: clamp(2rem, 4vw, 3rem);
            margin-bottom: 3rem;
            color: #1a1a1a;
        ">
            Our Vastu Solutions
        </h2>
        
        <div class="cards-grid" style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        ">

HTML;

    foreach ($solutions as $solution) {
        $html .= <<<CARD
            <div class="glass-card" style="
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            " onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 12px 40px rgba(0, 0, 0, 0.15)';" 
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 32px rgba(0, 0, 0, 0.1)';">
                
                <img src="{$img_base}/{$solution['image']}" 
                     alt="{$solution['title']}" 
                     class="card-img-top" 
                     style="
                         width: 100%;
                         height: 200px;
                         object-fit: cover;
                         border-radius: 20px 20px 0 0;
                     ">
                
                <div class="card-body" style="padding: 25px;">
                    <div class="card-accent" style="
                        width: 60px;
                        height: 4px;
                        background: {$solution['gradient']};
                        border-radius: 2px;
                        margin-bottom: 15px;
                    "></div>
                    
                    <h3 style="
                        font-size: 1.5rem;
                        font-weight: 600;
                        margin-bottom: 12px;
                        color: #1a1a1a;
                    ">{$solution['title']}</h3>
                    
                    <p style="
                        color: #4a4a4a;
                        line-height: 1.6;
                        margin-bottom: 20px;
                    ">{$solution['description']}</p>
                    
                    <a href="#learn-more" style="
                        color: #E76F51;
                        font-weight: 600;
                        text-decoration: none;
                        display: inline-flex;
                        align-items: center;
                        gap: 5px;
                        transition: gap 0.3s ease;
                    " onmouseover="this.style.gap='10px';" onmouseout="this.style.gap='5px';">
                        Learn More →
                    </a>
                </div>
            </div>

CARD;
    }

    $html .= <<<HTML
        </div>
    </div>
</section>

HTML;

    return $html;
}

// ============================================================================
// CSS INJECTION FUNCTION
// ============================================================================

/**
 * Inject enhanced CSS into WordPress Customizer
 * Preserves existing glassmorphism variables
 * 
 * @return bool Success status
 */
function pioneer_inject_css() {
    $existing_css = get_theme_mod('custom_css', '');
    
    $new_css = <<<CSS

/* ============================================
   PIONEER VISUALS - Phase 2 CSS Injection
   ============================================ */

/* Global Design Tokens */
:root {
    --accent-primary: #A8E6CF;
    --accent-secondary: #F4A261;
    --accent-tertiary: #E76F51;
    --text-primary: #1a1a1a;
    --text-secondary: #4a4a4a;
    --glass-bg: rgba(255, 255, 255, 0.7);
    --glass-border: rgba(255, 255, 255, 0.3);
    --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.1);
    --shadow-hover: 0 12px 40px rgba(0, 0, 0, 0.15);
}

/* Hero Section Enhancements */
.hero-section {
    color: white !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.hero-section * {
    color: white !important;
}

/* Card Image Styling */
.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 20px 20px 0 0;
}

/* Glass Card Base */
.glass-card {
    background: var(--glass-bg);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    box-shadow: var(--shadow-soft);
    transition: all 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-hover);
}

/* Responsive Typography */
@media (max-width: 768px) {
    .hero-section {
        padding: 80px 20px !important;
        min-height: 500px !important;
    }
    
    .solution-grid {
        padding: 60px 15px !important;
    }
    
    .cards-grid {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
    }
}

/* Smooth Scroll Behavior */
html {
    scroll-behavior: smooth;
}

/* CTA Button Enhancements */
.cta-button {
    position: relative;
    overflow: hidden;
}

.cta-button::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.cta-button:hover::before {
    width: 300px;
    height: 300px;
}

CSS;

    // Check if CSS already injected
    if (strpos($existing_css, 'PIONEER VISUALS - Phase 2') !== false) {
        return true; // Already injected, skip
    }
    
    $combined_css = $existing_css . "\n" . $new_css;
    set_theme_mod('custom_css', $combined_css);
    
    return true;
}

// ============================================================================
// MAIN EXECUTION
// ============================================================================

// Start output buffering for clean HTML report
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pioneer Visuals - Deployment Report</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
            min-height: 100vh;
        }
        .report-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .report-header {
            background: linear-gradient(135deg, #A8E6CF, #7ECBB5);
            padding: 40px;
            text-align: center;
        }
        .report-header h1 {
            color: #1a1a1a;
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .report-header p {
            color: #2a2a2a;
            font-size: 1.1rem;
        }
        .report-body {
            padding: 40px;
        }
        .status-item {
            background: #f8f9fa;
            border-left: 4px solid #A8E6CF;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
        .status-item.success {
            border-left-color: #28a745;
            background: #d4edda;
        }
        .status-item.warning {
            border-left-color: #ffc107;
            background: #fff3cd;
        }
        .status-item.error {
            border-left-color: #dc3545;
            background: #f8d7da;
        }
        .status-item h3 {
            margin-bottom: 10px;
            color: #1a1a1a;
        }
        .status-item p {
            color: #4a4a4a;
            line-height: 1.6;
        }
        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            margin: 10px 0;
        }
        .next-steps {
            background: linear-gradient(135deg, #F4A261, #E76F51);
            color: white;
            padding: 30px;
            border-radius: 12px;
            margin-top: 30px;
        }
        .next-steps h2 {
            margin-bottom: 15px;
        }
        .next-steps ol {
            margin-left: 20px;
            line-height: 2;
        }
        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-left: 10px;
        }
        .badge.success { background: #28a745; color: white; }
        .badge.info { background: #17a2b8; color: white; }
        .badge.warning { background: #ffc107; color: #1a1a1a; }
    </style>
</head>
<body>
    <div class="report-container">
        <div class="report-header">
            <h1>🚀 Pioneer Visuals</h1>
            <p>Phase 2 Deployment Report - Visual Integration</p>
        </div>
        
        <div class="report-body">
            <?php
            // Step 1: Asset Detection
            echo '<div class="status-item success">';
            echo '<h3>✓ Smart Asset Detection <span class="badge info">STEP 1</span></h3>';
            
            $asset_info = pioneer_detect_image_base();
            echo '<p><strong>Detection Method:</strong> ' . esc_html($asset_info['method']) . '</p>';
            echo '<p><strong>Base URL:</strong> <code>' . esc_html($asset_info['url']) . '</code></p>';
            echo '<p><strong>File Path:</strong> <code>' . esc_html($asset_info['path']) . '</code></p>';
            echo '<p><strong>Images Found:</strong> ' . $asset_info['images_found'] . ' / 4 expected files</p>';
            
            if ($asset_info['images_found'] === 0) {
                echo '<p class="warning" style="color: #856404; margin-top: 10px;">⚠️ <strong>Warning:</strong> No images detected. Please upload images to the detected path.</p>';
            }
            echo '</div>';
            
            $img_base = $asset_info['url'];
            
            // Step 2: Content Generation
            echo '<div class="status-item success">';
            echo '<h3>✓ Content Generation <span class="badge info">STEP 2</span></h3>';
            
            $hero_html = pioneer_generate_hero_html($img_base);
            $grid_html = pioneer_generate_solution_grid($img_base);
            $full_content = $hero_html . "\n\n" . $grid_html;
            
            echo '<p><strong>Hero Section:</strong> Generated with background image overlay</p>';
            echo '<p><strong>Solution Grid:</strong> 3 cards with wellness, wealth, and relationships imagery</p>';
            echo '<p><strong>Total HTML Size:</strong> ' . number_format(strlen($full_content)) . ' characters</p>';
            echo '</div>';
            
            // Step 3: Database Update
            echo '<div class="status-item success">';
            echo '<h3>✓ Database Update <span class="badge info">STEP 3</span></h3>';
            
            // Get homepage
            $homepage = get_page_by_path('home');
            if (!$homepage) {
                $homepage = get_posts(['post_type' => 'page', 'name' => 'home', 'numberposts' => 1]);
                $homepage = $homepage ? $homepage[0] : null;
            }
            
            if (!$homepage) {
                // Try to find a page with "Home" in title
                $homepage = get_posts([
                    'post_type' => 'page',
                    'title' => 'Home',
                    'numberposts' => 1
                ]);
                $homepage = $homepage ? $homepage[0] : null;
            }
            
            if ($homepage) {
                $update_result = wp_update_post([
                    'ID' => $homepage->ID,
                    'post_content' => $full_content
                ]);
                
                if ($update_result && !is_wp_error($update_result)) {
                    echo '<p><strong>Status:</strong> <span class="badge success">SUCCESS</span></p>';
                    echo '<p><strong>Page Updated:</strong> ' . esc_html($homepage->post_title) . ' (ID: ' . $homepage->ID . ')</p>';
                    echo '<p><strong>Page URL:</strong> <a href="' . get_permalink($homepage->ID) . '" target="_blank">' . get_permalink($homepage->ID) . '</a></p>';
                } else {
                    echo '<p><strong>Status:</strong> <span class="badge warning">FAILED</span></p>';
                    echo '<p>Error: ' . (is_wp_error($update_result) ? $update_result->get_error_message() : 'Unknown error') . '</p>';
                }
            } else {
                echo '<p><strong>Status:</strong> <span class="badge warning">PAGE NOT FOUND</span></p>';
                echo '<p>Could not locate a "Home" page in the database. Please create one manually.</p>';
            }
            echo '</div>';
            
            // Step 4: CSS Injection
            echo '<div class="status-item success">';
            echo '<h3>✓ CSS Injection <span class="badge info">STEP 4</span></h3>';
            
            $css_result = pioneer_inject_css();
            
            if ($css_result) {
                echo '<p><strong>Status:</strong> <span class="badge success">INJECTED</span></p>';
                echo '<p>Enhanced CSS has been added to WordPress Customizer</p>';
                echo '<p><strong>Includes:</strong></p>';
                echo '<ul style="margin-left: 20px; line-height: 1.8;">';
                echo '<li>Global Design Tokens (CSS Variables)</li>';
                echo '<li>Hero Section White Text Enforcement</li>';
                echo '<li>Card Image Styling</li>';
                echo '<li>Glassmorphism Effects</li>';
                echo '<li>Responsive Mobile Optimizations</li>';
                echo '<li>CTA Button Ripple Effects</li>';
                echo '</ul>';
            }
            echo '</div>';
            ?>
            
            <div class="next-steps">
                <h2>📋 Next Steps</h2>
                <ol>
                    <li><strong>Verify Visual Output:</strong> Visit your homepage and confirm images are displaying correctly</li>
                    <li><strong>Upload Missing Images:</strong> If images are missing, upload them to:
                        <div class="code-block"><?php echo esc_html($asset_info['path']); ?></div>
                        Required files: hero-bg.jpg, wellness.jpg, wealth.jpg, relationships.jpg
                    </li>
                    <li><strong>Test Responsiveness:</strong> Check mobile and tablet views for proper scaling</li>
                    <li><strong>Security Cleanup:</strong> Delete this script file (pioneer-visuals.php) from your server</li>
                    <li><strong>Cache Clear:</strong> Clear any caching plugins or CDN cache to see changes immediately</li>
                </ol>
            </div>
            
            <div style="text-align: center; margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                <p style="color: #4a4a4a; font-size: 0.9rem;">
                    <strong>Deployment Time:</strong> <?php echo date('Y-m-d H:i:s'); ?><br>
                    <strong>WordPress Version:</strong> <?php echo get_bloginfo('version'); ?><br>
                    <strong>Active Theme:</strong> <?php echo wp_get_theme()->get('Name'); ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
<?php

// Output the buffered content
$output = ob_get_clean();
echo $output;

// End of script
exit;
