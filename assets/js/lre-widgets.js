/**
 * Luxury Real Estate Widgets â€” Master Client-side JavaScript Suite
 * High-performance, GPU-accelerated luxury real estate interactivity.
 *
 * @package Luxury_RE_Widgets
 */

(function ( window, document, $ ) {
    'use strict';

    window.LREWidgets = window.LREWidgets || {};

    var prefersReducedMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

    // =========================================================================
    // 1. UNIVERSAL SCROLL REVEAL ENGINE
    // =========================================================================
    LREWidgets.initReveals = function ( $scope ) {
        var root = ( $scope && $scope.length ) ? $scope[0] : document;
        var revealEls = root.querySelectorAll( '.reveal, .reveal--left, .reveal--right, .reveal--zoom, .reveal--stagger' );
        var imageRevealEls = root.querySelectorAll( '.image-reveal' );

        var triggerElementReveal = function ( el ) {
            el.classList.add( 'revealed' );
        };

                // Immediate smooth reveal for Hero section on page load / element ready
        var heroEls = root.querySelectorAll( '.hero .reveal, .hero.reveal, .hero__content, .hero__content .reveal, .hero__cta-group' );
        heroEls.forEach( function ( el ) {
            setTimeout( function () {
                triggerElementReveal( el );
            }, 120 );
        } );

        if ( 'IntersectionObserver' in window ) {
            var observer = new IntersectionObserver( function ( entries, obs ) {
                entries.forEach( function ( entry ) {
                    if ( entry.isIntersecting ) {
                        triggerElementReveal( entry.target );
                        obs.unobserve( entry.target );
                    }
                } );
            }, {
                threshold: 0.08,
                rootMargin: '0px 0px -40px 0px'
            } );

            revealEls.forEach( function ( el ) {
                if ( ! el.classList.contains( 'revealed' ) ) {
                    observer.observe( el );
                }
            } );

            var imgObserver = new IntersectionObserver( function ( entries, obs ) {
                entries.forEach( function ( entry ) {
                    if ( entry.isIntersecting ) {
                        triggerElementReveal( entry.target );
                        obs.unobserve( entry.target );
                    }
                } );
            }, {
                threshold: 0.12,
                rootMargin: '0px 0px -30px 0px'
            } );

            imageRevealEls.forEach( function ( el ) {
                if ( ! el.classList.contains( 'revealed' ) ) {
                    if ( el.classList.contains( 'community-card' ) ) {
                        var siblingIndex = Array.prototype.indexOf.call( el.parentNode ? el.parentNode.children : [], el );
                        if ( siblingIndex > 0 ) {
                            el.style.transitionDelay = ( siblingIndex * 0.09 ) + 's';
                        }
                    }
                    imgObserver.observe( el );
                }
            } );
        } else {
            revealEls.forEach( triggerElementReveal );
            imageRevealEls.forEach( triggerElementReveal );
        }
    };

    // =========================================================================
    // 2. KINETIC IMAGE HOVER ZOOM ENGINE (Web Animations API)
    // =========================================================================
    LREWidgets.initImageZoom = function ( $scope ) {
        var root = ( $scope && $scope.length ) ? $scope[0] : document;

        var zoomTargets = [
            { container: '.about__image-wrapper',    img: '.about__image-inner img', maxScale: '1.10' },
            { container: '.services__image-card',    img: 'img',                     maxScale: '1.09' },
            { container: '.services__image-wrapper', img: '.services__image-card img', maxScale: '1.09' },
            { container: '.listing-card',            img: '.listing-card__image img', maxScale: '1.09' },
            { container: '.testimonial__image-col',   img: 'img',                    maxScale: '1.08' },
            { container: '.community-card',          img: '.community-card__image',  maxScale: '1.09' },
            { container: '.side-menu__box',          img: '.side-menu__box-bg img',  maxScale: '1.14' }
        ];

        zoomTargets.forEach( function ( target ) {
            var containers = root.querySelectorAll( target.container );
            containers.forEach( function ( box ) {
                var img = box.querySelector( target.img );
                if ( ! img || box._lreZoomAttached ) return;
                box._lreZoomAttached = true;

                var currentAnim = null;

                box.addEventListener( 'mouseenter', function () {
                    var currentTransform = window.getComputedStyle( img ).transform;
                    if ( currentAnim ) currentAnim.cancel();

                    if ( 'animate' in img ) {
                        currentAnim = img.animate(
                            [
                                { transform: currentTransform && currentTransform !== 'none' ? currentTransform : 'scale(1.0) translate3d(0, 0, 0)' },
                                { transform: 'scale(' + target.maxScale + ') translate3d(0, 0, 0)' }
                            ],
                            {
                                duration: 3500,
                                fill: 'forwards',
                                easing: 'cubic-bezier(0.25, 1, 0.5, 1)'
                            }
                        );
                    }
                } );

                box.addEventListener( 'mouseleave', function () {
                    var currentTransform = window.getComputedStyle( img ).transform;
                    if ( currentAnim ) currentAnim.cancel();

                    if ( 'animate' in img ) {
                        currentAnim = img.animate(
                            [
                                { transform: currentTransform && currentTransform !== 'none' ? currentTransform : 'scale(' + target.maxScale + ') translate3d(0, 0, 0)' },
                                { transform: 'scale(1.0) translate3d(0, 0, 0)' }
                            ],
                            {
                                duration: 1600,
                                fill: 'forwards',
                                easing: 'cubic-bezier(0.25, 1, 0.5, 1)'
                            }
                        );
                    }
                } );
            } );
        } );
    };

    // =========================================================================
    // 3. HEADER & SIDE DRAWER
    // =========================================================================
    LREWidgets.Header = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            var navbar = root.querySelector( '.navbar' ) || document.getElementById( 'navbar' );
            var sideMenu = root.querySelector( '.side-menu' ) || document.getElementById( 'side-menu' );
            var openBtn = root.querySelector( '#menu-open-btn' ) || document.getElementById( 'menu-open-btn' );
            var closeBtn = root.querySelector( '#menu-close-btn' ) || document.getElementById( 'menu-close-btn' );

            LREWidgets.initImageZoom( $scope );

            if ( navbar ) {
                var onScroll = function () {
                    if ( window.scrollY > 60 ) {
                        navbar.classList.add( 'scrolled' );
                    } else {
                        navbar.classList.remove( 'scrolled' );
                    }
                };
                window.addEventListener( 'scroll', onScroll, { passive: true } );
                onScroll();
            }

            if ( sideMenu && openBtn ) {
                var openSideMenu = function () {
                    sideMenu.classList.add( 'active' );
                    sideMenu.setAttribute( 'aria-hidden', 'false' );
                    openBtn.setAttribute( 'aria-expanded', 'true' );
                    document.body.classList.add( 'menu-open' );
                    if ( closeBtn ) {
                        setTimeout( function () { closeBtn.focus(); }, 400 );
                    }
                };

                var closeSideMenu = function () {
                    sideMenu.classList.remove( 'active' );
                    sideMenu.setAttribute( 'aria-hidden', 'true' );
                    openBtn.setAttribute( 'aria-expanded', 'false' );
                    document.body.classList.remove( 'menu-open' );
                    openBtn.focus();
                };

                openBtn.addEventListener( 'click', openSideMenu );
                if ( closeBtn ) {
                    closeBtn.addEventListener( 'click', closeSideMenu );
                }

                document.addEventListener( 'keydown', function ( e ) {
                    if ( e.key === 'Escape' && sideMenu.classList.contains( 'active' ) ) {
                        closeSideMenu();
                    }
                } );

                sideMenu.querySelectorAll( 'a[href^="#"]' ).forEach( function ( link ) {
                    link.addEventListener( 'click', closeSideMenu );
                } );
            }
        }
    };

    // =========================================================================
    // 4. CONCIERGE (BACK TO TOP)
    // =========================================================================
    LREWidgets.Concierge = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            var btn = root.querySelector( '.back-to-top' ) || document.getElementById( 'back-to-top' );
            if ( ! btn ) return;

            var toggleVisibility = function () {
                if ( window.scrollY > 400 ) {
                    btn.classList.add( 'visible' );
                } else {
                    btn.classList.remove( 'visible' );
                }
            };

            window.addEventListener( 'scroll', toggleVisibility, { passive: true } );
            toggleVisibility();

            btn.addEventListener( 'click', function () {
                window.scrollTo( { top: 0, behavior: 'smooth' } );
            } );
        }
    };

    // =========================================================================
    // 5. HERO (CONTINUOUS LUXURY CROSSFADE & KEN BURNS ENGINE)
    // =========================================================================
    LREWidgets.Hero = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            if ( ! root ) return;

            // Trigger kinetic text animations on Hero Title, Subtitle, CTA
            var heroTitles = root.querySelectorAll ? root.querySelectorAll( '.hero-mask > span' ) : [];
            for ( var m = 0; m < heroTitles.length; m++ ) {
                ( function ( span, idx ) {
                    span.style.animation = 'none';
                    void span.offsetWidth;
                    span.style.animation = 'heroMaskUp 1.2s cubic-bezier(0.16, 0.84, 0.44, 1) ' + ( 0.3 + idx * 0.22 ) + 's forwards';
                } )( heroTitles[m], m );
            }

            var sub = root.querySelector ? root.querySelector( '.hero__subtitle' ) : null;
            if ( sub ) {
                sub.style.animation = 'none';
                void sub.offsetWidth;
                sub.style.animation = 'heroFadeUp 1.1s cubic-bezier(0.16, 0.84, 0.44, 1) 0.7s forwards';
            }

            var cta = root.querySelector ? root.querySelector( '.hero__cta-group' ) : null;
            if ( cta ) {
                cta.style.animation = 'none';
                void cta.offsetWidth;
                cta.style.animation = 'heroFadeUp 1.1s cubic-bezier(0.16, 0.84, 0.44, 1) 0.9s forwards';
            }

            var sliders = root.querySelectorAll ? root.querySelectorAll( '.hero__slider' ) : [];
            if ( ! sliders.length && root.classList && root.classList.contains( 'hero__slider' ) ) {
                sliders = [ root ];
            }

            for ( var s = 0; s < sliders.length; s++ ) {
                ( function ( slider ) {
                    var slides = slider.querySelectorAll( '.hero__slide' );
                    if ( slides.length <= 1 ) return;

                    var rawInterval = slider.getAttribute( 'data-autoplay-interval' );
                    var interval = parseInt( rawInterval || '5000', 10 );
                    if ( isNaN( interval ) || interval < 1500 ) interval = 5000;
                    var current = 0;

                    if ( slider._heroInterval ) {
                        clearInterval( slider._heroInterval );
                        slider._heroInterval = null;
                    }

                    // Reset all slides and setup initial slide 0
                    for ( var i = 0; i < slides.length; i++ ) {
                        slides[i].classList.remove( 'is-prev' );
                        if ( i === 0 ) {
                            slides[i].classList.add( 'active' );
                        } else {
                            slides[i].classList.remove( 'active' );
                        }
                    }

                    slider._heroInterval = setInterval( function () {
                        var prevSlide = slides[current];
                        current = ( current + 1 ) % slides.length;
                        var nextSlide = slides[current];

                        // Mark previous slide as is-prev to hold its background view
                        prevSlide.classList.add( 'is-prev' );
                        prevSlide.classList.remove( 'active' );

                        // Activate next slide so it fades in and begins Ken Burns zoom
                        nextSlide.classList.remove( 'is-prev' );
                        nextSlide.classList.add( 'active' );

                        // After crossfade completes (2000ms), clean up previous slide
                        setTimeout( function () {
                            prevSlide.classList.remove( 'is-prev' );
                        }, 2100 );
                    }, interval );
                } )( sliders[s] );
            }
        }
    };

    // =========================================================================
    // 6. ABOUT OUR STORY
    // =========================================================================
    LREWidgets.About = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            // Watermark Scroll Parallax
            if ( ! prefersReducedMotion ) {
                var aboutSec = root.querySelector( '.about' ) || root;
                var watermark = root.querySelector( '.about__watermark' );

                if ( aboutSec && watermark ) {
                    var updateParallax = function () {
                        var rect = aboutSec.getBoundingClientRect();
                        var winH = window.innerHeight;
                        if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                            var progress = ( winH - rect.top ) / ( winH + rect.height );
                            var isMobile = window.innerWidth <= 768;
                            var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                            var yShift = ( progress - 0.5 ) * ( isMobile ? 16 : 36 );
                            watermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                        }
                    };
                    window.addEventListener( 'scroll', updateParallax, { passive: true } );
                    updateParallax();
                }
            }
        }
    };

    // =========================================================================
    // 7. SERVICES
    // =========================================================================
    LREWidgets.Services = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var items = root.querySelectorAll( '.services__item' );
            var mainImage = root.querySelector( '#services-main-img' );

            if ( items.length && mainImage ) {
                items.forEach( function ( item ) {
                    item.addEventListener( 'mouseenter', function () {
                        var newSrc = item.getAttribute( 'data-img' );
                        if ( newSrc && mainImage.src !== newSrc ) {
                            mainImage.style.opacity = '0.5';
                            mainImage.style.transform = 'scale(1.04)';
                            setTimeout( function () {
                                mainImage.src = newSrc;
                                mainImage.style.opacity = '1';
                                mainImage.style.transform = 'scale(1.0)';
                            }, 180 );
                        }
                        items.forEach( function ( i ) { i.classList.remove( 'active' ); } );
                        item.classList.add( 'active' );
                    } );
                } );
            }
        }
    };

    // =========================================================================
    // 8. FEATURED PROPERTIES (CAROUSEL & LIKES)
    // =========================================================================
    LREWidgets.Properties = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            if ( ! root ) return;

            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var carousel = root.querySelector( '#listings-carousel' ) || root.querySelector( '.listings__carousel' );
            var prevBtn = root.querySelector( '#listings-prev' );
            var nextBtn = root.querySelector( '#listings-next' );
            var dots = root.querySelectorAll( '.listings__nav-dot' );

            if ( carousel ) {
                var getScrollAmount = function () {
                    var card = carousel.querySelector( '.listing-card' );
                    return card ? card.offsetWidth + 24 : 350;
                };

                if ( prevBtn ) {
                    prevBtn.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        carousel.scrollBy( { left: -getScrollAmount(), behavior: 'smooth' } );
                    } );
                }

                if ( nextBtn ) {
                    nextBtn.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        carousel.scrollBy( { left: getScrollAmount(), behavior: 'smooth' } );
                    } );
                }

                // Dot navigation
                dots.forEach( function ( dot, index ) {
                    dot.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        var totalScrollable = carousel.scrollWidth - carousel.clientWidth;
                        var pageScroll = ( totalScrollable / Math.max( 1, dots.length - 1 ) ) * index;
                        carousel.scrollTo( { left: pageScroll, behavior: 'smooth' } );
                    } );
                } );

                // Update active dot on scroll
                var listingScrollTicking = false;
                carousel.addEventListener( 'scroll', function () {
                    if ( ! listingScrollTicking ) {
                        requestAnimationFrame( function () {
                            var totalScrollable = carousel.scrollWidth - carousel.clientWidth;
                            if ( totalScrollable > 0 && dots.length > 0 ) {
                                var progress = carousel.scrollLeft / totalScrollable;
                                var activeIndex = Math.min( dots.length - 1, Math.round( progress * ( dots.length - 1 ) ) );
                                dots.forEach( function ( d, i ) {
                                    d.classList.toggle( 'active', i === activeIndex );
                                } );
                            }
                            listingScrollTicking = false;
                        } );
                        listingScrollTicking = true;
                    }
                }, { passive: true } );

                // Mouse drag-to-scroll support for desktop
                var isDown = false;
                var startX, scrollLeftVal;

                carousel.addEventListener( 'mousedown', function ( e ) {
                    if ( e.target.closest( '.listing-card__like-btn' ) || e.target.closest( 'a' ) ) return;
                    isDown = true;
                    carousel.style.cursor = 'grabbing';
                    carousel.style.userSelect = 'none';
                    startX = e.pageX - carousel.offsetLeft;
                    scrollLeftVal = carousel.scrollLeft;
                } );

                carousel.addEventListener( 'mouseleave', function () {
                    isDown = false;
                    carousel.style.cursor = '';
                    carousel.style.userSelect = '';
                } );

                carousel.addEventListener( 'mouseup', function () {
                    isDown = false;
                    carousel.style.cursor = '';
                    carousel.style.userSelect = '';
                } );

                carousel.addEventListener( 'mousemove', function ( e ) {
                    if ( ! isDown ) return;
                    e.preventDefault();
                    var x = e.pageX - carousel.offsetLeft;
                    var walk = ( x - startX ) * 1.5;
                    carousel.scrollLeft = scrollLeftVal - walk;
                } );

                // Heart Favorite Button Toggle
                var likeButtons = carousel.querySelectorAll( '.listing-card__like-btn' );
                likeButtons.forEach( function ( btn ) {
                    btn.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        e.stopPropagation();
                        btn.classList.toggle( 'liked' );
                    } );
                } );
            }
        }
    };

    // =========================================================================
    // 9. TESTIMONIALS (SLIDER)
    // =========================================================================
    LREWidgets.Testimonials = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var slider = root.querySelector( '.testimonial__slider' ) || document.getElementById( 'testimonial-slider' );
            var track = root.querySelector( '.testimonial__track' ) || document.getElementById( 'testimonial-track' );
            var prevBtn = root.querySelector( '#testimonial-prev' ) || document.getElementById( 'testimonial-prev' );
            var nextBtn = root.querySelector( '#testimonial-next' ) || document.getElementById( 'testimonial-next' );
            var dots = root.querySelectorAll( '.testimonial__nav-dot' );

            if ( slider && track && prevBtn && nextBtn ) {
                var slides = track.querySelectorAll( '.testimonial__slide' );
                var currentSlide = 0;

                var showSlide = function ( index ) {
                    if ( slides.length === 0 ) return;
                    currentSlide = ( index + slides.length ) % slides.length;
                    track.style.transform = 'translateX(-' + ( currentSlide * 100 ) + '%)';

                    slides.forEach( function ( s, idx ) {
                        s.classList.toggle( 'active', idx === currentSlide );
                    } );
                    dots.forEach( function ( d, idx ) {
                        d.classList.toggle( 'active', idx === currentSlide );
                    } );
                };

                prevBtn.addEventListener( 'click', function () { showSlide( currentSlide - 1 ); } );
                nextBtn.addEventListener( 'click', function () { showSlide( currentSlide + 1 ); } );

                dots.forEach( function ( dot, idx ) {
                    dot.addEventListener( 'click', function () { showSlide( idx ); } );
                } );
            }
        }
    };

    // =========================================================================
    // 10. COMMUNITIES (CONTINUOUS INFINITE REEL SLIDER)
    // =========================================================================
    LREWidgets.Communities = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var communitiesSlider = root.querySelector( '#communities-slider' ) || root.querySelector( '.communities__slider' );
            var communitiesTrack  = root.querySelector( '#communities-track' )  || root.querySelector( '.communities__track' );
            var communityPrevBtn  = root.querySelector( '#communities-prev' )   || root.querySelector( '.communities__arrow#communities-prev' );
            var communityNextBtn  = root.querySelector( '#communities-next' )   || root.querySelector( '.communities__arrow#communities-next' );
            var communityDots     = root.querySelectorAll( '.communities__dot' );

            if ( communitiesSlider && communitiesTrack ) {
                if ( communitiesTrack.dataset.sliderInit === 'true' ) {
                    return;
                }
                communitiesTrack.dataset.sliderInit = 'true';

                var rawCards = Array.prototype.slice.call( communitiesTrack.children );
                var baseCount = rawCards.length;

                if ( baseCount > 0 ) {
                    rawCards.forEach( function ( card ) {
                        communitiesTrack.appendChild( card.cloneNode( true ) );
                    } );

                    var isAnimating = false;
                    var activeDotIndex = 0;
                    var animationTimer = null;

                    var getCardStep = function () {
                        var card = communitiesTrack.querySelector( '.community-card' );
                        var trackStyle = window.getComputedStyle( communitiesTrack );
                        var gap = parseFloat( trackStyle.gap ) || 20;
                        return card ? card.offsetWidth + gap : 280;
                    };

                    var updateDots = function () {
                        if ( communityDots.length === 0 ) return;
                        communityDots.forEach( function ( dot, idx ) {
                            dot.classList.toggle( 'active', idx === ( activeDotIndex % communityDots.length ) );
                        } );
                    };

                    var slideNext = function () {
                        if ( isAnimating ) return;
                        isAnimating = true;
                        clearTimeout( animationTimer );

                        var step = getCardStep();
                        communitiesTrack.style.transition = 'transform 0.45s cubic-bezier(0.16, 1, 0.3, 1)';
                        communitiesTrack.style.transform = 'translateX(-' + step + 'px)';

                        animationTimer = setTimeout( function () {
                            communitiesTrack.appendChild( communitiesTrack.firstElementChild );
                            communitiesTrack.style.transition = 'none';
                            communitiesTrack.style.transform = 'translateX(0)';
                            void communitiesTrack.offsetHeight;
                            activeDotIndex = ( activeDotIndex + 1 ) % baseCount;
                            updateDots();
                            isAnimating = false;
                        }, 460 );
                    };

                    var slidePrev = function () {
                        if ( isAnimating ) return;
                        isAnimating = true;
                        clearTimeout( animationTimer );

                        var step = getCardStep();
                        communitiesTrack.insertBefore( communitiesTrack.lastElementChild, communitiesTrack.firstElementChild );
                        communitiesTrack.style.transition = 'none';
                        communitiesTrack.style.transform = 'translateX(-' + step + 'px)';
                        void communitiesTrack.offsetHeight;

                        requestAnimationFrame( function () {
                            communitiesTrack.style.transition = 'transform 0.45s cubic-bezier(0.16, 1, 0.3, 1)';
                            communitiesTrack.style.transform = 'translateX(0)';
                        } );

                        animationTimer = setTimeout( function () {
                            communitiesTrack.style.transition = 'none';
                            activeDotIndex = ( activeDotIndex - 1 + baseCount ) % baseCount;
                            updateDots();
                            isAnimating = false;
                        }, 460 );
                    };

                    if ( communityNextBtn ) {
                        communityNextBtn.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            slideNext();
                        } );
                    }

                    if ( communityPrevBtn ) {
                        communityPrevBtn.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            slidePrev();
                        } );
                    }

                    communityDots.forEach( function ( dot, idx ) {
                        dot.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            if ( isAnimating ) return;
                            var currentDot = activeDotIndex % communityDots.length;
                            if ( idx === currentDot ) return;
                            if ( idx > currentDot ) {
                                slideNext();
                            } else {
                                slidePrev();
                            }
                        } );
                    } );

                    var isDragging = false;
                    var startX = 0;
                    var currentX = 0;

                    var onDragStart = function ( e ) {
                        if ( isAnimating ) return;
                        isDragging = true;
                        communitiesSlider.style.cursor = 'grabbing';
                        startX = e.type.indexOf( 'touch' ) !== -1 ? e.touches[0].clientX : e.clientX;
                        currentX = startX;
                        communitiesTrack.style.transition = 'none';
                    };

                    var onDragMove = function ( e ) {
                        if ( ! isDragging || isAnimating ) return;
                        currentX = e.type.indexOf( 'touch' ) !== -1 ? e.touches[0].clientX : e.clientX;
                        var delta = currentX - startX;
                        communitiesTrack.style.transform = 'translateX(' + delta + 'px)';
                    };

                    var onDragEnd = function () {
                        if ( ! isDragging ) return;
                        isDragging = false;
                        communitiesSlider.style.cursor = 'grab';
                        var delta = currentX - startX;

                        if ( delta < -45 ) {
                            slideNext();
                        } else if ( delta > 45 ) {
                            slidePrev();
                        } else {
                            communitiesTrack.style.transition = 'transform 0.35s ease';
                            communitiesTrack.style.transform = 'translateX(0)';
                        }
                    };

                    communitiesSlider.addEventListener( 'mousedown', onDragStart );
                    window.addEventListener( 'mousemove', onDragMove );
                    window.addEventListener( 'mouseup', onDragEnd );

                    communitiesSlider.addEventListener( 'touchstart', onDragStart, { passive: true } );
                    communitiesSlider.addEventListener( 'touchmove', onDragMove, { passive: true } );
                    communitiesSlider.addEventListener( 'touchend', onDragEnd, { passive: true } );
                }
            }
        }
    };

    // =========================================================================
    // 11. CTA & APPOINTMENT MODAL
    // =========================================================================
    LREWidgets.CTA = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );
        }
    };

    // =========================================================================
    // 12. FOOTER
    // =========================================================================
    LREWidgets.Footer = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
        }
    };

    // =========================================================================
    // ELEMENTOR HOOK BINDINGS
    // =========================================================================
    function lreBindElementorHooks() {
        if ( typeof elementorFrontend === 'undefined' || ! elementorFrontend.hooks ) {
            return;
        }

        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_header.default',       function ( $scope ) { LREWidgets.Header.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_concierge.default',    function ( $scope ) { LREWidgets.Concierge.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_hero.default',         function ( $scope ) { LREWidgets.Hero.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_about.default',        function ( $scope ) { LREWidgets.About.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_services.default',     function ( $scope ) { LREWidgets.Services.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_properties.default',   function ( $scope ) { LREWidgets.Properties.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_testimonials.default', function ( $scope ) { LREWidgets.Testimonials.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_communities.default',  function ( $scope ) { LREWidgets.Communities.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_cta.default',          function ( $scope ) { LREWidgets.CTA.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_footer.default',       function ( $scope ) { LREWidgets.Footer.init( $scope ); } );
    }

    // Auto-run on DOM ready
    function lreInitAllWidgets() {
        LREWidgets.initReveals();
        LREWidgets.initImageZoom();
        if ( LREWidgets.Header )       LREWidgets.Header.init();
        if ( LREWidgets.Hero )         LREWidgets.Hero.init();
        if ( LREWidgets.Properties )   LREWidgets.Properties.init();
        if ( LREWidgets.Testimonials ) LREWidgets.Testimonials.init();
        if ( LREWidgets.Communities )  LREWidgets.Communities.init();
        if ( LREWidgets.CTA )          LREWidgets.CTA.init();
        if ( LREWidgets.Concierge )    LREWidgets.Concierge.init();
    }

    if ( document.readyState === 'complete' || document.readyState === 'interactive' ) {
        lreInitAllWidgets();
        lreBindElementorHooks();
    } else {
        document.addEventListener( 'DOMContentLoaded', function () {
            lreInitAllWidgets();
            lreBindElementorHooks();
        } );
    }

    if ( typeof jQuery !== 'undefined' ) {
        jQuery( window ).on( 'elementor/frontend/init', lreBindElementorHooks );
    }

}( window, document, typeof jQuery !== 'undefined' ? jQuery : null ));