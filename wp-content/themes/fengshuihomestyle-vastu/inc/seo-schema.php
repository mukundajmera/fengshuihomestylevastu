<?php
/**
 * Vastu Schema Generator - Entity Graph SEO Engine
 *
 * Generates JSON-LD structured data for Answer Engine optimization
 * (ChatGPT/Google SGE) and Core Web Vitals compliance.
 *
 * @package Feng_Shui_Homestyle_Vastu
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Vastu_Schema_Generator
 *
 * Generates context-aware JSON-LD schemas based on page type
 * to maximize visibility in AI-powered search results.
 */
class Vastu_Schema_Generator
{
    /**
     * Organization constants
     */
    private const ORG_NAME = 'Feng Shui Homestyle Vastu';
    private const FOUNDER_NAME = 'Sanjay Jain';
    private const FOUNDER_TITLE = 'Scientific Vastu Expert';
    private const PHONE = '+919828088678';

    /**
     * Social profile URLs for sameAs
     */
    private const SOCIAL_PROFILES = [
        'https://www.linkedin.com/in/sanjayjainvastu',
        'https://www.instagram.com/fengshuihomestylevastu',
        'https://www.facebook.com/fengshuihomestylevastu',
    ];

    /**
     * Geographic areas served
     */
    private const AREAS_SERVED = [
        'Global',
        'USA',
        'India',
        'UAE',
        'Singapore',
        'United Kingdom',
        'Canada',
        'Australia',
    ];

    /**
     * Service offerings
     */
    private const SERVICES = [
        [
            'name' => 'Home Vastu Audit',
            'description' => 'Complete residential energy analysis using True North Satellite Mapping and AutoCAD floor plan analysis for health, wealth, and harmony.',
        ],
        [
            'name' => 'Factory & Industrial Vastu',
            'description' => 'Industrial space optimization for enhanced productivity, safety, and profitability without structural demolition.',
        ],
        [
            'name' => 'Commercial Office Vastu',
            'description' => 'Business space energy alignment for improved team dynamics, success, and growth.',
        ],
        [
            'name' => 'Remote Scientific Consultation',
            'description' => '100% remote Vastu consultation using satellite imagery and scientific analysis methods.',
        ],
        [
            'name' => 'New Construction Guidance',
            'description' => 'Vastu-compliant planning for new homes and buildings from the foundation stage.',
        ],
        [
            'name' => 'Vastu Remedies (No Demolition)',
            'description' => 'Non-invasive energy corrections using elements, colors, and strategic placements.',
        ],
    ];

    /**
     * Constructor - Register hooks
     */
    public function __construct()
    {
        add_action('wp_head', [$this, 'output_schema'], 5);
    }

    /**
     * Output minified JSON-LD schema based on page type
     */
    public function output_schema(): void
    {
        $schema = $this->get_page_schema();

        if (empty($schema)) {
            return;
        }

        // Output strictly minified JSON-LD
        echo '<script type="application/ld+json">' .
            wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
            '</script>' . "\n";
    }

    /**
     * Get appropriate schema based on current page type
     *
     * @return array Schema data
     */
    private function get_page_schema(): array
    {
        $schemas = [];

        // Always include Organization schema
        $schemas[] = $this->get_organization_schema();

        // Add page-specific schema
        if (is_singular('post')) {
            $schemas[] = $this->get_article_schema();
        } elseif (is_front_page()) {
            $schemas[] = $this->get_website_schema();
            $schemas[] = $this->get_local_business_schema();
        } elseif (is_page()) {
            $schemas[] = $this->get_webpage_schema();
        } elseif (is_archive() || is_category()) {
            $schemas[] = $this->get_collection_page_schema();
        }

        // Add BreadcrumbList for non-front pages
        if (!is_front_page()) {
            $schemas[] = $this->get_breadcrumb_schema();
        }

        // Return @graph format for multiple schemas
        return [
            '@context' => 'https://schema.org',
            '@graph' => $schemas,
        ];
    }

    /**
     * Get ConsultingService Organization schema
     *
     * @return array Organization schema
     */
    private function get_organization_schema(): array
    {
        return [
            '@type' => 'ConsultingService',
            '@id' => home_url('/#organization'),
            'name' => self::ORG_NAME,
            'url' => home_url(),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => get_stylesheet_directory_uri() . '/assets/images/logo.png',
                'width' => 600,
                'height' => 60,
            ],
            'image' => get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg',
            'telephone' => self::PHONE,
            'email' => 'contact@fengshuihomestylevastu.com',
            'founder' => $this->get_founder_schema(),
            'areaServed' => array_map(function ($area) {
                return [
                    '@type' => 'Place',
                    'name' => $area,
                ];
            }, self::AREAS_SERVED),
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Vastu & Feng Shui Consultation Services',
                'itemListElement' => array_map(function ($service, $index) {
                    return [
                        '@type' => 'Offer',
                        'position' => $index + 1,
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => $service['name'],
                            'description' => $service['description'],
                            'provider' => [
                                '@id' => home_url('/#organization'),
                            ],
                        ],
                    ];
                }, self::SERVICES, array_keys(self::SERVICES)),
            ],
            'slogan' => 'Scientific Vastu: Harmony without Demolition',
            'description' => 'Expert Vastu Shastra & Feng Shui consultations with 25+ years of experience. 100% remote, 0% demolition. Transform your space for health, wealth, and harmony.',
            'knowsLanguage' => ['English', 'Hindi'],
            'priceRange' => '$$',
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => '4.9',
                'reviewCount' => '10000',
                'bestRating' => '5',
                'worstRating' => '1',
            ],
            'sameAs' => self::SOCIAL_PROFILES,
        ];
    }

    /**
     * Get Person schema for founder
     *
     * @return array Person schema
     */
    private function get_founder_schema(): array
    {
        return [
            '@type' => 'Person',
            '@id' => home_url('/#founder'),
            'name' => self::FOUNDER_NAME,
            'jobTitle' => self::FOUNDER_TITLE,
            'description' => 'Leading Scientific Vastu Expert with 25+ years of experience. Pioneer in remote Vastu consultations using satellite mapping and AutoCAD analysis.',
            'knowsAbout' => [
                'Vastu Shastra',
                'Feng Shui',
                'Five Elements Theory',
                'Spatial Energy Optimization',
                'Scientific Remote Consultation',
                'AutoCAD Floor Plan Analysis',
            ],
            'sameAs' => self::SOCIAL_PROFILES,
            'worksFor' => [
                '@id' => home_url('/#organization'),
            ],
        ];
    }

    /**
     * Get TechArticle schema for blog posts
     *
     * @return array Article schema
     */
    private function get_article_schema(): array
    {
        global $post;

        $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'large');
        if (!$thumbnail_url) {
            $thumbnail_url = get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg';
        }

        // Calculate word count for reading time
        $content = get_post_field('post_content', $post->ID);
        $word_count = str_word_count(strip_tags($content));

        return [
            '@type' => 'TechArticle',
            '@id' => get_permalink() . '#article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt() ?: wp_trim_words(strip_tags($content), 30),
            'image' => [
                '@type' => 'ImageObject',
                'url' => $thumbnail_url,
            ],
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => [
                '@id' => home_url('/#founder'),
            ],
            'publisher' => [
                '@id' => home_url('/#organization'),
            ],
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => get_permalink(),
            ],
            'proficiencyLevel' => 'Expert',
            'about' => [
                '@type' => 'Thing',
                '@id' => home_url('/#vastu-shastra'),
                'name' => 'Vastu Shastra',
                'description' => 'Ancient Indian science of architecture and spatial arrangement for harmonious living.',
                'sameAs' => 'https://en.wikipedia.org/wiki/Vastu_shastra',
            ],
            'wordCount' => $word_count,
            'articleSection' => $this->get_article_categories(),
            'inLanguage' => 'en-US',
            'isAccessibleForFree' => true,
            'speakable' => [
                '@type' => 'SpeakableSpecification',
                'cssSelector' => ['.entry-title', '.entry-content p:first-of-type'],
            ],
        ];
    }

    /**
     * Get article categories
     *
     * @return array Category names
     */
    private function get_article_categories(): array
    {
        $categories = get_the_category();
        if (empty($categories)) {
            return ['Vastu Shastra'];
        }

        return array_map(function ($cat) {
            return $cat->name;
        }, $categories);
    }

    /**
     * Get WebSite schema for front page
     *
     * @return array WebSite schema
     */
    private function get_website_schema(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => home_url('/#website'),
            'url' => home_url(),
            'name' => self::ORG_NAME,
            'description' => get_bloginfo('description'),
            'publisher' => [
                '@id' => home_url('/#organization'),
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => home_url('/?s={search_term_string}'),
                ],
                'query-input' => 'required name=search_term_string',
            ],
            'inLanguage' => 'en-US',
        ];
    }

    /**
     * Get LocalBusiness schema for front page
     *
     * @return array LocalBusiness schema
     */
    private function get_local_business_schema(): array
    {
        return [
            '@type' => 'LocalBusiness',
            '@id' => home_url('/#localbusiness'),
            'name' => self::ORG_NAME,
            'image' => get_stylesheet_directory_uri() . '/assets/images/hero-serene-living-space.jpg',
            'telephone' => self::PHONE,
            'priceRange' => '$$',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Jaipur',
                'addressRegion' => 'Rajasthan',
                'addressCountry' => 'IN',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => 26.9124,
                'longitude' => 75.7873,
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '09:00',
                'closes' => '18:00',
            ],
            'sameAs' => self::SOCIAL_PROFILES,
        ];
    }

    /**
     * Get WebPage schema for static pages
     *
     * @return array WebPage schema
     */
    private function get_webpage_schema(): array
    {
        return [
            '@type' => 'WebPage',
            '@id' => get_permalink() . '#webpage',
            'url' => get_permalink(),
            'name' => get_the_title(),
            'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 30),
            'isPartOf' => [
                '@id' => home_url('/#website'),
            ],
            'inLanguage' => 'en-US',
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
        ];
    }

    /**
     * Get CollectionPage schema for archives
     *
     * @return array CollectionPage schema
     */
    private function get_collection_page_schema(): array
    {
        $title = is_category() ? single_cat_title('', false) : get_the_archive_title();
        $description = is_category() ? category_description() : get_the_archive_description();

        return [
            '@type' => 'CollectionPage',
            '@id' => get_permalink() . '#collectionpage',
            'url' => get_permalink(),
            'name' => $title,
            'description' => $description ?: 'Browse our collection of Vastu Shastra and Feng Shui articles.',
            'isPartOf' => [
                '@id' => home_url('/#website'),
            ],
            'inLanguage' => 'en-US',
        ];
    }

    /**
     * Get BreadcrumbList schema
     *
     * @return array BreadcrumbList schema
     */
    private function get_breadcrumb_schema(): array
    {
        $breadcrumbs = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => home_url(),
            ],
        ];

        $position = 2;

        // Add category for posts
        if (is_singular('post')) {
            $categories = get_the_category();
            if (!empty($categories)) {
                $breadcrumbs[] = [
                    '@type' => 'ListItem',
                    'position' => $position++,
                    'name' => $categories[0]->name,
                    'item' => get_category_link($categories[0]->term_id),
                ];
            }
        }

        // Add current page
        $breadcrumbs[] = [
            '@type' => 'ListItem',
            'position' => $position,
            'name' => is_archive() ? get_the_archive_title() : get_the_title(),
            'item' => get_permalink(),
        ];

        return [
            '@type' => 'BreadcrumbList',
            '@id' => get_permalink() . '#breadcrumb',
            'itemListElement' => $breadcrumbs,
        ];
    }

    /**
     * Get FAQ schema (for FAQ pages/sections)
     *
     * @param array $faqs Array of question/answer pairs
     * @return array FAQPage schema
     */
    public static function get_faq_schema(array $faqs): array
    {
        return [
            '@type' => 'FAQPage',
            'mainEntity' => array_map(function ($faq) {
                return [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $faq['answer'],
                    ],
                ];
            }, $faqs),
        ];
    }

    /**
     * Get HowTo schema (for tutorial/guide content)
     *
     * @param string $name Guide name
     * @param string $description Guide description
     * @param array $steps Array of step arrays with 'name' and 'text'
     * @return array HowTo schema
     */
    public static function get_howto_schema(string $name, string $description, array $steps): array
    {
        return [
            '@type' => 'HowTo',
            'name' => $name,
            'description' => $description,
            'step' => array_map(function ($step, $index) {
                return [
                    '@type' => 'HowToStep',
                    'position' => $index + 1,
                    'name' => $step['name'],
                    'text' => $step['text'],
                ];
            }, $steps, array_keys($steps)),
        ];
    }
}

// Initialize the schema generator
new Vastu_Schema_Generator();
