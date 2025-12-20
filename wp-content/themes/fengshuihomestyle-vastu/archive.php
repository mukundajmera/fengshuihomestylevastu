<?php
/**
 * The template for displaying blog archive pages
 * 
 * This is the "Wisdom Hub" - Blog Feed with Glassmorphism UI
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="wisdom-hub-archive site-main">
    
    <!-- Wisdom Hub Hero -->
    <section class="wisdom-hub-hero">
        <div class="container">
            <h1 class="hub-title">Vastu Wisdom Hub</h1>
            <p class="hub-subtitle">Ancient Knowledge, Modern Precision, Practical Solutions</p>
            
            <!-- Category Filter Tabs -->
            <div class="hub-filters">
                <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="filter-tab <?php echo ! is_category() ? 'active' : ''; ?>">
                    All Articles
                </a>
                <a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Directional Mastery' ) ) ); ?>" class="filter-tab">
                    Directional Mastery
                </a>
                <a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Solutions & Remedies' ) ) ); ?>" class="filter-tab">
                    Solutions & Remedies
                </a>
                <a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Remote Vastu' ) ) ); ?>" class="filter-tab">
                    Remote & Scientific
                </a>
            </div>
        </div>
    </section>

    <!-- Blog Feed Grid -->
    <section class="wisdom-hub-grid">
        <div class="container">
            <div class="blog-posts-grid">
                
                <?php if ( have_posts() ) : ?>
                    
                    <?php while ( have_posts() ) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card glassmorphism-card' ); ?>>
                            
                            <!-- Featured Image with Minimalist Biophilic Style -->
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="blog-card-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy' ) ); ?>
                                    </a>
                                    
                                    <!-- Category Badge -->
                                    <div class="category-badge">
                                        <?php
                                        $categories = get_the_category();
                                        if ( ! empty( $categories ) ) {
                                            echo esc_html( $categories[0]->name );
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Card Content -->
                            <div class="blog-card-content">
                                
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <span class="post-date">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                        </svg>
                                        <?php echo get_the_date(); ?>
                                    </span>
                                    <span class="reading-time">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                        </svg>
                                        <?php echo fengshuihomestyle_vastu_reading_time(); ?> min read
                                    </span>
                                </div>
                                
                                <!-- Title -->
                                <h2 class="blog-card-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <!-- Excerpt -->
                                <div class="blog-card-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                                </div>
                                
                                <!-- Read More Link -->
                                <a href="<?php the_permalink(); ?>" class="read-more-link">
                                    Read Full Article
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                    </svg>
                                </a>
                                
                            </div>
                        </article>
                        
                    <?php endwhile; ?>
                    
                    <!-- Pagination -->
                    <div class="blog-pagination">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => __( '← Previous', 'fengshuihomestyle-vastu' ),
                            'next_text' => __( 'Next →', 'fengshuihomestyle-vastu' ),
                        ) );
                        ?>
                    </div>
                    
                <?php else : ?>
                    
                    <!-- No Posts Found -->
                    <div class="no-posts-found glassmorphism-card">
                        <h2>No articles found</h2>
                        <p>We're constantly adding new Vastu wisdom. Check back soon or explore other categories.</p>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cta-primary">
                            Return to Homepage
                        </a>
                    </div>
                    
                <?php endif; ?>
                
            </div>
            
            <!-- Sidebar: Lead Magnet & Popular Posts -->
            <aside class="wisdom-hub-sidebar">
                
                <!-- Lead Magnet CTA -->
                <div class="sidebar-widget glassmorphism-card lead-magnet-widget">
                    <h3>Free Vastu Readiness Checklist</h3>
                    <p>Get our comprehensive 25-Point Vastu Readiness Checklist for new homeowners.</p>
                    <a href="<?php echo esc_url( home_url( '/download-checklist' ) ); ?>" class="cta-secondary">
                        📥 Download Free PDF
                    </a>
                </div>
                
                <!-- Popular Posts -->
                <div class="sidebar-widget glassmorphism-card popular-posts-widget">
                    <h3>Most Read Articles</h3>
                    <?php
                    $popular_posts = new WP_Query( array(
                        'posts_per_page' => 5,
                        'meta_key' => 'post_views_count',
                        'orderby' => 'meta_value_num',
                        'order' => 'DESC',
                    ) );
                    
                    if ( $popular_posts->have_posts() ) :
                        echo '<ul class="popular-posts-list">';
                        while ( $popular_posts->have_posts() ) : $popular_posts->the_post();
                            echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                        endwhile;
                        echo '</ul>';
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                
                <!-- WhatsApp Consultation CTA -->
                <div class="sidebar-widget glassmorphism-card whatsapp-sidebar-cta">
                    <h3>Have a Specific Question?</h3>
                    <p>Chat with Sanjay Jain for instant Vastu guidance.</p>
                    <a href="https://wa.me/919810143516?text=Hi%20Sanjay%2C%20I%20need%20Vastu%20help%20with..." 
                       class="cta-primary" 
                       target="_blank" 
                       rel="noopener noreferrer">
                        📱 WhatsApp Now
                    </a>
                </div>
                
            </aside>
            
        </div>
    </section>
    
</main>

<?php get_footer(); ?>
