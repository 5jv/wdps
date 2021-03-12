(function ($) {
    "use strict";
    
    var getElementSettings = function( $element ) {
		var elementSettings = {},
			modelCID 		= $element.data( 'model-cid' );

		if ( isEditMode && modelCID ) {
			var settings 		= elementorFrontend.config.elements.data[ modelCID ],
				settingsKeys 	= elementorFrontend.config.elements.keys[ settings.attributes.widgetType || settings.attributes.elType ];

			jQuery.each( settings.getActiveControls(), function( controlKey ) {
				if ( -1 !== settingsKeys.indexOf( controlKey ) ) {
					elementSettings[ controlKey ] = settings.attributes[ controlKey ];
				}
			} );
		} else {
			elementSettings = $element.data('settings') || {};
		}

		return elementSettings;
	};

    var isEditMode		= false;
    
    var PPSwiperSliderHandler = function ($scope, $) {
        var $carousel                   = $scope.find('.pp-swiper-slider').eq(0),
            $slider_options             = JSON.parse( $carousel.attr('data-slider-settings') );

		var mySwiper = new Swiper($carousel, $slider_options);
			
		PPSliderUpdate( mySwiper, '.pp-swiper-slider', 'swiper' );
    };
    
    var PPSliderUpdate = function (slider, selector, type) {

		if( 'undefined' !== typeof type ){
			type = 'swiper';
		}

		var $triggers = [
			'ppe-tabs-switched',
			'ppe-toggle-switched',
		];

		$triggers.forEach(function(trigger) {
			if ( 'undefined' !== typeof trigger ) {
				$(document).on(trigger, function(e, wrap) {
					if ( wrap.find( selector ).length > 0 ) {
						setTimeout(function() {
							if ( 'slick' === type ) {
								slider.slick( 'setPosition' );
							}
							if ( 'swiper' === type ) {
								slider.update();
							}
						}, 100);
					}
				});
			}
		});
	};
    
    var ImageHotspotHandler = function ($scope, $) {
		var id                   = $scope.data('id'),
			elementSettings      = getElementSettings( $scope ),
        	ttArrow              = elementSettings.tooltip_arrow,
        	ttAlwaysOpen         = elementSettings.tooltip_always_open,
			$tt_trigger          = elementSettings.tooltip_trigger,
			tooltipZindex        = elementSettings.tooltip_zindex,
			elementorBreakpoints = elementorFrontend.config.breakpoints;

        $('.pp-hot-spot-wrap[data-tooltip]').each(function () {
            var ttPosition   = $(this).data('tooltip-position'),
				ttTemplate   = '',
				ttSize       = $(this).data('tooltip-size'),
				animationIn  = $(this).data('tooltip-animation-in'),
				animationOut = $(this).data('tooltip-animation-out');

            // tablet
            if ( window.innerWidth <= elementorBreakpoints.lg && window.innerWidth >= elementorBreakpoints.md ) {
                ttPosition = $scope.find('.pp-hot-spot-wrap[data-tooltip]').data('tooltip-position-tablet');
            }

            // mobile
            if ( window.innerWidth < elementorBreakpoints.md ) {
                ttPosition = $scope.find('.pp-hot-spot-wrap[data-tooltip]').data('tooltip-position-mobile');
            }
            
            if ( ttArrow === 'yes' ) {
                ttTemplate = '<div class="pp-tooltip pp-tooltip-' + id + ' pp-tooltip-' + ttSize + '"><div class="pp-tooltip-body"><div class="pp-tooltip-content"></div><div class="pp-tooltip-callout"></div></div></div>';
            } else {
                ttTemplate = '<div class="pp-tooltip pp-tooltip-' + id + ' pp-tooltip-' + ttSize + '"><div class="pp-tooltip-body"><div class="pp-tooltip-content"></div></div></div>';
			}
			
			var tooltipConfig = {
                template     : ttTemplate,
				position     : ttPosition,
				animationIn	 : animationIn,
				animationOut : animationOut,
				animDuration : 400,
				zindex       : tooltipZindex,
				alwaysOpen   : ( ttAlwaysOpen === 'yes' ) ? true : false,
                toggleable   : ($tt_trigger === 'click') ? true : false
			};
            
            $(this)._tooltip( tooltipConfig );
        });
    };
    
    var ImageComparisonHandler = function ($scope, $) {
        var image_comparison_elem       = $scope.find('.pp-image-comparison').eq(0),
            settings                    = image_comparison_elem.data('settings');
        
        image_comparison_elem.twentytwenty({
            default_offset_pct:         settings.visible_ratio,
            orientation:                settings.orientation,
            before_label:               settings.before_label,
            after_label:                settings.after_label,
            move_slider_on_hover:       settings.slider_on_hover,
            move_with_handle_only:      settings.slider_with_handle,
            click_to_move:              settings.slider_with_click,
            no_overlay:                 settings.no_overlay
        });
    };
    
    var CounterHandler = function ($scope, $) {
        var counter_elem   = $scope.find('.pp-counter').eq(0),
            target         = counter_elem.data('target'),
            separator      = $scope.find('.pp-counter-number').data('separator'),
			separator_char = $scope.find('.pp-counter-number').data('separator-char'),
			format         = ( separator_char !== '' ) ? '(' + separator_char + 'ddd).dd' : '(,ddd).dd';

        $(counter_elem).waypoint(function () {
            $(target).each(function () {
                var v                   = $(this).data('to'),
                    speed               = $(this).data('speed'),
                    od                  = new Odometer({
                        el:             this,
                        value:          0,
                        duration:       speed,
                        format:         (separator === 'yes') ? format : ''
                    });
                od.render();
                setInterval(function () {
                    od.update(v);
                });
            });
        },
            {
                offset:             '80%',
                triggerOnce:        true
            });
	};
    
    var LogoCarouselHandler = function ($scope, $) {
        var carousel_wrap               = $scope.find('.pp-logo-carousel-wrap').eq(0),
            carousel                    = carousel_wrap.find('.pp-logo-carousel'),
            slider_options              = JSON.parse( carousel_wrap.attr('data-slider-settings') );

        var mySwiper = new Swiper(carousel, slider_options);
    };
	
	var IbEqualHeight = function($scope, $) {
		var maxHeight = 0;
		$scope.find('.swiper-slide').each( function() {
			if($(this).height() > maxHeight){
				maxHeight = $(this).height();
			}
		});
		$scope.find('.pp-info-box-content-wrap').css('min-height',maxHeight);
	};
    
    var InfoBoxCarouselHandler = function ($scope, $) {
		var elementSettings			= getElementSettings( $scope ),
            $carousel               = $scope.find('.pp-info-box-carousel'),
            slider_options          = JSON.parse( $carousel.attr('data-slider-settings') ),
            equal_height			= elementSettings.equal_height_boxes,
			mySwiper				= new Swiper($carousel, slider_options);
		
		if ( equal_height === 'yes' ) {
			IbEqualHeight($scope, $);
			$(window).resize(IbEqualHeight($scope, $));
		}
		
		PPSliderUpdate( mySwiper, '.pp-info-box-carousel', 'swiper' );
    };
    
    var InstaFeedPopupHandler = function ($scope, $) {
        var widgetId        = $scope.data('id'),
			instafeedElem   = $scope.find('.pp-instagram-feed').eq(0),
			elementSettings = getElementSettings( $scope ),
            layout          = elementSettings.feed_layout,
            likes           = elementSettings.insta_likes,
            comments        = elementSettings.insta_comments;

		if ( layout === 'carousel' ) {
			var carousel      = $scope.find('.swiper-container').eq(0),
				sliderOptions = JSON.parse( carousel.attr('data-slider-settings') ),
				mySwiper      = new Swiper(carousel, sliderOptions);
		} else if ( layout === 'masonry' ) {
			var grid = $('#pp-instafeed-' + widgetId).imagesLoaded( function() {
				grid.masonry({
					itemSelector: '.pp-feed-item',
					percentPosition: true
				});
			});
		}
		
		if ( elementSettings.use_api !== 'yes' ) {
			var settings   = instafeedElem.data('settings'),
            	popup      = settings.popup,
            	image_link = settings.img_link;

			var pp_feed = new PPInstagramFeed({
					id: widgetId,
					username: elementSettings.username,
					layout: layout,
					limit: settings.images_count,
					likes_count: (likes === 'yes'),
					comments_count: (comments === 'yes'),
					popup: popup,
					image_link: image_link,
					carousel: sliderOptions,
				});
		}
    };
    
    var TeamMemberCarouselHandler = function ($scope, $) {
        var carousel      = $scope.find('.pp-tm-carousel').eq(0),
            sliderOptions = JSON.parse( carousel.attr('data-slider-settings') ),
			mySwiper      = new Swiper(carousel, sliderOptions);
    };
    
    var ImageScrollHandler = function($scope, $) {
        var scrollElement    = $scope.find(".pp-image-scroll-container"),
            scrollOverlay    = scrollElement.find(".pp-image-scroll-overlay"),
            scrollVertical   = scrollElement.find(".pp-image-scroll-vertical"),
			elementSettings  = getElementSettings( $scope ),
            imageScroll      = scrollElement.find('.pp-image-scroll-image img'),
            direction        = elementSettings.direction_type,
            reverse			 = elementSettings.reverse,
            trigger			 = elementSettings.trigger_type,
            transformOffset  = null;
        
        function startTransform() {
            imageScroll.css("transform", (direction == "vertical" ? "translateY" : "translateX") + "( -" +  transformOffset + "px)");
        }
        
        function endTransform() {
            imageScroll.css("transform", (direction == 'vertical' ? "translateY" : "translateX") + "(0px)");
        }
        
        function setTransform() {
            if( direction == "vertical" ) {
                transformOffset = imageScroll.height() - scrollElement.height();
            } else {
                transformOffset = imageScroll.width() - scrollElement.width();
            }
        }
        
        if( trigger == "scroll" ) {
            scrollElement.addClass("pp-container-scroll");
            if ( direction == "vertical" ) {
                scrollVertical.addClass("pp-image-scroll-ver");
            } else {
                scrollElement.imagesLoaded(function() {
                  scrollOverlay.css( { "width": imageScroll.width(), "height": imageScroll.height() } );
                });
            }
        } else {
            if ( reverse === 'yes' ) {
                scrollElement.imagesLoaded(function() {
                    scrollElement.addClass("pp-container-scroll-instant");
                    setTransform();
                    startTransform();
                });
            }
            if ( direction == "vertical" ) {
                scrollVertical.removeClass("pp-image-scroll-ver");
            }
            scrollElement.mouseenter(function() {
                scrollElement.removeClass("pp-container-scroll-instant");
                setTransform();
                reverse === 'yes' ? endTransform() : startTransform();
            });

            scrollElement.mouseleave(function() {
                reverse === 'yes' ? startTransform() : endTransform();
            });
        }
    };
    
    var AdvancedAccordionHandler = function ($scope, $) {
    	var $advanced_accordion         = $scope.find(".pp-advanced-accordion").eq(0),
            elementSettings             = getElementSettings( $scope ),
        	$accordion_title            = $scope.find(".pp-accordion-tab-title"),
        	$accordion_type             = elementSettings.accordion_type,
        	$accordion_speed            = elementSettings.toggle_speed;
			
        // Open default actived tab
        $accordion_title.each(function(){
            if ( $(this).hasClass('pp-accordion-tab-active-default') ) {
                $(this).addClass('pp-accordion-tab-show pp-accordion-tab-active');
                $(this).next().slideDown($accordion_speed)
            }
        })

        // Remove multiple click event for nested accordion
        $accordion_title.unbind("click");

        $accordion_title.click(function(e) {
            e.preventDefault();

            var $this = $(this);

            if ( $accordion_type === 'accordion' ) {
                if ( $this.hasClass("pp-accordion-tab-show") ) {
                    $this.removeClass("pp-accordion-tab-show pp-accordion-tab-active");
                    $this.next().slideUp($accordion_speed);
                } else {
                    $this.parent().parent().find(".pp-accordion-tab-title").removeClass("pp-accordion-tab-show pp-accordion-tab-active");
                    $this.parent().parent().find(".pp-accordion-tab-content").slideUp($accordion_speed);
                    $this.toggleClass("pp-accordion-tab-show pp-accordion-tab-active");
                    $this.next().slideToggle($accordion_speed);
                }
            } else {
                // For acccordion type 'toggle'
                if ( $this.hasClass("pp-accordion-tab-show") ) {
                    $this.removeClass("pp-accordion-tab-show pp-accordion-tab-active");
                    $this.next().slideUp($accordion_speed);
                } else {
                    $this.addClass("pp-accordion-tab-show pp-accordion-tab-active");
                    $this.next().slideDown($accordion_speed);
                }
            }
        });
    };

    var ContentTickerHandler = function ($scope, $) {
        var $carousel                   = $scope.find('.pp-content-ticker').eq(0),
            $slider_options             = JSON.parse( $carousel.attr('data-slider-settings') );

        var mySwiper = new Swiper($carousel, $slider_options);
    };

	var PPButtonHandler = function ( $scope, $) {
		var id = $scope.data('id');
		var ttipPosition = $scope.find('.pp-button[data-tooltip]').data('tooltip-position');

		// tablet
		if ( window.innerWidth <= 1024 && window.innerWidth >= 768 ) {
			ttipPosition = $scope.find('.pp-button[data-tooltip]').data('tooltip-position-tablet');
		}
		// mobile
		if ( window.innerWidth < 768 ) {
			ttipPosition = $scope.find('.pp-button[data-tooltip]').data('tooltip-position-mobile');
		}
		$scope.find('.pp-button[data-tooltip]')._tooltip( {
			template: '<div class="pp-tooltip pp-tooltip-'+id+'"><div class="pp-tooltip-body"><div class="pp-tooltip-content"></div><div class="pp-tooltip-callout"></div></div></div>',
			position: ttipPosition,
			animDuration: 400
		} );
	};

	var TwitterTimelineHandler = function ($scope, $) {
		$(document).ready(function () {
			if ('undefined' !== twttr) {
				twttr.widgets.load();
			}
		});
	};
    
    var ImageAccordionHandler = function ($scope, $) {
		var $image_accordion            = $scope.find('.pp-image-accordion').eq(0),
            elementSettings             = getElementSettings( $scope ),
            $action                     = elementSettings.accordion_action,
		    $id                         = $image_accordion.attr( 'id' ),
		    $item                       = $('#'+ $id +' .pp-image-accordion-item');
		   
		if ( 'on-hover' === $action ) {
            $item.hover(
                function ImageAccordionHover() {
                    $item.css('flex', '1');
                    $item.removeClass('pp-image-accordion-active');
                    $(this).addClass('pp-image-accordion-active');
                    $item.find('.pp-image-accordion-content-wrap').removeClass('pp-image-accordion-content-active');
                    $(this).find('.pp-image-accordion-content-wrap').addClass('pp-image-accordion-content-active');
                    $(this).css('flex', '3');
                },
                function() {
                    $item.css('flex', '1');
                    $item.find('.pp-image-accordion-content-wrap').removeClass('pp-image-accordion-content-active');
                    $item.removeClass('pp-image-accordion-active');
                }
            );
        }
		else if ( 'on-click' === $action ) {
            $item.click( function(e) {
                e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
                $item.css('flex', '1');
				$item.removeClass('pp-image-accordion-active');
                $(this).addClass('pp-image-accordion-active');
				$item.find('.pp-image-accordion-content-wrap').removeClass('pp-image-accordion-content-active');
				$(this).find('.pp-image-accordion-content-wrap').addClass('pp-image-accordion-content-active');
                $(this).css('flex', '3');
            });

            $('#'+ $id).click( function(e) {
                e.stopPropagation(); // when you click within the content area, it stops the page from seeing it as clicking the body too
            });

            $('body').click( function() {
                $item.css('flex', '1');
				$item.find('.pp-image-accordion-content-wrap').removeClass('pp-image-accordion-content-active');
				$item.removeClass('pp-image-accordion-active');
            });
		}
    };

	var GFormsHandler = function( $scope, $ ) {
		if ( 'undefined' == typeof $scope )
			return;

		$scope.find('select:not([multiple])').each(function() {
			var	gf_select_field = $( this );
			if( gf_select_field.next().hasClass('chosen-container') ) {
				gf_select_field.next().wrap( "<span class='pp-gf-select-custom'></span>" );
			} else {
				gf_select_field.wrap( "<span class='pp-gf-select-custom'></span>" );
			}
		});
	};

	var PricingTableHandler = function( $scope, $ ) {
		var id                   = $scope.data('id'),
			toolTopElm           = $scope.find('.pp-pricing-table-tooptip[data-tooltip]'),
			elementSettings      = getElementSettings( $scope ),
        	ttArrow              = elementSettings.tooltip_arrow,
			ttTrigger            = elementSettings.tooltip_trigger,
			elementorBreakpoints = elementorFrontend.config.breakpoints;

		toolTopElm.each(function () {
            var ttPosition   = $(this).data('tooltip-position'),
				ttTemplate   = '',
				ttSize       = $(this).data('tooltip-size'),
				animationIn  = $(this).data('tooltip-animation-in'),
				animationOut = $(this).data('tooltip-animation-out');

            // tablet
            if ( window.innerWidth <= elementorBreakpoints.lg && window.innerWidth >= elementorBreakpoints.md ) {
                ttPosition = $scope.find('.pp-pricing-table-tooptip[data-tooltip]').data('tooltip-position-tablet');
            }

            // mobile
            if ( window.innerWidth < elementorBreakpoints.md ) {
                ttPosition = $scope.find('.pp-pricing-table-tooptip[data-tooltip]').data('tooltip-position-mobile');
            }
            
            if ( ttArrow === 'yes' ) {
                ttTemplate = '<div class="pp-tooltip pp-tooltip-' + id + ' pp-tooltip-' + ttSize + '"><div class="pp-tooltip-body"><div class="pp-tooltip-content"></div><div class="pp-tooltip-callout"></div></div></div>';
            } else {
                ttTemplate = '<div class="pp-tooltip pp-tooltip-' + id + ' pp-tooltip-' + ttSize + '"><div class="pp-tooltip-body"><div class="pp-tooltip-content"></div></div></div>';
			}
			
			var tooltipConfig = {
                template:     ttTemplate,
				position:     ttPosition,
				animationIn:  animationIn,
				animationOut: animationOut,
				animDuration: 400,
				alwaysOpen:   false,
                toggleable:   (ttTrigger === 'click') ? true : false
			};
            
            $(this)._tooltip( tooltipConfig );
        });
	};
    
    $(window).on('elementor/frontend/init', function () {
        if ( elementorFrontend.isEditMode() ) {
			isEditMode = true;
		}
        
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-image-hotspots.default', ImageHotspotHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-image-comparison.default', ImageComparisonHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-counter.default', CounterHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-logo-carousel.default', LogoCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-info-box-carousel.default', InfoBoxCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-instafeed.default', InstaFeedPopupHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-team-member-carousel.default', TeamMemberCarouselHandler);
        elementorFrontend.hooks.addAction('frontend/element_ready/pp-scroll-image.default', ImageScrollHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-advanced-accordion.default', AdvancedAccordionHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-content-ticker.default', ContentTickerHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-buttons.default', PPButtonHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-twitter-timeline.default', TwitterTimelineHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-twitter-tweet.default', TwitterTimelineHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-image-accordion.default', ImageAccordionHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-gravity-forms.default', GFormsHandler);
		elementorFrontend.hooks.addAction('frontend/element_ready/pp-pricing-table.default', PricingTableHandler);
		
		if (isEditMode) {
			parent.document.addEventListener("mousedown", function(e) {
				var widgets = parent.document.querySelectorAll(".elementor-element--promotion");

				if (widgets.length > 0) {
					for (var i = 0; i < widgets.length; i++) {
						if (widgets[i].contains(e.target)) {
							var dialog = parent.document.querySelector("#elementor-element--promotion__dialog");
							var icon = widgets[i].querySelector(".icon > i");

							if (icon.classList.toString().indexOf("ppicon") >= 0) {
								dialog.querySelector(".dialog-buttons-action").style.display = "none";

								if (dialog.querySelector(".pp-dialog-buttons-action") === null) {
									var button = document.createElement("a");
									var buttonText = document.createTextNode("Upgrade to PowerPack Pro");

									button.setAttribute("href", "https://powerpackelements.com/upgrade/?utm_medium=pp-elements-lite&utm_source=pp-editor-icons&utm_campaign=pp-pro-upgrade");
									button.setAttribute("target", "_blank");
									button.classList.add(
										"dialog-button",
										"dialog-action",
										"dialog-buttons-action",
										"elementor-button",
										"elementor-button-success",
										"pp-dialog-buttons-action"
									);
									button.appendChild(buttonText);

									dialog.querySelector(".dialog-buttons-action").insertAdjacentHTML("afterend", button.outerHTML);
								} else {
									dialog.querySelector(".pp-dialog-buttons-action").style.display = "";
								}
							} else {
								dialog.querySelector(".dialog-buttons-action").style.display = "";

								if (dialog.querySelector(".pp-dialog-buttons-action") !== null) {
									dialog.querySelector(".pp-dialog-buttons-action").style.display = "none";
								}
							}

							// stop loop
							break;
						}
					}
				}
			});
		}
    });
    
}(jQuery));