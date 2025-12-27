<?php
/**
 * The template for displaying single service posts
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main single-service">

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class('service-article'); ?>>

                <!-- Service Header -->
                <header class="service-header">
                    <div class="container">
                        <h1 class="service-title"><?php the_title(); ?></h1>
                        
                        <?php if (has_excerpt()) : ?>
                            <div class="service-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="service-featured-image">
                        <div class="container">
                            <?php the_post_thumbnail('large', array('loading' => 'eager')); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Service Content -->
                <div class="service-content">
                    <div class="container">
                        <div class="content-wrapper">
                            <?php the_content(); ?>
                        </div>

                        <!-- Service CTA -->
                        <div class="service-cta glassmorphism-card">
                            <h3><?php esc_html_e('Ready to Transform Your Space?', 'fengshuihomestyle-vastu'); ?></h3>
                            <p><?php esc_html_e('Get personalized Vastu consultation for this service. Chat with Sanjay Jain now.', 'fengshuihomestyle-vastu'); ?></p>
                            <a href="<?php echo esc_url('https://wa.me/919828088678?text=' . urlencode('Hi Sanjay, I am interested in ' . get_the_title() . '. Please guide me.')); ?>" 
                               class="cta-primary" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                📱 <?php esc_html_e('Chat on WhatsApp', 'fengshuihomestyle-vastu'); ?>
                            </a>
                        </div>

                        <!-- Service Benefits Section -->
                        <?php
                        $benefits = get_post_meta(get_the_ID(), 'service_benefits', true);
                        if (!empty($benefits) && is_string($benefits)) :
                        ?>
                            <div class="service-benefits">
                                <h3><?php esc_html_e('Key Benefits', 'fengshuihomestyle-vastu'); ?></h3>
                                <div class="benefits-grid">
                                    <?php
                                    $benefits_array = explode("\n", $benefits);
                                    foreach ($benefits_array as $benefit) :
                                        if (!empty(trim($benefit))) :
                                    ?>
                                        <div class="benefit-item glassmorphism-card">
                                            <span class="benefit-icon">✓</span>
                                            <span class="benefit-text"><?php echo esc_html(trim($benefit)); ?></span>
                                        </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Related Services -->
                        <div class="related-services">
                            <h3><?php esc_html_e('Other Services', 'fengshuihomestyle-vastu'); ?></h3>
                            <div class="related-services-grid">
                                <?php
                                $related_services = new WP_Query(array(
                                    'post_type' => 'service',
                                    'post__not_in' => array(get_the_ID()),
                                    'posts_per_page' => 3,
                                    'orderby' => 'rand',
                                ));

                                if ($related_services->have_posts()) :
                                    while ($related_services->have_posts()) : $related_services->the_post();
                                ?>
                                        <div class="related-service-card glassmorphism-card">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <a href="<?php the_permalink(); ?>" class="service-image">
                                                    <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                                </a>
                                            <?php endif; ?>
                                            <div class="service-card-content">
                                                <h4 class="service-card-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                                <?php if (has_excerpt()) : ?>
                                                    <p class="service-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                                <?php endif; ?>
                                                <a href="<?php the_permalink(); ?>" class="read-more-link">
                                                    <?php esc_html_e('Learn More', 'fengshuihomestyle-vastu'); ?> →
                                                </a>
                                            </div>
                                        </div>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </article>

        <?php endwhile; ?>

    </main>
</div>

<?php
get_footer();
