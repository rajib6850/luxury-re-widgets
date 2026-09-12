/**
 * Luxury Real Estate Widgets - Master Client-side JavaScript Suite
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
        var revealEls = root.querySelectorAll( '.reveal, .reveal--left, .reveal--right, .reveal--zoom, .reveal--stagger, .title-mask, .lre-story__header, .lre-team__header, .lre-aserv__header, .lre-reviews__header, .lre-comm-showcase__header, .lre-comm-frame, .lre-comm-showcase__filter-nav, .lre-contact__header, .lre-contact__desk, .lre-contact__form-wrapper, .about__text, .services__header, .listings__header, .testimonial__inner, .communities__header-text, .cta__content, .footer__main, .lre-press-editorial__masthead, .lre-press-editorial, .lre-newsletter-white__info, .lre-newsletter-white' );
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

        // Elementor Editor mode: immediately reveal all elements without waiting for scroll
        var isEditor = ( typeof elementorFrontend !== 'undefined' && elementorFrontend.isEditMode && elementorFrontend.isEditMode() ) ||
                       document.body.classList.contains( 'elementor-editor-active' ) ||
                       document.body.classList.contains( 'elementor-editor-preview' ) ||
                       document.body.classList.contains( 'elementor-edit-mode' ) ||
                       ( window.parent && window.parent !== window && window.parent.elementor );

        if ( isEditor ) {
            revealEls.forEach( triggerElementReveal );
            imageRevealEls.forEach( triggerElementReveal );
            var allEditorElements = root.querySelectorAll( '.reveal, .title-mask, .lre-comm-frame, .lre-comm-showcase__header, .lre-comm-showcase__filter-nav, .lre-contact__header, .lre-contact__desk, .lre-contact__form-wrapper, .lre-guide__header, .lre-guide__chapter, .lre-sguide__header, .lre-sguide__chapter, .lre-press-editorial__masthead, .lre-press-editorial, .lre-newsletter-white__info, .lre-newsletter-white' );
            allEditorElements.forEach( triggerElementReveal );
            return;
        }

        // Immediate smooth reveal for Hero section on page load / element ready
        var heroEls = root.querySelectorAll( '.hero .reveal, .hero.reveal, .hero__content, .hero__content .reveal, .hero__cta-group, .lre-phero .reveal, .lre-contact, .lre-contact .reveal, .lre-contact .title-mask, .lre-single-post__hero .reveal, .lre-single-post__featured-frame' );
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
            var sub = root.querySelector ? root.querySelector( '.hero__subtitle' ) : null;
            var cta = root.querySelector ? root.querySelector( '.hero__cta-group' ) : null;

            var isEdit = false;
            try {
                isEdit = ( window.elementorFrontend && window.elementorFrontend.isEditMode() ) ||
                         document.body.classList.contains( 'elementor-editor-active' ) ||
                         document.body.classList.contains( 'elementor-editor-preview' ) ||
                         document.body.classList.contains( 'elementor-edit-mode' );
            } catch ( e ) {}

            if ( isEdit ) {
                for ( var m = 0; m < heroTitles.length; m++ ) {
                    heroTitles[m].style.animation = 'none';
                    heroTitles[m].style.transform = 'none';
                    heroTitles[m].style.opacity = '1';
                }
                if ( sub ) {
                    sub.style.animation = 'none';
                    sub.style.transform = 'none';
                    sub.style.opacity = '1';
                }
                if ( cta ) {
                    cta.style.animation = 'none';
                    cta.style.transform = 'none';
                    cta.style.opacity = '1';
                }
            } else {
                for ( var m = 0; m < heroTitles.length; m++ ) {
                    ( function ( span, idx ) {
                        span.style.animation = 'none';
                        void span.offsetWidth;
                        span.style.animation = 'heroMaskUp 1.2s cubic-bezier(0.16, 0.84, 0.44, 1) ' + ( 0.3 + idx * 0.22 ) + 's forwards';
                    } )( heroTitles[m], m );
                }

                if ( sub ) {
                    sub.style.animation = 'none';
                    void sub.offsetWidth;
                    sub.style.animation = 'heroFadeUp 1.1s cubic-bezier(0.16, 0.84, 0.44, 1) 0.7s forwards';
                }

                if ( cta ) {
                    cta.style.animation = 'none';
                    void cta.offsetWidth;
                    cta.style.animation = 'heroFadeUp 1.1s cubic-bezier(0.16, 0.84, 0.44, 1) 0.9s forwards';
                }
            }

            var sliders = root.querySelectorAll ? root.querySelectorAll( '.hero__slider' ) : [];
            if ( ! sliders.length && root.classList && root.classList.contains( 'hero__slider' ) ) {
                sliders = [ root ];
            }

            for ( var s = 0; s < sliders.length; s++ ) {
                ( function ( slider ) {
                    var slides = slider.querySelectorAll( '.hero__slide' );
                    if ( ! slides.length ) return;

                    var hasActive = false;
                    for ( var a = 0; a < slides.length; a++ ) {
                        if ( slides[a].classList.contains( 'active' ) ) {
                            hasActive = true;
                            break;
                        }
                    }
                    if ( ! hasActive ) {
                        slides[0].classList.add( 'active' );
                    }

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
    // =========================================================================
    // 8. FEATURED PROPERTIES (CAROUSEL, GRID PAGINATION & LIKES)
    // =========================================================================
    LREWidgets.Properties = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            if ( ! root ) return;

            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            // --- A. Heart Favorite / Wishlist Button Toggle (Grid & Carousel) ---
            var likeButtons = root.querySelectorAll( '.listing-card__like-btn' );
            likeButtons.forEach( function ( btn ) {
                if ( btn.getAttribute( 'data-lre-bound' ) ) return;
                btn.setAttribute( 'data-lre-bound', 'true' );
                btn.addEventListener( 'click', function ( e ) {
                    e.preventDefault();
                    e.stopPropagation();
                    btn.classList.toggle( 'liked' );
                } );
            } );

            // --- B. Carousel Mode ---
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

                // Autoplay Support
                var autoplayEnabled = carousel.getAttribute( 'data-autoplay' ) === 'yes';
                var autoplaySpeed = parseInt( carousel.getAttribute( 'data-autoplay-speed' ), 10 ) || 4500;
                var pauseOnHover = carousel.getAttribute( 'data-pause-on-hover' ) !== 'no';
                var autoplayTimer = null;

                var startAutoplay = function () {
                    if ( ! autoplayEnabled || autoplayTimer ) return;
                    autoplayTimer = setInterval( function () {
                        var maxScroll = carousel.scrollWidth - carousel.clientWidth;
                        if ( maxScroll <= 0 ) return;
                        if ( carousel.scrollLeft >= maxScroll - 15 ) {
                            carousel.scrollTo( { left: 0, behavior: 'smooth' } );
                        } else {
                            carousel.scrollBy( { left: getScrollAmount(), behavior: 'smooth' } );
                        }
                    }, autoplaySpeed );
                };

                var stopAutoplay = function () {
                    if ( autoplayTimer ) {
                        clearInterval( autoplayTimer );
                        autoplayTimer = null;
                    }
                };

                if ( autoplayEnabled ) {
                    startAutoplay();
                    if ( pauseOnHover ) {
                        carousel.addEventListener( 'mouseenter', stopAutoplay );
                        carousel.addEventListener( 'mouseleave', startAutoplay );
                    }
                }
            }

            // --- C. Grid Mode & Pagination ---
            var gridWrapper = root.querySelector( '.listings__grid-wrapper' );
            var grid = root.querySelector( '#listings-grid' ) || root.querySelector( '.listings__grid' );

            if ( gridWrapper && grid ) {
                var paginationType = gridWrapper.getAttribute( 'data-pagination-type' ) || 'numbers';
                var totalPages = parseInt( gridWrapper.getAttribute( 'data-total-pages' ), 10 ) || 1;
                var cards = grid.querySelectorAll( '.listing-card' );

                // 1. Numbered Pagination
                if ( paginationType === 'numbers' && totalPages > 1 ) {
                    var paginationNav = gridWrapper.querySelector( '.listings__pagination' );
                    if ( paginationNav ) {
                        var pageButtons = paginationNav.querySelectorAll( '.listings__pagination-btn[data-page]' );
                        var prevPageBtn = paginationNav.querySelector( '.listings__pagination-prev' );
                        var nextPageBtn = paginationNav.querySelector( '.listings__pagination-next' );
                        var currentPage = 1;

                        var goToPage = function ( page, shouldScroll ) {
                            if ( page < 1 || page > totalPages ) return;
                            currentPage = page;

                            // Update cards visibility
                            cards.forEach( function ( card ) {
                                var cardPage = parseInt( card.getAttribute( 'data-page' ), 10 ) || 1;
                                if ( cardPage === currentPage ) {
                                    card.classList.remove( 'is-hidden' );
                                    card.classList.remove( 'fade-in-up' );
                                    // Trigger reflow for smooth re-animation
                                    void card.offsetWidth;
                                    card.classList.add( 'fade-in-up' );
                                } else {
                                    card.classList.add( 'is-hidden' );
                                    card.classList.remove( 'fade-in-up' );
                                }
                            } );

                            // Update number buttons
                            pageButtons.forEach( function ( btn ) {
                                var btnPage = parseInt( btn.getAttribute( 'data-page' ), 10 );
                                var isActive = ( btnPage === currentPage );
                                btn.classList.toggle( 'is-active', isActive );
                                btn.setAttribute( 'aria-current', isActive ? 'page' : 'false' );
                            } );

                            // Update prev/next arrows
                            if ( prevPageBtn ) {
                                prevPageBtn.disabled = ( currentPage <= 1 );
                            }
                            if ( nextPageBtn ) {
                                nextPageBtn.disabled = ( currentPage >= totalPages );
                            }

                            // Re-init image reveal & zoom
                            LREWidgets.initReveals( $scope );
                            LREWidgets.initImageZoom( $scope );

                            // Smooth scroll up to widget header
                            if ( shouldScroll ) {
                                var headerEl = root.querySelector( '.listings__header' ) || gridWrapper;
                                if ( headerEl ) {
                                    var headerRect = headerEl.getBoundingClientRect();
                                    var offsetTop = window.pageYOffset + headerRect.top - 80;
                                    window.scrollTo( { top: Math.max( 0, offsetTop ), behavior: 'smooth' } );
                                }
                            }
                        };

                        pageButtons.forEach( function ( btn ) {
                            btn.addEventListener( 'click', function ( e ) {
                                e.preventDefault();
                                var targetPage = parseInt( btn.getAttribute( 'data-page' ), 10 );
                                if ( targetPage && targetPage !== currentPage ) {
                                    goToPage( targetPage, true );
                                }
                            } );
                        } );

                        if ( prevPageBtn ) {
                            prevPageBtn.addEventListener( 'click', function ( e ) {
                                e.preventDefault();
                                if ( currentPage > 1 ) {
                                    goToPage( currentPage - 1, true );
                                }
                            } );
                        }

                        if ( nextPageBtn ) {
                            nextPageBtn.addEventListener( 'click', function ( e ) {
                                e.preventDefault();
                                if ( currentPage < totalPages ) {
                                    goToPage( currentPage + 1, true );
                                }
                            } );
                        }
                    }
                }

                // 2. Load More Button
                if ( paginationType === 'load_more' && totalPages > 1 ) {
                    var loadMoreBtn = gridWrapper.querySelector( '.listings__load-more-btn' );
                    if ( loadMoreBtn ) {
                        loadMoreBtn.addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            var curPage = parseInt( loadMoreBtn.getAttribute( 'data-current-page' ), 10 ) || 1;
                            var nxtPage = curPage + 1;

                            if ( nxtPage <= totalPages ) {
                                cards.forEach( function ( card ) {
                                    var cardPage = parseInt( card.getAttribute( 'data-page' ), 10 ) || 1;
                                    if ( cardPage === nxtPage ) {
                                        card.classList.remove( 'is-hidden' );
                                        card.classList.remove( 'fade-in-up' );
                                        void card.offsetWidth;
                                        card.classList.add( 'fade-in-up' );
                                    }
                                } );

                                loadMoreBtn.setAttribute( 'data-current-page', nxtPage );

                                if ( nxtPage >= totalPages ) {
                                    loadMoreBtn.classList.add( 'is-hidden' );
                                }

                                LREWidgets.initReveals( $scope );
                                LREWidgets.initImageZoom( $scope );
                            }
                        } );
                    }
                }
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

                var rawCards = Array.prototype.slice.call( communitiesTrack.children );
                var baseCount = rawCards.length;
                var slideDisabled = communitiesSlider.getAttribute( 'data-slide-enabled' ) === 'false';

                // 3 or fewer items or slide disabled: static luxury grid, no slider needed
                if ( baseCount <= 3 || slideDisabled ) {
                    communitiesTrack.dataset.sliderInit = 'static';
                    communitiesSlider.style.cursor = 'default';
                    return;
                }

                communitiesTrack.dataset.sliderInit = 'true';

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
                        if ( window.innerWidth > 1024 ) {
                            monoliths.forEach( function ( m ) { m.classList.remove( 'is-active' ); } );
                            mono.classList.add( 'is-active' );
                        }
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

                var isAutoplay    = section.getAttribute( 'data-autoplay' ) === 'yes';
                var autoplaySpeed = parseInt( section.getAttribute( 'data-speed' ), 10 ) || 5000;
                var pauseOnHover  = section.getAttribute( 'data-pause-hover' ) !== 'no';
                var infiniteLoop  = section.getAttribute( 'data-loop' ) !== 'no';
                var autoplayTimer = null;
                var isPaused      = false;
                var currentIndex  = 0;

                var updateNavState = function () {
                    if ( ! infiniteLoop ) {
                        if ( prevBtn ) {
                            if ( currentIndex <= 0 ) {
                                prevBtn.setAttribute( 'disabled', 'disabled' );
                                prevBtn.classList.add( 'is-disabled' );
                            } else {
                                prevBtn.removeAttribute( 'disabled' );
                                prevBtn.classList.remove( 'is-disabled' );
                            }
                        }
                        if ( nextBtn ) {
                            if ( currentIndex >= totalCards - 1 ) {
                                nextBtn.setAttribute( 'disabled', 'disabled' );
                                nextBtn.classList.add( 'is-disabled' );
                            } else {
                                nextBtn.removeAttribute( 'disabled' );
                                nextBtn.classList.remove( 'is-disabled' );
                            }
                        }
                    }
                };

                var switchDossier = function ( newIndex ) {
                    if ( ! infiniteLoop ) {
                        if ( newIndex < 0 || newIndex >= totalCards ) {
                            updateNavState();
                            return;
                        }
                    } else {
                        if ( newIndex < 0 ) newIndex = totalCards - 1;
                        if ( newIndex >= totalCards ) newIndex = 0;
                    }

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

                    updateNavState();
                };

                // Initial navigation state
                updateNavState();

                // Autoplay Engine
                var startAutoplay = function () {
                    if ( ! isAutoplay || totalCards <= 1 ) return;
                    stopAutoplay();
                    autoplayTimer = setInterval( function () {
                        if ( ! isPaused ) {
                            var nextIdx = currentIndex + 1;
                            if ( nextIdx >= totalCards && ! infiniteLoop ) {
                                nextIdx = 0; // loop back on autoplay even if manual nav is non-infinite
                            }
                            switchDossier( nextIdx );
                        }
                    }, autoplaySpeed );
                };

                var stopAutoplay = function () {
                    if ( autoplayTimer ) {
                        clearInterval( autoplayTimer );
                        autoplayTimer = null;
                    }
                };

                var resetAutoplay = function () {
                    if ( isAutoplay ) {
                        stopAutoplay();
                        startAutoplay();
                    }
                };

                if ( isAutoplay ) {
                    startAutoplay();
                    if ( pauseOnHover ) {
                        section.addEventListener( 'mouseenter', function () {
                            isPaused = true;
                        } );
                        section.addEventListener( 'mouseleave', function () {
                            isPaused = false;
                        } );
                    }
                }

                // Tab Click
                tabBtns.forEach( function ( btn ) {
                    btn.addEventListener( 'click', function () {
                        var targetIdx = parseInt( this.getAttribute( 'data-index' ), 10 );
                        if ( ! isNaN( targetIdx ) ) {
                            switchDossier( targetIdx );
                            resetAutoplay();
                        }
                    } );
                } );

                // Prev / Next Navigation
                if ( prevBtn ) {
                    prevBtn.addEventListener( 'click', function () {
                        switchDossier( currentIndex - 1 );
                        resetAutoplay();
                    } );
                }
                if ( nextBtn ) {
                    nextBtn.addEventListener( 'click', function () {
                        switchDossier( currentIndex + 1 );
                        resetAutoplay();
                    } );
                }

                // Touch Swipe on mobile
                var wrapper = section.querySelector( '.lre-reviews__dossiers-wrapper' );
                if ( wrapper ) {
                    var touchStartX = 0;
                    var touchEndX   = 0;

                    wrapper.addEventListener( 'touchstart', function ( e ) {
                        touchStartX = e.changedTouches[0].screenX;
                        if ( isAutoplay && pauseOnHover ) {
                            isPaused = true;
                        }
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
                            resetAutoplay();
                        }
                        if ( isAutoplay && pauseOnHover ) {
                            setTimeout( function () { isPaused = false; }, 1000 );
                        }
                    }, { passive: true } );
                }
            } );
        }
    };

    // =========================================================================
    // 16. PAGE HERO (lre_page_hero)
    // =========================================================================
    LREWidgets.PageHero = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );
        }
    };

    // =========================================================================
    // 16. COMMUNITIES SHOWCASE - Minimal Lifestyle Filter Navigation
    // =========================================================================
    LREWidgets.CommunitiesShowcase = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            var sections = root.querySelectorAll( '.lre-comm-showcase' );
            if ( ! sections.length ) return;

            sections.forEach( function ( section ) {
                var navItems = section.querySelectorAll( '.lre-comm-nav-item' );
                var frames   = section.querySelectorAll( '.lre-comm-frame' );
                if ( ! navItems.length || ! frames.length ) return;

                navItems.forEach( function ( item ) {
                    item.addEventListener( 'click', function () {
                        navItems.forEach( function ( n ) { n.classList.remove( 'is-active' ); } );
                        item.classList.add( 'is-active' );
                        var filterVal = item.getAttribute( 'data-filter' ) || 'all';

                        frames.forEach( function ( frame ) {
                            var frameCat = frame.getAttribute( 'data-category' ) || '';
                            if ( filterVal === 'all' || frameCat === filterVal ) {
                                frame.style.display = '';
                            } else {
                                frame.style.display = 'none';
                            }
                        } );
                    } );
                } );
            } );
        }
    };

    // =========================================================================
    // 17. CONTACT & BESPOKE ADVISORY (lre_contact)
    // =========================================================================
    LREWidgets.Contact = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            var contactSections = root.querySelectorAll( '.lre-contact' );

            contactSections.forEach( function ( section ) {
                // Immediate entrance animation on page load / widget mount
                setTimeout( function () {
                    section.classList.add( 'revealed' );
                    var masks = section.querySelectorAll( '.title-mask' );
                    masks.forEach( function ( m ) { m.classList.add( 'revealed' ); } );
                    var reveals = section.querySelectorAll( '.reveal' );
                    reveals.forEach( function ( r ) { r.classList.add( 'revealed' ); } );
                }, 100 );

                var form = section.querySelector( '.lre-contact__form' );
                if ( form ) {
                    form.addEventListener( 'submit', function ( e ) {
                        e.preventDefault();

                        var btn      = form.querySelector( '.lre-contact__submit-btn' );
                        var feedback = form.querySelector( '.lre-contact__feedback' );

                        // Required Field Validation
                        var requiredFields = form.querySelectorAll( '[required]' );
                        var hasError = false;
                        var firstInvalid = null;

                        requiredFields.forEach( function ( input ) {
                            if ( input.type === 'checkbox' ) {
                                if ( ! input.checked ) {
                                    hasError = true;
                                    if ( ! firstInvalid ) firstInvalid = input;
                                }
                            } else if ( ! input.value.trim() ) {
                                hasError = true;
                                if ( ! firstInvalid ) firstInvalid = input;
                            }
                        } );

                        if ( hasError && firstInvalid ) {
                            firstInvalid.focus();
                            if ( feedback ) {
                                feedback.className = 'lre-contact__feedback lre-contact__feedback--error';
                                feedback.textContent = 'Please complete all required fields.';
                                feedback.style.display = 'block';
                            }
                            return;
                        }

                        // Button Loading State
                        var btnText = btn ? btn.querySelector( '.lre-contact__btn-text' ) : null;
                        var originalText = btnText ? btnText.textContent : 'SUBMIT';
                        if ( btn ) {
                            btn.disabled = true;
                            btn.classList.add( 'is-loading' );
                            if ( btnText ) {
                                btnText.textContent = 'TRANSMITTING...';
                            }
                        }

                        if ( feedback ) {
                            feedback.style.display = 'none';
                        }

                        var ajaxEndpoint = form.getAttribute( 'action' ) || ( typeof LREData !== 'undefined' && LREData.ajaxUrl ? LREData.ajaxUrl : '/wp-admin/admin-ajax.php' );
                        var formData = new FormData( form );

                        // Ensure action & nonce are included
                        if ( ! formData.get( 'action' ) ) {
                            formData.append( 'action', 'lre_contact_submit' );
                        }
                        if ( ! formData.get( 'nonce' ) && typeof LREData !== 'undefined' && LREData.nonce ) {
                            formData.append( 'nonce', LREData.nonce );
                        }

                        fetch( ajaxEndpoint, {
                            method: 'POST',
                            body: formData
                        } )
                        .then( function ( res ) { return res.json(); } )
                        .then( function ( res ) {
                            if ( btn ) {
                                btn.disabled = false;
                                btn.classList.remove( 'is-loading' );
                                if ( btnText ) btnText.textContent = originalText;
                            }

                            if ( feedback ) {
                                var msg = res.data && res.data.message ? res.data.message : ( res.success ? 'Your message has been sent successfully.' : 'An error occurred. Please try again.' );
                                feedback.className = 'lre-contact__feedback ' + ( res.success ? 'lre-contact__feedback--success' : 'lre-contact__feedback--error' );
                                feedback.textContent = msg;
                                feedback.style.display = 'block';
                                feedback.scrollIntoView( { behavior: 'smooth', block: 'nearest' } );
                            }

                            if ( res.success ) {
                                form.reset();

                                // Optional Redirect
                                if ( res.data && res.data.redirect_url ) {
                                    setTimeout( function () {
                                        window.location.href = res.data.redirect_url;
                                    }, 1200 );
                                }
                            }
                        } )
                        .catch( function ( err ) {
                            if ( btn ) {
                                btn.disabled = false;
                                btn.classList.remove( 'is-loading' );
                                if ( btnText ) btnText.textContent = originalText;
                            }
                            if ( feedback ) {
                                feedback.className = 'lre-contact__feedback lre-contact__feedback--error';
                                feedback.textContent = 'A network error occurred. Please check your connection and try again.';
                                feedback.style.display = 'block';
                            }
                            console.error( 'LRE Contact submit error:', err );
                        } );
                    } );
                }
            } );
        }
    };

    // -------------------------------------------------------------------------
    // BUYING GUIDE & ACQUISITION PROTOCOL WIDGET
    // -------------------------------------------------------------------------
    // =========================================================================
    // 18. BUYING GUIDE - Super-Luxury Editorial Monograph
    // =========================================================================
    LREWidgets.BuyingGuide = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var root = $scope ? $scope[0] : document;
            var guideSections = root.querySelectorAll( '.lre-guide' );
            guideSections.forEach( function ( section ) {
                if ( ! prefersReducedMotion ) {
                    var watermark = section.querySelector( '.lre-guide__watermark' );
                    if ( watermark ) {
                        var updateGuideParallax = function () {
                            var rect = section.getBoundingClientRect();
                            var winH = window.innerHeight;
                            if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                                var progress = ( winH - rect.top ) / ( winH + rect.height );
                                var isMobile = window.innerWidth <= 768;
                                var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                                var yShift = ( progress - 0.5 ) * ( isMobile ? 16 : 36 );
                                watermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                            }
                        };
                        window.addEventListener( 'scroll', updateGuideParallax, { passive: true } );
                        updateGuideParallax();
                    }
                }
            } );
        }
    };

    // =========================================================================
    // 19. SELLER'S GUIDE - Super-Luxury Editorial Monograph
    // =========================================================================
    LREWidgets.SellersGuide = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
            LREWidgets.initImageZoom( $scope );

            var root = $scope ? $scope[0] : document;
            var sguideSections = root.querySelectorAll( '.lre-sguide' );
            sguideSections.forEach( function ( section ) {
                if ( ! prefersReducedMotion ) {
                    var watermark = section.querySelector( '.lre-sguide__watermark' );
                    if ( watermark ) {
                        var updateSguideParallax = function () {
                            var rect = section.getBoundingClientRect();
                            var winH = window.innerHeight;
                            if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                                var progress = ( winH - rect.top ) / ( winH + rect.height );
                                var isMobile = window.innerWidth <= 768;
                                var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                                var yShift = ( progress - 0.5 ) * ( isMobile ? 16 : 36 );
                                watermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                            }
                        };
                        window.addEventListener( 'scroll', updateSguideParallax, { passive: true } );
                        updateSguideParallax();
                    }
                }
            } );
        }
    };

    // =========================================================================
    // 20. PRESS & RECOGNITION - Reveal & Interactivity
    // =========================================================================
    LREWidgets.Press = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );
        }
    };

    // =========================================================================
    // 21. GLOBAL NEWSLETTER - AJAX Lead Capture
    // =========================================================================
    LREWidgets.Newsletter = {
        init: function ( $scope ) {
            LREWidgets.initReveals( $scope );

            var root = $scope ? $scope[0] : document;
            var forms = root.querySelectorAll( '.lre-newsletter__form' );

            forms.forEach( function ( form ) {
                if ( form.dataset.lreBound ) {
                    return;
                }
                form.dataset.lreBound = 'true';

                form.addEventListener( 'submit', function ( e ) {
                    e.preventDefault();

                    var emailInput = form.querySelector( 'input[name="email"]' );
                    var submitBtn  = form.querySelector( '.lre-newsletter__btn' );
                    var msgBox     = form.querySelector( '.lre-newsletter__message' );
                    var nonceInput = form.querySelector( 'input[name="nonce"]' );

                    var email = emailInput ? emailInput.value.trim() : '';
                    var nonce = ( nonceInput && nonceInput.value ) ? nonceInput.value : ( window.LREData && LREData.nonce ? LREData.nonce : '' );
                    var ajaxUrl = ( window.LREData && LREData.ajaxUrl ) ? LREData.ajaxUrl : '/wp-admin/admin-ajax.php';

                    var consentInput = form.querySelector( 'input[name="consent"]' );
                    if ( consentInput && ! consentInput.checked ) {
                        if ( msgBox ) {
                            msgBox.textContent = 'Please agree to the privacy policy to continue.';
                            msgBox.className = 'lre-newsletter__message is-active is-error';
                        }
                        return;
                    }

                    if ( ! email || email.indexOf( '@' ) === -1 || email.indexOf( '.' ) === -1 ) {
                        var invalidMsgInput = form.querySelector( 'input[name="invalid_email_message"]' );
                        var invalidMsg = invalidMsgInput && invalidMsgInput.value ? invalidMsgInput.value : 'Please enter a valid email address.';
                        if ( msgBox ) {
                            msgBox.textContent = invalidMsg;
                            msgBox.className = 'lre-newsletter__message is-active is-error';
                        }
                        return;
                    }

                    // Loading State
                    if ( submitBtn ) {
                        submitBtn.classList.add( 'is-loading' );
                        submitBtn.disabled = true;
                    }
                    if ( msgBox ) {
                        msgBox.className = 'lre-newsletter__message';
                        msgBox.textContent = '';
                    }

                    var formData = new FormData( form );
                    if ( ! formData.get( 'action' ) ) {
                        formData.append( 'action', 'lre_newsletter_submit' );
                    }
                    if ( ! formData.get( 'nonce' ) && nonce ) {
                        formData.append( 'nonce', nonce );
                    }

                    fetch( ajaxUrl, {
                        method: 'POST',
                        body: formData
                    } )
                    .then( function ( res ) {
                        return res.json();
                    } )
                    .then( function ( data ) {
                        if ( submitBtn ) {
                            submitBtn.classList.remove( 'is-loading' );
                            submitBtn.disabled = false;
                        }
                        if ( msgBox ) {
                            if ( data && data.success ) {
                                msgBox.textContent = ( data.data && data.data.message ) ? data.data.message : 'Thank you for subscribing. Welcome to The Aguirre Report.';
                                msgBox.className = 'lre-newsletter__message is-active is-success';
                                form.reset();

                                if ( data.data && data.data.redirect_url ) {
                                    setTimeout( function () {
                                        window.location.href = data.data.redirect_url;
                                    }, 1200 );
                                }
                            } else {
                                msgBox.textContent = ( data && data.data && data.data.message ) ? data.data.message : 'Subscription failed. Please try again.';
                                msgBox.className = 'lre-newsletter__message is-active is-error';
                            }
                        }
                    } )
                    .catch( function () {
                        if ( submitBtn ) {
                            submitBtn.classList.remove( 'is-loading' );
                            submitBtn.disabled = false;
                        }
                        if ( msgBox ) {
                            msgBox.textContent = 'A connection error occurred. Please try again.';
                            msgBox.className = 'lre-newsletter__message is-active is-error';
                        }
                    } );
                } );
            } );
        }
    };

    // =========================================================================
    // PRESS & RECOGNITION (EDITORIAL MAGAZINE SPREAD)
    // =========================================================================
    LREWidgets.Press = {
        init: function ( $scope ) {
            var $strip = $scope ? $( $scope ).find( '.lre-press-strip' ) : $( '.lre-press-strip' );
            if ( ! $strip.length ) {
                return;
            }

            if ( typeof LREWidgets.initReveals === 'function' ) {
                LREWidgets.initReveals();
            }

            // Watermark Scroll Parallax (matching About, Team, Story & Services widgets)
            if ( ! prefersReducedMotion ) {
                $strip.each( function () {
                    var section = this;
                    var watermark = section.querySelector( '.lre-press-strip__watermark' );
                    if ( watermark && ! watermark._lreParallaxAttached ) {
                        watermark._lreParallaxAttached = true;
                        var updatePressParallax = function () {
                            var rect = section.getBoundingClientRect();
                            var winH = window.innerHeight;
                            if ( rect.bottom >= -100 && rect.top <= winH + 100 ) {
                                var progress = ( winH - rect.top ) / ( winH + rect.height );
                                var isMobile = window.innerWidth <= 768;
                                var xShift = isMobile ? -50 : ( -50 + ( progress - 0.5 ) * 20 );
                                var yShift = ( progress - 0.5 ) * ( isMobile ? 14 : 32 );
                                watermark.style.transform = 'translate3d(' + xShift + '%, ' + yShift + 'px, 0)';
                            }
                        };
                        window.addEventListener( 'scroll', updatePressParallax, { passive: true } );
                        window.addEventListener( 'resize', updatePressParallax, { passive: true } );
                        updatePressParallax();
                    }
                } );
            }

            // If in Elementor editor mode, immediately show revealed items
            if ( $( 'body' ).hasClass( 'elementor-editor-active' ) || $( 'body' ).hasClass( 'elementor-edit-mode' ) ) {
                $strip.find( '.reveal' ).addClass( 'revealed' );
            }
        }
    };

    // =========================================================================
    // ELEMENTOR HOOK BINDINGS
    // =========================================================================
    
    // =========================================================================
    // LRE HOME VALUATION & MULTI-STEP VALUATION ENGINE
    // =========================================================================
    LREWidgets.HomeValuation = {
        init: function ( $scope ) {
            var context = ( $scope && $scope[0] ) ? $scope[0] : document;
            var sections = context.querySelectorAll( '[data-lre-widget="lre-home-valuation"]' );
            if ( ! sections.length && context.classList && context.classList.contains( 'lre-home-val' ) ) {
                sections = [ context ];
            }

            sections.forEach( function ( section ) {
                if ( section.getAttribute( 'data-eval-initialized' ) === 'true' ) return;
                section.setAttribute( 'data-eval-initialized', 'true' );

                var form = section.querySelector( '.lre-home-val__form' );
                var tabs = section.querySelectorAll( '.lre-home-val__step-tab' );
                var panes = section.querySelectorAll( '.lre-home-val__step-pane' );
                var successBox = section.querySelector( '.lre-home-val__success-state' );
                var resetBtn = section.querySelector( '.lre-home-val__reset-btn' );
                var progressFill = section.querySelector( '.lre-home-val__progress-bar' );

                function goToStep( targetStep ) {
                    tabs.forEach( function ( tab ) {
                        var stepNum = parseInt( tab.getAttribute( 'data-step' ), 10 );
                        if ( stepNum === targetStep ) {
                            tab.classList.add( 'active' );
                        } else {
                            tab.classList.remove( 'active' );
                        }
                    } );

                    if ( progressFill && tabs.length > 0 ) {
                        var percent = ( targetStep / tabs.length ) * 100;
                        progressFill.style.width = percent + '%';
                    }

                    panes.forEach( function ( pane ) {
                        var paneNum = parseInt( pane.getAttribute( 'data-step-pane' ), 10 );
                        if ( paneNum === targetStep ) {
                            pane.style.display = 'block';
                            pane.style.opacity = '0';
                            pane.style.transform = 'translateY(12px)';
                            setTimeout( function () {
                                pane.style.transition = 'opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                                pane.style.opacity = '1';
                                pane.style.transform = 'translateY(0)';
                                pane.classList.add( 'active' );
                            }, 20 );
                        } else {
                            pane.style.display = 'none';
                            pane.classList.remove( 'active' );
                        }
                    } );
                }

                function validateStep( currentStep ) {
                    var currentPane = section.querySelector( '.lre-home-val__step-pane[data-step-pane="' + currentStep + '"]' );
                    if ( ! currentPane ) return true;

                    var requiredInputs = currentPane.querySelectorAll( '[required]' );
                    var isValid = true;
                    var firstInvalid = null;

                    requiredInputs.forEach( function ( input ) {
                        if ( ! input.value || ! input.value.trim() ) {
                            isValid = false;
                            input.classList.add( 'lre-input-error' );
                            if ( ! firstInvalid ) firstInvalid = input;
                        } else {
                            input.classList.remove( 'lre-input-error' );
                        }
                    } );

                    if ( ! isValid && firstInvalid ) {
                        firstInvalid.focus();
                    }

                    return isValid;
                }

                // Tab clicks
                tabs.forEach( function ( tab ) {
                    tab.addEventListener( 'click', function () {
                        var targetStep = parseInt( tab.getAttribute( 'data-step' ), 10 );
                        var currentActiveTab = section.querySelector( '.lre-home-val__step-tab.active' );
                        var currentStep = currentActiveTab ? parseInt( currentActiveTab.getAttribute( 'data-step' ), 10 ) : 1;

                        if ( targetStep > currentStep ) {
                            if ( ! validateStep( currentStep ) ) return;
                        }
                        goToStep( targetStep );
                    } );
                } );

                // Next buttons
                var nextBtns = section.querySelectorAll( '.lre-home-val__btn--next' );
                nextBtns.forEach( function ( btn ) {
                    btn.addEventListener( 'click', function () {
                        var nextStep = parseInt( btn.getAttribute( 'data-next' ), 10 );
                        var currentStep = nextStep - 1;
                        if ( validateStep( currentStep ) ) {
                            goToStep( nextStep );
                        }
                    } );
                } );

                // Back buttons
                var backBtns = section.querySelectorAll( '.lre-home-val__btn-back' );
                backBtns.forEach( function ( btn ) {
                    btn.addEventListener( 'click', function () {
                        var prevStep = parseInt( btn.getAttribute( 'data-prev' ), 10 );
                        goToStep( prevStep );
                    } );
                } );

                // Check Item / Radio Box Sync
                var checkItems = section.querySelectorAll( '.lre-home-val__check-item' );
                checkItems.forEach( function ( box ) {
                    var input = box.querySelector( 'input' );
                    if ( ! input ) return;

                    function syncBox() {
                        if ( input.type === 'radio' ) {
                            var group = section.querySelectorAll( 'input[name="' + input.name + '"]' );
                            group.forEach( function ( r ) {
                                var p = r.closest( '.lre-home-val__check-item' );
                                if ( p ) p.classList.toggle( 'is-checked', r.checked );
                            } );
                        } else {
                            box.classList.toggle( 'is-checked', input.checked );
                        }
                    }

                    input.addEventListener( 'change', syncBox );
                    syncBox();
                } );

                // Input error clear
                var allInputs = section.querySelectorAll( '.lre-home-val__input' );
                allInputs.forEach( function ( input ) {
                    input.addEventListener( 'input', function () {
                        input.classList.remove( 'lre-input-error' );
                    } );
                } );

                // Form AJAX Submit
                if ( form ) {
                    form.addEventListener( 'submit', function ( e ) {
                        e.preventDefault();

                        var currentActiveTab = section.querySelector( '.lre-home-val__step-tab.active' );
                        var currentStep = currentActiveTab ? parseInt( currentActiveTab.getAttribute( 'data-step' ), 10 ) : 3;
                        if ( ! validateStep( currentStep ) ) return;

                        var submitBtn = form.querySelector( '.lre-home-val__btn--submit' );
                        var originalBtnHtml = submitBtn ? submitBtn.innerHTML : '';

                        if ( submitBtn ) {
                            submitBtn.disabled = true;
                            submitBtn.innerHTML = '<span>Processing Valuation...</span>';
                        }

                        var ajaxUrl = ( window.LREData && window.LREData.ajaxUrl )
                            ? window.LREData.ajaxUrl
                            : ( form.getAttribute( 'action' ) || ( window.location.origin + '/wp-admin/admin-ajax.php' ) );

                        var formData = new FormData( form );

                        fetch( ajaxUrl, {
                            method: 'POST',
                            body: formData,
                            credentials: 'same-origin'
                        } )
                        .then( function ( response ) {
                            return response.json();
                        } )
                        .then( function ( data ) {
                            if ( data && data.success ) {
                                form.style.display = 'none';
                                if ( successBox ) {
                                    successBox.style.display = 'block';
                                    successBox.style.opacity = '0';
                                    successBox.style.transform = 'translateY(16px)';
                                    setTimeout( function () {
                                        successBox.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                                        successBox.style.opacity = '1';
                                        successBox.style.transform = 'translateY(0)';
                                    }, 30 );
                                }
                                section.scrollIntoView( { behavior: 'smooth', block: 'start' } );
                            } else {
                                var errMsg = ( data && data.data && data.data.message ) ? data.data.message : 'An error occurred. Please try again.';
                                alert( errMsg );
                                if ( submitBtn ) {
                                    submitBtn.disabled = false;
                                    submitBtn.innerHTML = originalBtnHtml;
                                }
                            }
                        } )
                        .catch( function ( err ) {
                            console.error( 'Home Valuation Submit Error:', err );
                            alert( 'Submission could not be completed. Please try again.' );
                            if ( submitBtn ) {
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalBtnHtml;
                            }
                        } );
                    } );
                }

                // Reset
                if ( resetBtn ) {
                    resetBtn.addEventListener( 'click', function () {
                        if ( form ) {
                            form.reset();
                            form.style.display = 'block';
                            checkItems.forEach( function ( b ) {
                                b.classList.remove( 'is-checked' );
                            } );
                        }
                        if ( successBox ) {
                            successBox.style.display = 'none';
                        }
                        goToStep( 1 );
                    } );
                }
            } );
        }
    };

    LREWidgets.SoldPortfolio = {
        init: function ( $scope ) {
            var root = $scope ? ( $scope[0] || $scope ) : document;
            var sections = root.querySelectorAll ? root.querySelectorAll( '.ledger-section, .lre-ledger-section, .lre-sold-portfolio' ) : [];
            if ( ! sections.length && root.classList && ( root.classList.contains( 'ledger-section' ) || root.classList.contains( 'lre-ledger-section' ) || root.classList.contains( 'lre-sold-portfolio' ) ) ) {
                sections = [ root ];
            }

            for ( var p = 0; p < sections.length; p++ ) {
                ( function ( sec ) {
                    if ( sec._ledgerInit ) return;
                    sec._ledgerInit = true;

                    var source = sec.getAttribute( 'data-source' ) || 'cpt';
                    var postsPerPage = parseInt( sec.getAttribute( 'data-posts-per-page' ) || '6', 10 );
                    var orderby = sec.getAttribute( 'data-orderby' ) || 'date';
                    var order = sec.getAttribute( 'data-order' ) || 'DESC';

                    var ledgerWrap = sec.querySelector( '.lre-ledger' );
                    var paginationWrap = sec.querySelector( '.lre-ledger-pagination-wrap' );
                    var modal = sec.querySelector( '.lre-ledger-modal, #property-modal, .lre-sold-modal' ) || document.querySelector( '.lre-ledger-modal, #property-modal, .lre-sold-modal' );

                    // Modal Helpers
                    function bindModalTriggers() {
                        if ( ! modal ) return;
                        var openBtns = sec.querySelectorAll( '.trigger-prop-modal, .js-open-sold-modal' );
                        var modalTitle = modal.querySelector( '#prop-modal-title, #lreModalTitle' );
                        var modalPrice = modal.querySelector( '#prop-modal-price, #lreModalPrice' );
                        var modalLoc   = modal.querySelector( '#prop-modal-location, #lreModalCity' );
                        var modalSpecs = modal.querySelector( '#prop-modal-specs, #lreModalBeds' );
                        var modalDesc  = modal.querySelector( '#prop-modal-desc, #lreModalDesc' );
                        var modalImg   = modal.querySelector( '#prop-modal-img, #lreModalImg' );

                        for ( var ob = 0; ob < openBtns.length; ob++ ) {
                            openBtns[ob].onclick = function ( e ) {
                                if ( e.target.closest( 'a:not(.trigger-prop-modal)' ) ) return;
                                e.preventDefault();
                                var row = this;
                                var title = row.getAttribute( 'data-title' ) || '';
                                var price = row.getAttribute( 'data-price' ) || '';
                                var loc   = row.getAttribute( 'data-location' ) || '';
                                var specs = row.getAttribute( 'data-specs' ) || '';
                                var desc  = row.getAttribute( 'data-desc' ) || '';
                                var img   = row.getAttribute( 'data-img' ) || row.getAttribute( 'data-image' ) || '';

                                if ( modalTitle ) modalTitle.textContent = title;
                                if ( modalPrice ) modalPrice.textContent = price;
                                if ( modalLoc )   modalLoc.textContent = loc;
                                if ( modalSpecs ) modalSpecs.textContent = specs;
                                if ( modalDesc )  modalDesc.textContent = desc || modalDesc.getAttribute( 'data-default-desc' ) || '';
                                if ( modalImg ) {
                                    if ( img ) {
                                        modalImg.src = img;
                                        if ( modalImg.parentElement ) modalImg.parentElement.style.display = '';
                                    } else {
                                        if ( modalImg.parentElement ) modalImg.parentElement.style.display = 'none';
                                    }
                                }

                                if ( typeof modal.showModal === 'function' ) {
                                    modal.showModal();
                                } else {
                                    modal.classList.add( 'is-active' );
                                }
                                document.body.style.overflow = 'hidden';
                            };
                        }
                    }

                    function closeModal() {
                        if ( ! modal ) return;
                        if ( typeof modal.close === 'function' ) {
                            modal.close();
                        }
                        modal.classList.remove( 'is-active' );
                        document.body.style.overflow = '';
                    }

                    if ( modal && ! modal._modalInit ) {
                        modal._modalInit = true;
                        var closeBtns = modal.querySelectorAll( '.lre-ledger-modal-close, #close-prop-modal, .js-close-sold-modal' );
                        for ( var cb = 0; cb < closeBtns.length; cb++ ) {
                            closeBtns[cb].addEventListener( 'click', function ( e ) {
                                e.preventDefault();
                                closeModal();
                            } );
                        }
                        modal.addEventListener( 'click', function ( e ) {
                            var rect = modal.getBoundingClientRect();
                            var isInDialog = (
                                rect.top <= e.clientY &&
                                e.clientY <= rect.top + rect.height &&
                                rect.left <= e.clientX &&
                                e.clientX <= rect.left + rect.width
                            );
                            if ( ! isInDialog ) {
                                closeModal();
                            }
                        } );
                        document.addEventListener( 'keydown', function ( e ) {
                            if ( e.key === 'Escape' ) {
                                closeModal();
                            }
                        } );
                    }

                    bindModalTriggers();

                    // Ultra-Smooth Floating Thumbnail Cursor Parallax
                    function bindThumbParallax() {
                        var rows = sec.querySelectorAll( '.ledger-row, .lre-ledger-row' );
                        for ( var r = 0; r < rows.length; r++ ) {
                            ( function ( row ) {
                                if ( row._thumbParallaxInit ) return;
                                row._thumbParallaxInit = true;

                                var thumb = row.querySelector( '.ledger-thumb' );
                                if ( ! thumb ) return;

                                var ticking = false;
                                var targetY = 0;

                                row.addEventListener( 'mousemove', function ( e ) {
                                    var rect = row.getBoundingClientRect();
                                    var relY = e.clientY - rect.top;
                                    var centerY = rect.height / 2;
                                    // Smooth micro-float (-22px to +22px)
                                    targetY = Math.max( -22, Math.min( 22, ( relY - centerY ) * 0.35 ) );

                                    if ( ! ticking ) {
                                        window.requestAnimationFrame( function () {
                                            thumb.style.transform = 'translateY(calc(-50% + ' + targetY + 'px)) scale(1) translate3d(0,0,0)';
                                            ticking = false;
                                        } );
                                        ticking = true;
                                    }
                                }, { passive: true } );

                                row.addEventListener( 'mouseleave', function () {
                                    thumb.style.transform = '';
                                } );
                            } )( rows[r] );
                        }
                    }

                    bindThumbParallax();

                    // AJAX Pagination and Filtering
                    function fetchPage( page, category ) {
                        var ajaxUrl = ( typeof LREData !== 'undefined' && LREData.ajaxUrl ) ? LREData.ajaxUrl : '/wp-admin/admin-ajax.php';
                        if ( ledgerWrap ) {
                            ledgerWrap.classList.add( 'is-loading' );
                        }

                        var formData = new FormData();
                        formData.append( 'action', 'lre_load_sold_portfolio' );
                        formData.append( 'paged', page );
                        formData.append( 'posts_per_page', postsPerPage );
                        formData.append( 'category', category );
                        formData.append( 'orderby', orderby );
                        formData.append( 'order', order );

                        fetch( ajaxUrl, {
                            method: 'POST',
                            body: formData
                        } )
                        .then( function ( res ) { return res.json(); } )
                        .then( function ( data ) {
                            if ( ledgerWrap ) {
                                ledgerWrap.classList.remove( 'is-loading' );
                            }
                            if ( data && data.success && data.data ) {
                                if ( ledgerWrap ) {
                                    ledgerWrap.innerHTML = data.data.html;
                                }
                                if ( paginationWrap ) {
                                    paginationWrap.innerHTML = data.data.pagination_html;
                                }
                                bindModalTriggers();
                                bindThumbParallax();
                                bindPaginationEvents();

                                // Smooth gentle scroll into view
                                var rect = sec.getBoundingClientRect();
                                if ( rect.top < 0 ) {
                                    sec.scrollIntoView( { behavior: 'smooth', block: 'start' } );
                                }
                            }
                        } )
                        .catch( function ( err ) {
                            if ( ledgerWrap ) {
                                ledgerWrap.classList.remove( 'is-loading' );
                            }
                            console.error( 'LRE Sold Portfolio AJAX Error:', err );
                        } );
                    }

                    function bindPaginationEvents() {
                        if ( ! paginationWrap ) return;
                        var pageBtns = paginationWrap.querySelectorAll( '.lre-ledger-page-btn:not(.is-disabled)' );
                        for ( var i = 0; i < pageBtns.length; i++ ) {
                            pageBtns[i].onclick = function ( e ) {
                                e.preventDefault();
                                var page = parseInt( this.getAttribute( 'data-page' ) || '1', 10 );
                                if ( ! page || this.classList.contains( 'is-active' ) ) return;

                                var activeCat = sec.querySelector( '.lre-ledger-filter.is-active' );
                                var cat = activeCat ? ( activeCat.getAttribute( 'data-filter' ) || 'all' ) : 'all';

                                if ( source === 'cpt' ) {
                                    fetchPage( page, cat );
                                } else {
                                    // Client-side repeater pagination
                                    paginateRepeater( page );
                                }
                            };
                        }
                    }

                    function paginateRepeater( page ) {
                        var rows = sec.querySelectorAll( '.ledger-row, .lre-ledger-row' );
                        var total = rows.length;
                        var start = ( page - 1 ) * postsPerPage;
                        var end = start + postsPerPage;

                        for ( var i = 0; i < total; i++ ) {
                            if ( i >= start && i < end ) {
                                rows[i].classList.remove( 'is-hidden' );
                            } else {
                                rows[i].classList.add( 'is-hidden' );
                            }
                        }

                        // Update active state in pagination buttons
                        var pageBtns = paginationWrap ? paginationWrap.querySelectorAll( '.lre-ledger-page-btn' ) : [];
                        for ( var j = 0; j < pageBtns.length; j++ ) {
                            var btnPage = parseInt( pageBtns[j].getAttribute( 'data-page' ), 10 );
                            if ( btnPage === page ) {
                                pageBtns[j].classList.add( 'is-active' );
                            } else {
                                pageBtns[j].classList.remove( 'is-active' );
                            }
                        }
                    }

                    bindPaginationEvents();

                    // Filter Tabs
                    var filterBtns = sec.querySelectorAll( '.lre-ledger-filter, .ledger-filter-btn' );
                    for ( var b = 0; b < filterBtns.length; b++ ) {
                        filterBtns[b].addEventListener( 'click', function ( e ) {
                            e.preventDefault();
                            for ( var ob = 0; ob < filterBtns.length; ob++ ) {
                                filterBtns[ob].classList.remove( 'is-active' );
                                filterBtns[ob].setAttribute( 'aria-selected', 'false' );
                            }
                            this.classList.add( 'is-active' );
                            this.setAttribute( 'aria-selected', 'true' );

                            var filter = this.getAttribute( 'data-filter' ) || 'all';

                            if ( source === 'cpt' ) {
                                fetchPage( 1, filter );
                            } else {
                                var allRows = sec.querySelectorAll( '.ledger-row, .lre-ledger-row' );
                                for ( var r = 0; r < allRows.length; r++ ) {
                                    var rCat = allRows[r].getAttribute( 'data-category' ) || '';
                                    if ( filter === 'all' || rCat.indexOf( filter ) !== -1 ) {
                                        allRows[r].classList.remove( 'is-hidden' );
                                    } else {
                                        allRows[r].classList.add( 'is-hidden' );
                                    }
                                }
                            }
                        } );
                    }
                } )( sections[p] );
            }
        }
    };

    // =========================================================================
    // COMMUNITY MONOGRAPH WIDGET (Fit-to-Screen Watermark & Dynamic Scaling)
    // =========================================================================
    LREWidgets.Community = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : ( ( $scope && $scope.nodeType ) ? $scope : document );
            var watermarks = root.querySelectorAll( '.lre-community__watermark' );
            if ( ! watermarks.length && root.classList && root.classList.contains( 'lre-community__watermark' ) ) {
                watermarks = [ root ];
            }

            if ( ! watermarks.length ) {
                return;
            }

            var fitAllWatermarks = function () {
                watermarks.forEach( function ( wm ) {
                    var hero = wm.closest( '.lre-community__hero' ) || wm.parentElement;
                    if ( ! hero ) return;

                    // Temporarily remove transform scale to measure unscaled natural scroll width
                    wm.style.transform = 'translateX(-50%) scale(1)';
                    var availWidth = hero.clientWidth * 0.90; // 90% max width: guaranteed 5% safe breathing space on each side
                    var textWidth = wm.scrollWidth;

                    if ( textWidth > availWidth && textWidth > 0 ) {
                        var scale = availWidth / textWidth;
                        wm.style.transform = 'translateX(-50%) scale(' + scale.toFixed(4) + ')';
                    } else {
                        wm.style.transform = 'translateX(-50%) scale(1)';
                    }
                } );
            };

            fitAllWatermarks();
            window.addEventListener( 'resize', fitAllWatermarks );
            if ( document.fonts && document.fonts.ready ) {
                document.fonts.ready.then( fitAllWatermarks );
            }
        }
    };

    function lreBindElementorHooks() {
        if ( typeof elementorFrontend === 'undefined' || ! elementorFrontend.hooks ) {
            return;
        }

        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_header.default',               function ( $scope ) { LREWidgets.Header.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_concierge.default',            function ( $scope ) { LREWidgets.Concierge.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_hero.default',                 function ( $scope ) { LREWidgets.Hero.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_about.default',                function ( $scope ) { LREWidgets.About.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_services.default',             function ( $scope ) { LREWidgets.Services.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_properties.default',           function ( $scope ) { LREWidgets.Properties.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_testimonials.default',         function ( $scope ) { LREWidgets.Testimonials.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_communities.default',          function ( $scope ) { LREWidgets.Communities.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_community.default',            function ( $scope ) { LREWidgets.Community.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_team.default',                 function ( $scope ) { LREWidgets.Team.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_cta.default',                  function ( $scope ) { LREWidgets.CTA.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_footer.default',               function ( $scope ) { LREWidgets.Footer.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_story.default',                function ( $scope ) { LREWidgets.Story.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_about_services.default',       function ( $scope ) { LREWidgets.AboutServices.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_reviews.default',              function ( $scope ) { LREWidgets.Reviews.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_page_hero.default',            function ( $scope ) { LREWidgets.PageHero.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_communities_showcase.default', function ( $scope ) { LREWidgets.CommunitiesShowcase.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_contact.default',              function ( $scope ) { LREWidgets.Contact.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_buying_guide.default',         function ( $scope ) { LREWidgets.BuyingGuide.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_sellers_guide.default',        function ( $scope ) { LREWidgets.SellersGuide.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_press.default',                function ( $scope ) { LREWidgets.Press.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_newsletter.default',           function ( $scope ) { LREWidgets.Newsletter.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_home_valuation.default',     function ( $scope ) { LREWidgets.HomeValuation.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_home_evaluation.default',    function ( $scope ) { LREWidgets.HomeValuation.init( $scope ); } );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/lre_sold_portfolio.default',      function ( $scope ) { LREWidgets.SoldPortfolio.init( $scope ); } );
    }

    LREWidgets.SinglePost = {
        init: function ( $scope ) {
            var root = ( $scope && $scope.length ) ? $scope[0] : document;
            var copyBtns = root.querySelectorAll( '.lre-single-post__share-btn--copy' );
            if ( copyBtns.length ) {
                copyBtns.forEach( function ( btn ) {
                    btn.addEventListener( 'click', function ( e ) {
                        e.preventDefault();
                        var url = window.location.href;
                        var pill = btn.closest( '.lre-single-post__share-pill' );
                        if ( pill && pill.getAttribute( 'data-share-url' ) ) {
                            url = pill.getAttribute( 'data-share-url' );
                        }

                        if ( navigator.clipboard && navigator.clipboard.writeText ) {
                            navigator.clipboard.writeText( url ).then( function () {
                                showTooltip( btn );
                            } ).catch( function () {
                                fallbackCopy( url, btn );
                            } );
                        } else {
                            fallbackCopy( url, btn );
                        }
                    } );
                } );
            }

            function showTooltip( btn ) {
                var tooltip = btn.querySelector( '.lre-single-post__tooltip' );
                if ( ! tooltip ) {
                    var actionSpan = btn.querySelector( 'span' );
                    if ( actionSpan ) {
                        var orig = actionSpan.textContent;
                        actionSpan.textContent = 'Copied!';
                        setTimeout( function () { actionSpan.textContent = orig; }, 2000 );
                    }
                    return;
                }
                tooltip.classList.add( 'show' );
                setTimeout( function () {
                    tooltip.classList.remove( 'show' );
                }, 2000 );
            }

            function fallbackCopy( text, btn ) {
                var textArea = document.createElement( 'textarea' );
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.opacity = '0';
                document.body.appendChild( textArea );
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand( 'copy' );
                    showTooltip( btn );
                } catch ( err ) {}
                document.body.removeChild( textArea );
            }

            // Smooth scroll for Table of Contents links
            var tocLinks = root.querySelectorAll( '.lre-single-post__toc-link' );
            tocLinks.forEach( function ( link ) {
                link.addEventListener( 'click', function ( e ) {
                    var targetId = link.getAttribute( 'href' );
                    if ( targetId && targetId.indexOf( '#' ) === 0 ) {
                        var targetEl = document.querySelector( targetId );
                        if ( targetEl ) {
                            e.preventDefault();
                            targetEl.scrollIntoView( { behavior: 'smooth', block: 'start' } );
                        }
                    }
                } );
            } );
        }
    };

    // Auto-run on DOM ready
    function lreInitAllWidgets() {
        LREWidgets.initReveals();
        LREWidgets.initImageZoom();
        if ( LREWidgets.Header )              LREWidgets.Header.init();
        if ( LREWidgets.Hero )                LREWidgets.Hero.init();
        if ( LREWidgets.Properties )          LREWidgets.Properties.init();
        if ( LREWidgets.Testimonials )        LREWidgets.Testimonials.init();
        if ( LREWidgets.Communities )         LREWidgets.Communities.init();
        if ( LREWidgets.Community )           LREWidgets.Community.init();
        if ( LREWidgets.Team )                LREWidgets.Team.init();
        if ( LREWidgets.CTA )                 LREWidgets.CTA.init();
        if ( LREWidgets.Concierge )           LREWidgets.Concierge.init();
        if ( LREWidgets.Story )               LREWidgets.Story.init();
        if ( LREWidgets.AboutServices )       LREWidgets.AboutServices.init();
        if ( LREWidgets.Reviews )             LREWidgets.Reviews.init();
        if ( LREWidgets.PageHero )            LREWidgets.PageHero.init();
        if ( LREWidgets.CommunitiesShowcase ) LREWidgets.CommunitiesShowcase.init();
        if ( LREWidgets.Contact )             LREWidgets.Contact.init();
        if ( LREWidgets.BuyingGuide )         LREWidgets.BuyingGuide.init();
        if ( LREWidgets.SellersGuide )        LREWidgets.SellersGuide.init();
        if ( LREWidgets.Press )               LREWidgets.Press.init();
        if ( LREWidgets.Newsletter )          LREWidgets.Newsletter.init();
        if ( LREWidgets.HomeValuation )       LREWidgets.HomeValuation.init();
        if ( LREWidgets.SoldPortfolio )       LREWidgets.SoldPortfolio.init();
        if ( LREWidgets.SinglePost )          LREWidgets.SinglePost.init();
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