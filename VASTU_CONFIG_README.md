# 🚀 Vastu Configuration Script - Quick Start Guide

## What is this?

`vastu-config.php` is a **ONE-CLICK configuration script** that automatically sets up your entire Feng Shui Homestyle Vastu website.

No manual WordPress configuration needed - just run this script and your website will be ready!

## ✨ What It Does

This script automatically:

✅ **Activates the Theme** - Switches from default theme to fengshuihomestyle-vastu
✅ **Creates Pages** - Home, About, Services, Contact, Blog pages ready to use
✅ **Sets Up Menus** - Primary navigation menu with all pages linked
✅ **Configures URLs** - SEO-friendly permalink structure (yourdomain.com/page-name/)
✅ **Verifies Assets** - Checks that all images and JavaScript files are in place
✅ **Configures Settings** - Site title, tagline, timezone, and more
✅ **Runs Health Check** - Comprehensive verification that everything is working

## 🎯 How to Use

### Step 1: Upload the File

Upload `vastu-config.php` to your WordPress root directory (same folder as wp-config.php).

**Via FTP/SFTP:**
```
/public_html/vastu-config.php  ← Upload here
/public_html/wp-config.php     ← Same level as this file
/public_html/wp-content/
/public_html/wp-admin/
```

**Via Hostinger File Manager:**
1. Log in to Hostinger hPanel
2. Go to Files > File Manager
3. Navigate to public_html folder
4. Click Upload
5. Select vastu-config.php

### Step 2: Run the Script

Open your browser and visit:

```
https://honeydew-cormorant-288039.hostingersite.com/vastu-config.php?run=true&key=vastu2026
```

**Important:** Use the exact URL with `?run=true&key=vastu2026` parameters

### Step 3: Review the Report

The script will show you a detailed report of everything it configured.

Look for:
- ✅ Green checkmarks = Success
- ⚠️ Orange warnings = Review needed
- ❌ Red errors = Fix required

### Step 4: Delete the Script

**For security, immediately delete** `vastu-config.php` after successful execution.

The script creates a marker file (`.vastu-configured`) to prevent re-execution.

## 🔐 Security Features

- **Secret Key Required:** Can't run without the correct key parameter
- **One-Time Use:** Automatically prevents re-execution after first run
- **Execution Marker:** Creates `.vastu-configured` file to track execution
- **Self-Destruct Recommendation:** Prompts you to delete after success

## 📋 Configuration Details

### Pages Created

| Page | Purpose | Set As |
|------|---------|--------|
| Home | Landing page | Front Page ✓ |
| About | About Sanjay Jain | - |
| Services | Vastu services offered | - |
| Blog | Blog post listing | Posts Page ✓ |
| Contact | Contact form and info | - |

### Menu Structure

**Primary Menu (Header):**
1. Home
2. About
3. Services
4. Blog
5. Contact

### Settings Configured

- **Site Title:** Feng Shui Homestyle Vastu
- **Tagline:** Scientific Vastu: Harmony without Demolition
- **Timezone:** Asia/Kolkata
- **Permalink Structure:** Post name (SEO-friendly)
- **Front Page:** Static page (Home)
- **Posts Page:** Blog

## 🐛 Troubleshooting

### Issue: "Secret key required" error

**Solution:** Ensure you're using the complete URL with the key parameter:
```
https://your-domain.com/vastu-config.php?run=true&key=vastu2026
```

### Issue: "Already configured" message

**Solution:** 
- The script has already run successfully
- To re-run, delete the `.vastu-configured` file from WordPress root
- Only do this if you need to reset the configuration

### Issue: "WordPress not found" error

**Solution:**
- Ensure the script is in the WordPress root directory (same level as wp-config.php)
- Check file permissions (should be readable)
- Verify WordPress is properly installed

### Issue: Page shows blank or errors

**Solution:**
1. Check PHP error logs
2. Ensure PHP version is 7.4 or higher
3. Verify database connection in wp-config.php
4. Try accessing WordPress admin to see if WP is working

## 📊 What Happens After Running

After successful execution, you should see:

1. ✅ **Theme Activated:** fengshuihomestyle-vastu is active
2. ✅ **Homepage Works:** Visit your homepage to see the Vastu theme
3. ✅ **Menu Navigation:** Header menu shows all pages
4. ✅ **SEO URLs:** URLs are clean (no ?p=123)
5. ✅ **Assets Verified:** All images and scripts are found

## 🎯 Next Steps

After running the configuration script:

1. **Visit Your Homepage**
   - https://honeydew-cormorant-288039.hostingersite.com/
   - Verify the theme looks correct

2. **Check the Navigation**
   - Click through all menu items
   - Ensure pages load correctly

3. **Test WhatsApp Button**
   - Click the WhatsApp button
   - Should open chat with Sanjay Jain

4. **Customize Content**
   - Go to WordPress Admin
   - Edit pages to add your content

5. **Delete This Script**
   - Remove vastu-config.php for security

## 📞 Support

If you encounter issues:

1. Check the **Troubleshooting** section above
2. Review the **DEPLOYMENT_GUIDE.md** for detailed instructions
3. Check WordPress error logs in Hostinger
4. Contact Hostinger support: support@hostinger.com

## 🔄 Re-running the Script

The script can only run once by default. To reset:

1. Delete `.vastu-configured` file from WordPress root
2. Run the script again with the same URL
3. Delete both files after successful execution

**Warning:** Re-running will overwrite existing pages and menus. Back up first!

## ✅ Success Indicators

You'll know it worked when you see:

- ✅ Green "Configuration Complete!" message
- ✅ All 7 steps show success
- ✅ Health check shows correct versions
- ✅ "Visit Homepage" button appears
- ✅ No red error messages

## 📝 Manual Alternative

If you prefer not to use this automated script, follow the manual setup instructions in **DEPLOYMENT_GUIDE.md**.

The manual process takes about 30 minutes vs. 30 seconds with this script.

---

**Script Version:** 2.0.0  
**Last Updated:** December 27, 2024  
**Security:** One-time execution, key-protected  
**Status:** Production Ready ✅

---

## Quick Reference

**Upload To:** WordPress root (same as wp-config.php)  
**Access URL:** `https://your-domain.com/vastu-config.php?run=true&key=vastu2026`  
**Execution Time:** ~5-10 seconds  
**After Success:** DELETE the script file  
**Marker File:** `.vastu-configured` (auto-created)  
**Security Key:** `vastu2026`
