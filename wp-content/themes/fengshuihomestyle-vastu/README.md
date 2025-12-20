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
   - Full-screen video background (flowing water/nature)
   - Compelling headline and sub-headline
   - Sticky WhatsApp CTA button
   - Trust markers strip

2. **Methodology Section** - "Scientific Vastu"
   - True North Satellite Mapping explanation
   - AutoCAD Floor Plan Analysis details
   - Zero Demolition Solutions showcase
   - Before/After energy diagram visualization

3. **Services Section** - "The Solution Menu"
   - Tabbed interface for easy navigation
   - Residential Harmony services
   - Commercial Success services
   - Astro-Vastu services

4. **Testimonials Section**
   - Social proof from satisfied clients
   - Glassmorphism cards

5. **Final CTA Section**
   - Gradient background
   - Clear call-to-action

### Mobile-First Design

- **Thumb Zone Navigation:** Bottom-centered controls
- **Responsive Typography:** Fluid scaling
- **Touch-Optimized:** Large tap targets, touch feedback
- **Performance Target:** LCP < 2.5 seconds

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
├── style.css              # Main stylesheet with Digital Zen design system
├── functions.php          # Theme functions and WordPress hooks
├── front-page.php         # Homepage template
├── screenshot.png         # Theme screenshot (to be added)
├── SITEMAP.md            # Detailed website architecture documentation
├── README.md             # This file
├── assets/
│   ├── css/              # Additional stylesheets (if needed)
│   ├── js/
│   │   └── custom.js     # Custom JavaScript for interactions
│   └── images/
│       └── hero-video.mp4 # Hero section background video (to be added)
└── template-parts/       # Reusable template components (future use)
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
