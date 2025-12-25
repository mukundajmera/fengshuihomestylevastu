<?php
/**
 * Hero Section Template Part
 * 
 * Adaptive hero component with different layouts for Mobile vs Desktop.
 * Uses wp_is_mobile() for conditional rendering to ensure "Super Responsiveness."
 *
 * @package FengShuiHomestyleVastu
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// WhatsApp link - centralized for easy updates
$whatsapp_link = 'https://wa.me/919820576150?text=' . rawurlencode('Hello! I am interested in your Vastu consultation services.');

?>

<?php if (wp_is_mobile()): ?>
    <!-- ========================================
         MOBILE HERO - Vertical Stack Layout
         9:16 Aspect Ratio | Thumb Zone Optimized
         ======================================== -->
    <section class="hero-section hero-mobile mobile-hero-bg" role="banner" aria-label="Hero Section">
        <div class="hero-mobile-container">
            <!-- Aspect Ratio Container (9:16) -->
            <div class="hero-mobile-aspect">
                <div class="hero-mobile-content">
                    <!-- Punchy Mobile Headline -->
                    <h1 class="hero-mobile-headline">
                        Harmonize Your Home
                    </h1>

                    <!-- Floating Action Button - Thumb Zone Centered -->
                    <a href="<?php echo esc_url($whatsapp_link); ?>" class="hero-fab" id="hero-whatsapp-fab"
                        aria-label="Contact us on WhatsApp" target="_blank" rel="noopener noreferrer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="32"
                            height="32">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        <span class="fab-text">Start Your Journey</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php else: ?>
    <!-- ========================================
         DESKTOP HERO - Cinematic Widescreen
         16:9 Aspect Ratio | Glassmorphism Overlay
         ======================================== -->
    <section class="hero-section hero-desktop desktop-hero-bg" role="banner" aria-label="Hero Section">
        <!-- Aspect Ratio Container (16:9) -->
        <div class="hero-desktop-aspect">
            <!-- Glassmorphism Overlay Panel - Left Side -->
            <div class="hero-glass-panel">
                <div class="hero-glass-content">
                    <!-- Full H1 Headline -->
                    <h1 class="hero-desktop-headline">
                        Scientific Vastu for Global Spaces
                    </h1>

                    <!-- Subtext -->
                    <p class="hero-desktop-subtext">
                        25 Years of Precision Engineering.
                    </p>

                    <!-- Glass Button CTA -->
                    <a href="#services" class="glass-button" id="hero-explore-services">
                        Explore Services
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>