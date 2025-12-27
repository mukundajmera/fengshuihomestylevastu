# Feng Shui Homestyle Vastu - Complete WordPress Website

[![WordPress](https://img.shields.io/badge/WordPress-6.x-blue.svg)](https://wordpress.org/)
[![Theme](https://img.shields.io/badge/Theme-Astra%20Child-green.svg)](https://wpastra.com/)
[![License](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

A production-grade, SEO-optimized, multi-page WordPress website for Feng Shui & Vastu consultancy services by Sanjay Jain.

## 🌟 Features

- ✅ **Multi-Page Architecture** - Complete template hierarchy
- ✅ **Custom Post Types** - Services and Testimonials
- ✅ **Responsive Design** - Mobile-first approach (320px - 1440px+)
- ✅ **SEO Optimized** - Schema markup, Open Graph, Twitter Cards
- ✅ **Image Optimization** - Lazy loading, WebP support, fetchpriority
- ✅ **Performance** - Core Web Vitals optimized
- ✅ **Navigation Menus** - Primary, Footer, and Mobile menus
- ✅ **Diagnostic Tools** - Automated site audit script

## 🚀 Quick Start

### Prerequisites
- WordPress 6.0+
- PHP 7.4+
- MySQL 5.7+ or MariaDB 10.2+
- Astra theme installed (parent theme)

### Installation

1. **Clone the repository:**
```bash
git clone https://github.com/mukundajmera/fengshuihomestylevastu.git
cd fengshuihomestylevastu
```

2. **Set up WordPress:**
   - If deploying to a server, upload all files to your web root
   - Create `wp-config.php` from `wp-config-sample.php`
   - Configure database settings

3. **Activate the theme:**
   - Go to WordPress Admin → Appearance → Themes
   - Activate "Feng Shui Homestyle Vastu" (child theme)

4. **Import content** (if available):
   - Go to Tools → Import
   - Import pages, posts, and custom post types

## 📦 What's Included

### Template Files
```
wp-content/themes/fengshuihomestyle-vastu/
├── front-page.php        # Homepage
├── page.php              # Generic pages
├── single.php            # Blog posts
├── single-service.php    # Service pages
├── archive.php           # Blog archive
├── search.php            # Search results
├── 404.php               # Error page
├── index.php             # Fallback template
└── functions.php         # Theme functions
```

### Custom Post Types
- **Services** (`/services/`)
- **Testimonials**

### Navigation Menus
- **Primary Menu** - Header navigation
- **Footer Menu** - Footer links
- **Mobile Menu** - Mobile navigation

### Tools & Scripts
- **Site Audit Script** - `scripts/site-audit.php`

## 🛠️ Configuration

### 1. Navigation Menus

Go to **Appearance → Menus** and create/assign menus:

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

### 2. Create Services

1. Go to **Services → Add New Service**
2. Add title, description, and featured image
3. Use custom field `service_benefits` for bullet points
4. Publish

### 3. Add Testimonials

1. Go to **Testimonials → Add New Testimonial**
2. Title: Client name + location
3. Content: Testimonial text
4. Featured image: Client photo (optional)
5. Publish

## 🧪 Running Tests

### Site Audit
Run the automated site audit to check for issues:

```bash
# Using WP-CLI
wp eval-file scripts/site-audit.php

# Or directly with PHP
php scripts/site-audit.php
```

The audit checks:
- ✅ Template files presence
- ✅ Image references
- ✅ Enqueue usage
- ✅ Hardcoded URLs
- ✅ Responsive CSS coverage

## 📱 Responsive Design

The theme uses a mobile-first approach with these breakpoints:

| Breakpoint | Width | Target |
|------------|-------|--------|
| Mobile | 320px+ | Base styles |
| Tablet | 768px+ | 2-column layouts |
| Desktop | 1024px+ | 3-column layouts |
| Large Desktop | 1440px+ | Max container width |

## 🔍 SEO Features

### Built-in SEO
- Schema.org markup (ProfessionalService, Organization, Person)
- Open Graph meta tags for social sharing
- Twitter Card support
- Canonical URLs
- Sitemap support (via plugins)

### Meta Tags
```php
// Automatically added to all pages
- Meta description
- OG tags (title, description, image, url)
- Twitter Card tags
- Viewport meta tag
```

## 🖼️ Image Optimization

### Helper Function
```php
<?php optimized_image('image-name.webp', 'Alt text', 'lazy'); ?>
```

### Best Practices
- Use WebP format
- Compress before upload (<200KB)
- Use appropriate dimensions
- Provide descriptive alt text
- Apply lazy loading (automatic for content)

## 🔧 Development

### File Structure
```
/
├── wp-content/
│   └── themes/
│       ├── astra/                    # Parent theme
│       └── fengshuihomestyle-vastu/  # Child theme (custom)
├── scripts/
│   └── site-audit.php                # Diagnostic tool
└── wp-config.php                     # WordPress config
```

### Custom Functions

#### Navigation
```php
fengshuihomestyle_vastu_register_menus()  // Register menus
Mobile_Walker_Nav_Menu                     // Custom walker
```

#### Post Types
```php
fengshuihomestyle_vastu_register_post_types()  // Register CPTs
```

#### Images
```php
optimized_image()                                        // Image helper
fengshuihomestyle_vastu_add_lazy_loading_to_images()    // Lazy load filter
vastu_generate_alt_text()                               // Alt text generator
```

## 🚀 Deployment

### To Hostinger (Current Live Site)

1. **Export from local:**
```bash
# Export database
wp db export backup.sql

# Create theme zip
cd wp-content/themes
zip -r fengshuihomestyle-vastu.zip fengshuihomestyle-vastu/
```

2. **Upload to Hostinger:**
   - Upload theme via FTP or File Manager
   - Import database via phpMyAdmin
   - Update `wp-config.php` with production settings
   - Update URLs in database

3. **Post-deployment:**
   - Activate theme
   - Set up menus
   - Configure permalinks (Settings → Permalinks)
   - Test all pages and links

### Environment Variables
```php
// wp-config.php
define('WP_DEBUG', false);           // Production: false
define('WP_DEBUG_LOG', false);       // Production: false
define('WP_CACHE', true);            // Enable caching
```

## 📊 Performance

### Core Web Vitals Targets
- **LCP (Largest Contentful Paint):** <2.5s
- **FID (First Input Delay):** <100ms
- **CLS (Cumulative Layout Shift):** <0.1

### Optimization Features
- ✅ Lazy loading images
- ✅ WebP format support
- ✅ Deferred JavaScript
- ✅ Minified CSS/JS (via plugins)
- ✅ Preload critical resources
- ✅ Font-display: swap

## 🐛 Troubleshooting

### Common Issues

**Images not loading:**
```bash
# Check file permissions
chmod 755 wp-content/themes/fengshuihomestyle-vastu/assets
chmod 644 wp-content/themes/fengshuihomestyle-vastu/assets/images/*
```

**Menu not appearing:**
- Ensure menu is created and assigned
- Check theme location in Appearance → Menus
- Clear cache

**404 errors:**
- Go to Settings → Permalinks
- Click "Save Changes" (no changes needed)
- This refreshes rewrite rules

## 📞 Support

- **Website:** https://fengshuihomestylevastu.com
- **GitHub Issues:** [Create an issue](https://github.com/mukundajmera/fengshuihomestylevastu/issues)
- **WhatsApp:** +91 9828088678 (Sanjay Jain)

## 📄 License

This project is licensed under the GNU General Public License v2 or later - see the [LICENSE](license.txt) file for details.

## 🙏 Acknowledgments

- **Parent Theme:** [Astra](https://wpastra.com/)
- **WordPress:** [WordPress.org](https://wordpress.org/)
- **Consultant:** Sanjay Jain - 25+ years of Vastu & Feng Shui expertise

## 📝 Changelog

### Version 1.0.0 (December 2024)
- ✅ Initial release
- ✅ Multi-page architecture implementation
- ✅ Custom post types (Services, Testimonials)
- ✅ Navigation menu system
- ✅ Responsive design (mobile-first)
- ✅ SEO optimization
- ✅ Image optimization
- ✅ Site audit tool
- ✅ Complete documentation

---

**Built with 🙏 for harmonious digital experiences**

**Last Updated:** December 27, 2024
