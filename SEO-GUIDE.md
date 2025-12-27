# SEO Features & XML Sitemap Guide

## Overview

This guide covers the enhanced SEO features and XML sitemap functionality added to the Feng Shui Homestyle Vastu WordPress theme.

## 📊 Enhanced Meta Tags

### Automatic Meta Tag Generation

The theme now automatically generates comprehensive meta tags for all pages:

#### Homepage Meta Tags
- Custom meta description optimized for search engines
- Targeted keywords for Feng Shui and Vastu services
- Open Graph tags for social media sharing
- Twitter Card support
- OG image with dimensions for optimal preview

#### Posts & Pages Meta Tags
- **Auto-generated descriptions** from post excerpt or content (30 words)
- **Open Graph tags** with proper article type
- **Article-specific tags**:
  - Published time (ISO 8601 format)
  - Modified time (ISO 8601 format)
  - Author attribution
- **Featured image** integration for social sharing
- **Twitter Card** support with images
- **Fallback image** when no featured image exists

### How It Works

The `fengshuihomestyle_vastu_custom_meta_tags()` function runs on every page load via the `wp_head` action hook.

**For Homepage:**
```html
<meta name="description" content="Expert Feng Shui and Vastu consultancy services...">
<meta property="og:title" content="Feng Shui Homestyle Vastu - Harmonize Your Space">
<meta property="og:type" content="website">
<meta property="og:image" content="[homepage-image]">
```

**For Blog Posts/Pages:**
```html
<meta name="description" content="[Auto-generated from content]">
<meta property="og:type" content="article">
<meta property="article:published_time" content="2024-12-27T10:00:00+00:00">
<meta property="article:modified_time" content="2024-12-27T15:30:00+00:00">
<meta property="og:image" content="[featured-image or fallback]">
```

### Customizing Meta Tags

To customize meta tags for specific posts/pages:

1. **Add Custom Excerpt** - Go to post editor → Excerpt panel
2. **Set Featured Image** - This becomes the social sharing image
3. **Title** - The post title becomes the OG title automatically

## 🗺️ XML Sitemap Generator

### Features

The XML sitemap generator creates a complete sitemap.xml file with:

- ✅ Homepage (priority: 1.0)
- ✅ All published pages (priority: 0.8)
- ✅ All published blog posts (priority: 0.7)
- ✅ All published services (priority: 0.9)
- ✅ Services archive page (priority: 0.8)
- ✅ Blog archive page (priority: 0.8)
- ✅ Image sitemap entries (for featured images)
- ✅ Last modified timestamps
- ✅ Change frequency hints

### Generating the Sitemap

#### Method 1: Via WP-CLI (Recommended)

```bash
wp eval-file scripts/generate-sitemap.php
```

Output:
```
✅ Sitemap generated successfully!
Location: /path/to/wordpress/sitemap.xml
Total URLs: 25
```

#### Method 2: Via PHP Directly

```bash
php scripts/generate-sitemap.php
```

#### Method 3: Programmatically

Add to `functions.php`:

```php
require_once get_stylesheet_directory() . '/scripts/generate-sitemap.php';

// Generate on theme activation
add_action('after_switch_theme', 'fengshuihomestyle_generate_xml_sitemap');
```

### Automatic Regeneration

To automatically regenerate the sitemap when content is updated, uncomment this line in `scripts/generate-sitemap.php`:

```php
// Line ~172 in generate-sitemap.php
add_action('save_post', 'fengshuihomestyle_regenerate_sitemap_on_save');
```

**Note:** This can be resource-intensive on high-traffic sites. For production, consider using a cron job instead:

```bash
# Add to crontab (regenerate daily at 2am)
0 2 * * * cd /path/to/wordpress && wp eval-file scripts/generate-sitemap.php
```

### Sitemap Structure

Example sitemap.xml:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

  <url>
    <loc>https://example.com/</loc>
    <lastmod>2024-12-27T10:30:00+00:00</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>

  <url>
    <loc>https://example.com/about/</loc>
    <lastmod>2024-12-20T15:00:00+00:00</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <url>
    <loc>https://example.com/blog/feng-shui-tips/</loc>
    <lastmod>2024-12-25T12:00:00+00:00</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
    <image:image>
      <image:loc>https://example.com/wp-content/uploads/featured-image.jpg</image:loc>
      <image:title>Feng Shui Tips for Home</image:title>
    </image:image>
  </url>

</urlset>
```

### Submitting to Search Engines

After generating the sitemap:

1. **Google Search Console**
   - Go to https://search.google.com/search-console
   - Select your property
   - Go to Sitemaps → Add new sitemap
   - Enter: `sitemap.xml`
   - Click Submit

2. **Bing Webmaster Tools**
   - Go to https://www.bing.com/webmasters
   - Select your site
   - Go to Sitemaps → Submit Sitemap
   - Enter: `https://yoursite.com/sitemap.xml`
   - Click Submit

3. **robots.txt** (Optional)
   Add to `/robots.txt`:
   ```
   User-agent: *
   Allow: /
   
   Sitemap: https://yoursite.com/sitemap.xml
   ```

## ⚡ Performance Optimizations

### Removed Unnecessary Features

The theme removes these WordPress features for better performance:

1. **wp_generator** - Hides WordPress version (security)
2. **wlwmanifest_link** - Windows Live Writer support (obsolete)
3. **rsd_link** - Really Simple Discovery (rarely used)
4. **wp_shortlink** - Redundant short URL (not needed)
5. **Emoji scripts** - Saves ~50KB (custom emoji can still be used)

### Existing Optimizations

- ✅ Preconnect to Google Fonts
- ✅ Preload hero image (LCP optimization)
- ✅ Defer non-critical JavaScript
- ✅ Lazy loading for images
- ✅ WebP format support
- ✅ Decoding="async" for images

### Performance Impact

These optimizations typically result in:
- **Reduced HTML size**: ~5-10KB less per page
- **Fewer HTTP requests**: 2-3 fewer requests
- **Faster LCP**: Hero image preloading improves Largest Contentful Paint
- **Better SEO**: Clean HTML without unnecessary code

## 🔍 SEO Best Practices

### For Blog Posts

1. **Use Descriptive Titles** (50-60 characters)
   ```
   ✅ "10 Feng Shui Tips for Better Sleep Quality"
   ❌ "Tips for Sleep"
   ```

2. **Write Custom Excerpts** (150-160 characters)
   - This becomes the meta description
   - Should include target keyword
   - Should be compelling for click-through

3. **Add Featured Images**
   - Recommended size: 1200×630px
   - This becomes the social sharing image
   - Use descriptive file names

4. **Use Headers Properly**
   - H1: Post title (automatic)
   - H2: Main sections
   - H3: Subsections

### For Pages

1. **Unique Titles** - Each page should have a unique title
2. **Descriptive Content** - First 30 words are important for auto-generated descriptions
3. **Featured Images** - Add for better social sharing
4. **Internal Linking** - Link to related pages/posts

### For Services

1. **Descriptive Titles** - Include service name and benefit
2. **Detailed Descriptions** - Use custom fields for benefits list
3. **Featured Images** - High-quality service images
4. **Call-to-Actions** - Include WhatsApp links

## 📈 Monitoring SEO

### Check Meta Tags

Use these tools to verify meta tags:

1. **Facebook Debugger**: https://developers.facebook.com/tools/debug/
2. **Twitter Card Validator**: https://cards-dev.twitter.com/validator
3. **OpenGraph.xyz**: https://www.opengraph.xyz/
4. **View Page Source**: Right-click → View Page Source → Search for `<meta`

### Check Sitemap

1. **Direct Access**: Visit `https://yoursite.com/sitemap.xml`
2. **Validate**: Use https://www.xml-sitemaps.com/validate-xml-sitemap.html
3. **Google Search Console**: Check index coverage report

### Monitor Performance

1. **Google PageSpeed Insights**: https://pagespeed.web.dev/
2. **GTmetrix**: https://gtmetrix.com/
3. **WebPageTest**: https://www.webpagetest.org/

## 🆘 Troubleshooting

### Sitemap Not Generating

**Issue**: Script runs but no sitemap.xml file

**Solution**:
```bash
# Check file permissions
ls -la /path/to/wordpress/ | grep sitemap.xml

# If doesn't exist, check write permissions
ls -ld /path/to/wordpress/

# Should be writable by web server
chmod 755 /path/to/wordpress/
```

### Meta Tags Not Showing

**Issue**: Meta tags don't appear in page source

**Solution**:
1. Clear all caches (browser, WordPress, server)
2. Check functions.php is loaded: Add `error_log('Functions loaded');`
3. Verify theme is active
4. Check for plugin conflicts (disable all plugins temporarily)

### Sitemap Returns 404

**Issue**: Visiting sitemap.xml shows 404 error

**Solution**:
1. Verify file exists: `ls -la /path/to/wordpress/sitemap.xml`
2. Check .htaccess rules aren't blocking it
3. Regenerate: `wp eval-file scripts/generate-sitemap.php`

### Images Not in Sitemap

**Issue**: Featured images don't appear in sitemap

**Solution**:
1. Ensure posts have featured images set
2. Verify images are accessible (not 404)
3. Regenerate sitemap
4. Check image URLs in sitemap.xml

## 📚 Additional Resources

- **WordPress SEO Guide**: https://developer.wordpress.org/advanced-administration/wordpress/seo/
- **Schema.org**: https://schema.org/
- **Open Graph Protocol**: https://ogp.me/
- **XML Sitemaps**: https://www.sitemaps.org/
- **Google Search Central**: https://developers.google.com/search

## 📝 Version History

**v1.1.0** - SEO Enhancements
- Enhanced meta tags for all page types
- XML sitemap generator
- Additional performance optimizations
- Image sitemap support

**v1.0.0** - Initial Release
- Basic meta tags (homepage only)
- Schema markup
- Performance optimizations

---

**Last Updated:** December 27, 2024
**Author:** Sanjay Jain / GitHub Copilot
**License:** GNU General Public License v2 or later
