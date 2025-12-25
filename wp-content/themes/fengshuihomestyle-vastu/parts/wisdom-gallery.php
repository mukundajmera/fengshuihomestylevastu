<?php
/**
 * Template Part: Wisdom Gallery
 * 
 * Displays the latest blog posts as swipeable "Glass Cards" with
 * WhatsApp sharing and embedded Article Schema for SEO.
 *
 * @package FengShuiHomestyle_Vastu
 */

defined('ABSPATH') || exit;

// Query Arguments
$wisdom_args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'post_status' => 'publish',
);

$wisdom_query = new WP_Query($wisdom_args);

// Fallback placeholder image
$fallback_image = get_template_directory_uri() . '/assets/images/placeholder-wisdom.jpg';
?>

<section class="wisdom-gallery" aria-label="Vastu Wisdom Articles">
    <div class="wisdom-gallery__header">
        <h2 class="wisdom-gallery__title">Vastu Wisdom</h2>
        <p class="wisdom-gallery__subtitle">Discover timeless insights for harmonious living</p>
    </div>

    <?php if ($wisdom_query->have_posts()): ?>
        <div class="wisdom-gallery__grid">
            <?php while ($wisdom_query->have_posts()):
                $wisdom_query->the_post();
                // Get post data
                $post_id = get_the_ID();
                $title = get_the_title();
                $permalink = get_permalink();
                $excerpt = wp_trim_words(get_the_excerpt(), 15, '...');
                $date_published = get_the_date('c'); // ISO 8601 format
                $date_display = get_the_date('M j, Y');

                // Get featured image or fallback
                $thumbnail_url = has_post_thumbnail()
                    ? get_the_post_thumbnail_url($post_id, 'medium_large')
                    : $fallback_image;

                // Author data for schema
                $author_name = get_the_author();
                $author_url = get_author_posts_url(get_the_author_meta('ID'));

                // WhatsApp Share Link (URL Encoded)
                $whatsapp_text = rawurlencode("Read this Vastu tip: {$title} - {$permalink}");
                $whatsapp_link = "https://wa.me/?text={$whatsapp_text}";

                // Build Article Schema
                $article_schema = array(
                    '@context' => 'https://schema.org',
                    '@type' => 'Article',
                    'headline' => $title,
                    'image' => $thumbnail_url,
                    'datePublished' => $date_published,
                    'author' => array(
                        '@type' => 'Person',
                        'name' => $author_name,
                        'url' => $author_url,
                    ),
                    'mainEntityOfPage' => array(
                        '@type' => 'WebPage',
                        '@id' => $permalink,
                    ),
                );
                ?>
                <!-- Glass Card -->
                <article class="glass-card wisdom-card" data-post-id="<?php echo esc_attr($post_id); ?>">

                    <!-- WhatsApp Share Button -->
                    <a href="<?php echo esc_url($whatsapp_link); ?>" class="wisdom-card__share" target="_blank"
                        rel="noopener noreferrer" aria-label="Share on WhatsApp">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                    </a>

                    <!-- Card Image -->
                    <div class="wisdom-card__image">
                        <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr($title); ?>"
                            loading="lazy" />
                    </div>

                    <!-- Card Content -->
                    <div class="wisdom-card__content">
                        <time class="wisdom-card__date" datetime="<?php echo esc_attr($date_published); ?>">
                            <?php echo esc_html($date_display); ?>
                        </time>

                        <h3 class="wisdom-card__title">
                            <a href="<?php echo esc_url($permalink); ?>">
                                <?php echo esc_html($title); ?>
                            </a>
                        </h3>

                        <p class="wisdom-card__excerpt"><?php echo esc_html($excerpt); ?></p>

                        <a href="<?php echo esc_url($permalink); ?>" class="wisdom-card__cta">
                            Read More
                            <svg class="wisdom-card__arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    </div>

                    <!-- JSON-LD Schema -->
                    <script type="application/ld+json">
                                <?php echo wp_json_encode($article_schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
                            </script>
                </article>

            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="wisdom-gallery__empty">No wisdom articles found. Check back soon!</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
</section>

<style>
    /* ==========================================================================
   WISDOM GALLERY - Glass Card Grid & Snap-Scroll
   ========================================================================== */

    .wisdom-gallery {
        padding: 4rem 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .wisdom-gallery__header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .wisdom-gallery__title {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700;
        background: linear-gradient(135deg, var(--color-accent, #8B5CF6), var(--color-primary, #059669));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .wisdom-gallery__subtitle {
        color: var(--color-text-muted, #64748B);
        font-size: 1.1rem;
    }

    /* Grid Layout - Desktop: 3 columns */
    .wisdom-gallery__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    /* Wisdom Card - Glass Effect */
    .wisdom-card {
        position: relative;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow:
            0 8px 32px rgba(0, 0, 0, 0.08),
            inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .wisdom-card:hover {
        transform: translateY(-8px);
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.12),
            inset 0 0 0 1px rgba(255, 255, 255, 0.3);
    }

    /* Share Button */
    .wisdom-card__share {
        position: absolute;
        top: 1rem;
        right: 1rem;
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        border-radius: 50%;
        color: #25D366;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, background 0.2s ease;
    }

    .wisdom-card__share:hover {
        transform: scale(1.1);
        background: #25D366;
        color: white;
    }

    /* Card Image */
    .wisdom-card__image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .wisdom-card__image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .wisdom-card:hover .wisdom-card__image img {
        transform: scale(1.05);
    }

    /* Card Content */
    .wisdom-card__content {
        padding: 1.5rem;
    }

    .wisdom-card__date {
        display: block;
        font-size: 0.8rem;
        color: var(--color-text-muted, #64748B);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .wisdom-card__title {
        font-size: 1.2rem;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 0.75rem;
    }

    .wisdom-card__title a {
        color: var(--color-text, #1E293B);
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .wisdom-card__title a:hover {
        color: var(--color-primary, #059669);
    }

    .wisdom-card__excerpt {
        font-size: 0.95rem;
        color: var(--color-text-muted, #64748B);
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    /* Read More CTA with Arrow Animation */
    .wisdom-card__cta {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--color-primary, #059669);
        text-decoration: none;
        transition: gap 0.3s ease;
    }

    .wisdom-card__cta:hover {
        gap: 0.75rem;
    }

    .wisdom-card__arrow {
        transition: transform 0.3s ease;
    }

    .wisdom-card__cta:hover .wisdom-card__arrow {
        transform: translateX(4px);
    }

    /* Empty State */
    .wisdom-gallery__empty {
        text-align: center;
        color: var(--color-text-muted, #64748B);
        font-style: italic;
        padding: 3rem;
    }

    /* ==========================================================================
   MOBILE: Horizontal Snap-Scroll (Swipeable Cards)
   ========================================================================== */

    @media (max-width: 1024px) {
        .wisdom-gallery__grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .wisdom-gallery {
            padding: 3rem 1rem;
        }

        .wisdom-gallery__grid {
            display: flex;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            -webkit-overflow-scrolling: touch;
            gap: 1rem;
            padding-bottom: 1rem;
            margin: 0 -1rem;
            padding-left: 1rem;
            padding-right: 1rem;

            /* Hide scrollbar but keep functionality */
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .wisdom-gallery__grid::-webkit-scrollbar {
            display: none;
        }

        .wisdom-card {
            flex: 0 0 85%;
            scroll-snap-align: start;
            min-width: 280px;
            max-width: 320px;
        }

        .wisdom-card__image {
            height: 180px;
        }

        .wisdom-card__content {
            padding: 1.25rem;
        }

        .wisdom-card__title {
            font-size: 1.1rem;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .wisdom-card {
            background: rgba(30, 41, 59, 0.7);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .wisdom-card__title a {
            color: #F1F5F9;
        }

        .wisdom-card__share {
            background: rgba(30, 41, 59, 0.9);
        }
    }
</style>