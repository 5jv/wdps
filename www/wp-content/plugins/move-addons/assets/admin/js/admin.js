;(function($) {
"use strict";

    var htmove_tab_menu = function( targetContent, target ){
        $('.htmove-tab-wrapper').find('ul').find('a').filter( function(i, a) {
            return target === a.hash;
        }).addClass('active').parent().siblings().children('a').removeClass('active');
        $( '.htmove-admin-tab-pane' + targetContent ).addClass('active').siblings().removeClass('active');
    }

    var htmove_sidebar_menu = function ( suffix ) {
        let $sidebararea = $( "#toplevel_page_" + suffix ),
            $href = window.location.href,
            $subhref = $href.substr( $href.indexOf( "admin.php" ) );

        $sidebararea.on("click", "a", function (e) {
            var $this = $(this);
            $("ul.wp-submenu li", $sidebararea).removeClass("current"), $this.hasClass("wp-has-submenu") ? $("li.wp-first-item", $sidebararea).addClass("current") : $this.parents("li").addClass("current");

            var $terget = $this.attr("href"),
            $tergetmenu = $terget.substring( $terget.lastIndexOf("#")+1 ),
            $targetContent = '#htmove-tab-content-'+$tergetmenu;
            htmove_tab_menu( $targetContent, '#'+$tergetmenu );
            
        }),

        $("ul.wp-submenu a", $sidebararea).each(function (e, $sidebararea) {
            $($sidebararea).attr("href") !== $subhref || $($sidebararea).parent().addClass("current");

            var $tergetmenu = $subhref.substring( $subhref.lastIndexOf("#")+1 );

            var $menuhref = $($sidebararea).attr("href"),
                $suburl = $menuhref.substring( $menuhref.lastIndexOf("#")+1 );

            if( $tergetmenu === $suburl ){
                var $targetContent = '#htmove-tab-content-'+$tergetmenu;
                htmove_tab_menu( $targetContent, '#'+$tergetmenu );
            }
            
        });

    };
    htmove_sidebar_menu('move-elementor');

    // Tab Menu
    function htmove_admin_tabs( $tabmenus, $tabpane ){

        $tabmenus.on('click', 'a', function(e){
            var $this = $(this),
                $target = $this.attr('href'),
                $targetContent = '#htmove-tab-content-'+$target.substring(1);

            var $sidebararea = $( "#toplevel_page_move-elementor" );

            window.location.hash = $target;
            $sidebararea.find('.wp-submenu').find('a').filter( function(i, a) {
                return $target === a.hash;
            }).parent().addClass('current').siblings().removeClass('current');

            $this.addClass('active').parent().siblings().children('a').removeClass('active');
            $( $tabpane + $targetContent ).addClass('active').siblings().removeClass('active');

        });

    }
    htmove_admin_tabs( $(".htmove-tab-wrapper ul"), '.htmove-admin-tab-pane' );

    /* Accordion */
    var htmove_accordion = function () {
        var adminAccordion = $('.htmove-admin-accordion'),
            adminAccordionCard = $('.htmove-admin-accordion-card'),
            adminAccordionHead = $('.htmove-admin-accordion-head'),
            adminAccordionBody = $('.htmove-admin-accordion-body');
        adminAccordionBody.hide()
        $('.htmove-admin-accordion-card.active').find('.htmove-admin-accordion-body').slideDown();
        adminAccordionHead.on('click', function(e) {
            e.preventDefault();
            var $this = $(this);

            if ($this.parent('.htmove-admin-accordion-card').hasClass('active')) {
                $this.parent('.htmove-admin-accordion-card').removeClass('active').find('.htmove-admin-accordion-body').slideUp();
            } else {
                $this.parent('.htmove-admin-accordion-card').addClass('active').find('.htmove-admin-accordion-body').slideDown();
                $this.parent().siblings('.htmove-admin-accordion-card').removeClass('active').find('.htmove-admin-accordion-body').slideUp();
            }
        })
    };
    htmove_accordion();

    /* GO Pro Popup Open/Close Function */
    var htmove_pro_popup = function() {
        $('[data-require="pro"]').on('click', function(e) {
            e.preventDefault();
            $('#htmove-gopro-popup').addClass('active');
        })
        $('.htmove-gopro-popup-close').on('click', function(e) {
            $('#htmove-gopro-popup').removeClass('active');
        })
    };
    htmove_pro_popup();

    
    var $option_form = $('#move-options-form'),
    $savebtn = $option_form.find('.htmove-option-btn');

    $option_form.on('submit', function(event) {
        event.preventDefault();

        $.ajax( {
            url: HTMOVE.ajaxurl,
            type: 'POST',
            data: {
                nonce: HTMOVE.nonce,
                action: 'htmove_save_opt_data',
                data: $option_form.serialize()
            },
            beforeSend: function(){
                $savebtn.text(HTMOVE.message.loading).addClass('updating-message');
            },
            success: function( data ) {
                $savebtn.removeClass('updating-message').addClass('disabled').attr('disabled', true).text(HTMOVE.message.success);
            },
            complete: function( data ) {
                $savebtn.removeClass('updating-message').addClass('disabled').attr('disabled', true).text(HTMOVE.message.success);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }

        });

    });

    // For checkout field
    $option_form.on('change', ':checkbox', function() {
        $savebtn.removeClass('disabled').attr('disabled', false).text( HTMOVE.message.btntxt );
    });

    // For input field
    $option_form.on( 'keyup', '.htmove-admin-from-field input' , function() {
        $savebtn.removeClass('disabled').attr('disabled', false).text( HTMOVE.message.btntxt );
    });


})(jQuery);
