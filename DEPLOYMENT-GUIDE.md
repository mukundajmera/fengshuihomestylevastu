# 🚀 Deployment Guide - Feng Shui Homestyle Vastu

This guide provides step-by-step instructions for deploying the WordPress website to production.

## 📋 Pre-Deployment Checklist

Before deploying, ensure you have:

- [ ] WordPress 6.0+ installed on hosting server
- [ ] PHP 7.4+ configured
- [ ] MySQL 5.7+ or MariaDB 10.2+ database ready
- [ ] FTP/SFTP or File Manager access
- [ ] Database management tool (phpMyAdmin, etc.)
- [ ] Backup of existing site (if applicable)

## 🔧 Step 1: Prepare Files

### 1.1 Download Repository Files

```bash
# Clone the repository
git clone https://github.com/mukundajmera/fengshuihomestylevastu.git
cd fengshuihomestylevastu
```

### 1.2 Verify Theme Files

```bash
# Check theme directory
ls -la wp-content/themes/fengshuihomestyle-vastu/

# Expected files:
# - functions.php
# - style.css
# - front-page.php
# - page.php
# - single.php
# - single-service.php
# - archive.php
# - search.php
# - 404.php
# - index.php
```

### 1.3 Validate PHP Syntax (Optional)

```bash
# Run syntax check on all PHP files
find wp-content/themes/fengshuihomestyle-vastu -name "*.php" -exec php -l {} \;
```

## 📤 Step 2: Upload to Server

### Option A: FTP/SFTP Upload

1. **Connect to your hosting server** via FTP client (FileZilla, Cyberduck, etc.)

2. **Upload theme files:**
   ```
   Local: /wp-content/themes/fengshuihomestyle-vastu/
   Remote: /public_html/wp-content/themes/fengshuihomestyle-vastu/
   ```

3. **Upload scripts (optional):**
   ```
   Local: /scripts/
   Remote: /public_html/scripts/
   ```

### Option B: Hostinger File Manager

1. Login to Hostinger control panel
2. Open **File Manager**
3. Navigate to `public_html/wp-content/themes/`
4. Upload theme folder or zip file
5. Extract if uploaded as zip

### Option C: WP-CLI (if available)

```bash
# SSH into server
ssh username@yourserver.com

# Navigate to WordPress directory
cd public_html

# Copy theme files
# (Assuming files are already on server in /tmp/)
cp -r /tmp/fengshuihomestyle-vastu wp-content/themes/
```

## 🗄️ Step 3: Database Configuration

### 3.1 WordPress Configuration

1. **Edit wp-config.php:**

```php
// Database settings (update with your credentials)
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASSWORD', 'your_database_password');
define('DB_HOST', 'localhost');

// Security keys (generate new ones)
// Visit: https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY', 'your-unique-phrase-here');
// ... (add all security keys)

// Debugging (set to false for production)
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);

// Memory limits
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');
```

### 3.2 File Permissions

Set correct permissions for security:

```bash
# Directories
find . -type d -exec chmod 755 {} \;

# Files
find . -type f -exec chmod 644 {} \;

# wp-config.php (more restrictive)
chmod 600 wp-config.php
```

## 🎨 Step 4: Activate Theme

### Via WordPress Admin:

1. Login to WordPress Admin: `https://yoursite.com/wp-admin`
2. Navigate to **Appearance → Themes**
3. Find "Feng Shui Homestyle Vastu" theme
4. Click **Activate**

### Via WP-CLI:

```bash
wp theme activate fengshuihomestyle-vastu
```

## 🧩 Step 5: Configure Theme Features

### 5.1 Create Navigation Menus

1. Go to **Appearance → Menus**
2. Create **Primary Menu:**
   - Home
   - Services
   - Blog
   - About
   - Contact

3. Create **Footer Menu:**
   - Privacy Policy
   - Terms of Service
   - Contact

4. Create **Mobile Menu** (same as Primary or customized)

5. **Assign menu locations:**
   - Primary Menu → Primary Menu (Header)
   - Footer Menu → Footer Menu
   - Mobile Menu → Mobile Menu

### 5.2 Configure Permalinks

1. Go to **Settings → Permalinks**
2. Select **Post name** structure: `/%postname%/`
3. Click **Save Changes**

This ensures clean URLs like:
- `/services/residential-vastu/`
- `/blog/feng-shui-tips/`

### 5.3 Create Sample Service

1. Go to **Services → Add New Service**

2. **Title:** "Residential Vastu Consultation"

3. **Content:**
```
Transform your home into a sanctuary of harmony and prosperity with our comprehensive residential Vastu consultation.

Our 100% remote service uses satellite mapping and AutoCAD analysis to provide precise recommendations without any demolition.
```

4. **Custom Fields:**
   - Key: `service_benefits`
   - Value:
   ```
   Enhanced family health and wellness
   Improved financial prosperity
   Better relationship harmony
   Optimized energy flow
   Zero demolition required
   ```

5. **Featured Image:** Upload service image (600×400px recommended)

6. **Publish**

### 5.4 Create Sample Pages

Create these essential pages:

**About Page:**
- Title: "About Sanjay Jain"
- Content: Bio and expertise
- Template: Default (page.php)

**Contact Page:**
- Title: "Contact Us"
- Content: Contact form, WhatsApp link
- Template: Default (page.php)

**Privacy Policy:**
- Title: "Privacy Policy"
- Content: Privacy policy text
- Template: Default (page.php)

## ⚙️ Step 6: Performance Optimization

### 6.1 Install Recommended Plugins

```
1. Caching: WP Rocket or W3 Total Cache
2. Security: Wordfence Security
3. SEO: Yoast SEO (optional, schema already built-in)
4. Image Optimization: ShortPixel or Smush
5. Backup: UpdraftPlus
```

### 6.2 Configure Caching

**For WP Rocket:**
1. Enable page caching
2. Enable GZIP compression
3. Enable browser caching
4. Minify CSS/JS
5. Enable lazy loading (images already lazy-loaded by theme)

**For W3 Total Cache:**
1. Enable Page Cache
2. Enable Minify
3. Enable Browser Cache
4. Configure Database Cache

### 6.3 Enable Gzip Compression

Add to `.htaccess` (if not using plugin):

```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/x-javascript
</IfModule>
```

### 6.4 Configure CDN (Optional)

If using Cloudflare or similar:
1. Point domain to CDN
2. Configure caching rules
3. Enable Brotli compression
4. Enable Auto Minify

## 🔒 Step 7: Security Hardening

### 7.1 Secure wp-config.php

Move above web root or set strict permissions:
```bash
chmod 600 wp-config.php
```

### 7.2 Disable File Editing

Add to `wp-config.php`:
```php
define('DISALLOW_FILE_EDIT', true);
```

### 7.3 Hide WordPress Version

Add to `functions.php` (already present in theme):
```php
remove_action('wp_head', 'wp_generator');
```

### 7.4 Limit Login Attempts

Install plugin: **Limit Login Attempts Reloaded**

### 7.5 SSL Certificate

Ensure SSL is installed and force HTTPS:

Add to `wp-config.php`:
```php
define('FORCE_SSL_ADMIN', true);
```

Add to `.htaccess`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## 🧪 Step 8: Testing

### 8.1 Run Site Audit

```bash
# Via WP-CLI
wp eval-file scripts/site-audit.php

# Or via browser (create temporary admin page)
```

### 8.2 Test Responsive Design

Test on these breakpoints:
- Mobile: 320px, 375px, 414px
- Tablet: 768px, 1024px
- Desktop: 1440px, 1920px

Tools:
- Browser DevTools
- BrowserStack
- Actual devices

### 8.3 Test Page Speed

Use these tools:
1. **Google PageSpeed Insights:** https://pagespeed.web.dev/
2. **GTmetrix:** https://gtmetrix.com/
3. **WebPageTest:** https://www.webpagetest.org/

Target metrics:
- LCP (Largest Contentful Paint): <2.5s
- FID (First Input Delay): <100ms
- CLS (Cumulative Layout Shift): <0.1

### 8.4 Test SEO

1. **Google Search Console:** Verify site
2. **Bing Webmaster Tools:** Submit sitemap
3. Check meta tags with: https://www.opengraph.xyz/
4. Validate schema with: https://validator.schema.org/

### 8.5 Cross-Browser Testing

Test on:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers

## 📊 Step 9: Monitoring Setup

### 9.1 Analytics

Install **Google Analytics 4:**
1. Create GA4 property
2. Install tracking code (via plugin or header)
3. Configure goals and events

### 9.2 Search Console

1. Verify ownership: https://search.google.com/search-console
2. Submit sitemap: `https://yoursite.com/sitemap.xml`
3. Monitor index coverage
4. Check mobile usability

### 9.3 Uptime Monitoring

Setup monitoring with:
- UptimeRobot (free)
- Pingdom
- Site24x7

## ✅ Step 10: Post-Deployment Checklist

After deployment, verify:

- [ ] Homepage loads correctly
- [ ] All menu links work
- [ ] Services page displays services
- [ ] Blog archive works
- [ ] Single blog post loads
- [ ] Search functionality works
- [ ] 404 page displays properly
- [ ] Contact forms work (if any)
- [ ] WhatsApp links work
- [ ] Images load with lazy loading
- [ ] Mobile menu functions
- [ ] SSL certificate active
- [ ] Redirects work (HTTP → HTTPS)
- [ ] Schema markup validates
- [ ] Open Graph tags work
- [ ] Site appears in Google Search
- [ ] Analytics tracking works

## 🆘 Troubleshooting

### Theme Not Showing

**Issue:** Theme doesn't appear in Appearance → Themes

**Solution:**
1. Check file permissions (755 for directories, 644 for files)
2. Verify `style.css` exists with proper header comment
3. Check error logs: `wp-content/debug.log`

### Blank Page After Activation

**Issue:** Site shows blank white page

**Solution:**
1. Enable debugging in `wp-config.php`:
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   define('WP_DEBUG_DISPLAY', false);
   ```
2. Check `wp-content/debug.log` for errors
3. Verify PHP version is 7.4+
4. Check parent theme (Astra) is installed

### Images Not Loading

**Issue:** Images return 404 errors

**Solution:**
1. Check image path: `/wp-content/themes/fengshuihomestyle-vastu/assets/images/`
2. Verify file permissions: `chmod 644 image.webp`
3. Clear cache (browser + server)
4. Check image URLs in source code

### Menu Not Displaying

**Issue:** Navigation menu doesn't show

**Solution:**
1. Verify menu is created: Appearance → Menus
2. Ensure menu is assigned to location
3. Check parent theme compatibility
4. Clear cache

### Custom Post Types Not Appearing

**Issue:** Services/Testimonials don't show in admin

**Solution:**
1. Flush rewrite rules: Settings → Permalinks → Save
2. Check functions.php loaded properly
3. Verify no PHP errors in debug log

## 📞 Support & Resources

### Documentation
- Theme Documentation: `/wp-content/themes/fengshuihomestyle-vastu/THEME-DOCUMENTATION.md`
- Implementation Summary: `/IMPLEMENTATION-SUMMARY.md`
- Main README: `/README.md`

### WordPress Resources
- WordPress Codex: https://codex.wordpress.org/
- Developer Resources: https://developer.wordpress.org/
- Support Forums: https://wordpress.org/support/

### Hosting Support (Hostinger)
- Hostinger Support: https://www.hostinger.com/support
- Knowledge Base: https://support.hostinger.com/

### Contact
- GitHub Issues: https://github.com/mukundajmera/fengshuihomestylevastu/issues
- WhatsApp: +91 9828088678 (Sanjay Jain)

## 🎉 Congratulations!

Your WordPress website is now live! 

Remember to:
- Keep WordPress and plugins updated
- Monitor site performance regularly
- Backup site weekly
- Review analytics monthly
- Update content regularly

---

**Deployment Guide Version:** 1.0.0
**Last Updated:** December 27, 2024
**Prepared for:** Feng Shui Homestyle Vastu
