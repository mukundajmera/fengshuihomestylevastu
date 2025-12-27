<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <section class="error-404 not-found">
            <div class="container">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'fengshuihomestyle-vastu'); ?></h1>
                </header>

                <div class="page-content glassmorphism-card">
                    <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try searching or return to the homepage?', 'fengshuihomestyle-vastu'); ?></p>

                    <?php get_search_form(); ?>

                    <div class="error-404-actions" style="margin-top: 2rem;">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-primary">
                            <?php esc_html_e('Return to Homepage', 'fengshuihomestyle-vastu'); ?>
                        </a>
                        
                        <a href="https://wa.me/919828088678?text=Hello%20Sanjay,%20I%20need%20help%20navigating%20the%20website." 
                           class="cta-secondary" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           style="margin-left: 1rem;">
                            <?php esc_html_e('Contact Support via WhatsApp', 'fengshuihomestyle-vastu'); ?>
                        </a>
                    </div>

                    <div class="popular-pages" style="margin-top: 3rem;">
                        <h3><?php esc_html_e('Popular Pages', 'fengshuihomestyle-vastu'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'fengshuihomestyle-vastu'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/blog')); ?>"><?php esc_html_e('Wisdom Hub (Blog)', 'fengshuihomestyle-vastu'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('About Sanjay Jain', 'fengshuihomestyle-vastu'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>"><?php esc_html_e('Contact Us', 'fengshuihomestyle-vastu'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>

<?php
get_footer();
