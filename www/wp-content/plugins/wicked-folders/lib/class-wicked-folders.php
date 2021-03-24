<?php

// Disable direct load
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

final class Wicked_Folders {

    private static $instance;

    private function __construct() {

		// Register autoload function
        spl_autoload_register( array( $this, 'autoload' ) );

		// Increased priority to 15 to accomodate Pods plugin which registers
		// its custom post types at priority 11
        add_action( 'init',				array( $this, 'init' ), 15 );
		add_action( 'pre_get_posts', 	array( $this, 'pre_get_posts' ), 20 ); // Must be called after pre_get_posts action in Wicked_Folders_Admin

		// Keep folder order in sync with sort order changes made by Category
		// Order and Taxonomy Terms Order plugin
		add_action( 'tto/update-order', array( $this, 'migrate_folder_order' ) );

		// Initalize admin singleton
		Wicked_Folders_Admin::get_instance();

		// Initalize AJAX singleton
		Wicked_Folders_Ajax::get_instance();

    }

    /**
	 * Plugin activation hook.
	 */
	public static function activate() {

		// Check for multisite
		if ( is_multisite() && is_plugin_active_for_network( dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'wicked-folders.php' ) ) {
			$sites = get_sites( array( 'fields' => 'ids' ) );
			foreach ( $sites as $id ) {
				switch_to_blog( $id );
				Wicked_Folders::activate_site();
				restore_current_blog();
			}
		} else {
			Wicked_Folders::activate_site();
		}

    }

	/**
	 * Activates/initalizes settings for a single site.
	 */
	public static function activate_site() {

		$post_types = get_option( 'wicked_folders_post_types', false );
		$taxonomies = get_option( 'wicked_folders_taxonomies', false );
		$state 		= get_user_meta( get_current_user_id(), 'wicked_folders_plugin_state', true );
		$enable_folder_pages = get_option( 'wicked_folders_enable_folder_pages', null );

		// Enable folders for pages by default
		if ( ! $post_types ) {
			$post_types = array( 'page' );
			update_option( 'wicked_folders_post_types', $post_types );
			update_option( 'wicked_folders_dynamic_folder_post_types', $post_types );
		}

		if ( ! $taxonomies ) {
			$taxonomies = array( 'wf_page_folders' );
			update_option( 'wicked_folders_taxonomies', $taxonomies );
		}

		if ( ! $state ) {
			$state = array();
			update_user_meta( get_current_user_id(), 'wicked_folders_plugin_state', $state );
		}

		if ( null === $enable_folder_pages ) {
			// Note: Set to zero instead of false due to WP bug.  See
			// https://core.trac.wordpress.org/ticket/40007
			update_option( 'wicked_folders_enable_folder_pages', 0 );
		}

    }

    public static function autoload( $class ) {

        $file 	= false;
        $files  = array(
			'Wicked_Folders_Screen_State' 					=> 'lib/class-wicked-folders-screen-state.php',
			'Wicked_Folders_Ajax' 							=> 'lib/class-wicked-folders-ajax.php',
			'Wicked_Folders_Admin' 							=> 'lib/class-wicked-folders-admin.php',
			'Wicked_Folders_WP_List_Table' 					=> 'lib/class-wicked-folders-wp-list-table.php',
			'Wicked_Folders_WP_Posts_List_Table' 			=> 'lib/class-wicked-folders-wp-posts-list-table.php',
			'Wicked_Folders_Posts_List_Table' 				=> 'lib/class-wicked-folders-posts-list-table.php',
			'Wicked_Folders_Folder' 						=> 'lib/class-wicked-folders-folder.php',
			'Wicked_Folders_Tree_View' 						=> 'lib/class-wicked-folders-tree-view.php',
			'Wicked_Folders_Term_Folder' 					=> 'lib/class-wicked-folders-term-folder.php',
			'Wicked_Folders_Dynamic_Folder'   				=> 'lib/class-wicked-folders-dynamic-folder.php',
			'Wicked_Folders_Author_Dynamic_Folder'  		=> 'lib/class-wicked-folders-author-dynamic-folder.php',
			'Wicked_Folders_Date_Dynamic_Folder'   			=> 'lib/class-wicked-folders-date-dynamic-folder.php',
			'Wicked_Folders_Term_Dynamic_Folder'   			=> 'lib/class-wicked-folders-term-dynamic-folder.php',
			'Wicked_Common' 								=> 'lib/class-wicked-common.php',
			'Wicked_Folders_Unassigned_Dynamic_Folder' 		=> 'lib/class-wicked-folders-unassigned-dynamic-folder.php',
			'Wicked_Folders_Post_Hierarchy_Dynamic_Folder' 	=> 'lib/class-wicked-folders-post-hierarchy-dynamic-folder.php',
        );

		if ( version_compare( get_bloginfo( 'version' ), '4.7.0', '<' ) ) {
			$files['Wicked_Folders_WP_List_Table'] = 'lib/compat/class-wicked-folders-wp-list-table.php';
		}

        if ( array_key_exists( $class, $files ) ) {
            $file = dirname( dirname( __FILE__ ) ) . '/' . $files[ $class ];
        }

        if ( $file ) {
            $file = str_replace( '/', DIRECTORY_SEPARATOR, $file );
            include_once( $file );
        }

	}

    public static function get_instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new Wicked_Folders();
		}
		return self::$instance;
	}

    public function init() {

		// Folder taxonomies were originally named 'wicked_{$post_type}_folders'
		// which could lead to taxonomy names that exceeded the allowed length
		// of 32 characters. Migrate folder taxonomy names if we haven't done so
		// already.
		$tax_name_migration_done 	= get_option( 'wicked_folders_tax_name_migration_done', false );
		$db_version 				= get_option( 'wicked_folders_db_version', '0' );

		if ( false === $tax_name_migration_done ) {
			$this->migrate_folder_taxonomy_names();
		}

        $this->register_taxonomies();

		Wicked_Folders_Admin::get_instance()->save_settings();

		// Update existing installs that don't have the dynamic folders option set yet
		$post_types = get_option( 'wicked_folders_dynamic_folder_post_types', false );

		if ( false === $post_types ) {
			update_option( 'wicked_folders_dynamic_folder_post_types', $this->post_types() );
		}

		if ( version_compare( $db_version, '2.17.0', '<' ) ) {
			update_option( 'wicked_folders_enable_folder_pages', false );
			update_option( 'wicked_folders_db_version', '2.17.0' );
		}

		if ( version_compare( $db_version, '2.17.5', '<' ) ) {
			$this->migrate_folder_order();
			update_option( 'wicked_folders_db_version', '2.17.5' );
		}
    }

    public function register_taxonomies() {
		static $done = false;

		// Only execute this function once per request
		if ( $done ) return false;

        $post_types = Wicked_Folders::post_type_objects();

        // Create a folder taxonomy for each post type
        foreach ( $post_types as $post_type ) {

            $tax_name = Wicked_Folders::get_tax_name( $post_type->name );

            $labels = array(
                'name'			=> sprintf( _x( '%1$s Folders', 'Taxonomy plural name', 'wicked-folders' ), $post_type->labels->singular_name ),
                'singular_name' => sprintf( _x( '%1$s Folder', 'Taxonomy singular name', 'wicked-folders' ), $post_type->labels->singular_name ),
                'all_items'		=> sprintf( __( 'All %1$s Folders', 'wicked-folders' ), $post_type->labels->singular_name ),
                'edit_item'		=> __( 'Edit Folder', 'wicked-folders' ),
                'update_item'	=> __( 'Update Folder', 'wicked-folders' ),
                'add_new_item'	=> __( 'Add New Folder', 'wicked-folders' ),
                'new_item_name' => __( 'Add Folder Name', 'wicked-folders' ),
                'menu_name'     => __( 'Folders', 'wicked-folders' ),
                'search_items'  => __( 'Search Folders', 'wicked-folders' ),
				'parent_item' 	=> __( 'Parent Folder', 'wicked-folders' ),
            );

            $args = array(
                'label'				=> _x( 'Folders', 'Taxonomy plural name', 'wicked-folders' ),
                'labels'			=> $labels,
                'show_tagcloud' 	=> false,
                'hierarchical'		=> true,
                'public'        	=> false,
                'show_ui'       	=> true,
                'show_in_menu'  	=> false,
				'show_in_rest' 		=> true,
                'show_admin_column' => true,
                'rewrite'			=> false,
            );

			if ( 'attachment' == $post_type->name && get_option( 'wicked_folders_enable_taxonomy_pages', false ) ) {
				$args['show_in_menu'] 	= true;
				$args['labels']['menu_name'] = __( 'Manage Folders', 'wicked-folders' );
			}

			register_taxonomy( $tax_name, $post_type->name, $args );

        }

		$done = true;
    }

	/**
	 * Gets the posts types that folders are enabled for.
	 *
	 * @return array
	 *  Array of post types.
	 */
	public static function post_types() {
		$post_types = get_option( 'wicked_folders_post_types', array() );

		return apply_filters( 'wicked_folders_post_types', $post_types );
	}

	/**
	 * Gets the posts type objects that folders are enabled for.
	 *
	 * @return array
	 *  Array of WP_Post_Type Object objects.
	 */
	public static function post_type_objects() {
		$post_types 		= array();
		$enabled_post_types = Wicked_Folders::post_types();
		$all_post_types 	= get_post_types( array(
			'show_ui' => true,
		), 'objects' );

		foreach ( $all_post_types as $post_type ) {
			if ( in_array( $post_type->name, $enabled_post_types ) ) {
				$post_types[] = $post_type;
			}
		}

		return apply_filters( 'wicked_folders_post_type_objects', $post_types );
	}

	/**
	 * Gets the posts types that dynamic folders are enabled for.
	 *
	 * @return array
	 *  Array of post types.
	 */
	public static function dynamic_folder_post_types() {
		$post_types = get_option( 'wicked_folders_dynamic_folder_post_types', array() );
		return apply_filters( 'wicked_folders_dynamic_folder_post_types', $post_types );
	}

	/**
	 * Gets the taxonomies that folders are enabled for.
	 *
	 * @return array
	 *  Array of taxonomy system names.
	 */
	public static function taxonomies() {
		$taxonomies = get_option( 'wicked_folders_taxonomies', array() );
		return apply_filters( 'wicked_folders_taxonomies', $taxonomies );
	}

	/**
	 * Moves an object to the specified folder.
	 *
	 * TODO: maybe change to two functions...move folder and move post?
	 *
	 * @param string $object_type
	 *  'folder' or 'post' for all other objects
	 *
	 * @param int $object_id
	 *  The ID of the object being moved.
	 *
	 * @param int $destination_folder_id
	 *  The ID of the folder that the object is being moved to.
	 *
	 * @param int $source_folder_id
	 *  For post object types, the folder ID the object is being moved from.
	 *
	 * @return bool
	 *  True on success, false on failure.
	 */
	public static function move_object( $object_type, $object_id, $destination_folder_id, $source_folder_id = false ) {

		if ( 'folder' == $object_type ) {
			$object = get_term( $object_id );
			$result = wp_update_term( $object->term_id, $object->taxonomy, array(
				'parent' => $destination_folder_id,
			) );
			return !! is_wp_error( $result );
		}

		if ( 'post' == $object_type ) {
			// Get the folder term
			$folder = get_term( $destination_folder_id );
			// Get the folders that the post is currently assigned to
			$terms 	= wp_get_object_terms( $object_id, $folder->taxonomy, array(
				'fields' => 'ids',
			) );
			// Add the destination folder
			if ( 0 !== $destination_folder_id ) {
				$terms[] = $destination_folder_id;
			}
			$terms = array_unique( $terms );
			// Remove the object from the source folder
			if ( false !== $source_folder_id && $source_folder_id != $destination_folder_id ) {
				$source_folder_index = array_search( $source_folder_id, $terms );
				if ( false !== $source_folder_index ) {
					unset( $terms[ $source_folder_index ] );
				}
			}
			$result = wp_set_object_terms( $object_id, $terms, $folder->taxonomy );
		}

	}

	/**
	 * Gets a folder.
	 *
	 * @param string $id
	 *  The folder's ID.
	 *
	 * @param string $post_type
	 *  The post type name that the folder is registered with.
	 *
	 * @param string $taxonomy
	 *  The taxonomy name to get folders from.
	 *
	 * @return Wicked_Folders_Folder|bool
	 *  A Wicked_Folders_Folder object or false if the folder doesn't exist.
	 */
	public static function get_folder( $id, $post_type, $taxonomy = false ) {
		global $wpdb;

		if ( ! $taxonomy ) $taxonomy = Wicked_Folders::get_tax_name( $post_type );

		$term 		= get_term( ( int ) $id, $taxonomy );
		$stub_types = array(
			self::get_user_post_type_name(),
			self::get_plugin_post_type_name(),
			self::get_gravity_forms_form_post_type_name(),
			self::get_gravity_forms_entry_post_type_name(),
		);

		if ( ! $term || is_wp_error( $term ) ) {
			$folder = false;
		} else {
			if ( in_array( $post_type, $stub_types ) ) {
				$count = ( int ) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT(tr.object_id)) AS n, tt.taxonomy FROM {$wpdb->term_relationships} AS tr INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy = %s AND tt.term_id = %d GROUP BY tt.taxonomy", $taxonomy, $term->term_id ) );
			} else {
				$count = ( int ) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT(p.ID)) AS n, tt.taxonomy FROM {$wpdb->posts} AS p INNER JOIN {$wpdb->term_relationships} AS tr ON p.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE p.post_type = %s AND p.post_status NOT IN ('trash', 'auto-draft') AND tt.taxonomy = %s AND tt.term_id = %d GROUP BY tt.taxonomy", $post_type, $taxonomy, $term->term_id ) );
			}

			$folder = new Wicked_Folders_Term_Folder( array(
				'id' 				=> $term->term_id,
				'name' 				=> $term->name,
				'parent' 			=> $term->parent,
				'taxonomy' 			=> $term->taxonomy,
				'post_type' 		=> $post_type,
				'show_item_count' 	=> true,
				'item_count' 		=> $count,
			) );
		}

		$filter_args = array(
			'id' 		=> $id,
			'post_type' => $post_type,
			'taxonomy' 	=> $taxonomy,
		);

		return apply_filters( 'wicked_folders_get_folder', $folder, $filter_args );

	}

	/**
     * Gets the folder objects for the specified post type and taxonomy.
     *
	 * @param string $post_type
	 *  The post type name.
	 *
	 * @param string $taxonomy
	 *  The taxonomy name to get folders from.
	 *
     * @return array
     *  Array of Wicked_Folders_Folder objects.
     */
    public static function get_folders( $post_type, $taxonomy = false ) {
		global $wpdb;

		// Bail if we don't have a post type
		if ( ! $post_type ) return array();

		$total_count 			= 0;
		$assigned_count 		= 0;
		$counts 				= array();
		$folders 				= array();
		$cache_key 				= array();
		$post_type_object 		= get_post_type_object( $post_type );
		$show_unassigned_folder = get_option( 'wicked_folders_show_unassigned_folder', true );
		$show_item_counts 		= get_option( 'wicked_folders_show_item_counts', true );
		$enable_dynamic_folders = self::dynamic_folders_enabled_for( $post_type );
		$stub_types 			= array(
			self::get_user_post_type_name(),
			self::get_plugin_post_type_name(),
			self::get_gravity_forms_form_post_type_name(),
			self::get_gravity_forms_entry_post_type_name(),
		);

		if ( ! $taxonomy ) $taxonomy = Wicked_Folders::get_tax_name( $post_type );

		// Only run count queries when show item counts setting is enabled
		if ( $show_item_counts ) {
			if ( in_array( $post_type, $stub_types ) ) {
				$counts 		= $wpdb->get_results( $wpdb->prepare( "SELECT tt.term_id, COUNT(tr.object_id) AS n FROM {$wpdb->term_relationships} AS tr INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy = %s GROUP BY tr.term_taxonomy_id", $taxonomy ), OBJECT_K );
				$assigned_count = ( int ) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT(tr.object_id)) AS n, tt.taxonomy FROM {$wpdb->term_relationships} AS tr INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE tt.taxonomy = %s GROUP BY tt.taxonomy", $taxonomy ) );
			} else {
				$counts 		= $wpdb->get_results( $wpdb->prepare( "SELECT tt.term_id, COUNT(tr.object_id) AS n FROM {$wpdb->term_relationships} AS tr INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN {$wpdb->posts} p ON tr.object_id = p.ID WHERE tt.taxonomy = %s AND p.post_status NOT IN ('trash', 'auto-draft') GROUP BY tr.term_taxonomy_id", $taxonomy ), OBJECT_K );
				$assigned_count = ( int ) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(DISTINCT(p.ID)) AS n, tt.taxonomy FROM {$wpdb->posts} AS p INNER JOIN {$wpdb->term_relationships} AS tr ON p.ID = tr.object_id INNER JOIN {$wpdb->term_taxonomy} AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id WHERE p.post_type = %s AND p.post_status NOT IN ('trash', 'auto-draft') AND tt.taxonomy = %s GROUP BY tt.taxonomy", $post_type, $taxonomy ) );
				$total_count 	= ( int ) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(p.ID) AS n FROM {$wpdb->posts} AS p WHERE p.post_type = %s AND p.post_status NOT IN ('trash', 'auto-draft')", $post_type ) );
			}

			if ( $post_type == self::get_user_post_type_name() ) {
				$total_count = ( int ) $wpdb->get_var( "SELECT COUNT(ID) AS n FROM {$wpdb->users}" );
			}

			if ( $post_type == self::get_plugin_post_type_name() ) {
				if ( ! function_exists( 'get_plugins' ) ) {
					require_once ABSPATH . 'wp-admin/includes/plugin.php';
				}

				$plugins = get_plugins();

				$total_count = count( $plugins );
			}

			if ( $post_type == self::get_gravity_forms_form_post_type_name() ) {
				if ( class_exists( 'GFAPI' ) ) {
					$active_forms 	= GFAPI::get_forms();
					$inactive_forms = GFAPI::get_forms( false );

					$total_count = count( $active_forms ) + count( $inactive_forms );
				}
			}

			if ( $post_type == self::get_gravity_forms_entry_post_type_name() ) {
				if ( class_exists( 'GFAPI' ) && class_exists( 'RGFormsModel' ) && class_exists( 'RGForms' ) ) {
					$forms   = RGFormsModel::get_forms( null, 'title' );
					$form_id = RGForms::get( 'id' );

					if ( empty( $form_id ) && isset( $forms[0]->id ) ) {
						$form_id = $forms[0]->id;
					}

					$total_count = GFAPI::count_entries( $form_id, array( 'status' => 'active' ) );
				}
			}
		}

        $filter_args = array(
			'post_type' => $post_type,
            'taxonomy' 	=> $taxonomy,
        );

		// Unassigned folder
		$unassigned_items = new Wicked_Folders_Unassigned_Dynamic_Folder( array(
			'id' 		=> 'unassigned_dynamic_folder',
			'name' 		=> __( 'Unassigned Items', 'wicked-folders' ),
			'parent' 	=> apply_filters( 'wicked_folders_unassigned_items_parent', 'root', $filter_args ),
			'post_type' => $post_type,
			'taxonomy' 	=> $taxonomy,
			'item_count'=> $total_count - $assigned_count,
			'order' 	=> -10,
		) );

		if ( $show_unassigned_folder ) $folders[] = $unassigned_items;

		// Add root folder
        $folders[] = new Wicked_Folders_Folder( array(
			'id' 				=> 0,
			//'name' => 		sprintf( __( 'All %1$s', 'wicked-folders' ), $post_type_object->label ),
			'name' 				=> __( 'All Folders', 'wicked-folders' ),
			'parent' 			=> 'root',
			'post_type' 		=> $post_type,
			'taxonomy' 			=> $taxonomy,
			'taxonomy' 			=> $taxonomy,
			'show_item_count' 	=> true,
			'item_count' 		=> $total_count,
		) );

		if ( version_compare( get_bloginfo( 'version' ), '4.5.0', '<' ) ) {
			$terms = get_terms( $taxonomy, array(
				'hide_empty' 	=> false,
			) );
		} else {
			$terms = get_terms( array(
				'taxonomy' 		=> $taxonomy,
				'hide_empty' 	=> false,
			) );
		}

		if ( ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_count = isset( $counts[ $term->term_id ] ) ? $counts[ $term->term_id ]->n : 0;
				$term_order = ( int ) get_term_meta( $term->term_id, 'wf_order', true );

				$folders[] = new Wicked_Folders_Term_Folder( array(
					'id' 			=> $term->term_id,
					'name' 			=> $term->name,
					'parent' 		=> $term->parent,
					'post_type' 	=> $post_type,
					'taxonomy' 		=> $taxonomy,
					'item_count' 	=> $term_count,
					'order' 		=> $term_order,
				) );
			}
		}

		// Check if dynamic folders are enabled for this post type
		if ( $enable_dynamic_folders ) {

			$dynamic_folders = array(
				new Wicked_Folders_Folder( array(
					'id' 		=> 'dynamic_root',
					'name' 		=> __( 'Dynamic Folders', 'wicked-folders' ),
					'parent' 	=> 'root',
					'post_type' => $post_type,
					'taxonomy' 	=> $taxonomy,
					'order' 	=> -100,
				) ),
			);

			if ( Wicked_Folders::get_user_post_type_name() != $post_type && Wicked_Folders::get_plugin_post_type_name() != $post_type ) {
				$date_folders 		= self::get_instance()->get_date_dynamic_folders( $post_type, $taxonomy );
				$author_folders 	= self::get_instance()->get_author_dynamic_folders( $post_type, $taxonomy );
				$term_folders 		= self::get_instance()->get_term_dynamic_folders( $post_type, $taxonomy );
				$hierarchy_folders 	= self::get_instance()->get_post_hiearchy_dynamic_folders( $post_type, $taxonomy );

				$dynamic_folders = array_merge( $dynamic_folders, $author_folders, $date_folders, $term_folders, $hierarchy_folders );
			}

			$dynamic_folders = ( array ) apply_filters( 'wicked_folders_get_dynamic_folders', $dynamic_folders, $filter_args );

			$folders = array_merge( $dynamic_folders, $folders );

		}

		foreach ( $folders as &$folder ) {
			$folder->type = get_class( $folder );
		}

        return ( array ) apply_filters( 'wicked_folders_get_folders', $folders, $filter_args );

    }

	/**
	 * Returns true if folders are enabled for the specified post type, false
	 * if not.
	 *
	 * @param string $post_type
	 *  The post type name to check.
	 *
	 * @return bool
	 */
	public static function enabled_for( $post_type ) {

		$post_types = Wicked_Folders::post_types();

		return in_array( $post_type, $post_types );

	}

	/**
	 * Returns true if dynamic folders are enabled for the specified post type,
	 * false if not.
	 *
	 * @param string $post_type
	 *  The post type name to check.
	 *
	 * @return bool
	 */
	public static function dynamic_folders_enabled_for( $post_type ) {

		$post_types = Wicked_Folders::dynamic_folder_post_types();

		return in_array( $post_type, $post_types );

	}

	/**
	 * Returns the plugin's version.
	 */
	public static function plugin_version() {

		static $version = false;

		if ( ! $version && function_exists( 'get_plugin_data' ) ) {
			$plugin_data 	= get_plugin_data( dirname( dirname( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'wicked-folders.php' );
			$version 		= $plugin_data['Version'];
		}

		return $version;

	}

	/**
	 * The timezone string set on the site's General Settings page.
	 *
	 * Thanks to this article on SkyVerge for handling UTC offsets:
	 * https://www.skyverge.com/blog/down-the-rabbit-hole-wordpress-and-timezones/
	 *
	 * @return string
	 *  A string that can be used to instantiate a DateTimeZone object.
	 */
	public static function timezone_identifier() {
		$timezones 	= timezone_identifiers_list();
		$timezone 	= get_option( 'timezone_string' );

		// If site timezone string is valid, return it
		if ( in_array( $timezone, $timezones ) ) {
			return $timezone;
		}

		// Get UTC offset, if it isn't set then return UTC
		if ( 0 === ( $utc_offset = get_option( 'gmt_offset', 0 ) ) ) {
			return 'UTC';
		}

		// Round offsets like 7.5 down to 7
		// TODO: explore if this is the right approach
		$utc_offset = round( $utc_offset, 0, PHP_ROUND_HALF_DOWN );

		// Adjust UTC offset from hours to seconds
		$utc_offset *= 3600;

		// Attempt to guess the timezone string from the UTC offset
		if ( $timezone = timezone_name_from_abbr( '', $utc_offset, 0 ) ) {
			// Make sure timezone is valid
			if ( in_array( $timezone, $timezones ) ) {
				return $timezone;
			}
		}

		// Last try, guess timezone string manually
		$is_dst = date( 'I' );

		foreach ( timezone_abbreviations_list() as $abbr ) {
			foreach ( $abbr as $city ) {
				if ( $city['dst'] == $is_dst && $city['offset'] == $utc_offset ) {
					// Make sure timezone is valid
					if ( in_array( $city['timezone_id'], $timezones ) ) {
						return $city['timezone_id'];
					}
				}
			}
		}

		// Fallback to UTC
		return 'UTC';
	}

	/**
	 * Returns a dynamically generated collection of date folders.
	 *
	 * @param string $post_type
	 *  The post type to generate folders for.
	 *
	 * @return array
	 *  Array of Wicked_Folders_Date_Dynamic_Folder objects.
	 */
	public function get_date_dynamic_folders( $post_type, $taxonomy ) {
		global $wpdb;

		$cache_key 	= array();
		$years 		= array();
		$folders 	= array();

		// Fetch post dates
		if ( 'attachment' == $post_type ) {
			$results = $wpdb->get_results( "SELECT post_date FROM {$wpdb->posts} WHERE post_type = 'attachment' ORDER BY post_date ASC" );
		} else {
			$results = $wpdb->get_results( $wpdb->prepare( "SELECT post_date FROM {$wpdb->posts} WHERE post_type = %s AND post_status NOT IN ('trash', 'auto-draft') ORDER BY post_date ASC", $post_type ) );
		}

		// Check for cache
		foreach ( $results as $row ) {
			// Skip blank dates
			if ( '0000-00-00 00:00:00' == $row->post_date ) continue;

			$timezone = new DateTimeZone( Wicked_Folders::timezone_identifier() );

			$date = new DateTime( $row->post_date, $timezone );

			$cache_key[] = $date->format( 'Ymd' );

		}

		$cache_key = 'wicked_folders_dynamic_date_cache_' . md5( 'dynamic_date_' . join( '_', $cache_key ) );

		if ( false !== ( $cached_folders = get_transient( $cache_key ) ) ) {
			return $cached_folders;
		}

		// Organize dates into an array that will be easy to loop through
		foreach ( $results as $row ) {

			// Skip blank dates
			if ( '0000-00-00 00:00:00' == $row->post_date ) continue;

			$timezone = new DateTimeZone( Wicked_Folders::timezone_identifier() );

			$date = new DateTime( $row->post_date, $timezone );

			$year 	= $date->format( 'Y' );
			$month 	= $date->format( 'm' );
			$day 	= $date->format( 'd' );

			//$dates[ $year ][ $month ][ $day ] = array();
			if ( ! isset( $years[ $year ] ) ) {
				$years[ $year ] = array(
					'year' 		=> $year,
					'name' 		=> $year,
					'months' 	=> array(),
				);
			}

			if ( ! isset( $years[ $year ]['months'][ $month ] ) ) {
				$years[ $year ]['months'][ $month ] = array(
					'month' => $month,
					'name' 	=> $date->format( 'F' ),
					'days' 	=> array(),
				);
			}

			if ( ! isset( $years[ $year ]['months'][ $month ]['days'][ $day ] ) ) {
				$years[ $year ]['months'][ $month ]['days'][ $day ] = array(
					'day' 	=> $day,
					'name' 	=> $date->format( 'j' ),
				);
			}

		}

		$folders[] = new Wicked_Folders_Date_Dynamic_Folder( array(
				'id' 		=> 'dynamic_date',
				'name' 		=> __( 'All Dates', 'wicked-folders' ),
				'parent' 	=> 'dynamic_root',
				'post_type' => $post_type,
				'taxonomy' 	=> $taxonomy,
			)
		);

		// Create our folders
		foreach ( $years as $year ) {

			$year_id = 'dynamic_date_' . $year['year'];

			$folders[] = new Wicked_Folders_Date_Dynamic_Folder( array(
					'id' 		=> $year_id,
					'name' 		=> $year['name'],
					'parent' 	=> 'dynamic_date',
					'post_type' => $post_type,
					'taxonomy' 	=> $taxonomy,
				)
			);

			foreach ( $year['months'] as $month ) {

				$month_id = 'dynamic_date_' . $year['year'] . '_' . $month['month'];

				$folders[] = new Wicked_Folders_Date_Dynamic_Folder( array(
						'id' 		=> $month_id,
						'name' 		=> $month['name'],
						'parent' 	=> $year_id,
						'post_type' => $post_type,
						'taxonomy' 	=> $taxonomy,
					)
				);

				foreach ( $month['days'] as $day ) {

					$day_id = 'dynamic_date_' . $year['year'] . '_' . $month['month'] . '_' . $day['day'];

					$folders[] = new Wicked_Folders_Date_Dynamic_Folder( array(
							'id' 		=> $day_id,
							'name' 		=> $day['name'],
							'parent' 	=> $month_id,
							'post_type' => $post_type,
							'taxonomy' 	=> $taxonomy,
						)
					);

				}
			}
		}

		set_transient( $cache_key, $folders, DAY_IN_SECONDS );

		return $folders;

	}

	/**
	 * Returns a dynamically generated collection of author folders.
	 *
	 * @param string $post_type
	 *  The post type to generate folders for.
	 *
	 * @return array
	 *  Array of Wicked_Folders_Author_Dynamic_Folder objects.
	 */
	public function get_author_dynamic_folders( $post_type, $taxonomy ) {

		// TODO: possibly cache

		global $wpdb;

		$folders = array();

		// Fetch authors
		$results = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT u.ID, u.display_name FROM {$wpdb->posts} p INNER JOIN {$wpdb->users} u ON p.post_author = u.ID AND post_status NOT IN ('trash', 'auto-draft') WHERE post_type = %s ORDER BY u.display_name ASC", $post_type ) );

		$folders[] = new Wicked_Folders_Author_Dynamic_Folder( array(
				'id' 		=> 'dynamic_author',
				'name' 		=> __( 'All Authors', 'wicked-folders' ),
				'parent' 	=> 'dynamic_root',
				'post_type' => $post_type,
				'taxonomy' 	=> $taxonomy,
			)
		);

		foreach ( $results as $row ) {

			$folders[] = new Wicked_Folders_Author_Dynamic_Folder( array(
					'id' 		=> 'dynamic_author_' . $row->ID,
					'name' 		=> $row->display_name,
					'parent' 	=> 'dynamic_author',
					'post_type' => $post_type,
					'taxonomy' 	=> $taxonomy,
				)
			);

		}

		return $folders;

	}

	public function get_term_dynamic_folders( $post_type, $taxonomy ) {

		$cache_key 			= array();
		$folders 			= array();
		$original_taxonomy 	= $taxonomy;
		/*
		// get_taxonomies only returns taxonomies that match the query exactly
		// meaning that it will omit any taxonomies that are assigned to multiple
		// post types (since we're only passing one post type to the object_type
		// filter). Therefore, use get_object_taxonomies instead and filter out
		// taxonomies we don't want
		$taxonomies 		= get_taxonomies( array(
			'object_type' 	=> array( $post_type ),
			'hierarchical' 	=> true,
			'show_ui' 		=> true,
		), 'objects' );
		*/
		$taxonomies = get_object_taxonomies( $post_type, 'objects' );
		$taxonomies = wp_filter_object_list( $taxonomies, array(
			'hierarchical' 	=> true,
			'show_ui' 		=> true,
		) );

		// Remove folders taxonomy
		unset( $taxonomies[ $original_taxonomy ] );

		// Filter taxonomies
		$filter_args = array(
			'post_type' 		=> $post_type,
			'folder_taxonomy' 	=> $original_taxonomy,
		);

		$taxonomies = ( array ) apply_filters( 'wicked_folders_term_dynamic_folder_taxonomies', $taxonomies, $filter_args );

		if ( is_array( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy ) {

				$terms 		= array();
				$cache_key 	= array();

				if ( version_compare( get_bloginfo( 'version' ), '4.5.0', '<' ) ) {
					$terms = get_terms( $taxonomy->name, array(
						'hide_empty' 	=> true,
					) );
				} else {
					$terms = get_terms( array(
						'taxonomy' 		=> $taxonomy->name,
						'hide_empty' 	=> true,
					) );
				}

				if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {

					foreach ( $terms as $term ) {
						$cache_key[] = $term->term_id . '-' . $term->parent;
					}

					$cache_key = 'wicked_folders_dynamic_term_' . $taxonomy->name . '_cache_' . md5( 'dynamic_term_' . $taxonomy->name . '_' . join( '_', $cache_key ) );

					if ( false !== ( $cached_folders = get_transient( $cache_key ) ) ) {
						$folders = array_merge( $folders, $cached_folders );
					} else {
						$folders[] = new Wicked_Folders_Term_Dynamic_Folder( array(
								'id' 		=> 'dynamic_term_' . $taxonomy->name,
								'name' 		=> $taxonomy->labels->name,
								'parent' 	=> 'dynamic_root',
								'post_type' => $post_type,
								'taxonomy' 	=> $original_taxonomy,
							)
						);

						foreach ( $terms as $term ) {
							$id 	= 'dynamic_term_' . $taxonomy->name . '__id__' . $term->term_id;
							$parent = 'dynamic_term_' . $taxonomy->name;

							if ( $term->parent ) {
								$parent .=  '__id__' . $term->parent;
							}

							$folders[] = new Wicked_Folders_Term_Dynamic_Folder( array(
								'id' 		=> $id,
								'name' 		=> $term->name,
								'parent' 	=> $parent,
								'post_type' => $post_type,
								'taxonomy' 	=> $original_taxonomy,
							) );
						}

						set_transient( $cache_key, $folders, DAY_IN_SECONDS );
					}
				}
			}
		}

		return $folders;

	}

	/**
	 * Sets up a post heirarchy dynamic folder.  For performance reasons, only
	 * the the root folder is generated.
	 *
	 * @param string $post_type
	 *  The post type to generate folders for.
	 *
	 * @return array
	 *  Array of Wicked_Folders_Post_Hierarchy_Dynamic_Folder objects.
	 */
	public function get_post_hiearchy_dynamic_folders( $post_type, $taxonomy ) {
		$folders 	= array();
		$post_type 	= get_post_type_object( $post_type );

		// Sanity check to make sure we have a post type to work with
		if ( $post_type ) {
			if ( isset( $post_type->hierarchical ) && true == $post_type->hierarchical ) {
				$folders[] = new Wicked_Folders_Post_Hierarchy_Dynamic_Folder( array(
						'id' 		=> 'dynamic_hierarchy_0',
						'name' 		=> sprintf( '%1$s %2$s', $post_type->labels->singular_name, __( 'Hierarchy', 'wicked-folders' ) ),
						'parent' 	=> 'dynamic_root',
						'post_type' => $post_type->name,
						'taxonomy' 	=> $taxonomy,
					)
				);
			}
		}

		return $folders;
	}

	/**
	 * Returns an instance of a dynamic folder or false if the item is not a
	 * dynamic folder.
	 *
	 * @param string $class
	 *  The class name of the dynamic folder to get.
	 *
	 * @return Wicked_Folders_Dynamic_Folder|bool
	 *  A dynamic folder instance or false.
	 */
	public static function get_dynamic_folder( $class, $id, $post_type, $taxonomy = false ) {

		if ( ! class_exists( $class ) ) return;

		if ( ! $taxonomy ) $taxonomy = Wicked_Folders::get_tax_name( $post_type );

		$folder = new $class( array(
			'id' 		=> $id,
			'post_type' => $post_type,
			'taxonomy' 	=> $taxonomy,
		) );

		if ( is_a( $folder, 'Wicked_Folders_Dynamic_Folder' ) ) {
			$folder->type = get_class( $folder );
			return $folder;
		} else {
			return false;
		}

	}

	/**
	 * Utility function that removes queries for the specified taxonomy from
	 * the query.
	 *
	 * @param WP_Query_Object $query
	 *  The query to remove the tax query from.
	 *
	 * @param string $taxonomy
	 *  The name of the taxonomy to remove
	 */
	public static function remove_tax_query( $query, $taxonomy ) {
		$tax_queries = $query->get( 'tax_query' );
		if ( is_array( $tax_queries ) ) {
			for ( $i = count( $tax_queries ); $i > -1; $i-- ) {
				// Make sure index exists (index could be something non-numeric
				// like 'operator')
				if ( isset( $tax_queries[ $i ]['taxonomy'] ) ) {
					if ( $taxonomy == $tax_queries[ $i ]['taxonomy'] ) {
						unset( $tax_queries[ $i ] );
					}
				}
			}
			$query->set( 'tax_query', $tax_queries );
		}
	}

	/**
	 * Checks if upselling is enabled.
	 */
	public static function is_upsell_enabled() {
		$upsell = true;
		if ( defined( 'WICKED_PLUGINS_ENABLE_UPSELL' ) ) {
			$upsell = WICKED_PLUGINS_ENABLE_UPSELL;
		}
		return apply_filters( 'wicked_plugins_enable_upsell', $upsell );
	}

	/**
	 * Checks the query and determines if the query is being ordered by a
	 * folder's sort order.
	 *
	 * @return bool
	 */
	public static function is_folder_order_query( WP_Query $query ) {
		$orderby = $query->get( 'orderby' );
		if ( is_array( $orderby ) ) {
			return array_key_exists( 'wicked_folder_order', $orderby );
		} else {
			if ( false !== strpos( $orderby, 'wicked_folder_order' ) ) {
				return true;
			}
		}
		return false;
		/*
		$is_folder_sorted_query = false;
		$meta_key 				= $query->get( 'meta_key' );
		// Folder sort meta key must be present to sort by folder
		if ( 0 === strpos( $meta_key, '_wicked_folders_sort_' ) ) {
			// Only worry about queries that are ordered by meta value
			if ( is_array( $query->query_vars['orderby'] ) ) {
				foreach ( $query->query_vars['orderby'] as $orderby => $order ) {
					if ( 'meta_value' == $orderby || 'meta_value_num' == $orderby ) {
						$is_folder_sorted_query = true;
					}
				}
			} else {
				if ( false !== strpos( $query->query_vars['orderby'], 'meta_value' ) ) {
					$is_folder_sorted_query = true;
				}
			}
		}
		return $is_folder_sorted_query;
		*/
	}

	public function pre_get_posts( $query ) {

		$this->apply_folder_order( $query );

	}

	/**
	 * Alters queries that are ordered by wicked_folder_order to order by the
	 * folder order meta key.
	 *
	 * @param WP_Query $query
	 *  The query to alter.
	 */
	private function apply_folder_order( WP_Query $query ) {

		// Skip queries that aren't being sorted by folder order
		if ( ! $this->is_folder_order_query( $query ) ) return;

		$meta_key 	= false;
		$folder_id 	= false;
		$taxonomy 	= false;
		$orderby 	= $query->get( 'orderby' );
		$tax_queries= $query->get( 'tax_query' );

		// Convert orderby to array format
		if ( ! is_array( $orderby ) ) {
			$fields 	= explode( ' ', $orderby );
			$orderby 	= array();
			foreach ( $fields as $field ) {
				$orderby[ $field ] = $query->get( 'order' );
			}
		}

		// Determine the meta key to sort by from the folder tax query
		if ( is_array( $tax_queries ) ) {
			foreach ( $tax_queries as $tax_query ) {
				if ( preg_match( '/^wf_(.*)_folders$/', $tax_query['taxonomy'] ) ) {
					$taxonomy = $tax_query['taxonomy'];
					// Only queries for a specific (i.e. one) folder can be ordered
					// by folder order
					if ( is_array( $tax_query['terms'] ) && 1 == count( $tax_query['terms'] ) ) {
						$folder_id = reset( $tax_query['terms'] );
					} elseif ( is_numeric( $tax_query['terms'] ) ) {
						$folder_id = ( int ) $tax_query['terms'];
					}
					if ( false !== $folder_id ) {
						$meta_key = '_wicked_folder_order__' . $taxonomy . '__' . $folder_id;
					}
				}
			}
		}

		if ( $meta_key ) {
			$this->initalize_folder_order( $folder_id, $taxonomy );
			// Create a new order by clause
			$a = array( 'meta_value_num' => $orderby[ 'wicked_folder_order'] );
			// Add the new order by clause
			Wicked_Common::array_insert_after_key( $orderby, 'wicked_folder_order', $a );
			// Remove folder order clause
			unset( $orderby[ 'wicked_folder_order'] );
			// If a secondary orderby isn't specified, order by title
			$orderby['title'] = 'ASC';
			// Update the query
			$query->set( 'orderby', $orderby );
			$query->set( 'meta_key', $meta_key );
		}

	}

	/**
	 * Inserts a folder order meta key for each post in the folder that doesn't
	 * already have a folder order meta key.
	 */
	public static function initalize_folder_order( $folder_id, $taxonomy ) {
		global $wpdb;

		$meta_key = '_wicked_folder_order__' . $taxonomy . '__' . $folder_id;

		$wpdb->query( "
			INSERT INTO
				{$wpdb->prefix}postmeta (post_id, meta_key, meta_value)
			SELECT
				p.ID, '{$meta_key}', 0
			FROM
				{$wpdb->prefix}posts p
			INNER JOIN
				{$wpdb->prefix}term_relationships tr ON p.ID = tr.object_id
			WHERE
				tr.term_taxonomy_id = {$folder_id} AND p.ID NOT IN (SELECT post_Id FROM {$wpdb->prefix}postmeta WHERE meta_key = '{$meta_key}')
		" );

	}

	/**
	 * Returns a folder taxonomy name for a post type ensuring that the name is
	 * 32 characters or less.
	 *
	 * @param string $post_name
	 *  The machine name of the post type.
	 */
	public static function get_tax_name( $post_name ) {
		// Post names are only allowed to be 20 characters so it shouldn't be
		// necessary to trim the name but do it just in case to ensure the
		// taxonomy name never exceeds 32 characters
		return 'wf_' . substr( $post_name, 0, 20 ) . '_folders';
	}

	/**
	 * Parses the name of the post type from a folder taxonomy.
	 *
	 * @param string $taxonomy
	 *  The taxonomy name.
	 * @return string|bool
	 *  The name of the post type that the folder taxonomy is for or, false if
	 *  the taxonomy is not a folder taxonomy.
	 */
	public static function get_post_name_from_tax_name( $taxonomy ) {
		if ( 0 === strpos( $taxonomy, 'wf_' ) && '_folders' == substr( $taxonomy, -8 ) ) {
			return substr( $taxonomy, 3, -8 );
		}

		return false;
	}

	// Migrates folder taxonomy names to the new prefix of 'wf_' (instead of
	// 'wicked_').
	private function migrate_folder_taxonomy_names() {
		global $wpdb;

		$result = $wpdb->get_results( "SELECT term_taxonomy_id, taxonomy FROM `{$wpdb->prefix}term_taxonomy` WHERE taxonomy LIKE 'wicked_%_folders'" );

		foreach ( $result as $result ) {
			// Get taxonomy name
			$tax_name = $result->taxonomy;
			// Strip the 'wicked_' prefix
			$tax_name = substr( $tax_name, 7 );
			// Prepend new 'wf_' prefix
			$tax_name = 'wf_' . $tax_name;
			$wpdb->update(
				"{$wpdb->prefix}term_taxonomy",
				array( 'taxonomy' => $tax_name ),
				array( 'term_taxonomy_id' => $result->term_taxonomy_id ),
				array( '%s' ),
				array( '%d' )
			);
		}

		// Update folder order keys
		$wpdb->query( "UPDATE {$wpdb->prefix}postmeta SET meta_key = REPLACE(meta_key, '_wicked_folder_order__wicked_', '_wicked_folder_order__wf_') WHERE meta_key LIKE '_wicked_folder_order__wicked_%'" );

		update_option( 'wicked_folders_tax_name_migration_done', true );

	}

	/**
	 * Migrates folder sort order from wp_terms.term_order to a term meta value
	 * named 'wf_order'.  Prior to version 2.17.5, the folder sort order was
	 * stored in this column; however, it appears that term_order is not part of
	 * the WordPress table schema for wp_terms.  Instead, it appears that the
	 * field was added by the Category Order and Taxonomy Terms Order plugin and
	 * the field was mistakenly thought to be a native WordPress field.
	 */
	public function migrate_folder_order() {
		global $wpdb;

		// Nothing to do if the column doesn't exist
		if ( ! $this->term_order_field_exists() ) return;

		// Fetch all Wicked Folder terms that have an order
		$results = $wpdb->get_results( "SELECT t.term_id, t.term_order FROM {$wpdb->terms} t INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id WHERE tt.taxonomy LIKE 'wf_%_folders' AND t.term_order <> 0" );

		// Store sort orders in term meta
		foreach ( $results as $result ) {
			update_term_meta( $result->term_id, 'wf_order', $result->term_order );
		}
	}

	/**
	 * Determines whether or not the field wp_terms.term_order exists.
	 *
	 * @return boolean
	 *  True if the field exists, false otherwise.
	 */
	public function term_order_field_exists() {
		global $wpdb;

		$result = $wpdb->query( "SHOW COLUMNS FROM {$wpdb->terms} LIKE 'term_order'" );

		return 1 === $result;
	}

	/**
	 * For a given post type (and optionally, a specific folder), returns
	 * whether or not folders should include items from child folders (the
	 * default behavior is to only include items in the currently selected
	 * folder.
	 *
	 * @param string $post_type
	 *  The post type name (e.g. post, page, attachment, etc.)
	 * @param integer $folder_id
	 *  The folder ID (i.e. term ID).
	 * @return boolean
	 *  True if children should be included, false otherwise.
	 */
	public static function include_children( $post_type, $folder_id = false ) {
		$option_name = 'attachment' == $post_type ? 'wicked_folders_include_attachment_children' : 'wicked_folders_include_children';

		// This option can be changed on the Settings page
		$include_children = get_option( $option_name, false );

		// Give others a chance to override the setting
		$include_children = ( bool ) apply_filters( 'wicked_folders_include_children', $include_children, $post_type, $folder_id );

		return $include_children;
	}

	/**
	 * Returns the name used for the user stub post type set up for the purpose
	 * of assigning users to folders.
	 */
	public static function get_user_post_type_name() {
		return apply_filters( 'wicked_folders_user_post_type_name', 'wf_user' );
	}

	/**
	 * Returns the name used for the plugin stub post type set up for the purpose
	 * of assigning plugins to folders.
	 */
	public static function get_plugin_post_type_name() {
		return apply_filters( 'wicked_folders_plugin_post_type_name', 'wf_plugin' );
	}

	public static function get_gravity_forms_form_post_type_name() {
		return apply_filters( 'wicked_folders_gravity_forms_form_post_type_name', 'wf_gf_form' );
	}

	public static function get_gravity_forms_entry_post_type_name() {
		return apply_filters( 'wicked_folders_gravity_forms_entry_post_type_name', 'wf_gf_entry' );
	}

	public static function is_horizontal_scrolling_enabled() {
		return ( bool ) apply_filters( 'wicked_folders_enable_horizontal_scrolling', false );
	}

	/**
	 * Gets the current language being viewed.
	 *
	 * @return string|bool
	 *  The two letter language code of the current language or false if unknown
	 *  or all languages are being viewed.
	 */
	public static function get_language() {
		if ( function_exists( 'pll_current_language' ) ) {
			$lang = pll_current_language();
		}

		if ( empty( $lang ) ) $lang = false;

		return apply_filters( 'wicked_folders_get_language', $lang );
	}

	public static function is_folder_taxonomy_translated( $taxonomy ) {
		$translated = false;

		if ( function_exists( 'pll_is_translated_taxonomy' ) ) {
			$translated = pll_is_translated_taxonomy( $taxonomy );
		}

		return apply_filters( 'wicked_folders_is_folder_taxonomy_translated', $translated, $taxonomy );
	}
}
