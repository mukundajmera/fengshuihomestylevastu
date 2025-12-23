# Blog Posts for WordPress

This directory contains production-ready blog posts based on the content outlined in WORDPRESS_GUIDE.md Section 6.

## Posts Included

1. **bedroom-mirror-marriage-conflict.md** - "Why a Bedroom Mirror Might Be Causing Conflict in Your Marriage"
   - Category: Relationships, Vastu Tips
   - Target keyword: bedroom vastu, mirror placement
   - SEO optimized with H1/H2 structure

2. **house-height-career-growth.md** - "Is Your House Height Blocking Your Success? The Vastu Construction Guide"
   - Category: Career Growth, Business Vastu, Construction
   - Target keyword: vastu construction, career growth
   - SEO optimized with H1/H2 structure

## How to Import to WordPress

### Method 1: Manual Copy-Paste (Recommended for Testing)

1. Log into your WordPress admin panel
2. Go to **Posts → Add New**
3. Open the `.md` file in a text editor
4. Copy the content (excluding the front matter between `---`)
5. Paste into the WordPress block editor
6. The markdown will be converted to blocks automatically
7. Set the metadata from the front matter:
   - Title
   - Slug (under Permalink settings)
   - Categories
   - Tags
   - Featured Image (upload separately)
   - Meta Description (using Yoast SEO or similar plugin)

### Method 2: Using a Markdown Import Plugin

1. Install the **WP Githuber MD** or **Markdown Block** plugin
2. Go to **Posts → Add New**
3. Enable markdown mode
4. Copy and paste the entire content including front matter
5. Adjust formatting as needed
6. Publish

### Method 3: Using WP-CLI (For Bulk Import)

If you have WP-CLI installed on your server:

```bash
# Navigate to WordPress root
cd /path/to/wordpress

# Import posts (you'll need to create a custom script)
wp post create --post_type=post --post_status=publish \
  --post_title="Why a Bedroom Mirror Might Be Causing Conflict in Your Marriage" \
  --post_content="$(cat wp-content/themes/fengshuihomestyle-vastu/blog-posts/bedroom-mirror-marriage-conflict.md)"
```

## Metadata Reference

Each blog post has metadata in the front matter (between `---` markers). Here's what to set in WordPress:

### For "Bedroom Mirror" Post:
- **Title:** Why a Bedroom Mirror Might Be Causing Conflict in Your Marriage
- **Slug:** bedroom-mirror-marriage-conflict-vastu
- **Categories:** Relationships, Vastu Tips
- **Tags:** bedroom vastu, marriage harmony, relationship tips, mirror placement
- **Meta Description:** Are you experiencing unexplained distances or frequent arguments with your spouse? Discover how the placement of mirrors in your bedroom affects your relationship according to Vastu Shastra.
- **Author:** Sanjay Jain
- **Featured Image:** Upload a bedroom image with mirror (see IMAGE-REQUIREMENTS.md)

### For "House Height" Post:
- **Title:** Is Your House Height Blocking Your Success? The Vastu Construction Guide
- **Slug:** house-height-career-growth-vastu-protocol
- **Categories:** Career Growth, Business Vastu, Construction
- **Tags:** vastu construction, career growth, business success, building height, factory vastu
- **Meta Description:** Discover how the height protocol in Vastu construction affects your career and business growth. Learn simple remedies if your building violates the North-East to South-West height rule.
- **Author:** Sanjay Jain
- **Featured Image:** Upload a construction/building image (see IMAGE-REQUIREMENTS.md)

## SEO Checklist (Use Yoast SEO or Similar)

For each post, ensure:

- [x] Focus keyword is in the title
- [x] Focus keyword is in the first paragraph
- [x] Focus keyword is in at least one H2 heading
- [x] Meta description is compelling and under 160 characters
- [x] URL slug is descriptive and includes keyword
- [x] Internal links to related content (add after publishing more posts)
- [x] External links (if relevant)
- [x] Alt text for all images
- [x] Featured image is optimized (< 200KB, WebP format)
- [x] Readability score is good (short paragraphs, bullet points, clear headers)

## Featured Images Required

Create or source these images (see ../assets/images/IMAGE-REQUIREMENTS.md):

1. **bedroom-mirror-reflection.jpg** (800x600px)
   - Peaceful bedroom with mirror visible
   - Natural lighting, serene atmosphere
   - Professional photography style

2. **construction-height-protocol.jpg** (800x600px)
   - Building or house under construction
   - Shows different height levels
   - Professional, clean aesthetic

## Content Structure

Both posts follow SEO best practices:

1. **H1 Title** - Main keyword included
2. **Introduction** - Hook with problem statement
3. **H2 Sections** - Break content into scannable chunks
4. **Bullet Points** - Easy-to-digest information
5. **Call-to-Action** - WhatsApp consultation link
6. **Related Articles** - Internal linking opportunities
7. **Disclaimer** - Professional credibility

## WhatsApp Links

All WhatsApp CTAs use the format:
```
https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20would%20like%20to%20consult%20regarding%20[specific-topic].
```

Update the phone number if needed in `functions.php` and these posts.

## Publishing Schedule (Suggested)

Week 1:
- Publish "Bedroom Mirror" post
- Share on social media
- Monitor engagement

Week 2:
- Publish "House Height" post
- Cross-link with first post
- Update front-page.php blog links

## Next Steps

After publishing these posts:

1. Create 3-5 more blog posts on related Vastu topics
2. Implement internal linking between all posts
3. Set up email capture on blog sidebar
4. Add social sharing buttons
5. Monitor analytics for top-performing content
6. Create pillar content around main themes (Residential, Commercial, Relationships)

## Contact

For questions about these posts or WordPress implementation:
- Review WORDPRESS_GUIDE.md
- Check ELEMENTOR-GUIDE.md for page builder approach
- See IMPLEMENTATION-SUMMARY.md for theme details

---

*These posts are production-ready and SEO-optimized. They follow the content strategy outlined in WORDPRESS_GUIDE.md Section 6.*
