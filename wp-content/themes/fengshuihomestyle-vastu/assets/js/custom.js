/**
 * Custom JavaScript for Feng Shui Homestyle Vastu Theme
 * Micro-interactions and Dynamic Effects
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Service Tabs Functionality
        $('.tab-button').on('click', function() {
            var tabId = $(this).data('tab');
            
            // Remove active class and update ARIA from all tabs and contents
            $('.tab-button').removeClass('active').attr('aria-selected', 'false');
            $('.tab-content').removeClass('active');
            
            // Add active class and update ARIA to clicked tab and corresponding content
            $(this).addClass('active').attr('aria-selected', 'true');
            $('#' + tabId).addClass('active');
        });

        // Activate first tab by default
        if ($('.tab-button').length > 0) {
            $('.tab-button').first().addClass('active').attr('aria-selected', 'true');
            $('.tab-content').first().addClass('active');
        }

        // Smooth scroll for anchor links
        $('a[href*="#"]').on('click', function(e) {
            if (this.hash !== '') {
                var target = $(this.hash);
                if (target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800, 'swing');
                }
            }
        });

        // Ripple effect on click
        $('.ripple-effect, .cta-primary, .tab-button').on('click', function(e) {
            var $ripple = $('<span class="ripple"></span>');
            var $button = $(this);
            var btnOffset = $button.offset();
            var xPos = e.pageX - btnOffset.left;
            var yPos = e.pageY - btnOffset.top;

            $ripple.css({
                top: yPos,
                left: xPos
            }).appendTo($button);

            setTimeout(function() {
                $ripple.remove();
            }, 600);
        });

        // Parallax effect for hero video background
        if ($('.hero-video-bg').length) {
            $(window).on('scroll', function() {
                var scrolled = $(window).scrollTop();
                $('.hero-video-bg').css('transform', 'translateY(' + (scrolled * 0.5) + 'px)');
            });
        }

        // Fade in elements on scroll
        function fadeInOnScroll() {
            $('.glass-card, .service-card').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('fade-in-visible');
                }
            });
        }

        $(window).on('scroll', fadeInOnScroll);
        fadeInOnScroll(); // Initial check

        // Add fade-in class
        $('<style>')
            .text('.glass-card, .service-card { opacity: 0; transform: translateY(30px); transition: all 0.6s ease; } ' +
                  '.fade-in-visible { opacity: 1 !important; transform: translateY(0) !important; }')
            .appendTo('head');

        // Lazy load video background
        if ($('.hero-video-bg').length && 'IntersectionObserver' in window) {
            var videoObserver = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var video = entry.target;
                        // Video already has src attribute, just ensure it plays
                        if (video.paused) {
                            video.play().catch(function(error) {
                                console.log('Video autoplay prevented:', error);
                            });
                        }
                        videoObserver.unobserve(video);
                    }
                });
            });

            $('.hero-video-bg').each(function() {
                videoObserver.observe(this);
            });
        }

        // Counter animation for trust markers
        function animateCounter() {
            $('.trust-counter').each(function() {
                var $this = $(this);
                var countTo = parseInt($this.text().replace(/,/g, ''));
                
                if (!$this.hasClass('counted')) {
                    $this.addClass('counted');
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum).toLocaleString());
                        },
                        complete: function() {
                            $this.text(countTo.toLocaleString());
                        }
                    });
                }
            });
        }

        // Trigger counter animation when visible
        var counterObserver = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter();
                }
            });
        });

        if ($('.trust-strip').length) {
            counterObserver.observe($('.trust-strip')[0]);
        }

        // Mobile menu optimization for thumb zone
        if ($(window).width() <= 768) {
            // Move navigation to bottom on mobile
            var $mobileNav = $('.mobile-nav-wrapper');
            if ($mobileNav.length) {
                $mobileNav.css({
                    'position': 'fixed',
                    'bottom': '0',
                    'left': '0',
                    'right': '0',
                    'z-index': '999'
                });
            }
        }

        // Performance: Debounce scroll events
        function debounce(func, wait) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    func.apply(context, args);
                }, wait);
            };
        }

        $(window).on('scroll', debounce(function() {
            fadeInOnScroll();
        }, 10));

        // Add loading state to CTAs
        $('.cta-primary').on('click', function() {
            var $btn = $(this);
            if (!$btn.hasClass('whatsapp-cta')) {
                $btn.addClass('loading');
                setTimeout(function() {
                    $btn.removeClass('loading');
                }, 1000);
            }
        });

        // Accessibility: Keyboard navigation for tabs
        $('.tab-button').on('keydown', function(e) {
            if (e.keyCode === 13 || e.keyCode === 32) { // Enter or Space
                e.preventDefault();
                $(this).trigger('click');
            }
        });

        // Touch feedback for mobile
        if ('ontouchstart' in window) {
            $('.cta-primary, .tab-button, .glass-card').on('touchstart', function() {
                $(this).addClass('touch-active');
            }).on('touchend', function() {
                var $this = $(this);
                setTimeout(function() {
                    $this.removeClass('touch-active');
                }, 300);
            });

            $('<style>')
                .text('.touch-active { opacity: 0.8; transform: scale(0.98); }')
                .appendTo('head');
        }

        // Console welcome message
        console.log('%c🏡 Feng Shui Homestyle Vastu', 'font-size: 20px; color: #648E7B; font-weight: bold;');
        console.log('%cScientific Vastu: Harmony without Demolition', 'font-size: 14px; color: #2E2B59;');

    });

})(jQuery);
