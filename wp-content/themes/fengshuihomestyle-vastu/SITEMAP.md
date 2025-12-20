# Feng Shui Homestyle Vastu - Website Sitemap & Architecture
## Pioneer 2025 Digital Zen Website Blueprint

---

## SITEMAP STRUCTURE

### Primary Navigation
1. **Home** (front-page.php)
   - Hero Section
   - Methodology
   - Services
   - Testimonials
   - CTA Section

2. **About Sanjay Jain**
   - 25+ Years Experience
   - Credentials & Certifications
   - Philosophy & Approach
   - Media Features

3. **Services**
   - Residential Vastu
   - Commercial Vastu
   - Astro-Vastu
   - Remote Consultations
   - Pricing & Packages

4. **Methodology**
   - Scientific Approach
   - Satellite Mapping Process
   - AutoCAD Analysis
   - Case Studies

5. **Resources**
   - Blog Articles
   - Vastu Tips
   - Video Tutorials
   - FAQs
   - Free Consultation Checklist

6. **Testimonials**
   - Client Success Stories
   - Video Testimonials
   - Before & After Gallery

7. **Contact**
   - WhatsApp Consultation Booking
   - Email Contact Form
   - Phone Support
   - Office Locations

---

## PAGE ARCHITECTURE - HOMEPAGE (front-page.php)

### Section 1: HERO SECTION - "The Energy Foyer"
**Purpose:** First impression, brand positioning, immediate conversion

**Components:**
- **Background:** Slow-motion video (flowing water/wind-swept leaves)
  - File format: MP4 (H.264), WebM fallback
  - Dimensions: 1920x1080
  - Optimized for <500KB
  - Auto-play, muted, loop, playsinline attributes

- **Headline:** 
  - Text: "Harmonize Your Space, Transform Your Life"
  - Font: Cinzel, 700 weight
  - Size: clamp(2.5rem, 6vw, 4.5rem)
  - Color: Deep Indigo (#2E2B59)

- **Sub-headline:**
  - Text: "Scientific Vastu & Feng Shui Consultations. 100% Remote. 0% Demolition. Over 25 years of expert guidance by Sanjay Jain."
  - Font: Lato, 300 weight
  - Size: clamp(1.1rem, 2vw, 1.5rem)
  - Color: Earth Brown (#8B7355)

- **Primary CTA:**
  - Text: "📱 Book Your WhatsApp Audit"
  - Style: Sticky button (fixed position)
  - Action: WhatsApp link with pre-filled message
  - Phone: +919810143516

- **Trust Markers Strip:**
  - "Trusted by 10,000+ Families"
  - "Global Remote Consultations"
  - "25+ Years Experience"
  - Style: Glassmorphism card with backdrop-filter

**Technical Specs:**
- Min-height: 100vh
- Display: Flexbox centered
- Mobile: min-height 90vh
- Performance: Lazy-load video with IntersectionObserver

---

### Section 2: METHODOLOGY - "Scientific Vastu"
**Purpose:** Establish credibility, explain the 2025 approach

**Components:**
- **Section Title:**
  - "Scientific Vastu: The 2025 Approach"
  - Font: Cinzel, centered
  - Size: clamp(2rem, 4vw, 3.5rem)

- **3-Column Grid:**
  1. **True North Satellite Mapping**
     - Icon: 🛰️
     - Description: Google Earth satellite imagery usage
     - Card style: Glassmorphism

  2. **AutoCAD Floor Plan Analysis**
     - Icon: 📐
     - Description: Millimeter precision analysis
     - Card style: Glassmorphism

  3. **Zero Demolition Solutions**
     - Icon: 🏡
     - Description: Spatial alignment focus
     - Card style: Glassmorphism

- **Before & After Energy Diagram:**
  - Grid layout: 2 columns
  - Visual representation: Color gradients
  - Before: Red gradient (blocked energy)
  - After: Green gradient (harmonized flow)
  - Container: White background, rounded corners, shadow

**Technical Specs:**
- Padding: 4rem vertical
- Background: Soft Cream (#FFF8F0)
- Grid: auto-fit, minmax(300px, 1fr)
- Cards: Fade-in on scroll with IntersectionObserver

---

### Section 3: SERVICES - "The Solution Menu"
**Purpose:** Showcase service offerings with tabbed navigation

**Components:**
- **Tab Navigation:**
  - 3 Tabs: Residential Harmony, Commercial Success, Astro-Vastu
  - Style: Pill-shaped buttons with Sage Green accent
  - Active state: Filled background
  - Hover: Scale(1.05) transform

- **Tab Content 1: Residential Harmony**
  - Health & Wellness (North-East)
  - Wealth & Prosperity (South-East)
  - Relationships & Harmony (South-West)
  - Education & Growth (West)

- **Tab Content 2: Commercial Success**
  - Office Productivity
  - Retail Growth
  - Industrial Vastu
  - Hospitality Excellence

- **Tab Content 3: Astro-Vastu**
  - Personal Energy Blueprint
  - Planetary Remedies
  - Timing & Muhurat
  - Holistic Transformation

**Technical Specs:**
- JavaScript: jQuery-based tab switching
- Grid: auto-fit, minmax(280px, 1fr)
- Cards: Glassmorphism with hover effects
- Animation: fadeIn transition on tab change

---

### Section 4: TESTIMONIALS
**Purpose:** Social proof, build trust

**Components:**
- 3-Column Grid of Client Stories
- Each card includes:
  - Quote (italic text)
  - Client name and location
  - Style: Glassmorphism cards

**Technical Specs:**
- Background: Warm Sand (#F5EAE1)
- Grid: 3 columns on desktop, 1 on mobile
- Cards: Fade-in on scroll

---

### Section 5: FINAL CTA
**Purpose:** Final conversion opportunity

**Components:**
- Full-width section
- Gradient background: Indigo to Sage Green
- Headline: "Ready to Transform Your Space?"
- Sub-text: Service USPs
- CTA Button: "Start Your Journey Now"
- WhatsApp link

**Technical Specs:**
- Min-height: 60vh
- Text color: White for contrast
- Button: Inverted colors (Sand bg, Indigo text)

---

## MOBILE-FIRST DESIGN SPECIFICATIONS

### Responsive Breakpoints:
- **Mobile:** 0-768px
- **Tablet:** 769-1024px
- **Desktop:** 1025px+

### Thumb Zone Optimization:
- Primary navigation: Bottom 25% of screen
- CTA buttons: Center-bottom on mobile
- WhatsApp widget: Fixed bottom-center
- Font sizes: Fluid typography with clamp()

### Mobile Performance:
- **LCP Target:** < 2.5 seconds
- **Optimizations:**
  - Preconnect to Google Fonts
  - Lazy-load video backgrounds
  - Debounced scroll events
  - Remove emoji scripts
  - Critical CSS inlined
  - Defer non-critical JavaScript

---

## FILE STRUCTURE

```
fengshuihomestyle-vastu/
├── style.css                 # Main stylesheet with Digital Zen system
├── functions.php             # Theme functionality & enqueues
├── front-page.php            # Homepage template
├── screenshot.png            # Theme screenshot (1200x900)
├── assets/
│   ├── css/
│   │   └── (additional styles if needed)
│   ├── js/
│   │   └── custom.js         # Micro-interactions & tabs
│   └── images/
│       ├── hero-video.mp4    # Hero background video
│       └── (other assets)
└── template-parts/
    └── (reusable components)
```

---

## DESIGN SYSTEM REFERENCE

### Color Palette:
- **Primary Background:** #F5EAE1 (Warm Sand)
- **Primary Accent:** #648E7B (Sage Green)
- **CTA/Stability:** #2E2B59 (Deep Indigo)
- **Secondary:** #8B7355 (Earth Brown)
- **Highlights:** #FFF8F0 (Soft Cream)
- **Base:** #FFFFFF (Zen White)

### Typography Scale:
- **H1:** clamp(2.5rem, 5vw, 4rem) - Cinzel Bold
- **H2:** clamp(2rem, 4vw, 3rem) - Cinzel SemiBold
- **H3:** clamp(1.5rem, 3vw, 2rem) - Cinzel SemiBold
- **Body:** 16px base - Lato Regular
- **Small:** 14px - Lato Light

### Spacing System:
- **xs:** 0.5rem (8px)
- **sm:** 1rem (16px)
- **md:** 2rem (32px)
- **lg:** 3rem (48px)
- **xl:** 4rem (64px)

### Effects:
- **Glassmorphism:** backdrop-filter: blur(10px)
- **Shadows:** 0 8px 32px rgba(46, 43, 89, 0.1)
- **Transitions:** cubic-bezier(0.4, 0, 0.2, 1)
- **Animations:** fadeInUp, fadeIn, pulse, ripple

---

## TECHNICAL IMPLEMENTATION NOTES

### WordPress Integration:
- Child theme of Astra
- Inherits Astra's performance optimizations
- Custom templates override parent
- Hooks into Astra theme filters

### Performance:
- Font preconnect headers
- Lazy-loading for images and videos
- Debounced scroll handlers
- Minimal DOM manipulation
- CSS-first animations
- Remove WordPress bloat (emoji scripts, etc.)

### SEO:
- Custom meta tags for homepage
- Schema markup inherited from Astra
- Semantic HTML5 structure
- Alt texts for all images
- Proper heading hierarchy

### Accessibility:
- Keyboard navigation support
- ARIA labels where needed
- Sufficient color contrast (WCAG AA)
- Focus indicators
- Reduced motion support
- Screen reader text for icons

### Browser Support:
- Modern browsers (Chrome, Firefox, Safari, Edge)
- Graceful degradation for older browsers
- Autoprefixer for CSS compatibility
- Polyfills not needed for target audience

---

## CONVERSION OPTIMIZATION

### CTA Strategy:
1. **Primary CTA:** Hero section - immediate visibility
2. **Sticky CTA:** Fixed WhatsApp button - always accessible
3. **Mid-page CTA:** After methodology - informed decision
4. **Final CTA:** End of page - last chance conversion

### Trust Building:
- Quantified social proof (10,000+ families)
- Years of experience (25+)
- Global reach messaging
- No demolition USP reinforcement
- Scientific approach emphasis

### User Journey:
1. **Awareness:** Hero captures attention
2. **Interest:** Methodology builds credibility
3. **Consideration:** Services explain options
4. **Social Proof:** Testimonials validate
5. **Action:** Final CTA converts

---

## FUTURE ENHANCEMENTS

### Phase 2 (Optional):
- Interactive energy map tool
- Virtual consultation booking system
- Blog with Vastu tips
- Video testimonials gallery
- Multi-language support (Hindi, English)
- Live chat integration
- Email newsletter signup
- Client portal for reports

### Analytics Tracking:
- Google Analytics 4
- Conversion tracking for WhatsApp clicks
- Scroll depth tracking
- Video engagement metrics
- A/B testing framework

---

**Document Version:** 1.0.0  
**Last Updated:** December 2024  
**Blueprint Status:** Complete - Ready for Implementation
