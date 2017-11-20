jQuery(document).ready(function($) {
    'use strict';

    /**
     * Sticky Header - scrolling
     */
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 150) {
            $(".header").addClass("out-of-top");
        } else {
            $(".header").removeClass("out-of-top");
        }
    });

    /**
     * Sticky Header - header height
     */
    if ($("body").hasClass("header-sticky")) {
        if ($(window).width() >= 768) {
            var header = $('#header').height();
            $(".page-wrapper").css("margin-top",(header - 1) + "px");
        }

        $(window).resize(function() {
            if ($(window).width() < 768) {
                $(".page-wrapper").css("margin-top","0px");
            } else {
                var header = $('#header').height();
                $(".page-wrapper").css("margin-top",(header - 1) + "px");
            }
        });
    }

    /**
     * Sidenav
     */
    $('.sidenav-toggle, .sidenav-close').on('click', function() {
        $('body').toggleClass('has-sidenav');
    });

    /**
     * Submenu table and phone fix
     */
    $('.sub-menu a').on('touchstart mouseenter focus', function(e) {
        if(e.type == 'touchstart') {            
            e.stopImmediatePropagation();
        }
    });

    /**
     * Navbar toggle
     */
    $('.navbar-toggle').on('click', function() {
        $('.header-navigation-wrapper').toggleClass('open');
    });

    $('.header-navigation-wrapper').on('click', function(e) {
        if (e.offsetX > 240) {
            $('.nav-main-wrapper').removeClass('open');
        }
    });

    /**
     * Compare
     */
    var has_compare = $('.sidenav #compare-controller').length;

    if( has_compare == 1) {
        $('.compare-add').on('click', function() {
            $('body').addClass('has-sidenav');
        })
    };

    /**
     * Favorites
     */
    var has_favorites = $('.sidenav #favorites-controller').length;

    if (has_favorites == 1) {
        $('.favorites-action').on('click', function() {
            $('body').addClass('has-sidenav');
        })
    };

    /**
     * Button animation
     */
    var ink, d, x, y;

    $(".btn, .btn-secondary, .header-action, .customizer-header, .nav-tabs li a").click(function(e){
        if($(this).find(".ink").length === 0){
            $(this).prepend("<span class='ink'></span>");
        }
             
        ink = $(this).find(".ink");
        ink.removeClass("animate");
         
        if(!ink.height() && !ink.width()){
            d = Math.max($(this).outerWidth(), $(this).outerHeight());
            ink.css({height: d, width: d});
        }
         
        x = e.pageX - $(this).offset().left - ink.width()/2;
        y = e.pageY - $(this).offset().top - ink.height()/2;
         
        ink.css({top: y+'px', left: x+'px'}).addClass("animate");
    });

    /**
     * Customizer
     */
    var customizer = $('.customizer');

    if (customizer.length !== 0) {
        $('li', customizer).on('click', function() {
            var rel = $(this).attr('rel');

            $('#realsite-css').attr('href', rel);
        });
    }

    /**
     * Sort form
     */
     var sort_form = $('#sort-form');
     $('select' , sort_form).change(function() {
        sort_form.submit();
     });

    /**
     * Bootstrap select
     */
    $('select').selectpicker({
        size: 10
    });

    /**
     * Input Group
     */
     $('.input-group .form-control').on('focus', function() {
         $(this).closest('.input-group').find('.input-group-addon').addClass('active');
     }).on('blur', function() {
         $(this).closest('.input-group').find('.input-group-addon').removeClass('active');
     });
     
    /**
     * Property detail map
     */
    var map_property = $('#map-position');
    
    if (map_property.length) {
        map_property.google_map({
            center: {
                latitude: map_property.data('latitude'),
                longitude: map_property.data('longitude')
            },
            markers: [{
                latitude: map_property.data('latitude'),
                longitude: map_property.data('longitude')
            }]
        });
    }

    /**
     * Scroll top
     */
    var scroll_top = $('.scroll-top');
    if(scroll_top.length != 0) {
        scroll_top.on('click', function() {
            $.scrollTo('body', 800);
        });
    }
     
    /**
     * Background image
     */
    $('*[data-background-image]').each(function() {
        $(this).css({
            'background-image': 'url(' + $(this).data('background-image') + ')'
        });
    });

    /**
     * Detail gallery
     */
    var propertyGallery = $('.property-detail-gallery');
    var propertyGalleryPreview = $('.property-detail-gallery-preview-inner');
    var propertyGalleryPreviewCount = propertyGalleryPreview.data('count');
    var propertyGalleryPreviewItems = 6;

    if (propertyGallery.length != 0) {
        var loop = true;

        if (propertyGallery.length === 1) {
            loop = false;
        }

        propertyGallery.owlCarousel({
            items: 1,
            loop: loop,
            autoHeight: true,
            autoplay: true,
            autoplayTimeout:5000,
            smartSpeed: 700,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
        });
    }

    if (propertyGalleryPreview.length != 0) {
        propertyGalleryPreview.owlCarousel({
            items: propertyGalleryPreviewItems,
            nav: (propertyGalleryPreviewCount > propertyGalleryPreviewItems),
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
        });
    }

    $('.property-detail-gallery-preview-inner .owl-item:first').addClass('highlighted');

    propertyGallery.on('changed.owl.carousel', function(event) {
        var currentIndex = event.item.index - 0; // bug because of "loop: true";
        var firstActiveIndex = $('.property-detail-gallery-preview-inner .owl-item.active:first').children().data('item-id');
        var lastActiveIndex = $('.property-detail-gallery-preview-inner .owl-item.active:last').children().data('item-id');

        if ( currentIndex == event.item.count ) {
            currentIndex = 0;
        }

        // Highlight current item
        $('.property-detail-gallery-preview-inner .owl-item.highlighted').removeClass('highlighted');
        $('.property-detail-gallery-preview-inner .owl-item:eq(' + currentIndex + ')').addClass('highlighted');

        // Move preview if it is necessary
        if (firstActiveIndex >= currentIndex) {
            for (var i = 0; i <= ( firstActiveIndex - currentIndex ); i++) {
                propertyGalleryPreview.trigger('prev.owl.carousel');
            }
        } else if (lastActiveIndex <= currentIndex) {
            for (var i = 0; i <= ( currentIndex - lastActiveIndex ); i++) {
                propertyGalleryPreview.trigger('next.owl.carousel');
            }
        }
    });

    // Show in gallery image from preview
    $('.property-detail-gallery-preview-inner .owl-item').click(function(){
        var itemIndex = $(this).children().data('item-id');
        propertyGallery.trigger('to.owl.carousel', [itemIndex, 300]);
    });

    $('.property-detail-gallery').on('click', function() {
        propertyGallery.trigger('stop.owl.autoplay');
    });

    /**
     * Colorbox
     */
    $('.property-detail-gallery a').colorbox({
        ref: 'property-gallery',
        maxHeight: '90%',
        maxWidth: '85%'
    });

    /**
    * Property carousel
    */
    if ($('.property-carousel').length != 0) {
        $('.property-carousel').owlCarousel({
            items: 5,
            //itemsDesktop : [1199, 5],
            //itemsDesktopSmall : [979, 3],
            //itemsTablet : [768, 2],
            //itemsTabletSmall : [1, 2],
            //itemsMobile : false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                768:{
                    items:3,
                    nav:true
                },
                979:{
                    items:4,
                    nav:true
                }
            },
            nav: true,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
        });
    }

    /**
     * Autosize textarea
     */
    $('textarea').autosize();

    /**
     * Header animation
     */
     $('.header-navigation > div > ul > li.has-children').hover(function() {
         var el = $('> div', this);

         el.transition({
             height: 'auto',
             duration: 250,
             width: 'auto'
         });
     }, function() {
         var el = $('> div', this);

         el.transition({
             height: 0,
             duration: 150,
             width: 0
         });
     });

     // Second level
     $('.header-navigation > div > ul > li.has-children > div > ul > li.has-children').hover(function() {
         var el = $('> div', this);

         $(this).closest('div').css('overflow', 'visible');

         el.transition({
             height: 'auto',
             duration: 250,
             width: 'auto'
         });
     }, function() {
         var el = $('> div', this);

         $(this).closest('div').css('overflow', 'hidden');

         el.transition({
             height: 0,
             duration: 150,
             width: 0
         });
     });

    /**
     * Social menu
     */

     $('.social-menu-wrapper').hover(function() {
        $('.social-menu').transition({
            duration: 250,
            height: 135,
            width: 121        
        });
     }, function() {
        $('.social-menu').transition({
            duration: 250,
            height: 0,
            width: 0
        });
     });

    /**
     * Customizer
     */
    $('.customizer-header').on('click', function() {
        if ($(this).hasClass('closed')) {
            $('.customizer-content').transition({
                duration: 250,
                height: 387,
                width: 176       
            });
        } else {
            $('.customizer-content').transition({
                duration: 250,
                height: 0,
                width: 0      
            })
        }

        $(this).toggleClass('closed');
    });

    /**
     * Dropdown
     */
    $('div.dropdown-menu').on('focusin', function() {
        $(this).transition({
            height: 'auto',
            duration: 150,
            width: 'auto'
        });
    });

    $('div.dropdown-menu').on('focusout', function() {
        $(this).transition({
            height: 0,
            duration: 250,
            width: 0
        });
    });

    /**
     * Mobile navigation
     */
    $('.navbar-toggle').on('click', function() {
        $('.header-navigation-wrapper').addClass('open');
    });

    $('body').on('click', function(e) {            
        if (e.offsetX > 240) {
            $('.header-navigation-wrapper.open').removeClass('open');
        }
    });

    /**
     * Google Map
     */
    var map = $('#fullscreen-map');

    if (map.length) {
        var url = '';
        if (window.location.search) {
            url = window.location.search + '&properties-feed=true';
        } else {
            url = '?properties-feed=true';
        }

        $.ajax({
            url: url,
            success: function(markers) {
                map.google_map({
                    infowindow: {
                        borderBottomSpacing: 0,
                        height: 120,
                        width: 424,
                        offsetX: 48,
                        offsetY: -87
                    },
                    zoom: map.data('zoom'),
                    marker: {
                        height: 56,
                        width: 56
                    },
                    cluster: {
                        height: 40,
                        width: 40,
                        gridSize: map.data('grid-size')
                    },
                    transparentMarkerImage: map.data('transparent-marker-image'),
                    transparentClusterImage: map.data('transparent-marker-image'),
                    markers: markers
                });
            }
        });
    }

});