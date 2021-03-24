<?php
/*

Plugin Name: Wicked Folders
Plugin URI: https://wickedplugins.com/wicked-folders/
Description: Organize your pages into folders.
Version: 2.17.9
Author: Wicked Plugins
Author URI: https://wickedplugins.com/
Text Domain: wicked-folders
License: GPLv2 or later

Copyright 2017 Driven Development, LLC dba Wicked Plugins
(email : hello@wickedplugins.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( class_exists( 'Wicked_Folders' ) ) return;

require_once( dirname( __FILE__ ) . '/lib/class-wicked-folders.php' );

register_activation_hook( __FILE__, array( 'Wicked_Folders', 'activate' ) );

Wicked_Folders::get_instance();
