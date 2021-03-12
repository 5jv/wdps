;(function ($) {
"use strict";
    
    /**
     * [MoveCounterUp]
     * @param {[string]} $scope
     */
    var MoveCounterUp = function ( $scope, $ ) {
        var counter_elem = $scope.find('.move-counter').eq(0);
        if ( counter_elem.length > 0 ) {
            counter_elem.counterUp({
                time: 2000
            });
        }
    };
    
    /**
     * [MoveFunFactCounterUp]
     * @param {[string]} $scope
     */
    var MoveFunFactCounterUp = function ( $scope, $ ) {
        var counter_elem = $scope.find('.htmove-funfact-counter').eq(0);
        if ( counter_elem.length > 0 ) {
            counter_elem.counterUp();
        }
    };

    /**
     * [MoveAccordion]
     * @param {[string]} $scope
     */
    var MoveAccordion = function ( $scope, $ ){
        var accordion_elem = $scope.find('.htmove-accordion').eq(0);
        var data_opt = accordion_elem.data('settings');
        if ( accordion_elem.length > 0 ) {
            var $id = accordion_elem.attr('id');
            new Accordion('#' + $id, {
                duration: 500,
                showItem: data_opt.showitem,
                elementClass: 'htmove-accordion-card',
                questionClass: 'htmove-accordion-head',
                answerClass: 'htmove-accordion-body',
            });
        }
    };

    /**
     * [MoveImageAccordion]
     * @param {[string]} $scope
     */
    var MoveImageAccordion = function ( $scope, $ ){
        var accordion_elem = $scope.find('.htmove-image-accordion').eq(0);
        if ( accordion_elem.length > 0 ) {

            var $grow = accordion_elem.data('grow');
            accordion_elem.find('.htmove-image-accordion-item.active').css('flex-grow', $grow).siblings().css('flex-grow', 1);

            $('.htmove-image-accordion-item').on('click', function() {
                var $this = $(this),
                    $grow = $this.parent('.htmove-image-accordion').data('grow');
                $this.addClass('active').css('flex-grow', $grow).siblings().removeClass('active').css('flex-grow', 1)
            });

        }
    };

    /**
     * [swiperSlider]
     * @param  {[type]} $scope
     */
    var swiperSlider = function ( $scope, $ ) {
        
        var swiperContainer = $scope.find('.htmove-swiper-slider').eq(0);

        if ( swiperContainer.length > 0 ) {
            var dataOpt = swiperContainer.data('settings');

            var navid = '.htmove-navigation-'+dataOpt.uniqid,
                pagiid = '.htmove-pagination-'+dataOpt.uniqid;

            var pagination =  {
                el: pagiid+' .swiper-pagination',
                type: 'bullets',
                clickable: true,
            };
            var navigation = {
                nextEl: navid+' .swiper-button-next',
                prevEl: navid+' .swiper-button-prev',
            };

            var autoplay = {
                delay: dataOpt.autoplay_delay,
                disableOnInteraction: false,
            };

            if( dataOpt.autoplay == false ){
                autoplay = false;
            }
            
            if( dataOpt.pagination == false ){
                pagination = false;
            }

            if( dataOpt.navigation == false ){
                navigation = false;
            }

            // Slider Items
            var item = parseInt( dataOpt.slideitem['item'] ) || 5,
                desktop = parseInt( dataOpt.slideitem['desktop'] ) || 5,
                tablet = parseInt( dataOpt.slideitem['tablet'] ) || 4,
                landscape_mobile = parseInt( dataOpt.slideitem['landscape_mobile'] ) || 3,
                large_mobile = parseInt( dataOpt.slideitem['large_mobile'] ) || 2,
                small_mobile = parseInt( dataOpt.slideitem['small_mobile'] ) || 1;

            if( dataOpt.style == 'two' ){
                
                var testimonialSyncThumbnail = new Swiper('.htmove-testimonial-sync-thumbnail', {
                    spaceBetween: 30,
                    slidesPerView: dataOpt.totalitem,
                    allowTouchMove: false,
                    loopedSlides: dataOpt.totalitem,
                    autoplay: autoplay,
                });

                var testimonialSyncContent = new Swiper('.htmove-testimonial-sync-content', {
                    loop: dataOpt.loop,
                    slidesPerView: item,
                    spaceBetween: dataOpt.spacebetween,
                    loopedSlides: dataOpt.totalitem,
                    pagination: pagination,
                    navigation: navigation,
                    thumbs: {
                        swiper: testimonialSyncThumbnail,
                    },
                    autoplay: autoplay,
                });

            }else{
                var swiper = new Swiper( swiperContainer, {
                    loop: dataOpt.loop,
                    autoplay: autoplay,
                    watchSlidesVisibility: true,
                    spaceBetween: dataOpt.spacebetween,
                    speed: dataOpt.speed,
                    pagination: pagination,
                    navigation: navigation,
                    slidesPerView: item,
                    effect: dataOpt.effect,
                    breakpoints: {
                        320: {
                            slidesPerView: small_mobile
                        },
                        480: {
                            slidesPerView: large_mobile
                        },
                        576: {
                            slidesPerView: landscape_mobile
                        },
                        768: {
                            slidesPerView: tablet
                        },
                        992: {
                            slidesPerView: desktop
                        },
                        1200: {
                            slidesPerView: item
                        }
                    },

                });
            }



        }

    }

    /**
     * [MoveCountdown]
     * @param {[string]} $scope
     */
    var MoveCountdown = function ( $scope, $ ) {
        var countdown_elem = $scope.find('.htmove-countdown-timer').eq(0);
        if ( countdown_elem.length > 0 ) {

            var dataOpt = countdown_elem.data('countdown');

            if( dataOpt.status.timecircle == true ){

                var dayTxt = dataOpt.customlabel.days,
                    hourTxt = dataOpt.customlabel.hours,
                    minuteTxt = dataOpt.customlabel.minutes,
                    secondTxt = dataOpt.customlabel.seconds;

                if( dataOpt.status.label == true ){
                    dayTxt = hourTxt = minuteTxt = secondTxt = '';
                }

                countdown_elem.TimeCircles({
                    count_past_zero: false,
                    animation: dataOpt.animation,
                    fg_width: dataOpt.fg_width,
                    bg_width: dataOpt.bg_width,
                    direction: dataOpt.direction,
                    circle_bg_color: dataOpt.bg_color,
                    use_background: dataOpt.use_bg,
                    time: {
                        Days: {
                            show: dataOpt.status.day,
                            text: dayTxt,
                            color: dataOpt.day_color,
                        },
                        Hours: {
                            show: dataOpt.status.hour,
                            text: hourTxt,
                            color: dataOpt.hour_color
                        },
                        Minutes: {
                            show: dataOpt.status.miniute,
                            text: minuteTxt,
                            color: dataOpt.minute_color
                        },
                        Seconds: {
                            show: dataOpt.status.second,
                            text: secondTxt,
                            color: dataOpt.second_color
                        }
                    }
                });

                $(window).resize(function() {
                    countdown_elem.TimeCircles().rebuild();
                })

            }else{
                countdown_elem.countdown(dataOpt.targetdate, function (event) {

                    var finalTime, days, hours, minutes, second;

                    if( dataOpt.status.label == true ){

                        days = '<div class="htmove-single-countdown days"><span class="htmove-countdown-time">%-D</span></div>';

                        hours = '<div class="htmove-single-countdown hour"><span class="htmove-countdown-time">%-H</span></div>';

                        minutes = '<div class="htmove-single-countdown minutes"><span class="htmove-countdown-time">%M</span></div>';

                        second = '<div class="htmove-single-countdown second"><span class="htmove-countdown-time">%S</span></div>';
                    }else{

                        days = '<div class="htmove-single-countdown days"><span class="htmove-countdown-time">%-D</span><span class="htmove-countdown-name">'+dataOpt.customlabel.days+'</span></div>';

                        hours = '<div class="htmove-single-countdown hour"><span class="htmove-countdown-time">%-H</span><span class="htmove-countdown-name">'+dataOpt.customlabel.hours+'</span></div>';

                        minutes = '<div class="htmove-single-countdown minutes"><span class="htmove-countdown-time">%M</span><span class="htmove-countdown-name">'+dataOpt.customlabel.minutes+'</span></div>';

                        second = '<div class="htmove-single-countdown second"><span class="htmove-countdown-time">%S</span><span class="htmove-countdown-name">'+dataOpt.customlabel.seconds+'</span></div>';

                    }

                    // Genarate date
                    if( dataOpt.status.day == false ){
                        days = '';
                    }
                    if( dataOpt.status.hour == false ){
                        hours = '';
                    }
                    if( dataOpt.status.miniute == false ){
                        minutes = '';
                    }
                    if( dataOpt.status.second == false ){
                        second = '';
                    }
                    finalTime = days + hours + minutes + second;

                    // Active Countdown
                    countdown_elem.html( event.strftime( finalTime ) );

                });
            }

        }
    };


    /**
     * [MoveImageComparison]
     * @param {[string]} $scope
     */
    var MoveImageComparison = function ( $scope, $ ) {
        var comparison_elem = $scope.find('.htmove-image-comparison').eq(0);
        if ( comparison_elem.length > 0 ) {
            var dataOpt = comparison_elem.data('settings');
            comparison_elem.imagesLoaded(function() {
                comparison_elem.twentytwenty(
                    {
                        orientation: dataOpt.orientation,
                        before_label: dataOpt.before_label,
                        after_label: dataOpt.after_label,
                        default_offset_pct: dataOpt.default_offset_pct,
                        no_overlay: dataOpt.no_overlay,
                        move_slider_on_hover: dataOpt.move_slider_on_hover,
                        click_to_move: dataOpt.click_to_move
                    }
                );
            });
        }
    };

    /**
     * [MoveVideoPlayer]
     * @param {[string]} $scope
     */
     var MoveVideoPlayer = function ($scope, $) {
        var container_elem = $scope.find('.htmove-video-area').eq(0);

        if ( container_elem.length > 0 ) {
            var videotype = container_elem.data('videotype');

            if( videotype.videocontainer == 'self' ){
                var videoplayer_elem = $scope.find('.htmove-video-player').eq(0);
                videoplayer_elem.YTPlayer();
            }else{
                var videopopup_elem = $scope.find('.htmove-video-popup').eq(0);
                videopopup_elem.magnificPopup({
                    type: 'iframe'
                });
            }
        }

    }

    /**
     * [MovePopupManager]
     * @param {[string]} $scope
     */
    var MovePopupManager = function ($scope, $){

        var container_masonry = $scope.find('.htmove-masonry-grid').eq(0);
        var container_grid = $scope.find('.htmove-popup-gallery').eq(0);

        if ( container_masonry.length > 0 ){
            container_masonry.imagesLoaded(function() {
                container_masonry.masonry({
                    itemSelector: '.htmove-masonry-item',
                    columnWidth: '.htmove-masonry-sizer',
                });
            });
        }

        if ( container_grid.length > 0 ) {
            container_grid.magnificPopup({
                delegate: 'a:not(.htmove-external-link)',
                type: 'image',
                tLoading: 'Loading image #%curr%...',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                },
                callbacks: {
                    elementParse: function(item) {
                        if (item.el.hasClass('htmove-video-popup')) {
                            item.type = 'iframe';
                        } else {
                            item.type = 'image';
                        }
                    }
                },
            });
        }

    }

    /**
     * [MoveInlineMenu]
     * @param {[string]} $scope
     */
    var MoveInlineMenu = function ($scope, $) {
        var container_menu = $scope.find('.htmove-inline-menu').eq(0);
        if ( container_menu.length > 0 ){
            
            $('.htmove-open').on('click', function() {
                $(this).hide();
                $(this).siblings().show();
                $(this).closest('.htmove-inline-menu').find('.htmove-inline-menu-list').slideDown();
            });

            $('.htmove-close').on('click', function() {
                $(this).hide();
                $(this).siblings().show();
                $(this).closest('.htmove-inline-menu').find('.htmove-inline-menu-list').slideUp();
            });

        }
    }

     /**
     * [MoveIsotope]
     * @param {[string]} $scope
     */
    var MoveIsotope = function ($scope, $) {

        var container_filter = $scope.find('.htmove-gallery-filter').eq(0);
        var isotopeGrid = $scope.find('.htmove-gallery-grid').eq(0);

        if ( container_filter.length > 0 ){
            
            var $grid = isotopeGrid,
                $gridId = $grid.attr('id'),
                $gridActive = $grid.data('gallery-active'),
                $isotopeFilter = $('[data-target="#' + $gridId + '"]').parent('.htmove-gallery-filter');
            $isotopeFilter.find('li[data-filter="' + $gridActive + '"]').addClass('active').siblings().removeClass('active');
            $isotopeFilter.on('click', '[data-filter]', function() {
                var $this = $(this),
                    $filterValue = $this.attr('data-filter'),
                    $targetIsotop = $this.parent().data('target');
                $this.addClass('active').siblings().removeClass('active');
                $($targetIsotop).isotope({
                    filter: $filterValue
                });
            });
            $grid.imagesLoaded(function() {
                $grid.isotope({
                    filter: $gridActive,
                    itemSelector: '.htmove-gallery-item',
                    masonry: {
                        columnWidth: '.htmove-gallery-sizer'
                    }
                });
            });

        }
    }

    /**
     * [MoveTabs]
     * @param {[string]} $scope
     */
    var MoveTabs = function ( $scope, $ ) {
        var tab_elem = $scope.find('.htmove-advance-tab').eq(0);
        if ( tab_elem.length > 0 ) {
            var $container = tab_elem.children('.htmove-tab-container');
            tab_elem.tabslet({
                animation: true,
                container: $container
            });
        }
    };

    /**
     * [MoveTooltip]
     * @param {[string]} $scope
     */
    var MoveTooltip = function ( $scope, $ ) {
        var tooltip_elem = $scope.find('.htmove-tooltip').eq(0);
        if ( tooltip_elem.length > 0 ) {
            tippy('.htmove-tooltip', {
                offset: [0, 20],
                maxWidth: 290,
                allowHTML: true,
                content: function(reference) {
                    if (reference.hasAttribute('data-template')) {
                        const id = reference.getAttribute('data-template');
                        const template = document.getElementById(id);
                        return template.innerHTML;
                    }
                },
            });
        }
    };

    /**
     * [MoveMailchimp]
     * @param {[string]} $scope
     */
    var MoveMailchimp = function ( $scope, $ ){
        var mailchimp_elem = $scope.find('.htmove-mailchimp-form').eq(0);
        var $form = $scope.find( '.htmove-mailchimp-form form' );
        var $savebtn = $form.find('.htmove-submit-btn');
        var $message = $scope.find('.htmove-message');

        var data_opt = mailchimp_elem.data('settings');

        var list = data_opt.mailchimpid,
            loadingtxt = data_opt.loadingtxt,
            btntxt  = data_opt.btntxt,
            success = data_opt.success_msg,
            error   = data_opt.error_msg;

        if ( mailchimp_elem.length > 0 ) {

            $form.on('submit', function(event) {
                event.preventDefault();

                var data = $( $form ).find( 'input' ).serialize() + "&list=" + list;
                $.ajax( {
                    url: HTFMOVE.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'htmove_addons_mailchimp_data_save',
                        data: data
                    },
                    beforeSend: function(){
                        $savebtn.text(loadingtxt).addClass('htmove-loading');
                    },
                    success: function( data ) {
                        $savebtn.removeClass('htmove-loading').text(btntxt);
                        $message.show().html('<p class="htmove-success">'+success+'</p>');
                    },
                    complete: function( data ) {
                        $savebtn.removeClass('htmove-loading').text(btntxt);
                        $message.show().html('<p class="htmove-success">'+success+'</p>');
                    },
                    error: function(errorThrown){
                        console.log(errorThrown);
                        $message.show().html('<p class="htmove-error">'+error+'</p>');
                    }

                });

                setTimeout( () => {
                    $message.hide();
                }, 6000 );

            });

        }
    }

    /*
    * MoveImageSlider slider
    */
    function MoveImageSlider(){
        $(".product-gallery-slider").slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: '<button class="slick-prev"><i class="fas fa-angle-left"></i></button>',
            nextArrow: '<button class="slick-next"><i class="fas fa-angle-right"></i></button>'
        });
    }

    /**
     * [MoveQuickView]
     * @param {[string]} $scope
     */
    var MoveQuickView = function ( $scope, $ ){
        var grid_elem = $scope.find('.htmove-product-grid').eq(0);

        if ( grid_elem.length > 0 ) {
            $(document).on('click', '.movequickview', function (event) {
                event.preventDefault();

                var $this = $(this);
                var productID = $this.data('quickid');

                $('.htmove-modal-body').html(''); /*clear content*/
                $('#htmovequick-viewmodal').addClass('htmovequickview-open htmoveloading');
                $('#htmovequick-viewmodal .htmove-modal-close').hide();
                $('.htmove-modal-body').html('<div class="htmove-loading"><div class="htmoveds-css"><div style="width:100%;height:100%" class="htmoveds-ripple"><div></div><div></div></div>');

                var data = {
                    id: productID,
                    action: "move_quickview",
                };
                $.ajax({
                    url: HTFMOVE.ajaxurl,
                    data: data,
                    method: 'POST',
                    success: function (response) {
                        setTimeout(function () {
                            $('.htmove-modal-body').html(response);
                            $('#htmovequick-viewmodal .htmove-modal-close').show();
                            $('.htmove-modal-dialog .htmove-modal-content').css("background-color","#ffffff");
                            $('#htmovequick-viewmodal').removeClass('htmoveloading');
                            MoveImageSlider();
                        }, 300 );
                    },
                    error: function () {
                        console.log("Quick View Not Loaded");
                    },
                });

            });
            $('.htmove-modal-close').on('click', function(event){
                $('#htmovequick-viewmodal').removeClass('htmovequickview-open');
                $('body').removeClass('htmovequickview');
                $('.htmove-modal-dialog .htmove-modal-content').css("background-color","transparent");
            });
        }

    }

    /*
    * Run this code under Elementor.
    */
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-animated-heading.default', MoveCounterUp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-brand.default', swiperSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-testimonial.default', swiperSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-recent-blog.default', swiperSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-news-ticker.default', swiperSlider );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-accordion.default', MoveAccordion );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-faq.default', MoveAccordion );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-job-manager.default', MoveAccordion );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-image-accordion.default', MoveImageAccordion );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-countdown.default', MoveCountdown );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-fun-fact.default', MoveFunFactCounterUp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-image-comparison.default', MoveImageComparison );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-video.default', MoveVideoPlayer );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-image-grid.default', MovePopupManager );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-image-masonry.default', MovePopupManager );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-inline-menu.default', MoveInlineMenu );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-filterable-gallery.default', MoveIsotope );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-filterable-gallery.default', MovePopupManager );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-advanced-tab.default', MoveTabs );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-tooltip.default', MoveTooltip );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-mailchimp.default', MoveMailchimp );
        elementorFrontend.hooks.addAction( 'frontend/element_ready/move-shop-product-grid.default', MoveQuickView );
        
    });

})(jQuery);