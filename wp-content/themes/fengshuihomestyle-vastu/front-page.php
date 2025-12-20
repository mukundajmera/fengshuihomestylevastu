<?php
/**
 * Template Name: Feng Shui Home Page
 * 
 * The front page template for Feng Shui Homestyle Vastu
 * Pioneer 2025 Digital Zen Design
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <!-- HERO SECTION - The Energy Foyer -->
        <section class="hero-section">
            <!-- Static Cinematic Image Background -->
            <div class="hero-image-bg" style="background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg' ); ?>');"></div>
            <div class="hero-overlay"></div>

            <div class="hero-content">
                <h1 class="hero-headline">Harmonize Your Space, Transform Your Life.</h1>
                <p class="hero-subheadline">
                    Expert Vastu & Feng Shui guidance to solve health, wealth, and relationship challenges. 100% Remote. No Demolition. 25+ years of mastery.
                </p>
                
                <a href="https://wa.me/919810143516?text=Hello!%20I%20would%20like%20to%20book%20a%20Vastu%20consultation" 
                   class="cta-primary ripple-effect" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Book WhatsApp Consultation
                </a>
            </div>
        </section>

        <!-- RESIDENTIAL SOLUTIONS - Interactive Grid -->
        <section class="residential-solutions-section">
            <h2 class="section-title">Residential Solutions</h2>
            <p class="section-subtitle">Transform every space in your home into a sanctuary of harmony and prosperity</p>
            
            <div class="residential-grid">
                <div class="glass-card residential-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-image-wrapper">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/vibrant-kitchen.jpg' ); ?>" 
                             alt="Health & Vitality - Clean vibrant kitchen" 
                             class="card-image" 
                             loading="lazy">
                        <div class="card-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="service-icon">💚</div>
                        <h3 class="service-title">Health & Vitality</h3>
                        <p class="service-description">
                            Fix energy blocks affecting family wellness. Create a vibrant kitchen and living spaces that promote health and vitality.
                        </p>
                        <a href="https://wa.me/919810143516?text=I%20want%20to%20improve%20health%20and%20vitality%20in%20my%20home" 
                           class="card-cta ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Get Started →
                        </a>
                    </div>
                </div>

                <div class="glass-card residential-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-image-wrapper">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/peaceful-bedroom.jpg' ); ?>" 
                             alt="Relationships & Rest - Peaceful balanced bedroom" 
                             class="card-image" 
                             loading="lazy">
                        <div class="card-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="service-icon">❤️</div>
                        <h3 class="service-title">Relationships & Rest</h3>
                        <p class="service-description">
                            Create a supportive atmosphere for harmony and sleep. Design a peaceful bedroom that nurtures relationships and rest.
                        </p>
                        <a href="https://wa.me/919810143516?text=I%20want%20to%20enhance%20relationships%20and%20rest%20in%20my%20home" 
                           class="card-cta ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Get Started →
                        </a>
                    </div>
                </div>

                <div class="glass-card residential-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-image-wrapper">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/minimalist-entrance.jpg' ); ?>" 
                             alt="Prosperity & Flow - Minimalist entrance foyer" 
                             class="card-image" 
                             loading="lazy">
                        <div class="card-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="service-icon">💰</div>
                        <h3 class="service-title">Prosperity & Flow</h3>
                        <p class="service-description">
                            Activate your home to attract financial growth. Optimize your entrance and foyer for wealth and abundance.
                        </p>
                        <a href="https://wa.me/919810143516?text=I%20want%20to%20activate%20prosperity%20in%20my%20home" 
                           class="card-cta ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Get Started →
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- COMMERCIAL GROWTH -->
        <section class="commercial-growth-section">
            <h2 class="section-title">Commercial Growth</h2>
            <p class="section-subtitle">Scaling Business without Disruption or Demolition</p>
            
            <div class="commercial-grid">
                <div class="glass-card commercial-card" data-aos="fade-right">
                    <div class="service-icon">🏢</div>
                    <h3 class="service-title">Office Optimization</h3>
                    <p class="service-description">
                        Enhance productivity and employee well-being through strategic workspace design. 
                        Zero disruption to daily operations.
                    </p>
                    <ul class="feature-list">
                        <li>✓ Enhanced team collaboration</li>
                        <li>✓ Increased focus and creativity</li>
                        <li>✓ Better decision-making spaces</li>
                    </ul>
                </div>

                <div class="glass-card commercial-card" data-aos="fade-up">
                    <div class="service-icon">🛒</div>
                    <h3 class="service-title">Retail Excellence</h3>
                    <p class="service-description">
                        Maximize customer flow and conversion rates with energy-optimized store layouts. 
                        No structural changes needed.
                    </p>
                    <ul class="feature-list">
                        <li>✓ Improved customer experience</li>
                        <li>✓ Higher sales conversion</li>
                        <li>✓ Enhanced brand perception</li>
                    </ul>
                </div>

                <div class="glass-card commercial-card" data-aos="fade-left">
                    <div class="service-icon">🏭</div>
                    <h3 class="service-title">Factory & Industrial</h3>
                    <p class="service-description">
                        Boost operational efficiency and worker safety through precise energy alignment. 
                        Maintain production while optimizing.
                    </p>
                    <ul class="feature-list">
                        <li>✓ Improved operational flow</li>
                        <li>✓ Enhanced worker safety</li>
                        <li>✓ Increased productivity</li>
                    </ul>
                </div>
            </div>

            <div class="commercial-cta">
                <a href="https://wa.me/919810143516?text=I%20want%20to%20scale%20my%20business%20with%20Vastu" 
                   class="cta-primary ripple-effect" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Book Commercial Consultation
                </a>
            </div>
        </section>

        <!-- SOCIAL PROOF & LEGACY -->
        <section class="social-proof-section">
            <div class="proof-strip">
                <div class="proof-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="proof-icon">⭐</div>
                    <div class="proof-number">25+</div>
                    <div class="proof-label">Years of Expert Guidance</div>
                </div>

                <div class="proof-divider"></div>

                <div class="proof-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="proof-icon">✓</div>
                    <div class="proof-number">10,000+</div>
                    <div class="proof-label">Success Stories</div>
                </div>

                <div class="proof-divider"></div>

                <div class="proof-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="proof-icon">🌍</div>
                    <div class="proof-number">Global</div>
                    <div class="proof-label">Remote Precision</div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS SECTION -->
        <section class="methodology-section" style="background: var(--color-warm-sand);">
            <h2 class="section-title">Success Stories</h2>
            <div class="service-grid" style="max-width: 1200px; margin: 0 auto;">
                <div class="glass-card">
                    <p class="service-description" style="font-style: italic; margin-bottom: 1rem;">
                        "After Sanjay Ji's remote consultation, our business grew by 300% within 6 months. 
                        The best part - no demolition required!"
                    </p>
                    <p style="color: var(--color-sage-green); font-weight: bold;">- Rajesh M., Mumbai</p>
                </div>

                <div class="glass-card">
                    <p class="service-description" style="font-style: italic; margin-bottom: 1rem;">
                        "The scientific approach using satellite mapping convinced me. Results were remarkable 
                        - improved health and family harmony."
                    </p>
                    <p style="color: var(--color-sage-green); font-weight: bold;">- Priya S., Bangalore</p>
                </div>

                <div class="glass-card">
                    <p class="service-description" style="font-style: italic; margin-bottom: 1rem;">
                        "Living abroad, I was skeptical about remote consultations. The AutoCAD analysis was 
                        incredibly precise. Highly recommended!"
                    </p>
                    <p style="color: var(--color-sage-green); font-weight: bold;">- David L., USA</p>
                </div>
            </div>
        </section>

        <!-- CALL TO ACTION SECTION -->
        <section class="hero-section" style="min-height: 60vh; background: linear-gradient(135deg, var(--color-deep-indigo) 0%, var(--color-sage-green) 100%);">
            <div class="hero-content">
                <h2 class="hero-headline" style="color: var(--color-zen-white);">
                    Ready to Transform Your Space?
                </h2>
                <p class="hero-subheadline" style="color: rgba(255, 255, 255, 0.9);">
                    Book your personalized Vastu consultation today.<br>
                    100% Remote. 100% Scientific. 0% Demolition.
                </p>
                <a href="https://wa.me/919810143516?text=Hello!%20I%20would%20like%20to%20book%20a%20Vastu%20consultation" 
                   class="cta-primary ripple-effect" 
                   style="background: var(--color-warm-sand); color: var(--color-deep-indigo);"
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Start Your Journey Now
                </a>
            </div>
        </section>

    </main>
</div>

<?php
get_footer();
