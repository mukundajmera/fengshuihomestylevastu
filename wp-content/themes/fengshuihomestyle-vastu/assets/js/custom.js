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

        // Kua Number Calculator
        $('#calculate-kua').on('click', function(e) {
            e.preventDefault();
            var yearInput = $('#kua-year').val();
            var year = parseInt(yearInput);
            var gender = $('#kua-gender').val();
            var result = 0;
            var description = "";

            // Input validation - Error handling for non-numeric or invalid year
            if (!yearInput || yearInput.trim() === '') {
                alert("Please enter your birth year.");
                $('#kua-year').focus();
                return;
            }

            if (isNaN(year)) {
                alert("Please enter a valid numeric year (e.g., 1985).");
                $('#kua-year').val('').focus();
                return;
            }

            var currentYear = new Date().getFullYear();
            if (year < 1900 || year > currentYear) {
                alert("Please enter a valid birth year between 1900 and " + currentYear + ".");
                $('#kua-year').focus();
                return;
            }

            // Kua Calculation Logic
            var sum = 0;
            var yearStr = year.toString();
            // Sum last two digits
            // Actually, sum ALL digits until single digit is common, but strict Kua formula is:
            // 1. Sum digits of year until single digit? No.
            // Simplified Formula:
            // Add the last two digits of the year of birth. If the result is 10 or greater, add the two digits to get a single number.

            // Standard Kua Formula:
            // Sum of digits of the year.
            var sumDigits = 0;
            var digits = yearStr.split('');
            // Usually we take the whole year sum until single digit.
            // Let's use the standard algorithm:
            // Add all digits of year. If > 9, add again.
            // Example: 1985 -> 1+9+8+5 = 23 -> 2+3 = 5.

            // Wait, typical Kua formula is:
            // 1. Add the last two digits of birth year. (e.g. 1985 -> 8+5=13 -> 1+3=4).
            // 2. Male: 10 - result (if born before 2000). 9 - result (if born after 2000? No).
            // Let's use the robust "Sum of all digits to single digit" approach then apply offset.
            // Kua Number Calculation:
            // Step 1: Add the last two digits of the year of birth. If the result is a double-digit number, add the two digits together to get a single number.
            // Example 1985: 8+5=13 -> 1+3 = 4.

            var lastTwo = year % 100;
            var d1 = Math.floor(lastTwo / 10);
            var d2 = lastTwo % 10;
            var kSum = d1 + d2;
            while (kSum > 9) {
                kSum = Math.floor(kSum / 10) + (kSum % 10);
            }

            // Step 2:
            if (gender === 'male') {
                // For Male: 10 - kSum (if born < 2000). 9 - kSum (if born >= 2000).
                // Actually, standard is: Before 2000: 10 - kSum. After 2000: 9 - kSum.
                // Wait, some sources say for 2000+, use 9. Let's stick to standard pre-2000 logic mainly or adjust.
                // Correct universal:
                // Pre-2000 Male: 10 - kSum.
                // 2000+ Male: 9 - kSum.

                var base = (year < 2000) ? 10 : 9;
                result = base - kSum;
                // If result is negative or 0? (e.g. 9-9=0 -> 9).
                // Let's handle wrapping.
                // Actually, if year is 2000+: 9 - kSum. Ex: 2000 -> 0+0=0. 9-0=9. Correct.
                // Ex: 2009 -> 0+9=9. 9-9=0. If 0, it becomes 9.
                // Wait, if result is 0, it is 9? No, Kua 9 is Fire.
                // Let's verify Kua 2009 Male: 9. (9-9=0, so 9).

                if (result <= 0) result += 9; // Handling edge cases if any

            } else {
                // For Female:
                // Pre-2000: 5 + kSum.
                // 2000+: 6 + kSum.

                var base = (year < 2000) ? 5 : 6;
                result = base + kSum;
                if (result > 9) {
                     result = Math.floor(result / 10) + (result % 10); // Reduce to single digit
                }
            }

            // Kua 5 exception:
            // Male 5 becomes 2.
            // Female 5 becomes 8.
            if (result === 5) {
                if (gender === 'male') result = 2;
                else result = 8;
            }

            // Display
            $('#kua-number-display').text(result);

            var group = (result === 1 || result === 3 || result === 4 || result === 9) ? "East Group" : "West Group";
            var element = "";
            switch(result) {
                case 1: element = "Water (Career)"; break;
                case 2: element = "Earth (Relationships)"; break;
                case 3: element = "Wood (Growth)"; break;
                case 4: element = "Wood (Wealth)"; break;
                case 6: element = "Metal (Helpful People)"; break;
                case 7: element = "Metal (Creativity)"; break;
                case 8: element = "Earth (Knowledge)"; break;
                case 9: element = "Fire (Fame)"; break;
            }

            $('#kua-description').html("<strong>Element:</strong> " + element + "<br><strong>Group:</strong> " + group + "<br><em>Unlock your specific directions in a full consultation.</em>");

            $('#kua-result').addClass('active');
        });

        // Console welcome message
        console.log('%c🏡 Feng Shui Homestyle Vastu', 'font-size: 20px; color: #648E7B; font-weight: bold;');
        console.log('%cScientific Vastu: Harmony without Demolition', 'font-size: 14px; color: #2E2B59;');

    });

})(jQuery);
