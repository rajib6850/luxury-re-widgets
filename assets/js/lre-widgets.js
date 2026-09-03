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
        var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
        var revealEls = root.querySelectorAll( '.reveal, .reveal--left, .reveal--right, .reveal--zoom, .reveal--stagger, .title-mask, .lre-story__header, .lre-team__header, .lre-aserv__header, .lre-reviews__header, .lre-press__header, .about__text, .services__header, .listings__header, .testimonial__inner, .communities__header-text, .cta__content, .footer__main' );
        var imageRevealEls = root.querySelectorAll( '.image-reveal' );

        var triggerElementReveal = function ( el ) {
            if ( ! el || el.classList.contains( 'revealed' ) ) {
                return;
            }
            el.classList.add( 'revealed' );
            var nestedMasks = el.querySelectorAll ? el.querySelectorAll( '.title-mask' ) : [];
            if ( nestedMasks && nestedMasks.length ) {
                nestedMasks.forEach( function ( m ) {
                    m.classList.add( 'revealed' );
                } );
            }
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
        var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );

        var zoomTargets = [
            { container: '.about__image-wrapper',    img: '.about__image-inner img', maxScale: '1.10' },
            { container: '.services__image-card',    img: 'img',                     maxScale: '1.09' },
            { container: '.services__image-wrapper', img: '.services__image-card img', maxScale: '1.09' },
            { container: '.listing-card',            img: '.listing-card__image img', maxScale: '1.09' },
            { container: '.testimonial__image-col',   img: 'img',                    maxScale: '1.08' },
            { container: '.community-card',          img: '.community-card__image',  maxScale: '1.09' },
            { container: '.side-menu__box',          img: '.side-menu__box-bg img',  maxScale: '1.14' },
            { container: '.lre-story__image-frame',  img: 'img',                     maxScale: '1.04' },
            { container: '.lre-aserv__card',         img: '.lre-aserv__card-frame img', maxScale: '1.05' },
            { container: '.lre-aserv__split-media',  img: '.lre-aserv__split-frame img', maxScale: '1.05' },
            { container: '.lre-aserv__monolith',     img: '.lre-aserv__mono-bg img', maxScale: '1.06' }
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
    // 3. HEADER, SIDE DRAWER & MOBILE DROPDOWN
    // =========================================================================
    LREWidgets.Header = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            var header = root.querySelector( '.site-header' ) || ( root.classList && root.classList.contains( 'site-header' ) ? root : document.querySelector( '.site-header' ) );
            var navbar = root.querySelector( '.navbar' ) || document.getElementById( 'navbar' );
            var sideMenu = root.querySelector( '.side-menu' ) || document.getElementById( 'side-menu' );
            var mobileDropdown = root.querySelector( '.navbar__mobile-dropdown' ) || document.getElementById( 'navbar-mobile-dropdown' );
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

            var mobileType = ( header && header.getAttribute( 'data-mobile-type' ) ) ? header.getAttribute( 'data-mobile-type' ) : 'drawer';

            // Mobile Dropdown Accordion handling
            if ( mobileDropdown && ! mobileDropdown._lreAttached ) {
                mobileDropdown._lreAttached = true;
                var toggles = mobileDropdown.querySelectorAll( '.navbar__mobile-toggle' );
                toggles.forEach( function ( toggle ) {
                    toggle.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        e.stopPropagation();
                        var parent = toggle.closest( '.navbar__mobile-item' );
                        if ( parent ) {
                            parent.classList.toggle( 'open' );
                        }
                    } );
                } );

                var parentLinks = mobileDropdown.querySelectorAll( '.navbar__mobile-item.has-children > .navbar__mobile-link' );
                parentLinks.forEach( function ( plink ) {
                    var href = plink.getAttribute( 'href' );
                    if ( ! href || href === '#' || href === '#0' ) {
                        plink.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            var parent = plink.closest( '.navbar__mobile-item' );
                            if ( parent ) {
                                parent.classList.toggle( 'open' );
                            }
                        } );
                    }
                } );

                mobileDropdown.querySelectorAll( 'a' ).forEach( function ( link ) {
                    var href = link.getAttribute( 'href' );
                    if ( href && href !== '#' && href !== '#0' ) {
                        link.addEventListener( 'click', function () {
                            mobileDropdown.classList.remove( 'active' );
                            var currentHeader = document.querySelector( '.site-header' );
                            var currentOpenBtn = document.getElementById( 'menu-open-btn' );
                            if ( currentHeader ) currentHeader.classList.remove( 'mobile-menu-active' );
                            if ( currentOpenBtn ) {
                                currentOpenBtn.classList.remove( 'active' );
                                currentOpenBtn.setAttribute( 'aria-expanded', 'false' );
                            }
                        } );
                    }
                } );
            }

            // Outside click to close mobile dropdown
            if ( ! window._lreMobileOutsideClickBound ) {
                window._lreMobileOutsideClickBound = true;
                document.addEventListener( 'click', function ( e ) {
                    var curDropdown = document.getElementById( 'navbar-mobile-dropdown' );
                    var curOpenBtn = document.getElementById( 'menu-open-btn' );
                    var curHeader = document.querySelector( '.site-header' );
                    if ( curDropdown && curDropdown.classList.contains( 'active' ) ) {
                        if ( ! curDropdown.contains( e.target ) && curOpenBtn && ! curOpenBtn.contains( e.target ) ) {
                            curDropdown.classList.remove( 'active' );
                            if ( curHeader ) curHeader.classList.remove( 'mobile-menu-active' );
                            if ( curOpenBtn ) {
                                curOpenBtn.classList.remove( 'active' );
                                curOpenBtn.setAttribute( 'aria-expanded', 'false' );
                            }
                        }
                    }
                } );
            }

            if ( openBtn && ! openBtn._lreAttached ) {
                openBtn._lreAttached = true;
                openBtn.addEventListener( 'click', function ( e ) {
                    e.preventDefault();
                    e.stopPropagation();

                    var curHeader = document.querySelector( '.site-header' ) || header;
                    var curMobileType = ( curHeader && curHeader.getAttribute( 'data-mobile-type' ) ) ? curHeader.getAttribute( 'data-mobile-type' ) : mobileType;
                    var curDropdown = document.getElementById( 'navbar-mobile-dropdown' ) || mobileDropdown;
                    var curSideMenu = document.getElementById( 'side-menu' ) || sideMenu;

                    var isMobile = window.innerWidth <= 1024;

                    if ( isMobile && curMobileType === 'dropdown' && curDropdown ) {
                        var isActive = curDropdown.classList.toggle( 'active' );
                        if ( curHeader ) curHeader.classList.toggle( 'mobile-menu-active', isActive );
                        openBtn.classList.toggle( 'active', isActive );
                        openBtn.setAttribute( 'aria-expanded', isActive ? 'true' : 'false' );
                    } else if ( curSideMenu ) {
                        curSideMenu.classList.add( 'active' );
                        curSideMenu.setAttribute( 'aria-hidden', 'false' );
                        openBtn.setAttribute( 'aria-expanded', 'true' );
                        document.body.classList.add( 'menu-open' );
                        if ( closeBtn ) {
                            setTimeout( function () { closeBtn.focus(); }, 400 );
                        }
                    }
                } );
            }

            if ( sideMenu ) {
                var closeSideMenu = function () {
                    sideMenu.classList.remove( 'active' );
                    sideMenu.setAttribute( 'aria-hidden', 'true' );
                    if ( openBtn ) {
                        openBtn.classList.remove( 'active' );
                        openBtn.setAttribute( 'aria-expanded', 'false' );
                    }
                    document.body.classList.remove( 'menu-open' );
                    if ( openBtn ) openBtn.focus();
                };

                if ( closeBtn && ! closeBtn._lreAttached ) {
                    closeBtn._lreAttached = true;
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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var items = root.querySelectorAll( '.service-item, .services__item' );
            var mainImage = root.querySelector( '#services-main-img' ) || root.querySelector( '.services__image-card img' );

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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
    // 10B. MEET THE TEAM CAROUSEL
    // =========================================================================
    LREWidgets.Team = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var teamSections = root.querySelectorAll( '.lre-team' );
            if ( ! teamSections.length && root.classList && root.classList.contains( 'lre-team' ) ) {
                teamSections = [ root ];
            }

            teamSections.forEach( function ( section ) {
                var viewport = section.querySelector( '.lre-team__viewport' );
                var track    = section.querySelector( '.lre-team__track' );
                var prevBtn  = section.querySelector( '.lre-team__arrow--prev' );
                var nextBtn  = section.querySelector( '.lre-team__arrow--next' );
                var modal    = section.querySelector( '.lre-team-modal' );

                // Watermark Scroll Parallax (matching About widget)
                if ( ! prefersReducedMotion ) {
                    var teamWatermark = section.querySelector( '.lre-team__watermark' );
                    if ( teamWatermark ) {
                        var updateTeamParallax = function () {
                            var rect = section.getBoundingClientRect();
                            var winH = window.innerHeight;
                            if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                                var progress = ( winH - rect.top ) / ( winH + rect.height );
                                var isMobile = window.innerWidth <= 768;
                                var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                                var yShift = ( progress - 0.5 ) * ( isMobile ? 16 : 36 );
                                teamWatermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                            }
                        };
                        window.addEventListener( 'scroll', updateTeamParallax, { passive: true } );
                        updateTeamParallax();
                    }
                }

                // Super-Luxury Person Details Modal
                if ( modal && track ) {
                    var modalImg       = modal.querySelector( '.lre-team-modal__img' );
                    var modalBadge     = modal.querySelector( '.lre-team-modal__badge-text' );
                    var modalBadgeWrap = modal.querySelector( '.lre-team-modal__badge' );
                    var modalName      = modal.querySelector( '.lre-team-modal__name' );
                    var modalRole      = modal.querySelector( '.lre-team-modal__role' );
                    var modalBio       = modal.querySelector( '.lre-team-modal__bio' );
                    var modalPhoneWrap = modal.querySelector( '.lre-team-modal__contact--phone' );
                    var modalPhoneLink = modal.querySelector( '.lre-team-modal__phone-link' );
                    var modalEmailWrap = modal.querySelector( '.lre-team-modal__contact--email' );
                    var modalEmailLink = modal.querySelector( '.lre-team-modal__email-link' );
                    var modalCtaBtn    = modal.querySelector( '.lre-team-modal__cta-btn' );
                    var modalCloseBtn  = modal.querySelector( '.lre-team-modal__close' );
                    var modalBackdrop  = modal.querySelector( '.lre-team-modal__backdrop' );

                    var openTeamModal = function ( card ) {
                        if ( ! card ) return;
                        var name    = card.getAttribute( 'data-name' ) || '';
                        var role    = card.getAttribute( 'data-role' ) || '';
                        var lic     = card.getAttribute( 'data-lic' ) || '';
                        var bio     = card.getAttribute( 'data-bio' ) || '';
                        var email   = card.getAttribute( 'data-email' ) || '';
                        var phone   = card.getAttribute( 'data-phone' ) || '';
                        var photo   = card.getAttribute( 'data-photo' ) || '';
                        var inquiry = card.getAttribute( 'data-inquiry' ) || '#contact';

                        if ( modalImg ) {
                            modalImg.src = photo;
                            modalImg.alt = name;
                        }
                        if ( modalBadge ) {
                            modalBadge.textContent = lic;
                        }
                        if ( modalBadgeWrap ) {
                            modalBadgeWrap.style.display = lic ? 'inline-flex' : 'none';
                        }
                        if ( modalName ) modalName.textContent = name;
                        if ( modalRole ) modalRole.textContent = role;
                        if ( modalBio )  modalBio.textContent  = bio;

                        if ( modalPhoneLink && modalPhoneWrap ) {
                            if ( phone ) {
                                modalPhoneLink.textContent = phone;
                                modalPhoneLink.href = 'tel:' + phone.replace( /[^\d+]/g, '' );
                                modalPhoneWrap.style.display = 'flex';
                            } else {
                                modalPhoneWrap.style.display = 'none';
                            }
                        }

                        if ( modalEmailLink && modalEmailWrap ) {
                            if ( email ) {
                                modalEmailLink.textContent = email;
                                modalEmailLink.href = 'mailto:' + email;
                                modalEmailWrap.style.display = 'flex';
                            } else {
                                modalEmailWrap.style.display = 'none';
                            }
                        }

                        if ( modalCtaBtn ) {
                            modalCtaBtn.href = inquiry;
                            var btnSpan = modalCtaBtn.querySelector( 'span' );
                            if ( btnSpan && name ) {
                                var firstName = name.split( ' ' )[0];
                                btnSpan.textContent = 'Schedule Consultation with ' + firstName;
                            }
                        }

                        modal.classList.add( 'lre-team-modal--active' );
                        modal.setAttribute( 'aria-hidden', 'false' );
                        document.body.classList.add( 'lre-modal-open' );
                        document.documentElement.classList.add( 'lre-modal-open' );
                        var modalDialog = modal.querySelector( '.lre-team-modal__dialog' );
                        if ( modalDialog ) {
                            modalDialog.scrollTop = 0;
                        }
                        modal.scrollTop = 0;
                    };

                    var closeTeamModal = function () {
                        modal.classList.remove( 'lre-team-modal--active' );
                        modal.setAttribute( 'aria-hidden', 'true' );
                        document.body.classList.remove( 'lre-modal-open' );
                        document.documentElement.classList.remove( 'lre-modal-open' );
                    };

                    // Open on card click
                    track.addEventListener( 'click', function ( e ) {
                        var card = e.target.closest( '.lre-team__card' );
                        if ( card && ! isDragging ) {
                            e.preventDefault();
                            openTeamModal( card );
                        }
                    } );

                    // Open on card Enter / Space keypress
                    track.addEventListener( 'keydown', function ( e ) {
                        if ( e.key === 'Enter' || e.key === ' ' ) {
                            var card = e.target.closest( '.lre-team__card' );
                            if ( card ) {
                                e.preventDefault();
                                openTeamModal( card );
                            }
                        }
                    } );

                    if ( modalCloseBtn ) {
                        modalCloseBtn.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            closeTeamModal();
                        } );
                    }

                    if ( modalBackdrop ) {
                        modalBackdrop.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            closeTeamModal();
                        } );
                    }

                    document.addEventListener( 'keydown', function ( e ) {
                        if ( e.key === 'Escape' && modal.classList.contains( 'lre-team-modal--active' ) ) {
                            closeTeamModal();
                        }
                    } );
                }

                if ( ! viewport || ! track ) return;
                if ( track.dataset.sliderInit === 'true' ) return;
                track.dataset.sliderInit = 'true';

                var rawCards = Array.prototype.slice.call( track.children );
                var baseCount = rawCards.length;
                if ( baseCount === 0 ) return;

                // Clone cards to ensure seamless looping
                if ( baseCount < 6 ) {
                    rawCards.forEach( function ( card ) {
                        track.appendChild( card.cloneNode( true ) );
                    } );
                    if ( baseCount <= 3 ) {
                        rawCards.forEach( function ( card ) {
                            track.appendChild( card.cloneNode( true ) );
                        } );
                    }
                }

                var isAnimating = false;
                var animationTimer = null;

                var getStep = function () {
                    var card = track.querySelector( '.lre-team__card' );
                    if ( ! card ) return 360;
                    var trackStyle = window.getComputedStyle( track );
                    var gap = parseFloat( trackStyle.gap ) || 28;
                    return card.offsetWidth + gap;
                };

                var slideNext = function () {
                    if ( isAnimating ) return;
                    isAnimating = true;
                    clearTimeout( animationTimer );

                    var step = getStep();
                    track.style.transition = 'transform 0.48s cubic-bezier(0.16, 1, 0.3, 1)';
                    track.style.transform = 'translateX(-' + step + 'px)';

                    animationTimer = setTimeout( function () {
                        if ( track.firstElementChild ) {
                            track.appendChild( track.firstElementChild );
                        }
                        track.style.transition = 'none';
                        track.style.transform = 'translateX(0)';
                        void track.offsetHeight;
                        isAnimating = false;
                    }, 490 );
                };

                var slidePrev = function () {
                    if ( isAnimating ) return;
                    isAnimating = true;
                    clearTimeout( animationTimer );

                    var step = getStep();
                    if ( track.lastElementChild ) {
                        track.insertBefore( track.lastElementChild, track.firstElementChild );
                    }
                    track.style.transition = 'none';
                    track.style.transform = 'translateX(-' + step + 'px)';
                    void track.offsetHeight;

                    requestAnimationFrame( function () {
                        track.style.transition = 'transform 0.48s cubic-bezier(0.16, 1, 0.3, 1)';
                        track.style.transform = 'translateX(0)';
                    } );

                    animationTimer = setTimeout( function () {
                        track.style.transition = 'none';
                        isAnimating = false;
                    }, 490 );
                };

                if ( nextBtn ) {
                    nextBtn.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        slideNext();
                    } );
                }

                if ( prevBtn ) {
                    prevBtn.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        slidePrev();
                    } );
                }

                // Touch / Swipe
                var startX = 0;
                var currentX = 0;
                var isDragging = false;

                viewport.addEventListener( 'touchstart', function ( e ) {
                    startX = e.touches[0].clientX;
                    isDragging = true;
                }, { passive: true } );

                viewport.addEventListener( 'touchmove', function ( e ) {
                    if ( ! isDragging ) return;
                    currentX = e.touches[0].clientX;
                }, { passive: true } );

                viewport.addEventListener( 'touchend', function () {
                    if ( ! isDragging ) return;
                    isDragging = false;
                    var diff = startX - currentX;
                    if ( Math.abs( diff ) > 40 ) {
                        if ( diff > 0 ) {
                            slideNext();
                        } else {
                            slidePrev();
                        }
                    }
                } );

                // Autoplay
                var autoplay = viewport.dataset.autoplay === 'yes';
                var interval = parseInt( viewport.dataset.interval, 10 ) || 5000;
                var autoIntervalId = null;

                var startAutoplay = function () {
                    if ( ! autoplay || autoIntervalId ) return;
                    autoIntervalId = setInterval( function () {
                        slideNext();
                    }, interval );
                };

                var stopAutoplay = function () {
                    if ( autoIntervalId ) {
                        clearInterval( autoIntervalId );
                        autoIntervalId = null;
                    }
                };

                if ( autoplay ) {
                    startAutoplay();
                    section.addEventListener( 'mouseenter', stopAutoplay );
                    section.addEventListener( 'mouseleave', startAutoplay );
                }
            } );
        }
    };

    // =========================================================================
    // 11. CTA & APPOINTMENT MODAL
    // =========================================================================
    LREWidgets.CTA = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
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
    // 13. ABOUT STORY & DETAILS (lre_story)
    // =========================================================================
    LREWidgets.Story = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            // Watermark Scroll Parallax (matching About & Team widgets)
            if ( ! prefersReducedMotion ) {
                var storySec = root.querySelector( '.lre-story' ) || ( ( root.classList && root.classList.contains( 'lre-story' ) ) ? root : document.querySelector( '.lre-story' ) );
                var watermark = root.querySelector( '.lre-story__watermark' ) || ( storySec ? storySec.querySelector( '.lre-story__watermark' ) : null );

                if ( storySec && watermark ) {
                    var updateStoryParallax = function () {
                        var rect = storySec.getBoundingClientRect();
                        var winH = window.innerHeight;
                        if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                            var progress = ( winH - rect.top ) / ( winH + rect.height );
                            var isMobile = window.innerWidth <= 768;
                            var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                            var yShift = ( progress - 0.5 ) * ( isMobile ? 16 : 36 );
                            watermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                        }
                    };
                    window.addEventListener( 'scroll', updateStoryParallax, { passive: true } );
                    updateStoryParallax();
                }
            }
        }
    };

    // =========================================================================
    // 14. ABOUT SERVICES (lre_about_services)
    // =========================================================================
    LREWidgets.AboutServices = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var aservSections = root.querySelectorAll( '.lre-aserv' );
            if ( ! aservSections.length && root.classList && root.classList.contains( 'lre-aserv' ) ) {
                aservSections = [ root ];
            }

            aservSections.forEach( function ( section ) {
                // Watermark Scroll Parallax (matching Team widget)
                if ( ! prefersReducedMotion ) {
                    var aservWatermark = section.querySelector( '.lre-aserv__watermark' );
                    if ( aservWatermark ) {
                        var updateAservParallax = function () {
                            var rect = section.getBoundingClientRect();
                            var winH = window.innerHeight;
                            if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                                var progress = ( winH - rect.top ) / ( winH + rect.height );
                                var isMobile = window.innerWidth <= 768;
                                var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                                var yShift = ( progress - 0.5 ) * ( isMobile ? 16 : 36 );
                                aservWatermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                            }
                        };
                        window.addEventListener( 'scroll', updateAservParallax, { passive: true } );
                        updateAservParallax();
                    }
                }
            } );

            // The Architectural Monolith (Expanding Panels Interaction)
            var monoliths = root.querySelectorAll( '.lre-aserv__monolith' );
            if ( monoliths.length ) {
                monoliths.forEach( function ( mono ) {
                    mono.addEventListener( 'mouseenter', function () {
                        monoliths.forEach( function ( m ) { m.classList.remove( 'is-active' ); } );
                        mono.classList.add( 'is-active' );
                    } );
                    mono.addEventListener( 'click', function ( e ) {
                        if ( e.target.closest( 'a' ) || e.target.closest( 'button' ) ) {
                            return;
                        }
                        monoliths.forEach( function ( m ) { m.classList.remove( 'is-active' ); } );
                        mono.classList.add( 'is-active' );
                    } );
                } );
            }

            // Interactive Split Image Switcher
            var showcaseImg = root.querySelector( '#lre-aserv-showcase-img' );
            var splitItems  = root.querySelectorAll( '.lre-aserv__split-item' );
            if ( showcaseImg && splitItems.length ) {
                splitItems.forEach( function ( item ) {
                    item.addEventListener( 'mouseenter', function () {
                        var newImg = item.getAttribute( 'data-img' );
                        if ( newImg && showcaseImg.src !== newImg ) {
                            showcaseImg.style.opacity = '0.35';
                            setTimeout( function () {
                                showcaseImg.src = newImg;
                                showcaseImg.style.opacity = '1';
                            }, 180 );
                        }
                    } );
                } );
            }
        }
    };

    // =========================================================================
    // 15. CLIENT REVIEWS & TRUST (lre_reviews)
    // =========================================================================
    LREWidgets.Reviews = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var revSections = root.querySelectorAll( '.lre-reviews' );
            if ( ! revSections.length && root.classList && root.classList.contains( 'lre-reviews' ) ) {
                revSections = [ root ];
            }
            if ( ! revSections.length ) {
                revSections = document.querySelectorAll( '.lre-reviews' );
            }

            revSections.forEach( function ( section ) {
                // Interactive Dossier Switcher
                var tabBtns   = section.querySelectorAll( '.lre-reviews__tab-btn' );
                var cards     = section.querySelectorAll( '.lre-reviews__dossier-card' );
                var prevBtn   = section.querySelector( '.lre-reviews__nav-btn--prev' );
                var nextBtn   = section.querySelector( '.lre-reviews__nav-btn--next' );
                var counterEl = section.querySelector( '.lre-reviews__active-num' );
                var totalCards = cards.length;

                if ( ! totalCards ) return;

                var currentIndex = 0;

                var switchDossier = function ( newIndex ) {
                    if ( newIndex < 0 ) newIndex = totalCards - 1;
                    if ( newIndex >= totalCards ) newIndex = 0;
                    if ( newIndex === currentIndex ) return;

                    tabBtns.forEach( function ( btn ) {
                        btn.classList.remove( 'is-active' );
                        btn.setAttribute( 'aria-selected', 'false' );
                    } );
                    cards.forEach( function ( card ) {
                        card.classList.remove( 'is-active' );
                        card.setAttribute( 'aria-hidden', 'true' );
                    } );

                    currentIndex = newIndex;

                    if ( tabBtns[currentIndex] ) {
                        tabBtns[currentIndex].classList.add( 'is-active' );
                        tabBtns[currentIndex].setAttribute( 'aria-selected', 'true' );
                    }
                    if ( cards[currentIndex] ) {
                        cards[currentIndex].classList.add( 'is-active' );
                        cards[currentIndex].setAttribute( 'aria-hidden', 'false' );
                    }
                    if ( counterEl ) {
                        counterEl.textContent = ( currentIndex + 1 < 10 ? '0' : '' ) + ( currentIndex + 1 );
                    }
                };

                // Tab Click
                tabBtns.forEach( function ( btn ) {
                    btn.addEventListener( 'click', function () {
                        var targetIdx = parseInt( this.getAttribute( 'data-index' ), 10 );
                        if ( ! isNaN( targetIdx ) ) {
                            switchDossier( targetIdx );
                        }
                    } );
                } );

                // Prev / Next Navigation
                if ( prevBtn ) {
                    prevBtn.addEventListener( 'click', function () {
                        switchDossier( currentIndex - 1 );
                    } );
                }
                if ( nextBtn ) {
                    nextBtn.addEventListener( 'click', function () {
                        switchDossier( currentIndex + 1 );
                    } );
                }

                // Touch Swipe on mobile
                var wrapper = section.querySelector( '.lre-reviews__dossiers-wrapper' );
                if ( wrapper ) {
                    var touchStartX = 0;
                    var touchEndX   = 0;

                    wrapper.addEventListener( 'touchstart', function ( e ) {
                        touchStartX = e.changedTouches[0].screenX;
                    }, { passive: true } );

                    wrapper.addEventListener( 'touchend', function ( e ) {
                        touchEndX = e.changedTouches[0].screenX;
                        var diff = touchStartX - touchEndX;
                        if ( Math.abs( diff ) > 45 ) {
                            if ( diff > 0 ) {
                                switchDossier( currentIndex + 1 );
                            } else {
                                switchDossier( currentIndex - 1 );
                            }
                        }
                    }, { passive: true } );
                }
            } );
        }
    };

    // =========================================================================
    // 16. PRESS & MEDIA (lre_press)
    // =========================================================================
    LREWidgets.Press = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );
        }
    };

    // =========================================================================
    // 17. PAGE HERO (lre_page_hero)
    // =========================================================================
    LREWidgets.PageHero = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );
        }
    };

    // =========================================================================
    // ELEMENTOR HOOK BINDINGS
    // =========================================================================
    function lreBindElementorHooks() {
        if ( typeof elementorFrontend === 'undefined' || ! elementorFrontend.hooks ) {
            return;
        }

        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_header.default',         function ( $scope ) { LREWidgets.Header.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_concierge.default',      function ( $scope ) { LREWidgets.Concierge.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_hero.default',           function ( $scope ) { LREWidgets.Hero.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_about.default',          function ( $scope ) { LREWidgets.About.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_services.default',       function ( $scope ) { LREWidgets.Services.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_properties.default',     function ( $scope ) { LREWidgets.Properties.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_testimonials.default',   function ( $scope ) { LREWidgets.Testimonials.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_communities.default',    function ( $scope ) { LREWidgets.Communities.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_team.default',           function ( $scope ) { LREWidgets.Team.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_cta.default',            function ( $scope ) { LREWidgets.CTA.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_footer.default',         function ( $scope ) { LREWidgets.Footer.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_story.default',          function ( $scope ) { LREWidgets.Story.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_about_services.default', function ( $scope ) { LREWidgets.AboutServices.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_reviews.default',        function ( $scope ) { LREWidgets.Reviews.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_press.default',          function ( $scope ) { LREWidgets.Press.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_page_hero.default',      function ( $scope ) { LREWidgets.PageHero.init( $scope ); } );
    }

    // Auto-run on DOM ready
    function lreInitAllWidgets() {
        LREWidgets.initReveals();
        LREWidgets.initImageZoom();
        if ( LREWidgets.Header )        LREWidgets.Header.init();
        if ( LREWidgets.Hero )          LREWidgets.Hero.init();
        if ( LREWidgets.Properties )    LREWidgets.Properties.init();
        if ( LREWidgets.Testimonials )  LREWidgets.Testimonials.init();
        if ( LREWidgets.Communities )   LREWidgets.Communities.init();
        if ( LREWidgets.Team )          LREWidgets.Team.init();
        if ( LREWidgets.CTA )           LREWidgets.CTA.init();
        if ( LREWidgets.Concierge )     LREWidgets.Concierge.init();
        if ( LREWidgets.Story )         LREWidgets.Story.init();
        if ( LREWidgets.AboutServices ) LREWidgets.AboutServices.init();
        if ( LREWidgets.Reviews )       LREWidgets.Reviews.init();
        if ( LREWidgets.Press )         LREWidgets.Press.init();
        if ( LREWidgets.PageHero )      LREWidgets.PageHero.init();
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