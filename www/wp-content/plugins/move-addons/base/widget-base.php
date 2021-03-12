<?php

namespace MoveAddons\Elementor\Widget;

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Base extends Widget_Base {

    /**
     * [get_categories] Get categories
     * @since 0.0.1
     * @return [array] Widget categories.
     */
    public function get_categories() {
        return [ 'move_addon' ];
    }

    /**
     * [get_custom_help_url] Get categories
     * @since 0.0.1
     * @return [URL] Help URL.
     */
    public function get_custom_help_url() {
        $str = substr( $this->get_name(), 0, 4 );
        if( $str == 'move' ){
            $url_slug = substr( $this->get_name(), 5 ).'-widget';
        }else{
            $url_slug = $this->get_name().'-widget';
        }
        return 'https://doc.moveaddons.com/'.$url_slug;
    }

}
