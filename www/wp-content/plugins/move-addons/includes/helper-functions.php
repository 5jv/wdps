<?php
/**
 * [move_addons_get_elementor] Get elementor instance
 * @return [\Elementor\Plugin]
 */
function move_addons_get_elementor() {
    return \Elementor\Plugin::instance();
}

/**
 * [move_addons_is_option]
 * @param  [type] $option_list [option filed list]
 * @param  [type] $key        [option key]
 * @return [string]
 */
function move_addons_is_option( $option_list, $key, $value ){
    return isset( get_option( $option_list )[$key][$value] ) ? get_option( $option_list )[$key][$value] : '';
}

/**
 * [move_addons_elementor_version description]
 * @param  string $operator
 * @param  string $version  string
 * @return [bool] true | false
 */
function move_addons_elementor_version( $operator = '<', $version = '2.6.0' ) {
    if( defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator ) ) { return true; } else{ return false; }
}

/**
 * [move_addons_render_icon]
 * @param  array  $settings 
 * @param  string $new_icon  new icon id
 * @param  string $old_icon  Old icon id
 * @param  array  $attributes icon attributes
 * @return [html]  html | false
 */
function move_addons_render_icon( $settings = [], $new_icon = 'selected_icon', $old_icon = 'icon', $attributes = [] ){

    $migrated = isset( $settings['__fa4_migrated'][$new_icon] );
    $is_new = empty( $settings[$old_icon] ) && \Elementor\Icons_Manager::is_migration_allowed();

    $attributes['aria-hidden'] = 'true';
    $output = '';

    if ( move_addons_elementor_version( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {

        if ( empty( $settings[$new_icon]['library'] ) ) {
            return false;
        }

        $tag = 'i';
        // handler SVG Icon
        if ( 'svg' === $settings[$new_icon]['library'] ) {
            if ( ! isset( $settings[$new_icon]['value']['id'] ) ) {
                return '';
            }
            $output = Elementor\Core\Files\Assets\Svg\Svg_Handler::get_inline_svg( $settings[$new_icon]['value']['id'] );

        } else {
            $icon_types = \Elementor\Icons_Manager::get_icon_manager_tabs();
            if ( isset( $icon_types[ $settings[$new_icon]['library'] ]['render_callback'] ) && is_callable( $icon_types[ $settings[$new_icon]['library'] ]['render_callback'] ) ) {
                return call_user_func_array( $icon_types[ $settings[$new_icon]['library'] ]['render_callback'], [ $settings[$new_icon], $attributes, $tag ] );
            }

            if ( empty( $attributes['class'] ) ) {
                $attributes['class'] = $settings[$new_icon]['value'];
            } else {
                if ( is_array( $attributes['class'] ) ) {
                    $attributes['class'][] = $settings[$new_icon]['value'];
                } else {
                    $attributes['class'] .= ' ' . $settings[$new_icon]['value'];
                }
            }
            $output = '<' . $tag . ' ' . \Elementor\Utils::render_html_attributes( $attributes ) . '></' . $tag . '>';
        }

    } else {
        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $settings[ $old_icon ];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $settings[ $old_icon ];
            } else {
                $attributes['class'] .= ' ' . $settings[ $old_icon ];
            }
        }
        $output = sprintf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
    }

    return $output;
 
}

/**
 * [move_addons_html_tag_lists]
 * @return [array] 
 */
function move_addons_html_tag_lists() {
    $html_tag_list = [
        'h1'   => esc_html__( 'H1', 'moveaddons' ),
        'h2'   => esc_html__( 'H2', 'moveaddons' ),
        'h3'   => esc_html__( 'H3', 'moveaddons' ),
        'h4'   => esc_html__( 'H4', 'moveaddons' ),
        'h5'   => esc_html__( 'H5', 'moveaddons' ),
        'h6'   => esc_html__( 'H6', 'moveaddons' ),
        'p'    => esc_html__( 'p', 'moveaddons' ),
        'div'  => esc_html__( 'div', 'moveaddons' ),
        'span' => esc_html__( 'span', 'moveaddons' ),
    ];
    return $html_tag_list;
}

/**
 * [move_addons_elementor_template] Elementor Templates List
 * @return [array]
 */
function move_addons_elementor_template() {
    $templates = move_addons_get_elementor()->templates_manager->get_source( 'local' )->get_items();
    $types = array();
    if ( empty( $templates ) ) {
        $template_lists = [ '0' => esc_html__( 'Do not Saved Templates.', 'moveaddons' ) ];
    } else {
        $template_lists = [ '0' => esc_html__( 'Select Template', 'moveaddons' ) ];
        foreach ( $templates as $template ) {
            $template_lists[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
        }
    }
    return $template_lists;
}

/**
 * [move_addons_get_sidebar]
 * @return [array]
 */
function move_addons_get_sidebar() {
    global $wp_registered_sidebars;
    $sidebars = array();

    if ( ! $wp_registered_sidebars ) {
        $sidebars['0'] = esc_html__( 'No sidebar were found', 'moveaddons' );
    } else {
        $sidebars['0'] = esc_html__( 'Select Sidebar', 'moveaddons' );
        foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
            $sidebars[ $sidebar_id ] = $sidebar['name'];
        }
    }
    return $sidebars;
}

/**
 * [move_addons_get_taxonomies]
 * @param  string $texonomy
 * @return [array]
 */
function move_addons_get_taxonomies( $texonomy = 'category' ){
    $categories = [];

    $terms = get_terms( array(
        'taxonomy' => $texonomy,
        'hide_empty' => true,
    ));
    if ( ! empty( $terms ) ){
        $categories = wp_list_pluck( $terms, 'name', 'slug' );
    }
    return $categories;
}

/**
 * [move_addons_get_taxonomie_list]
 * @param  integer  $id product id
 * @param  string  $taxonomy
 * @param  integer $limit 
 * @return [void] 
 */
function move_addons_get_taxonomie_list( $limit = 1, $taxonomy = 'product_cat', $id = null ) { 
    $terms = get_the_terms( $id, $taxonomy );
    $i = 0;
    if ( is_wp_error( $terms ) )
        return $terms;

    if ( empty( $terms ) )
        return false;

    foreach ( $terms as $term ) {
        $i++;
        $link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $link ) ) {
            return $link;
        }
        echo '<li><a href="' . esc_url( $link ) . '">' . $term->name . '</a></li>';
        if( $i == $limit ){
            break;
        }else{ continue; }
    }
}

/**
 * [move_addons_get_available_menus]
 * @return [array]
 */
function move_addons_get_available_menus(){
    $menus = [];

    $get_menus = wp_get_nav_menus();
    if ( ! empty( $get_menus ) ){
        $menus = wp_list_pluck( $get_menus, 'name', 'slug' );
    }
    return $menus;
}

/**
 * [move_addons_get_cookie_name] Get Compare cookie name
 * @return [string] 
 */
function move_addons_get_cookie_name() {
    $name = 'htmove_has_count';
    if ( is_multisite() ){
        $name .= '_' . get_current_blog_id();
    }
    return $name;
}

/**
 * [move_addons_set_post_count]
 * @param  [int] $postid
 * @param  [string] $posttype
 * @return [null] 
 */
function move_addons_set_post_count( $postid, $posttype ) {
    if( $posttype == 'page' ){
        $count_key = 'htmove_page_views_count';
    }else{
        $count_key = 'htmove_post_views_count';
    }
    $count = get_post_meta( $postid, $count_key, true );
    if( $count == '' ){
        $count = 0;
        delete_post_meta( $postid, $count_key );
        add_post_meta( $postid, $count_key, '0' );
    }else{
        // if the post has already been stored under the cookie
        $cookie_name = move_addons_get_cookie_name();        
        if( !isset( $_COOKIE[ $cookie_name.'-'.$postid ] ) ){
            setcookie( $cookie_name.'-'.$postid, 'htmovealreadycount', 0, COOKIEPATH, COOKIE_DOMAIN, false, false );
            $_COOKIE[$cookie_name.'-'.$postid] = "htmovealreadycount";
            $count++;
            update_post_meta( $postid, $count_key, $count );
        }
    }
}

/**
 * [move_addons_get_post_view]
 * @param  [int] $postid
 * @param  [string] $posttype
 * @return [int] $count
 */
function move_addons_get_post_view( $postid, $posttype ){
    if( $posttype == 'page' ){
        $count_key = 'htmove_page_views_count';
    }else{
        $count_key = 'htmove_post_views_count';
    }
    $count =  get_post_meta( $postid, $count_key, true );
    if( $count =='' ){
        delete_post_meta( $postid, $count_key );
        add_post_meta( $postid, $count_key, '0' );
        return "0";
    }
    return $count;
}

/**
 * [move_addons_view_count] Set View Counter
 * @return void
 */
function move_addons_view_count(){
    if( is_single() && get_post_type() == 'post' ){
        move_addons_set_post_count( get_the_ID(), 'post' );
    }elseif( is_singular( 'page' ) && get_post_type() == 'page' ){
        move_addons_set_post_count( get_the_ID(), 'page' );
    }
}

/**
 * [move_addons_get_post_list]
 * @return [array]
 */
function move_addons_get_post_list( $posttype, $args = [] ) {
    $postes = [];
    $limit = 20;
    if( !empty( $args['limit'] ) ){
        $limit = $args['limit'];
    }

    $get_post_list = get_posts( [
        'post_type'      => $posttype,
        'post_status'    => 'publish',
        'posts_per_page' => $limit,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ] );

    if ( ! empty( $get_post_list ) ) {
        $postes = wp_list_pluck( $get_post_list, 'post_title', 'ID' );
    }

    return $postes;
}

/**
 * [move_addons_is_form_activated]
 * @param  [string] $calss 
 * @return [bool]  
 */
function move_addons_is_form_activated( $calss ) {
    return class_exists( $calss );
}

/**
 * [move_addons_get_cf7_forms]
 * @return [array]
 */
function move_addons_get_cf7_forms() {
    $forms = array();
    if ( move_addons_is_form_activated( '\WPCF7' ) ) {
        $forms_args = array( 
            'post_type'      => 'wpcf7_contact_form',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        );
        $get_forms = get_posts( $forms_args );

        if ( ! empty( $get_forms ) ) {
            $forms = wp_list_pluck( $get_forms, 'post_title', 'ID' );
        }
    }
    return $forms;
}

/**
 * [move_addons_generate_list]
 * @param  [string] $texts 
 * @return [HTML]  
 */
function move_addons_generate_list( $texts ){
    $texts = explode( "\n", $texts );
    if( count( $texts ) && !empty( $texts ) ){
        echo '<ul>';
            foreach( $texts as $text ) { echo '<li>'. $text .' </li>'; }
        echo '</ul>';
    }
}

/**
 * [move_addons_language_code]
 * @return [array]
 */
function move_addons_language_code(){
    return [
        'af' => 'Afrikaans',
        'sq' => 'Albanian',
        'ar' => 'Arabic',
        'eu' => 'Basque',
        'bn' => 'Bengali',
        'bs' => 'Bosnian',
        'bg' => 'Bulgarian',
        'ca' => 'Catalan',
        'zh-cn' => 'Chinese',
        'zh-tw' => 'Chinese-tw',
        'hr' => 'Croatian',
        'cs' => 'Czech',
        'da' => 'Danish',
        'nl' => 'Dutch',
        'en' => 'English',
        'et' => 'Estonian',
        'fi' => 'Finnish',
        'fr' => 'French',
        'gl' => 'Galician',
        'ka' => 'Georgian',
        'de' => 'German',
        'el' => 'Greek (Modern)',
        'he' => 'Hebrew',
        'hi' => 'Hindi',
        'hu' => 'Hungarian',
        'is' => 'Icelandic',
        'io' => 'Ido',
        'id' => 'Indonesian',
        'it' => 'Italian',
        'ja' => 'Japanese',
        'kk' => 'Kazakh',
        'ko' => 'Korean',
        'lv' => 'Latvian',
        'lb' => 'Letzeburgesch',
        'lt' => 'Lithuanian',
        'lu' => 'Luba-Katanga',
        'mk' => 'Macedonian',
        'mg' => 'Malagasy',
        'ms' => 'Malay',
        'ro' => 'Moldovan, Moldavian, Romanian',
        'nb' => 'Norwegian Bokmål',
        'nn' => 'Norwegian Nynorsk',
        'fa' => 'Persian',
        'pl' => 'Polish',
        'pt' => 'Portuguese',
        'ru' => 'Russian',
        'sr' => 'Serbian',
        'sk' => 'Slovak',
        'sl' => 'Slovenian',
        'es' => 'Spanish',
        'sv' => 'Swedish',
        'tr' => 'Turkish',
        'uk' => 'Ukrainian',
        'vi' => 'Vietnamese',
    ];
}

/**
 * [move_addons_mailchimp]
 * @return [array] mailchimp List
 */
function move_addons_mailchimp() {
    $mailchimp = array();
    $api = move_addons_is_option('htmove_userdata_list','mailchimpapi','value');

    $server = explode('-', $api);

    if( !isset( $server[1] ) ){
        return [ esc_html__( 'Do not Found Mailchimp API Key', 'moveaddons' ) ];
    }

    $url = 'https://'.$server[1].'.api.mailchimp.com/3.0/lists?apikey='.$api; 
    $response = wp_remote_get( $url, [] );

    if ( is_array( $response ) && ! is_wp_error( $response ) ) {
        $headers = $response['headers']; 
        $body    = (array) json_decode( $response['body'] ); 
        $listed = isset( $body['lists'] ) ? $body['lists'] : [];
        
        $mailchimp = wp_list_pluck( $listed, 'name', 'id' );
        return $mailchimp;
    }else{
        return [ esc_html__( 'There is no list', 'moveaddons' ) ];
    }

}

/**
* Usages: Compare button shortcode [yith_compare_button] From "YITH WooCommerce Compare" plugins.
* Plugins URL: https://wordpress.org/plugins/yith-woocommerce-compare/
* File Path: yith-woocommerce-compare/includes/class.yith-woocompare-frontend.php
* The Function "woolentor_compare_button" Depends on YITH WooCommerce Compare plugins. If YITH WooCommerce Compare is installed and actived, then it will work.
*/
function move_addons_compare_button( $buttonstyle = 1 ){
    if( !class_exists('YITH_Woocompare') ) return;
    global $product;
    $product_id = $product->get_id();
    $comp_link = home_url() . '?action=yith-woocompare-add-product';
    $comp_link = add_query_arg('id', $product_id, $comp_link);

    if( $buttonstyle == 1 ){
        echo do_shortcode('[yith_compare_button]');
    }else{
        echo '<div class="woocommerce product compare-button"><a title="'. esc_attr__('Add to Compare', 'moveaddons') .'" href="'. esc_url( $comp_link ) .'" class="htmove-product-action-btn compare" data-product_id="'. esc_attr( $product_id ) .'" rel="nofollow"><i class="fas fa-exchange-alt"></i></a></div>';
    }

}

/**
* Usages: "woolentor_add_to_wishlist_button()" function is used  to modify the wishlist button from "YITH WooCommerce Wishlist" plugins.
* Plugins URL: https://wordpress.org/plugins/yith-woocommerce-wishlist/
* File Path: yith-woocommerce-wishlist/templates/add-to-wishlist.php
* The below Function depends on YITH WooCommerce Wishlist plugins. If YITH WooCommerce Wishlist is installed and actived, then it will work.
*/
function move_addons_add_to_wishlist_button( $normalicon = '<i class="far fa-heart"></i>', $addedicon = '<i class="fas fa-heart"></i>', $tooltip = 'no' ) {
    global $product, $yith_wcwl;

    if ( ! class_exists( 'YITH_WCWL' ) || empty(get_option( 'yith_wcwl_wishlist_page_id' ))) return;

    $url          = YITH_WCWL()->get_wishlist_url();
    $product_type = $product->get_type();
    $exists       = $yith_wcwl->is_product_in_wishlist( $product->get_id() );
    $classes      = 'class="add_to_wishlist htmove-product-action-btn"';
    $add          = get_option( 'yith_wcwl_add_to_wishlist_text' );
    $browse       = get_option( 'yith_wcwl_browse_wishlist_text' );
    $added        = get_option( 'yith_wcwl_product_added_text' );

    $output = '';

    $output  .= '<div class="wishlist button-default yith-wcwl-add-to-wishlist add-to-wishlist-' . esc_attr( $product->get_id() ) . '">';
        $output .= '<div class="yith-wcwl-add-button';
            $output .= $exists ? ' hide" style="display:none;"' : ' show"';
            $output .= '><a href="' . esc_url( htmlspecialchars( YITH_WCWL()->get_wishlist_url() ) ) . '" data-product-id="' . esc_attr( $product->get_id() ) . '" data-product-type="' . esc_attr( $product_type ) . '" ' . $classes . ' >'.$normalicon.'</a>';
            $output .= '<i class="fa fa-spinner fa-pulse ajax-loading" style="visibility:hidden"></i>';
        $output .= '</div>';

        $output .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"><a class="htmove-product-action-btn" href="' . esc_url( $url ) . '">'.$addedicon.'</a></div>';
        $output .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"><a href="' . esc_url( $url ) . '" class="htmove-product-action-btn">'.$addedicon.'</a></div>';
    $output .= '</div>';
    return $output;
}

/**
 * [move_addons_in_footer]
 * @return [void]
 */
function move_addons_in_footer(){
    do_action( 'move_footer_content' );
}