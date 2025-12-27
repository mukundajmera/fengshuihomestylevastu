# WordPress Theme Implementation Guide
## Feng Shui Homestyle Vastu - Multi-Page Architecture

This document provides comprehensive guidance on using and managing the Feng Shui Homestyle Vastu WordPress theme.

## 📋 Table of Contents
- [Theme Structure](#theme-structure)
- [Template Files](#template-files)
- [Custom Post Types](#custom-post-types)
- [Navigation Menus](#navigation-menus)
- [Image Optimization](#image-optimization)
- [Responsive Design](#responsive-design)
- [SEO Features](#seo-features)
- [Maintenance](#maintenance)

## 🏗️ Theme Structure

This is a **child theme** of Astra, which provides the foundation while allowing customization without affecting the parent theme.

```
fengshuihomestyle-vastu/
├── assets/
│   ├── images/          # Theme images
│   └── js/              # Custom JavaScript files
├── inc/
│   └── seo-schema.php   # SEO and Schema markup
├── parts/
│   ├── compass-overlay.php
│   ├── hero-section.php
│   └── wisdom-gallery.php
├── functions.php        # Theme functions and hooks
├── style.css            # Main stylesheet
├── front-page.php       # Homepage template
├── page.php             # Generic page template
├── single.php           # Blog post template
├── single-service.php   # Service post template
├── archive.php          # Blog archive template
├── search.php           # Search results template
├── 404.php              # Error page template
└── index.php            # Fallback template
```

## 📄 Template Files

### Front Page (Homepage)
**File:** `front-page.php`
- Main landing page with hero section
- Services showcase
- Testimonials
- Call-to-action sections

### Generic Pages
**File:** `page.php`
- Used for: About, Contact, Services pages
- Simple content layout
- Full-width or container-based

### Blog Posts
**File:** `single.php`
- Individual blog post display
- Related posts section
- Social sharing integration
- WhatsApp CTA integration

### Services
**File:** `single-service.php`
- Individual service page
- Benefits section
- Related services
- Conversion-optimized CTAs

### Blog Archive
**File:** `archive.php`
- Blog listing page
- Category filtering
- Pagination
- Sidebar with lead magnets

### Search Results
**File:** `search.php`
- Search results display
- No results fallback
- Alternative suggestions

### 404 Error Page
**File:** `404.php`
- Custom error page
- Popular pages links
- Search functionality
- WhatsApp support link

### Main Fallback
**File:** `index.php`
- WordPress required fallback template
- Used when no specific template matches

## 🔧 Custom Post Types

### Services CPT
**Slug:** `service`
**URL Structure:** `/services/service-name/`

#### Creating a Service:
1. Go to WordPress Admin → Services → Add New Service
2. Enter service title and description
3. Add featured image (recommended: 600×400px)
4. Use custom fields for:
   - `service_benefits` (one benefit per line)
   - `service_price` (optional)
   - `service_duration` (optional)

#### Service Benefits Example:
```
Enhanced productivity and focus
Improved team collaboration
Better decision-making environment
Optimized energy flow
```

### Testimonials CPT
**Slug:** `testimonial`

#### Creating a Testimonial:
1. Go to WordPress Admin → Testimonials → Add New Testimonial
2. Title: Client name and location (e.g., "John Smith - New York")
3. Content: Full testimonial text
4. Featured Image: Client photo (optional, recommended: 300×300px)

## 🧭 Navigation Menus

### Menu Locations
The theme supports three menu locations:

1. **Primary Menu** (`primary`)
   - Main header navigation
   - Displayed on desktop and tablet
   - Full horizontal menu

2. **Footer Menu** (`footer`)
   - Footer navigation links
   - Typically: About, Contact, Privacy Policy, Terms

3. **Mobile Menu** (`mobile-menu`)
   - Mobile-specific navigation
   - Hamburger menu icon
   - Responsive walker for mobile optimization

### Setting Up Menus

#### Via WordPress Admin:
1. Go to **Appearance → Menus**
2. Create a new menu or edit existing
3. Add pages, posts, custom links
4. Assign to menu location
5. Save menu

#### Menu Structure Example:
```
Primary Menu:
├── Home
├── Services
│   ├── Residential Vastu
│   ├── Commercial Vastu
│   └── Remote Consultation
├── Blog
├── About
└── Contact
```

### Custom Walker
The theme includes `Mobile_Walker_Nav_Menu` class for responsive menus with improved mobile navigation.

## 🖼️ Image Optimization

### Helper Function: `optimized_image()`

**Usage:**
```php
<?php optimized_image('hero-image.webp', 'Hero image description', 'eager'); ?>
```

**Parameters:**
- `$image_name` (string) - Image filename in `/assets/images/`
- `$alt_text` (string) - Alt text for accessibility
- `$loading` (string) - 'lazy' (default) or 'eager'
- `$size` (string) - Image size (default: 'full')
- `$additional_attrs` (array) - Additional HTML attributes

**Example:**
```php
<?php 
optimized_image(
    'service-icon.png', 
    'Service icon', 
    'lazy',
    'medium',
    array('class' => 'service-icon', 'width' => '100')
); 
?>
```

### Lazy Loading
- Automatically applied to content images via `the_content` filter
- Hero images use `loading="eager"` for LCP optimization
- Below-fold images use `loading="lazy"`

### Recommended Image Formats
- **Hero Images:** WebP format, 1920×1080px
- **Service Cards:** WebP format, 600×400px
- **Blog Thumbnails:** WebP format, 800×600px
- **Testimonials:** WebP format, 300×300px

### Image Optimization Best Practices
1. Always use WebP format when possible
2. Compress images before upload (target: <200KB)
3. Use appropriate dimensions for each context
4. Provide descriptive alt text for all images
5. Use `fetchpriority="high"` for LCP images only

## 📱 Responsive Design

### Breakpoints
```css
/* Mobile First (Base) - 320px+ */
/* Tablet - 768px+ */
/* Desktop - 1024px+ */
/* Large Desktop - 1440px+ */
```

### Container Widths
- **Mobile:** 100% with 15px padding
- **Tablet:** 720px max-width
- **Desktop:** 1140px max-width
- **Large Desktop:** 1320px max-width

### Testing Responsive Design
1. Use browser DevTools
2. Test on actual devices
3. Check all breakpoints: 320px, 375px, 768px, 1024px, 1440px

## 🔍 SEO Features

### Built-in SEO
- ✅ Schema.org markup (inc/seo-schema.php)
- ✅ Open Graph tags for social sharing
- ✅ Twitter Card meta tags
- ✅ Canonical URLs
- ✅ Robots meta tags
- ✅ Viewport meta tag

### Meta Tags
Automatically added to all pages:
- Description
- Keywords (homepage only)
- OG Image (1200×630px recommended)
- Author information

### Schema Types
- ProfessionalService (homepage)
- Organization
- Person (Sanjay Jain)
- LocalBusiness
- Article (blog posts)

## 🛠️ Maintenance

### Running Site Audit
```bash
cd /path/to/wordpress
wp eval-file scripts/site-audit.php
```

Or via PHP:
```bash
php scripts/site-audit.php
```

### Audit Checks:
- ✅ Template files presence
- ✅ Image reference validation
- ✅ Enqueue usage
- ✅ Hardcoded URLs
- ✅ Responsive CSS coverage
- ✅ Media query coverage

### Regular Maintenance Tasks
1. **Weekly:**
   - Update content
   - Check for broken links
   - Monitor page speed

2. **Monthly:**
   - Run site audit script
   - Update plugins (if any)
   - Check responsive design

3. **Quarterly:**
   - Review SEO performance
   - Update schema markup
   - Optimize images

### Common Issues

#### Images Not Loading
- Check file exists in `/assets/images/`
- Verify file permissions (644 for files, 755 for directories)
- Clear browser cache
- Check image path in code

#### Menu Not Displaying
- Ensure menu is assigned to correct location
- Check theme supports navigation menus
- Clear cache (if using caching plugin)

#### Responsive Issues
- Clear cache
- Check CSS media queries
- Validate viewport meta tag
- Test on actual devices

## 📞 Support

For theme-specific issues or customization:
- Review this documentation
- Run the site audit script
- Check WordPress debug log
- Contact: Sanjay Jain via WhatsApp (+91 9828088678)

## 📝 Version History

**v1.0.0** - Initial Release
- Multi-page architecture
- Custom post types (Services, Testimonials)
- Three navigation menu locations
- Responsive design (mobile-first)
- SEO optimization
- Image optimization helpers
- Site audit tool

---

**Last Updated:** December 2024
**Author:** Sanjay Jain
**License:** GNU General Public License v2 or later
