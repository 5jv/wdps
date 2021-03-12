<?php

class Wicked_Folders_Posts_List_Table extends Wicked_Folders_WP_Posts_List_Table {

    private $lie_about_has_items = false;

    public function __construct( $args = array() ) {

        parent::__construct( $args );

        // Work-around for post type not being set on 'post' folder pages
        if ( ! $this->screen->post_type ) {
            $this->screen->post_type = 'post';
        }

    }

    protected function get_bulk_actions() {
        return array();
    }

    protected function extra_tablenav( $which ) {
        return '';
    }

    public function prepare_items() {

        // Trick Wicked_Folders_WP_Posts_List_Table into sorting by alphabetical
        $orderby    = isset( $_GET['orderby'] ) ? $_GET['orderby'] : false;
        $order      = isset( $_GET['order'] ) ? $_GET['order'] : false;

        if ( ! $orderby || 'menu_order title' == $orderby ) {
            $_GET['orderby'] = 'title';
            $_GET['order'] = 'asc';
        }

        parent::prepare_items();

        if ( $orderby ) {
            $_GET['orderby'] = $orderby;
        }

        if ( $order ) {
            $_GET['order'] = $order;
        }

    }

    public function has_items() {

        if ( $this->lie_about_has_items ) {
            return true;
        } else {
            return parent::has_items();
        }

    }

    public function search_box( $text, $input_id ) {

        // Trick the search box into always displaying (this way if a folder
        // doesn't contain any items, the search box will be there when
        // navigating to a different folder)
        $this->lie_about_has_items = true;

        parent::search_box( $text, $input_id );

        $this->lie_about_has_items = false;

    }

}
