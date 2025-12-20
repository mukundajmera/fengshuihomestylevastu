# Feng Shui Homestyle Vastu - WordPress Child Theme

A pioneer-level 2025 "Digital Zen" website for Feng Shui Homestyle Vastu by Sanjay Jain, featuring a modern, biophilic design system that blends ancient Vastu Shastra wisdom with cutting-edge web technologies.

## Overview

**Brand Promise:** Scientific Vastu: Harmony without Demolition

This WordPress child theme is built on the Astra framework and implements a comprehensive design system specifically crafted for the spiritual wellness and architectural science industries.

## Features

### Design System - "Digital Zen"

#### 🎨 Biophilic Color Palette
- **Warm Sand** (#F5EAE1) - Primary background for earth-grounded feel
- **Sage Green** (#648E7B) - Primary accent for growth and vitality
- **Deep Indigo** (#2E2B59) - CTA color for stability and trust
- **Earth Brown** (#8B7355) - Supporting accent
- **Soft Cream** (#FFF8F0) - Highlight color

#### ✍️ Typography System
- **Headings:** Cinzel (Serif) - Ancient wisdom and authority
- **Body:** Lato (Sans-serif) - Modern approachability
- Fluid typography using CSS clamp() for responsive scaling

#### 🎭 UI Effects
- **Glassmorphism:** Semi-transparent cards with backdrop blur
- **Micro-interactions:** Ripple effects, fade-ins, hover animations
- **Smooth transitions:** CSS cubic-bezier easing
- **Parallax effects:** Subtle video background movement

### Homepage Sections

1. **Hero Section** - "The Energy Foyer"
   - Large cinematic static image background (serene living space with natural light)
   - Compelling headline: "Harmonize Your Space, Transform Your Life."
   - Sub-headline with 25+ years expertise highlight
   - Prominent WhatsApp CTA button
   - Optimized for "Quiet Luxury" 2025 wellness aesthetic

2. **Residential Solutions** - Interactive Grid
   - Three focused life solutions with high-resolution lifestyle images
   - **Health & Vitality:** Vibrant kitchen imagery, energy block solutions
   - **Relationships & Rest:** Peaceful bedroom design for harmony
   - **Prosperity & Flow:** Minimalist entrance optimization for wealth
   - Glassmorphism cards with image overlays
   - Individual CTAs for each solution

3. **Commercial Growth** - Business Scaling
   - Professional section for offices, retail, and factories
   - Focus on "Scaling Business without Disruption or Demolition"
   - Three service cards with feature lists
   - Dark indigo background for authority and contrast
   - Dedicated commercial consultation CTA

4. **Social Proof & Legacy** - Trust Markers
   - Horizontal strip with key statistics
   - "25+ Years of Expert Guidance"
   - "10,000+ Success Stories"  
   - "Global Remote Precision"
   - Glassmorphism effect on sage green background
   - Astro-Vastu services

5. **Testimonials Section** - Success Stories
   - Client testimonials with glassmorphism cards
   - Real results from satisfied clients
   - Social proof from diverse locations (Mumbai, Bangalore, USA)

6. **Final CTA Section** - Conversion Focus
   - Gradient background (Deep Indigo to Sage Green)
   - Clear value proposition
   - Strong call-to-action to book consultation

### Mobile-First Design

- **Thumb Zone Navigation:** Bottom-centered sticky WhatsApp button (15px from bottom, centered)
- **Responsive Typography:** Fluid scaling with CSS clamp()
- **Touch-Optimized:** Large tap targets (44px minimum), touch feedback
- **Mobile Breakpoints:** Optimized for 768px and below
- **Sticky CTA:** Full-width button (max 320px) positioned for easy thumb access
- **Performance Target:** LCP < 2.5 seconds

### Imagery Standards

Following "Quiet Luxury" 2025 wellness aesthetic:
- **High-Resolution:** Minimum 1920x1080 for hero, 800x600 for cards
- **Style:** Natural morning light, serene indoor plants, high-end modern architecture
- **Avoid:** Generic clipart spiritual icons, overly staged photos
- **Color Harmony:** Images complement biophilic color palette
- **Format:** WebP with JPG fallback, optimized < 500KB each
- **See:** `assets/images/IMAGE-REQUIREMENTS.md` for detailed specifications

### Performance Optimizations

- Lazy-loading for images and videos
- Font preconnection
- Debounced scroll events
- Removal of WordPress bloat (emoji scripts, etc.)
- Critical CSS inlining
- Deferred JavaScript loading

## Installation

1. **Prerequisites:**
   - WordPress 5.3 or higher
   - Astra theme installed and activated
   - PHP 5.3 or higher

2. **Installation Steps:**
   ```bash
   # Navigate to your WordPress themes directory
   cd wp-content/themes/

   # The theme is already in place as 'fengshuihomestyle-vastu'
   ```

3. **Activation:**
   - Go to WordPress Admin → Appearance → Themes
   - Activate "Feng Shui Homestyle Vastu" theme

4. **Configuration:**
   - Set a static front page: Settings → Reading → Front page displays → A static page → Select "Home"
   - Update WhatsApp phone number in `functions.php` if needed (default: +919810143516)

## File Structure

```
fengshuihomestyle-vastu/
├── style.css                    # Main stylesheet with Digital Zen design system
├── functions.php                # Theme functions and WordPress hooks
├── front-page.php               # Homepage template with new sections
├── demo-preview.html            # Standalone demo (open in browser)
├── demo-preview-backup.html     # Previous version backup
├── README.md                    # This file
├── ELEMENTOR-GUIDE.md          # Complete Elementor implementation guide
├── SITEMAP.md                  # Detailed website architecture
├── assets/
│   ├── css/                    # Additional stylesheets (if needed)
│   ├── js/
│   │   └── custom.js           # Custom JavaScript for interactions
│   └── images/
│       ├── IMAGE-REQUIREMENTS.md    # Detailed image specifications
│       ├── VIDEO-INSTRUCTIONS.md    # Video requirements (legacy)
│       ├── hero-serene-living-space.jpg     # Hero section (to be added)
│       ├── vibrant-kitchen.jpg              # Health & Vitality card (to be added)
│       ├── peaceful-bedroom.jpg             # Relationships & Rest card (to be added)
│       └── minimalist-entrance.jpg          # Prosperity & Flow card (to be added)
└── template-parts/             # Reusable template components (future use)
```

## Customization

### Changing Colors

Edit CSS custom properties in `style.css`:

```css
:root {
    --color-warm-sand: #F5EAE1;
    --color-sage-green: #648E7B;
    --color-deep-indigo: #2E2B59;
    /* ... modify as needed */
}
```

### Updating Content

1. **Hero Section:** Edit `front-page.php` lines 30-65
2. **Services:** Edit `front-page.php` lines 125-285
3. **Testimonials:** Edit `front-page.php` lines 290-315

### WhatsApp Integration

Update phone number in `functions.php`:

```php
$phone_number = '+919810143516'; // Change to your number
```

### Adding Video Background

1. Add your video file to `/assets/images/hero-video.mp4`
2. Recommended specs:
   - Format: MP4 (H.264 codec)
   - Resolution: 1920x1080
   - Duration: 10-30 seconds (looping)
   - File size: < 500KB (optimized)

## JavaScript Functionality

### Tab System
- Automatic activation of first tab
- Smooth transitions between tabs
- Keyboard accessible (Enter/Space keys)

### Animations
- Fade-in on scroll for cards
- Counter animation for trust markers
- Ripple effects on buttons
- Parallax video background

### Performance Features
- Debounced scroll handlers
- Intersection Observer for lazy loading
- Touch feedback for mobile devices

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

Graceful degradation for older browsers.

## Accessibility

- WCAG 2.1 Level AA compliant
- Keyboard navigation support
- Sufficient color contrast
- Screen reader friendly
- Reduced motion support for users with vestibular disorders

## SEO Features

- Custom meta tags for homepage
- Schema markup (inherited from Astra)
- Semantic HTML5 structure
- Optimized page titles and descriptions
- Fast loading times

## Support

For questions or customization requests, contact:
- Email: info@fengshuihomestylevastu.com
- WhatsApp: +919810143516

## Credits

- **Design & Development:** Based on the "Pioneer 2025 Website Master Blueprint"
- **Parent Theme:** Astra by Brainstorm Force
- **Fonts:** Google Fonts (Cinzel, Lato)
- **Framework:** WordPress

## License

This theme is licensed under the GNU General Public License v2 or later.

## Changelog

### Version 1.0.0 - December 2024
- Initial release
- Complete Digital Zen design system implementation
- Hero section with video background
- Scientific Vastu methodology section
- Tabbed services section
- Testimonials section
- Mobile-first responsive design
- Performance optimizations
- WhatsApp integration
- Comprehensive documentation

## Future Roadmap

- [ ] Add screenshot.png for theme preview
- [ ] Create additional page templates (About, Services, Contact)
- [ ] Implement blog post styling
- [ ] Add interactive energy map tool
- [ ] Create video testimonials gallery
- [ ] Implement multi-language support (Hindi, English)
- [ ] Add appointment booking system
- [ ] Create client portal for reports

---

**Version:** 1.0.0  
**Last Updated:** December 2024  
**Status:** Production Ready
