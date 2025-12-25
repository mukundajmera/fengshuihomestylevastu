# Quick Fix Implementation Guide

This document provides code snippets that can be directly copy-pasted to fix common issues found during the audit.

## 1. Critical Meta Tags (Add to wp_head)

```php
/**
 * Add critical meta tags for SEO and social sharing
 */
function vastu_add_critical_meta_tags() {
    // Viewport
    echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">' . "\n";
    
    // Robots
    echo '<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">' . "\n";
    
    // Canonical
    $canonical_url = is_front_page() ? home_url('/') : get_permalink();
    echo '<link rel="canonical" href="' . esc_url($canonical_url) . '">' . "\n";
    
    // Open Graph for front page
    if (is_front_page()) {
        $og_image = get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg';
        echo '<meta property="og:title" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(get_bloginfo('description')) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">' . "\n";
        echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
    }
}
add_action('wp_head', 'vastu_add_critical_meta_tags', 1);
```

## 2. Preload LCP Images

```php
/**
 * Preload hero images for better LCP
 */
function vastu_preload_lcp_images() {
    if (is_front_page()) {
        $hero_image = get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.webp';
        echo '<link rel="preload" as="image" href="' . esc_url($hero_image) . '" fetchpriority="high">' . "\n";
    }
}
add_action('wp_head', 'vastu_preload_lcp_images', 2);
```

## 3. Add Vary: User-Agent Header

```php
/**
 * Add Vary: User-Agent header for proper mobile/desktop caching
 */
function vastu_add_vary_header() {
    if (!is_admin()) {
        header('Vary: User-Agent');
    }
}
add_action('send_headers', 'vastu_add_vary_header');
```

## 4. Prevent Horizontal Scroll (CSS)

```css
/* Add to style.css */
html {
    overflow-x: hidden;
}

body {
    overflow-x: hidden;
}

/* For grid/flex containers */
.bento-grid,
.content-container {
    overflow-x: hidden;
    max-width: 100%;
}
```

## 5. CLS Prevention with Aspect Ratio

```css
/* Add aspect-ratio to prevent layout shift */
.hero-image-bg {
    aspect-ratio: 16 / 9;
}

.hero-mobile-aspect {
    aspect-ratio: 9 / 16;
}

.card-image {
    aspect-ratio: 4 / 3;
}
```

## 6. Kua Calculator Error Handling (JavaScript)

```javascript
$('#calculate-kua').on('click', function(e) {
    e.preventDefault();
    var yearInput = $('#kua-year').val();
    var year = parseInt(yearInput);
    
    // Validation
    if (!yearInput || yearInput.trim() === '') {
        alert("Please enter your birth year.");
        $('#kua-year').focus();
        return;
    }
    
    if (isNaN(year)) {
        alert("Please enter a valid numeric year (e.g., 1985).");
        $('#kua-year').val('').focus();
        return;
    }
    
    if (year < 1900 || year > 2025) {
        alert("Please enter a valid birth year between 1900 and 2025.");
        $('#kua-year').focus();
        return;
    }
    
    // Continue with calculation...
});
```

## 7. Touch Target Minimum Height

```css
/* Ensure all interactive elements meet 44px minimum (iOS) */
.cta-primary,
.btn,
button,
input,
select,
.touch-target {
    min-height: 48px; /* 4px safety margin */
    min-width: 48px;
}
```

## 8. Dequeue Unused WordPress Assets

```php
/**
 * Remove unnecessary WordPress default assets
 */
function vastu_dequeue_unused_assets() {
    // Remove Block Library CSS
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    
    // Remove Global Styles
    wp_dequeue_style('global-styles');
    
    // Remove Classic Theme Styles
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'vastu_dequeue_unused_assets', 100);
```

## 9. Defer Non-Critical JavaScript

```php
/**
 * Add defer attribute to scripts
 */
function vastu_defer_scripts($tag, $handle, $src) {
    $defer_scripts = [
        'vastu-compass',
        'kua-calculator',
        'analytics',
    ];
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src=', ' defer src=', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'vastu_defer_scripts', 10, 3);
```

## 10. Alt Text Helper Function

```php
/**
 * Generate context-aware alt text for images
 */
function vastu_get_alt_text($context = 'default') {
    $alt_texts = [
        'hero' => 'Serene living space designed with Vastu principles',
        'kitchen' => 'Kitchen aligned with Vastu Fire element',
        'bedroom' => 'Peaceful bedroom with Vastu balance',
        'office' => 'Office space optimized for productivity',
        'default' => 'Vastu harmonized space',
    ];
    
    return esc_attr($alt_texts[$context] ?? $alt_texts['default']);
}
```

## Testing Commands

### Check if viewport meta tag exists:
```bash
curl -s https://yoursite.com | grep -i viewport
```

### Check for Vary header:
```bash
curl -I https://yoursite.com | grep -i vary
```

### Validate Schema.org markup:
```bash
# Visit: https://validator.schema.org/
# Or use Google Rich Results Test
```

### Check Core Web Vitals:
```bash
# Visit: https://pagespeed.web.dev/
# Test URL: https://yoursite.com
```

## Deployment Checklist

- [ ] Meta tags added to `<head>`
- [ ] Preload links for LCP images
- [ ] Vary: User-Agent header active
- [ ] Overflow-x: hidden on html/body
- [ ] Aspect-ratio added to images
- [ ] Touch targets meet 48px minimum
- [ ] Unused assets dequeued
- [ ] Scripts deferred appropriately
- [ ] Error handling in forms
- [ ] All escaping functions used
- [ ] Test on mobile device
- [ ] Test on 320px width
- [ ] Validate schema markup
- [ ] Check PageSpeed score

## Performance Monitoring

After deployment, monitor these metrics:

1. **Google Search Console** - Core Web Vitals report
2. **PageSpeed Insights** - Score and recommendations
3. **Google Analytics** - Mobile bounce rate
4. **WhatsApp Conversions** - Track CTA clicks

## Support

If you encounter issues:
1. Check browser console for JavaScript errors
2. Validate HTML with W3C Validator
3. Test responsive design with Chrome DevTools
4. Clear caching plugins and CDN cache
5. Test on real mobile devices

---
**Last Updated:** December 25, 2024  
**Version:** 1.0.0
