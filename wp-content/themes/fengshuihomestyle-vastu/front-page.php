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
                    Experience Scientific Vastu & Feng Shui that solves Health, Wealth, and Relationship challenges—without breaking a single brick. Over 25 years of mastery brought to your doorstep via 100% Remote Consultations.
                </p>
                
                <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                   class="cta-primary ripple-effect" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Chat with Sanjay Jain on WhatsApp
                </a>
            </div>
        </section>

        <!-- RESIDENTIAL SOLUTIONS - Interactive Grid -->
        <section class="residential-solutions-section">
            <h2 class="section-title">Life Solutions</h2>
            <p class="section-subtitle">Transform every space in your home into a sanctuary of harmony and prosperity</p>
            
            <div class="residential-grid">
                <div class="glass-card residential-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-image-wrapper">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/vibrant-kitchen.jpg' ); ?>" 
                             alt="Family Wellness & Vitality - Clean vibrant kitchen" 
                             class="card-image" 
                             loading="lazy">
                        <div class="card-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="service-icon">❤️</div>
                        <h3 class="service-title">Family Wellness & Vitality</h3>
                        <p class="service-description">
                            Is your family facing frequent health issues? We align your Kitchen and North-East zones to balance the Fire and Water elements, restoring the natural energy of wellness in your home.
                        </p>
                        <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                           class="card-cta ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Chat with Sanjay Jain →
                        </a>
                    </div>
                </div>

                <div class="glass-card residential-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-image-wrapper">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/peaceful-bedroom.jpg' ); ?>" 
                             alt="Relationship Sanctuary - Peaceful balanced bedroom" 
                             class="card-image" 
                             loading="lazy">
                        <div class="card-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="service-icon">∞</div>
                        <h3 class="service-title">Relationship Sanctuary</h3>
                        <p class="service-description">
                            Create a bedroom environment that fosters deep rest and emotional connection. Our South-West stability remedies help resolve conflicts and bring harmony to your personal life.
                        </p>
                        <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                           class="card-cta ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Chat with Sanjay Jain →
                        </a>
                    </div>
                </div>

                <div class="glass-card residential-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-image-wrapper">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/minimalist-entrance.jpg' ); ?>" 
                             alt="The Gateway to Abundance - Minimalist entrance foyer" 
                             class="card-image" 
                             loading="lazy">
                        <div class="card-overlay"></div>
                    </div>
                    <div class="card-content">
                        <div class="service-icon">💰</div>
                        <h3 class="service-title">The Gateway to Abundance</h3>
                        <p class="service-description">
                            Your main entrance is the mouth of opportunity. We use elemental balancing to ensure your home attracts financial growth and career success.
                        </p>
                        <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                           class="card-cta ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            Chat with Sanjay Jain →
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- COMMERCIAL GROWTH -->
        <section class="commercial-growth-section">
            <h2 class="section-title">The Growth Engine</h2>
            <p class="section-subtitle">Scalable Vastu solutions for Offices, Retail, and Factories</p>
            
            <div class="commercial-grid">
                <div class="glass-card commercial-card" data-aos="fade-right">
                    <div class="service-icon">🏢</div>
                    <h3 class="service-title">Office Productivity</h3>
                    <p class="service-description">
                        Optimize your workspace to increase employee productivity, enhance decision-making, and create an environment where innovation thrives—no structural changes required.
                    </p>
                    <ul class="feature-list">
                        <li>✓ Enhanced team collaboration & creativity</li>
                        <li>✓ Improved focus and efficiency</li>
                        <li>✓ Better leadership & strategic thinking</li>
                    </ul>
                </div>

                <div class="glass-card commercial-card" data-aos="fade-up">
                    <div class="service-icon">🛒</div>
                    <h3 class="service-title">Retail Excellence</h3>
                    <p class="service-description">
                        Attract high-paying clients, increase average transaction values, and create customer flow that naturally converts—all through strategic energy optimization.
                    </p>
                    <ul class="feature-list">
                        <li>✓ Increased customer footfall & dwell time</li>
                        <li>✓ Higher sales conversion rates</li>
                        <li>✓ Enhanced brand perception & loyalty</li>
                    </ul>
                </div>

                <div class="glass-card commercial-card" data-aos="fade-left">
                    <div class="service-icon">🏭</div>
                    <h3 class="service-title">Industrial Growth</h3>
                    <p class="service-description">
                        Clear the path for exponential profit. Boost operational efficiency, enhance worker safety, and optimize production flow while maintaining full operations.
                    </p>
                    <ul class="feature-list">
                        <li>✓ Streamlined operational flow</li>
                        <li>✓ Enhanced worker safety & morale</li>
                        <li>✓ Increased productivity & profitability</li>
                    </ul>
                </div>
            </div>

            <div class="commercial-cta">
                <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                   class="cta-primary ripple-effect" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Chat with Sanjay Jain on WhatsApp
                </a>
            </div>
        </section>

        <!-- INTERACTIVE TOOLS - Kua Number & Compass -->
        <section class="vastu-tools-section" id="tools">
            <h2 class="section-title" style="color: var(--color-zen-white);">Discover Your Energy</h2>
            <p class="section-subtitle" style="color: rgba(255,255,255,0.9);">Find your personal Kua Number to unlock your best directions.</p>

            <div class="tool-card">
                <h3>Find Your Kua Number</h3>
                <div class="kua-calculator-form">
                    <input type="number" id="kua-year" class="tool-input" placeholder="Enter Birth Year (e.g., 1985)" min="1900" max="2025">
                    <select id="kua-gender" class="tool-input">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <button id="calculate-kua" class="cta-primary" style="width: 100%; margin-top: 10px;">Calculate Now</button>
                </div>
                <div id="kua-result" class="tool-result">
                    <h4>Your Kua Number is: <span id="kua-number-display" class="text-gold" style="font-size: 2rem;"></span></h4>
                    <p id="kua-description"></p>
                </div>
            </div>
        </section>

        <!-- WISDOM HUB - Production-Ready Blog Posts -->
        <section class="wisdom-hub-grid" id="blog">
            <div class="container" style="display: block; max-width: 1200px;">
                <h2 class="section-title">Wisdom Hub</h2>
                <p class="section-subtitle">Expert insights for a balanced life.</p>

                <div class="blog-posts-grid">
                    <!-- Blog 1 -->
                    <article class="blog-card">
                        <div class="blog-card-image">
                            <!-- Placeholder image or generic bedroom image -->
                            <div style="background: var(--color-warm-sand); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3rem;">🛏️</div>
                            <span class="category-badge">Relationships</span>
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title"><a href="#">The Secret to a Happy Marriage? Check Your Bedroom Mirror.</a></h3>
                            <p class="blog-card-excerpt">
                                Are you experiencing unexplained distances or frequent arguments with your spouse? While relationship dynamics are complex, Vastu Shastra suggests that the physical layout of your bedroom plays a silent but powerful role in your domestic harmony.
                            </p>
                            <p><strong>The "Sensitive" Vastu of Relationships:</strong> According to Vastu expert Sanjay Jain, husband-wife relationships are becoming increasingly delicate. One of the biggest "silent killers" of peace in the bedroom is the improper placement of mirrors.</p>
                            <a href="#" class="read-more-link">Read Full Article →</a>
                        </div>
                    </article>

                    <!-- Blog 2 -->
                    <article class="blog-card">
                        <div class="blog-card-image">
                            <!-- Placeholder image or generic construction image -->
                            <div style="background: var(--color-deep-indigo); width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 3rem;">🏗️</div>
                            <span class="category-badge">Career Growth</span>
                        </div>
                        <div class="blog-card-content">
                            <h3 class="blog-card-title"><a href="#">Boosting Your Career & Growth: The Vastu Height Protocol</a></h3>
                            <p class="blog-card-excerpt">
                                Is Your House Height Blocking Your Success? In the world of business and career, "growth" isn't just about hard work—it’s about the energy balance of the space you occupy.
                            </p>
                            <p><strong>The Height Hierarchy:</strong> North-East (Lowest) → North-West → South-East → South-West (Highest). If your NE is higher than SW, it's a "Growth Killer".</p>
                            <a href="#" class="read-more-link">Read Full Article →</a>
                        </div>
                    </article>
                </div>
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

        <!-- ABOUT SANJAY JAIN SECTION -->
        <section class="about-sanjay-section">
            <div class="about-container">
                <div class="about-content">
                    <h2 class="section-title">About Sanjay Jain</h2>
                    <div class="about-text">
                        <p class="about-intro">
                            With a legacy spanning over 25 years, Sanjay Jain has become a global pioneer in Remote Scientific Vastu.
                        </p>
                        <p>
                            Having served over 10,000 families and businesses across continents, his approach is unique: it combines the ancient spiritual laws of Vastu Shastra with modern architectural precision. By utilizing satellite mapping and AutoCAD analysis, Sanjay provides 100% accurate remedies that require zero demolition, making him the trusted choice for the modern, high-end homeowner.
                        </p>
                        <p>
                            What began as a personal journey to bridge ancient wisdom with contemporary living has evolved into a pioneering practice that transforms lives. Sanjay's philosophy is elegantly simple yet profoundly effective: <strong>your space should work for you, not against you.</strong>
                        </p>
                        <p>
                            Whether it's a home struggling with persistent health challenges, a business facing stagnant growth, or relationships needing deeper harmony, Sanjay's remedies are scientifically precise, non-invasive, and remarkably transformative. From Mumbai boardrooms to Sydney suburbs, from Dubai high-rises to New York apartments, he has helped families and entrepreneurs unlock prosperity, wellness, and peace—all through the power of aligned energy and time-tested wisdom adapted for the 21st century.
                        </p>
                    </div>
                    <div class="about-cta">
                        <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                           class="cta-primary ripple-effect" 
                           target="_blank" 
                           rel="noopener noreferrer">
                            📱 Chat with Sanjay Jain on WhatsApp
                        </a>
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

        <!-- RESULTS GALLERY - Trust & Proliferation Engine -->
        <section class="results-gallery-section">
            <h2 class="section-title">Results Gallery</h2>
            <p class="section-subtitle">Real transformations. Measured outcomes. Zero demolition.</p>
            
            <div class="results-grid">
                <div class="glass-card results-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="result-icon water-element">💧</div>
                    <div class="result-content">
                        <div class="result-challenge">
                            <h4>Challenge</h4>
                            <p>Declining Profits in Manufacturing Unit</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-solution">
                            <h4>Remedial Solution</h4>
                            <p>Water Element Activation in North Zone</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-outcome">
                            <h4>Pioneer Outcome</h4>
                            <p class="outcome-metric">20% Revenue Growth</p>
                            <span class="outcome-timeline">Within 4 Months</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card results-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="result-icon fire-element">🔥</div>
                    <div class="result-content">
                        <div class="result-challenge">
                            <h4>Challenge</h4>
                            <p>Stagnant Sales & Low Customer Footfall</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-solution">
                            <h4>Remedial Solution</h4>
                            <p>Fire Element Enhancement in South-East</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-outcome">
                            <h4>Pioneer Outcome</h4>
                            <p class="outcome-metric">35% Sales Increase</p>
                            <span class="outcome-timeline">Within 3 Months</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card results-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="result-icon earth-element">🌱</div>
                    <div class="result-content">
                        <div class="result-challenge">
                            <h4>Challenge</h4>
                            <p>Family Health Issues & Constant Medical Bills</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-solution">
                            <h4>Remedial Solution</h4>
                            <p>Earth Element Balance in Center & SW</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-outcome">
                            <h4>Pioneer Outcome</h4>
                            <p class="outcome-metric">85% Health Improvement</p>
                            <span class="outcome-timeline">Within 6 Months</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card results-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="result-icon metal-element">⚡</div>
                    <div class="result-content">
                        <div class="result-challenge">
                            <h4>Challenge</h4>
                            <p>Career Stagnation & Delayed Promotions</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-solution">
                            <h4>Remedial Solution</h4>
                            <p>Metal Strip Placement in North-West</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-outcome">
                            <h4>Pioneer Outcome</h4>
                            <p class="outcome-metric">Job Promotion Received</p>
                            <span class="outcome-timeline">Within 2 Months</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card results-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="result-icon space-element">🌟</div>
                    <div class="result-content">
                        <div class="result-challenge">
                            <h4>Challenge</h4>
                            <p>Relationship Discord & Family Conflicts</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-solution">
                            <h4>Remedial Solution</h4>
                            <p>Space Element Optimization & Color Therapy</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-outcome">
                            <h4>Pioneer Outcome</h4>
                            <p class="outcome-metric">Restored Family Harmony</p>
                            <span class="outcome-timeline">Within 5 Months</span>
                        </div>
                    </div>
                </div>

                <div class="glass-card results-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="result-icon wood-element">🍃</div>
                    <div class="result-content">
                        <div class="result-challenge">
                            <h4>Challenge</h4>
                            <p>Business Losses & Cash Flow Problems</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-solution">
                            <h4>Remedial Solution</h4>
                            <p>Wood Element Activation in East Zone</p>
                        </div>
                        <div class="result-divider"></div>
                        <div class="result-outcome">
                            <h4>Pioneer Outcome</h4>
                            <p class="outcome-metric">300% Profit Growth</p>
                            <span class="outcome-timeline">Within 6 Months</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="results-cta">
                <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                   class="cta-primary ripple-effect" 
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Chat with Sanjay Jain on WhatsApp
                </a>
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
                <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20my%20space." 
                   class="cta-primary ripple-effect" 
                   style="background: var(--color-warm-sand); color: var(--color-deep-indigo);"
                   target="_blank" 
                   rel="noopener noreferrer">
                    📱 Chat with Sanjay Jain on WhatsApp
                </a>
            </div>
        </section>

    </main>
</div>

<?php
get_footer();
