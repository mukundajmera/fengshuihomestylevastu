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
            <!-- Video Background -->
            <video class="hero-video-bg" autoplay muted loop playsinline 
                   src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/hero-video.mp4' ); ?>"
                   poster="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/hero-poster.jpg' ); ?>">
                <!-- Fallback for browsers that don't support video -->
                <p>Your browser does not support the video tag.</p>
            </video>
            <div class="hero-video-overlay"></div>

            <div class="hero-content">
                <h1 class="hero-headline">Harmonize Your Space, Transform Your Life</h1>
                <p class="hero-subheadline">
                    Scientific Vastu & Feng Shui Consultations. 100% Remote. 0% Demolition.<br>
                    Over 25 years of expert guidance by Sanjay Jain.
                </p>
                
                <a href="https://wa.me/919810143516?text=Hello!%20I%20would%20like%20to%20book%20a%20Vastu%20consultation" 
                   class="cta-primary ripple-effect" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Book Your WhatsApp Audit
                </a>

                <!-- Trust Markers -->
                <div class="trust-strip">
                    <div class="trust-item">
                        <span class="trust-icon">✓</span>
                        <span>Trusted by <strong class="trust-counter">10000</strong>+ Families</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">🌍</span>
                        <span><strong>Global</strong> Remote Consultations</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-icon">⭐</span>
                        <span><strong>25+</strong> Years Experience</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- METHODOLOGY SECTION - Scientific Vastu -->
        <section class="methodology-section">
            <h2 class="section-title">Scientific Vastu: The 2025 Approach</h2>
            
            <div class="methodology-content">
                <div class="glass-card">
                    <div class="service-icon">🛰️</div>
                    <h3 class="service-title">True North Satellite Mapping</h3>
                    <p class="service-description">
                        We use Google Earth satellite imagery to determine the precise True North orientation 
                        of your property, ensuring accurate directional analysis for optimal energy flow.
                    </p>
                </div>

                <div class="glass-card">
                    <div class="service-icon">📐</div>
                    <h3 class="service-title">AutoCAD Floor Plan Analysis</h3>
                    <p class="service-description">
                        Advanced CAD technology allows us to analyze your space with millimeter precision, 
                        identifying energy imbalances and opportunities for harmonization.
                    </p>
                </div>

                <div class="glass-card">
                    <div class="service-icon">🏡</div>
                    <h3 class="service-title">Zero Demolition Solutions</h3>
                    <p class="service-description">
                        Our scientific approach focuses on spatial alignment and energy redirection, 
                        eliminating the need for costly and disruptive structural changes.
                    </p>
                </div>
            </div>

            <!-- Before & After Energy Diagram -->
            <div class="energy-diagram">
                <h3 style="text-align: center; margin-bottom: 2rem;">Energy Flow Transformation</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; align-items: center;">
                    <div>
                        <h4 style="color: #8B7355; text-align: center;">Before</h4>
                        <div style="background: linear-gradient(45deg, rgba(255,0,0,0.2), rgba(255,100,100,0.2)); padding: 3rem; border-radius: 15px; text-align: center; min-height: 200px; display: flex; align-items: center; justify-content: center;">
                            <p style="font-size: 2rem; opacity: 0.7;">Blocked Energy</p>
                        </div>
                    </div>
                    <div>
                        <h4 style="color: #648E7B; text-align: center;">After</h4>
                        <div style="background: linear-gradient(45deg, rgba(100,142,123,0.2), rgba(100,200,150,0.2)); padding: 3rem; border-radius: 15px; text-align: center; min-height: 200px; display: flex; align-items: center; justify-content: center;">
                            <p style="font-size: 2rem; opacity: 0.7;">Harmonized Flow</p>
                        </div>
                    </div>
                </div>
                <p style="text-align: center; margin-top: 2rem; color: #8B7355; font-style: italic;">
                    *Visualization represents energy flow optimization through scientific Vastu principles
                </p>
            </div>
        </section>

        <!-- SERVICES SECTION - The Solution Menu -->
        <section class="services-section">
            <h2 class="section-title">Our Services</h2>

            <div class="service-tabs">
                <button class="tab-button ripple-effect" 
                        data-tab="residential" 
                        role="tab" 
                        aria-selected="true" 
                        aria-controls="residential">Residential Harmony</button>
                <button class="tab-button ripple-effect" 
                        data-tab="commercial" 
                        role="tab" 
                        aria-selected="false" 
                        aria-controls="commercial">Commercial Success</button>
                <button class="tab-button ripple-effect" 
                        data-tab="astro-vastu" 
                        role="tab" 
                        aria-selected="false" 
                        aria-controls="astro-vastu">Astro-Vastu</button>
            </div>

            <!-- Residential Harmony Tab -->
            <div id="residential" class="tab-content">
                <div class="service-grid">
                    <div class="glass-card service-card">
                        <div class="service-icon">💚</div>
                        <h3 class="service-title">Health & Wellness</h3>
                        <p class="service-description">
                            North-East zone optimization for enhanced vitality, mental clarity, and overall well-being. 
                            Address health challenges through proper spatial energy alignment.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">💰</div>
                        <h3 class="service-title">Wealth & Prosperity</h3>
                        <p class="service-description">
                            South-East sector balancing to attract abundance and financial growth. 
                            Activate wealth corners and remove blockages hindering prosperity.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">❤️</div>
                        <h3 class="service-title">Relationships & Harmony</h3>
                        <p class="service-description">
                            South-West zone enhancement for stable relationships and family harmony. 
                            Strengthen bonds and create a nurturing home environment.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🎓</div>
                        <h3 class="service-title">Education & Growth</h3>
                        <p class="service-description">
                            West zone optimization for children's education and career advancement. 
                            Create focused study areas that enhance concentration and learning.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Commercial Success Tab -->
            <div id="commercial" class="tab-content">
                <div class="service-grid">
                    <div class="glass-card service-card">
                        <div class="service-icon">🏢</div>
                        <h3 class="service-title">Office Productivity</h3>
                        <p class="service-description">
                            Workspace optimization for enhanced employee performance, creativity, and collaboration. 
                            Strategic desk placement and energy flow design.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🛒</div>
                        <h3 class="service-title">Retail Growth</h3>
                        <p class="service-description">
                            Store layout design to maximize customer flow, increase sales, and create an inviting 
                            shopping atmosphere that converts browsers to buyers.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🏭</div>
                        <h3 class="service-title">Industrial Vastu</h3>
                        <p class="service-description">
                            Factory and manufacturing facility optimization for operational efficiency, 
                            worker safety, and business growth through proper machinery placement.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🏨</div>
                        <h3 class="service-title">Hospitality Excellence</h3>
                        <p class="service-description">
                            Hotel, restaurant, and hospitality venue design for positive guest experiences, 
                            repeat business, and reputation building through energy harmony.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Astro-Vastu Tab -->
            <div id="astro-vastu" class="tab-content">
                <div class="service-grid">
                    <div class="glass-card service-card">
                        <div class="service-icon">⭐</div>
                        <h3 class="service-title">Personal Energy Blueprint</h3>
                        <p class="service-description">
                            Integration of your birth chart with living spaces for a personalized approach. 
                            Align your environment with your cosmic energy signature.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🌙</div>
                        <h3 class="service-title">Planetary Remedies</h3>
                        <p class="service-description">
                            Address challenging planetary positions through spatial corrections and placement 
                            of specific elements in corresponding directional zones.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🔮</div>
                        <h3 class="service-title">Timing & Muhurat</h3>
                        <p class="service-description">
                            Select auspicious timings for important events, moving in, renovations, and 
                            major decisions based on astrological and Vastu principles.
                        </p>
                    </div>

                    <div class="glass-card service-card">
                        <div class="service-icon">🌟</div>
                        <h3 class="service-title">Holistic Transformation</h3>
                        <p class="service-description">
                            Comprehensive life area analysis combining Vedic astrology with Vastu Shastra 
                            for complete harmonization of your personal and spatial energies.
                        </p>
                    </div>
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
