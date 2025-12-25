<?php
/**
 * Template Part: Bento Grid
 *
 * This template part can be included directly in page templates
 * as an alternative to using the [modern_bento_home] shortcode.
 *
 * Usage: <?php get_template_part( 'parts/bento', 'grid' ); ?>
 *
 * @package Vastu_2026_Glass
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Get the latest blog post
$recent_posts = wp_get_recent_posts(array(
    'numberposts' => 1,
    'post_status' => 'publish',
));

$latest_post_title = '';
$latest_post_link = '#';

if (!empty($recent_posts)) {
    $latest_post_title = esc_html($recent_posts[0]['post_title']);
    $latest_post_link = esc_url(get_permalink($recent_posts[0]['ID']));
}

// Hero background image
$hero_bg_url = apply_filters('vastu_hero_background_url', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=80');

// WhatsApp configuration
$whatsapp_number = apply_filters('vastu_whatsapp_number', '919876543210');
$whatsapp_message = apply_filters('vastu_whatsapp_message', 'Hello! I would like to get my Energy Report.');
$whatsapp_url = 'https://wa.me/' . $whatsapp_number . '?text=' . rawurlencode($whatsapp_message);
?>

<section class="bento-grid" aria-label="Homepage Feature Grid">

    <!-- Hero Item (Spans 2 columns) -->
    <article class="bento-item bento-item--hero glass-card"
        style="background-image: url('<?php echo esc_url($hero_bg_url); ?>');">
        <div class="hero-content">
            <h2><?php echo esc_html(apply_filters('vastu_hero_title', 'Transform Your Space, Transform Your Life')); ?>
            </h2>
            <p><?php echo esc_html(apply_filters('vastu_hero_description', 'Discover the ancient wisdom of Vastu Shastra combined with modern Feng Shui principles for harmonious living.')); ?>
            </p>
            <a href="<?php echo esc_url($whatsapp_url); ?>" class="btn-primary" target="_blank"
                rel="noopener noreferrer">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                </svg>
                <?php echo esc_html(apply_filters('vastu_hero_cta_text', 'Get Energy Report')); ?>
            </a>
        </div>
    </article>

    <!-- Wisdom Item (Latest Blog Post) -->
    <article class="bento-item bento-item--wisdom glass-card">
        <span class="wisdom-label"><?php esc_html_e('Latest Wisdom', 'vastu-2026-glass'); ?></span>
        <h3><?php esc_html_e('From Our Blog', 'vastu-2026-glass'); ?></h3>
        <?php if (!empty($latest_post_title)): ?>
            <p class="post-title">
                <a href="<?php echo $latest_post_link; ?>">
                    <?php echo $latest_post_title; ?>
                </a>
            </p>
        <?php else: ?>
            <p class="post-title">
                <?php esc_html_e('Explore our collection of Vastu and Feng Shui insights.', 'vastu-2026-glass'); ?></p>
        <?php endif; ?>
    </article>

    <!-- Contact Item (WhatsApp Trigger) -->
    <div id="whatsapp-trigger" class="bento-item bento-item--contact glass-card"
        onclick="window.open('<?php echo esc_js($whatsapp_url); ?>', '_blank')" role="button" tabindex="0"
        aria-label="<?php esc_attr_e('Contact us on WhatsApp', 'vastu-2026-glass'); ?>">
        <svg class="whatsapp-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
        </svg>
        <h3><?php esc_html_e('Chat With Us', 'vastu-2026-glass'); ?></h3>
        <p><?php esc_html_e('Get instant consultation', 'vastu-2026-glass'); ?></p>
    </div>

</section>