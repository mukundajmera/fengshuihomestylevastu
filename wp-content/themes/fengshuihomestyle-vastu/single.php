<?php
/**
 * The template for displaying single blog posts
 * 
 * Optimized for conversion with Magnetic CTA blocks and internal linking
 *
 * @package Feng_Shui_Homestyle_Vastu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<main id="main" class="blog-single site-main">
    
    <?php while ( have_posts() ) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post-article' ); ?>>
            
            <!-- Article Header -->
            <header class="article-header">
                <div class="container-narrow">
                    
                    <!-- Category Badge -->
                    <div class="article-categories">
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) {
                            foreach ( $categories as $category ) {
                                echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="category-badge">';
                                echo esc_html( $category->name );
                                echo '</a>';
                            }
                        }
                        ?>
                    </div>
                    
                    <!-- Title -->
                    <h1 class="article-title"><?php the_title(); ?></h1>
                    
                    <!-- Meta Information -->
                    <div class="article-meta">
                        <span class="author-meta">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                            By Sanjay Jain
                        </span>
                        <span class="date-meta">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                            </svg>
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="reading-time-meta">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg>
                            <?php echo fengshuihomestyle_vastu_reading_time(); ?> min read
                        </span>
                    </div>
                    
                    <!-- Featured Image -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="article-featured-image">
                            <?php the_post_thumbnail( 'large', array( 'loading' => 'eager' ) ); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </header>
            
            <!-- Article Content -->
            <div class="article-content">
                <div class="container-narrow">
                    
                    <!-- Main Content -->
                    <div class="content-wrapper">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Magnetic CTA Block (End of Article) -->
                    <div class="magnetic-cta-block glassmorphism-card">
                        <div class="cta-inner">
                            <h3>Is Your Space Aligned for 2025?</h3>
                            <p>Get a 2-minute WhatsApp check with Sanjay Jain. Share your biggest Vastu concern and receive instant guidance.</p>
                            <a href="https://wa.me/919810143516?text=Hi%20Sanjay%2C%20I%20just%20read%20your%20article%20on%20<?php echo urlencode( get_the_title() ); ?>.%20My%20concern%20is..." 
                               class="cta-whatsapp" 
                               target="_blank" 
                               rel="noopener noreferrer">
                                📱 Chat on WhatsApp Now
                            </a>
                            <span class="cta-trust-badge">Join 10,000+ satisfied clients worldwide</span>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <?php
                    $tags = get_the_tags();
                    if ( $tags ) : ?>
                        <div class="article-tags">
                            <span class="tags-label">Tags:</span>
                            <?php foreach ( $tags as $tag ) : ?>
                                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="tag-badge">
                                    <?php echo esc_html( $tag->name ); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Related Posts (Internal Linking for SEO) -->
                    <div class="related-posts-section">
                        <h3 class="related-posts-title">Continue Reading</h3>
                        <div class="related-posts-grid">
                            <?php
                            // Get related posts from same category
                            $categories = get_the_category();
                            $category_ids = array();
                            
                            if ( $categories ) {
                                foreach ( $categories as $category ) {
                                    $category_ids[] = $category->term_id;
                                }
                            }
                            
                            $related_posts = new WP_Query( array(
                                'category__in' => $category_ids,
                                'post__not_in' => array( get_the_ID() ),
                                'posts_per_page' => 3,
                                'orderby' => 'rand',
                            ) );
                            
                            if ( $related_posts->have_posts() ) :
                                while ( $related_posts->have_posts() ) : $related_posts->the_post();
                            ?>
                                    <div class="related-post-card glassmorphism-card">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>" class="related-post-image">
                                                <?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy' ) ); ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="related-post-content">
                                            <h4 class="related-post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h4>
                                            <a href="<?php the_permalink(); ?>" class="related-post-link">Read Article →</a>
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

<?php get_footer(); ?>
