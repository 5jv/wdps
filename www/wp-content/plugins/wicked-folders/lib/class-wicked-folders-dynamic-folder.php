<?php

/**
 * Represents a dynamic folder.
 */
abstract class Wicked_Folders_Dynamic_Folder extends Wicked_Folders_Folder {

    public function __construct( $args ) {

        parent::__construct( $args );

        $this->movable = false;
        $this->editable = false;
    }

    public abstract function pre_get_posts( $query );

}
