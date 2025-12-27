<?php
/**
 * The template for displaying search results pages
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main search-results">

        <header class="page-header">
            <div class="container">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf(esc_html__('Search Results for: %s', 'fengshuihomestyle-vastu'), '<span>' . esc_html(get_search_query()) . '</span>');
                    ?>
                </h1>
            </div>
        </header>

        <section class="search-results-section">
            <div class="container">
                <?php if (have_posts()) : ?>

                    <div class="search-results-grid">
                        <?php
                        while (have_posts()) :
                            the_post();
                            ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-card glassmorphism-card'); ?>>
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="result-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('loading' => 'lazy')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="result-content">
                                    <header class="entry-header">
                                        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                                    </header>

                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                    </div>

                                    <div class="entry-meta">
                                        <span class="post-type">
                                            <?php echo esc_html(get_post_type_object(get_post_type())->labels->singular_name); ?>
                                        </span>
                                        <span class="post-date">
                                            <?php echo get_the_date(); ?>
                                        </span>
                                    </div>

                                    <a href="<?php the_permalink(); ?>" class="read-more-link">
                                        <?php esc_html_e('Read More', 'fengshuihomestyle-vastu'); ?> →
                                    </a>
                                </div>
                            </article>

                        <?php endwhile; ?>
                    </div>

                    <div class="pagination">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => __('← Previous', 'fengshuihomestyle-vastu'),
                            'next_text' => __('Next →', 'fengshuihomestyle-vastu'),
                        ));
                        ?>
                    </div>

                <?php else : ?>

                    <div class="no-results glassmorphism-card">
                        <h2><?php esc_html_e('Nothing Found', 'fengshuihomestyle-vastu'); ?></h2>
                        <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'fengshuihomestyle-vastu'); ?></p>
                        
                        <?php get_search_form(); ?>

                        <div class="search-suggestions" style="margin-top: 2rem;">
                            <h3><?php esc_html_e('Search Suggestions:', 'fengshuihomestyle-vastu'); ?></h3>
                            <ul>
                                <li><?php esc_html_e('Try using more general keywords', 'fengshuihomestyle-vastu'); ?></li>
                                <li><?php esc_html_e('Check your spelling', 'fengshuihomestyle-vastu'); ?></li>
                                <li><?php esc_html_e('Try different keywords', 'fengshuihomestyle-vastu'); ?></li>
                                <li><?php esc_html_e('Search for Vastu topics like: bedroom, kitchen, entrance, wealth, health', 'fengshuihomestyle-vastu'); ?></li>
                            </ul>
                        </div>

                        <div class="search-alternatives" style="margin-top: 2rem;">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-primary">
                                <?php esc_html_e('Return to Homepage', 'fengshuihomestyle-vastu'); ?>
                            </a>
                            <?php
                            $whatsapp_message = sprintf(
                                "Hello Sanjay, I couldn't find information about %s.",
                                get_search_query()
                            );
                            $whatsapp_url = 'https://wa.me/919828088678?text=' . rawurlencode($whatsapp_message);
                            ?>
                            <a href="<?php echo esc_url($whatsapp_url); ?>" 
                               class="cta-secondary" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               style="margin-left: 1rem;">
                                <?php esc_html_e('Ask Sanjay Directly', 'fengshuihomestyle-vastu'); ?>
                            </a>
                        </div>
                    </div>

                <?php endif; ?>
            </div>
        </section>

    </main>
</div>

<?php
get_footer();
