=== Wicked Folders ===
Contributors: wickedplugins
Tags: folders, administration, tree view, content management, page organization, custom post type organization, media library folders, media library categories, media library organization
Requires at least: 4.6
Tested up to: 5.7
Stable tag: 2.17.9
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Organize pages and custom post types into folders.

== Description ==

Wicked Folders is the ultimate tool for managing large numbers of pages and custom post types.  The plugin simplifies content management by allowing you to organize your content into folders.  Wicked Folders is an administration plugin that does not alter your content’s permalinks or hierarchy giving you the complete freedom to organize your pages and/or custom post types any way you want independently of your site’s structure.

= Features =
* Organize pages, posts, and custom post types into folders
* Control which post types can be organized using folders
* Create an unlimited number of folders and nest them any way you like
* Tree view of folders
* Drag and drop folders to easily reorganize them
* Drag and drop items to quickly move them into folders
* Bulk move items to folders
* Assign items to multiple folders
* Toggle folder pane on or off
* Clone folders
* Resizable folder pane
* Dynamic folders (read more below)
* Search folders
* Display number of items assigned to each folder
* Support for right-to-left languages

= Dynamic Folders =
Dynamic folders let you to filter pages (and custom post types) by things like date or author.  You can even browse pages or custom post types by other categories that are assigned to the post type.  The handy "Unassigned Items" dynamic folder shows you items that haven't been assigned to a folder yet and the "Page Hierarchy" folder lets you browse your pages as if each parent page were a folder.  Dynamic folders are generated on the fly which means you don’t have to do anything; simply install the plugin and enable dynamic folders for the post types you want on the Wicked Folders settings page.  See the screenshots section for an example.

= How the Plugin Works =
Wicked Folders works by leveraging WordPress’s built-in taxonomy API.  When you enable folders for pages or a custom post type, the plugin creates a new taxonomy for that post type called ‘Folders’.  Folders are essentially another type of category and work like blog post categories; the difference is that Wicked Folders allows you to easily browse your content by folder.

This plugin does not alter your page or custom post types’ permalinks, hierarchy, sort order, or anything else; it simply allows you to organize your pages and custom post types into virtual folders so that you can find them more easily.

= Wicked Folders Pro =
Organize your WordPress media library, users, plugins, and more using folders with [Wicked Folders Pro](https://wickedplugins.com/plugins/wicked-folders/?utm_source=readme&utm_campaign=wicked_folders&utm_content=pro_link).  Wicked Folders Pro lets you use folders to organize:

* Media
* Users
* Plugins
* Gravity Forms entries and forms
* WooCommerce products, orders, and coupons

[Learn more about Wicked Folders Pro](https://wickedplugins.com/plugins/wicked-folders/?utm_source=readme&utm_campaign=wicked_folders&utm_content=pro_learn_more_link).

= Support =
Please see the [FAQ section]( https://wordpress.org/plugins/wicked-folders/#faq) for common questions, [check out the documentation](https://wickedplugins.com/support/wicked-folders/?utm_source=readme&utm_campaign=wicked_plugins&utm_content=documentation_link) or, [visit the support forum]( https://wordpress.org/support/plugin/wicked-folders) if you have a question or need help.

= About Wicked Plugins =
Wicked Plugins specializes in crafting high-quality, reliable plugins that extend WordPress in powerful ways while being simple and intuitive to use.  We’re full-time developers who know WordPress inside and out and our customer happiness engineers offer friendly support for all our products. [Visit our website](https://wickedplugins.com/??utm_source=readme&utm_campaign=wicked_plugins&utm_content=about_link) to learn more about us.

== Installation ==

1. Upload 'wicked-folders' to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen by searching for 'Wicked Folders'.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Visit Settings > Wicked Folders and enable folders for the desired post types (folder management for pages is enabled by default)

To start organizing your content into folders, go to the Pages screen in your WordPress admin.  Click the "plus" icon in the Folders panel to add your first folder.  To move a page to a folder, hover your mouse over the row of the page you want to move, then click and drag the "move" icon in the first column and drag the page to a folder.  To move multiple pages, check the boxes next to the pages you want to move first.

== Frequently Asked Questions ==

= I installed the plugin, now what? =
The plugin will automatically enable folder management for pages upon activation.  To start organizing your pages into folders, go to the Pages screen in your WordPress admin.  From there, click the "plus" icon in the Folders panel to add your first folder.  Visit the plugin’s settings page at Settings > Wicked Folders to enable folders for custom post types.

= Does this plugin change my page’s or custom post types’ permalinks? =
No, the plugin doesn’t modify pages or custom post types beyond controlling what folders they belong to.

= What happens when I delete a folder? =
Folders work like categories.  When you delete a folder, any pages that were in the folder are simply unassigned from that folder.  The pages are not deleted or modified in any way.

= If I delete a folder will the pages in the folder be deleted? =
No, only the folder is deleted.

= How do I put a page in a folder? =
There are two ways.  The first is to visit the Pages screen, move your mouse over the "move" icon that shows up in the pages list when hovering over a row and drag and drop the page to the desired folder.  Alternatively, you can edit the page and assign folders in the ‘Folders’ meta box in the right sidebar.

= How do I put a page in multiple folders? =
Edit the page and select the desired folders in the ‘Folders’ meta box in the right sidebar.

= How do I remove a page from a folder? =
Edit the page and uncheck the box next to the folder you want to remove it from in the ‘Folders’ meta box in the right sidebar.

= Can the folder pane be hidden? =
Yes, to hide the folder pane, click the 'Toggle folders' link (near the bottom of the admin menu on the left side of the screen). To unhide the folder pane, click the 'Toggle folders' link again.

= Can the folder pane be resized? =
Yes, hover your mouse over the vertical grey hairline divider line between the folders and posts and then click and drag to resize.

= Can I organize my media library using folders? =
Media library folders is a premium feature available in Wicked Folders Pro.  [Learn more](https://wickedplugins.com/plugins/wicked-folders/?utm_source=readme&utm_campaign=wicked_folders&utm_content=media_faq_link).

= Can I organize Gravity Forms entries and forms into folders? =
Yes, the pro version of the plugin, Wicked Folders Pro, adds folders for Gravity Forms entries and forms.  [Learn more](https://wickedplugins.com/plugins/wicked-folders/?utm_source=readme&utm_campaign=wicked_folders&utm_content=gravityforms_faq_link).

= Can I organize WooCommerce products, orders, and coupons into folders? =
Yes, the pro version of the plugin, Wicked Folders Pro, adds folders for WooCommerce products, orders and coupons.  [Learn more](https://wickedplugins.com/plugins/wicked-folders/?utm_source=readme&utm_campaign=wicked_folders&utm_content=woocommerce_faq_link).

= How does the "Page Hierarchy" folder work?
The "Page Hierarchy" folder (found under "Dynamic Folders") is a dynamic folder (meaning it's generated on the fly) that lets your browse the hierarchy of your site as if each parent page was a folder. For example, imagine you have two pages ("Child A" and "Child B") that are assigned to a parent page (called "Parent Page"). In that case, expanding the "Page Hierarchy" folder would show a folder labeled "Parent Page" and, clicking on it, would filter the list of pages to show you the pages assigned to that parent (in this case "Child A" and "Child B").

= I toggled the folder pane off and now I see none (or only some) of my pages.  What happened? =
It's possible your pages are still filtered by a specific folder.  Toggle the folder pane back on, navigate to 'All Folders', and then toggle the folder pane off again.

= If I deactivate the plugin, will my folders still be there if I reactivate the plugin later? =
Yes.  The plugin does not delete the folder data when it is deactivated or uninstalled.

= Can I organize my folders in a specific sort order? =
Yes.  To sort folders in a specific order, click the 'Settings' button (i.e. the button with the cog/gear icon) in the folder pane toolbar and set the 'Organization Mode' to 'Sort'.  When in 'Sort' mode, you can move folders up and down to sort them the way you want.  When finished, change the 'Organization Mode' back to 'Normal' to be able to organize your folders by dragging and dropping into other folders.

= Why are some of my folders grayed out? =
When you search folders by keyword, folders that don't match the keyword are greyed out so that folders that do match the search term stand out.  Delete the text in the folder search field to return the folders to their normal non-greyed-out state.

== Screenshots ==

1. Page folders
2. Easily drag and drop folders to rearrange
3. Drag and drop pages to quickly move pages into folders
4. Bulk move pages to folders
5. Dynamic folders let you quickly filter content by properties like date or author
6. Pro feature: media library folders

== Changelog ==

= 2.17.9 (March 22, 2021) =
* Fix PHP error that can occur due to an invalid timezone identifier string
* Fix media library folder pane resizer handle not visible (Wicked Folders Pro)
* Fix media modal folder pane position when admin menu is folded and media modal is displayed on front end (Wicked Folders Pro)

= 2.17.8 (March 13, 2021) =
* Add work-around for issue caused by Polylang plugin mangling AJAX requests

= 2.17.7 (February 2, 2021) =
* Add folder support for classes and layout blocks post types added by Ed School theme
* Add folder support for testimonial and testimonial rotator post types added by Testimonial Rotator plugin

= 2.17.6 (November 19, 2020) =
* Fix 'Move to Folder' column not appearing for Pretty Links
* Fix bug preventing Elementor Global Widgets from being moved to folders

= 2.17.5 (October 14, 2020) =
* Fix bug causing custom folder sort order to not be preserved

= 2.17.4 (September 17, 2020) =
* Exclude auto draft posts from folder item counts
* Fix bug causing folder item counts to be wrong in certain scenarios (this was due to grouping by term_taxonomy_id field instead of term_id field)

= 2.17.3 (August 19, 2020) =
* Only run count queries if 'Show number of items in each folder' setting is enabled

= 2.17.2 (June 3, 2020) =
* Include 'Toggle Folders' menu item on Admin Menu Editor settings screen so that it's position can be controlled

= 2.17.1 (May 1, 2020) =
* Fix bugs introduced in previous version that were preventing some settings such as "Don't reload page when navigating folders" to not take effect

= 2.17.0 (April 18, 2020) =
* Add option to display folder item counts
* Add ability to search folders by name
* Add ability to sort folders arbitrarily
* 'Expand All' and 'Collapse All' buttons have been consolidated into a single button in the folder pane toolbar.  Clicking the button the first time expands all folders.  Clicking the button a second time collapses all folders.
* Folder pane behavior has been changed to no longer scroll horizontally.  Horizontal scrolling can be re-enabled if desired by using the `wicked_folders_enable_horizontal_scrolling` filter and returning true
* Legacy folder pages option has been removed

= 2.16.6 (April 5, 2020) =
* Make additional fix to post type check when on Users, Plugins, Gravity Forms Forms, or Gravity Forms Entries screens

= 2.16.5 (April 5, 2020) =
* Fix post type check when on Users, Plugins, Gravity Forms Forms, or Gravity Forms Entries screens

= 2.16.4 (March 31, 2020) =
* Update 'Tested up to' flag to 5.4

= 2.16.3 =
* Fix folder pane blank when switching between languages when using Polylang plugin
* Fix WPML language filter links disappearing when changing folders
* Add support for different folder pane state based on current language
* Add folder support for LifterLMS lessons

= 2.16.2 =
* Check for 'is_plugin_active' function before using to prevent possible errors when loading on front-end

= 2.16.1 =
* Fix PHP error that can occur on legacy folder pages
* Fix blank folder pane issue that can occur when Dynamic Folders have been turned off for a post type and the last-viewed folder for the post type was a page hierarchy dynamic folder
* Fix potential issue introduced in 2.16 that can cause the wrong folders to be displayed for a post type

= 2.16.0 =
* Change post types to be sorted alphabetically on Settings page
* Add support for folders on Blocks screen (i.e. reusable blocks)
* Make various changes to support folders for Users, Plugins, and Gravity Forms in Wicked Folders Pro

= 2.15.1 =
* Fix typo that was causing PHP warnings in some environments

= 2.15.0 =
* Navigating between folders no longer reloads the page (this behavior can be changed by updating the 'Don't reload page when navigating folders' option on the Settings page)
* Add folder breadcrumbs to top of posts lists; add setting to enable/disable breadcrumbs
* Darken border colors to match colors in WordPress 5.3
* Change folder toolbar buttons to use standard link color

= 2.14.0 =
* Add ability to unassign items from all folders by dragging to the 'Unassigned Items' folder
* Add setting to enable or disable 'Unassigned Items' folder
* Move 'Unassigned Items' folder to root level (folder can be moved back under 'Dynamic Folders' if desired by using 'wicked_folders_unassigned_items_parent' filter and returning 'dynamic_root')
* Fix PHP warnings in AJAX responses after moving items
* Add ability to activate/deactivate license key (Wicked Folders Pro)
* No longer display active license key on Settings page (Wicked Folders Pro)

= 2.13.4 =
* Replace hard-coded references to admin-ajax.php with variable

= 2.13.3 =
* Fix issue with post hierarchy dynamic folder always displaying pages (instead of post type currently being viewed)

= 2.13.2 =
* Fix folder pane displaying on sub pages of post types
* Fix issue with 'Folders' section in media modal attachment details sometimes overlapping previous field

= 2.13.1 =
* Fix 'Toggle folders' link not showing up when folders are enabled for Posts

= 2.13.0 =
* Add option to display folder hierarchy in folder column of post lists
* Add ability to clone child folders
* Change 'My Templates' to 'Elementor Templates' on Wicked Folders settings page
* Fix issue with folder names wrapping in folder category meta boxes
* Fix issue with folder category meta boxes not displaying folder hierarchy
* Fix bug regarding post lists sometimes not filtering properly when filtered by folder taxonomy
* Prevent folder pane from loading on media child pages (Wicked Folders Pro)

= 2.12.1 =
* Replace references to WordPress 'isRtl' JavaScript variable with custom function
* Prevent WooCommerce orders from opening when clicking on 'Move' icon (Wicked Folders Pro)

= 2.12.0 =
* Move folder pane toggle from admin bar to admin menu
* Add a success message after cloning a folder
* Fix issue regarding folder column sometimes not appearing for certain post types
* Fix some minor responsive display issues
* Fix some minor right-to-left display issues
* Fix inconsistent indentation of folders in parent folder dropdown

= 2.11.6 =
* Revert 'Tested up to' flag back to 5.1 (plugin is compatible with WordPress 5.2 but for some reason WordPress plugin directory began displaying a message saying the plugin hadn't been tested with the last three major versions)

= 2.11.5 =
* Change access of register_taxonomies function to public
* Fix left margin next to 'move' icon in 'move items' column
* Update 'Tested up to' flag to 5.2

= 2.11.4 =
* Add right-to-left support

= 2.11.3 =
* Check if 'hideAssignedItems' property exists when saving state
* Update 'Tested up to' flag to 5.1

= 2.11.2 =
* Revert to 'All Folders' when a previously selected dynamic folder no longer exists
* Correct Post Hierarchy dynamic folder to only display root level pages
* Correct Post Hierarchy folder to respect 'Include items from child folders' setting

= 2.11.1 =
* Fix missing order IDs when dragging WooCommerce orders to folders (Wicked Folders Pro)
* Fix move column width for WooCommerce orders (Wicked Folders Pro)
* Minor correction to readme

= 2.11.0 =
* Add new setting to include items from child folders
* Add folder support for Easy Digital Downloads (Wicked Folders Pro)

= 2.10.2 =
* Fix issue regarding 'Move' column not being returned after using 'Quick Edit' causing table layout to break
* Fix bug regarding posts no longer being draggable after using quick edit
* Extend work-around implemented previously for Polylang plugin for Polylang Pro version

= 2.10.1 =
* Add missing file for post hierarchy dynamic folder class

= 2.10.0 =
* Fix undefined index error when saving settings with no post types selected
* Fix issue regarding 'Move' column always displaying in post lists even when folders are not enabled for the post type
* Add work-around for issue caused by 'Anything Order by Terms' plugin manipulating AJAX requests
* Add new post hierarchy dynamic folder
* Tested for compatibility with WordPress 5.0

= 2.9.4 =
* Fix category dynamic folders to work for taxonomies that are assigned to multiple post types
* Add ability to filter taxonomies for category dynamic folders

= 2.9.3 =
* Enable REST API for folder taxonomies in order to support Gutenberg
* Fix bug regarding user dynamic folder querying non-existent user tables on multisite

= 2.9.2 =
* Add work-around for issue caused by Polylang plugin manipulating AJAX requests on media pages

= 2.9.1 =
* Change prefix for folder taxonomies from 'wicked_' to 'wf_' to ensure folder taxonomy name never exceeds 32 characters
* Fix folder pane to correctly reflect the selected folder when filtering by a folder using the folders column in the posts list table

= 2.9.0 =
* Update folder pane to be responsive
* Add filter to allow folder pane width to be overridden

= 2.8.4 =
* Add folder name to cache key to prevent folder cache from becoming stale after a folder is renamed

= 2.8.3 =
* Fix bug regarding folders not displaying for users who don't already have a folder screen state setting saved

= 2.8.2 =
* Minor adjustment to accommodate custom post types created with Pods plugin

= 2.8.1 =
* Fix bug regarding folder cache not clearing after moving a folder

= 2.8.0 =
* Add multisite support
* Fix bug regarding legacy folder page option incorrectly being enabled for new installs
* Fix bug regarding folder page menu item showing up under Media when legacy folder page option is disabled (Wicked Folders Pro)
* Fix bug causing author dynamic folders to not appear in some instances (Wicked Folders Pro)
* Persist selected folder across all media modal instances on a page (Wicked Folders Pro)
* Add support for folders to media list view (Wicked Folders Pro)
* Add support for plugin icons (Wicked Folders Pro)

= 2.7.3 =
* Implement additional work-arounds to prevent fatal errors caused by themes or plugins that call wp_enqueue_media too early

= 2.7.2 =
* Implement work-around to prevent fatal errors caused by themes or plugins that call wp_enqueue_media too early

= 2.7.1 =
* Add category dynamic folders
* Fix bug regarding date dynamic folders not working for post types that use a custom status
* Add support for ACF (Advanced Custom Fields) field group post types (Wicked Folders Pro)

= 2.7 =
* Integrate folder pane into post list pages
* Extend support to all custom post types that have UI enabled (previously, folders were only available for custom post types that had a top-level menu item in the admin navigation)
* Add option to disabled 'Folders' page
* Add support for WooCommerce product, order and coupon folders (Wicked Folders Pro)

= 2.6.1 =
* Fix admin_body_class filter incorrectly overriding body class and not properly returning body classes

= 2.6.0 =
* New feature! Add ability to order items within a folder
* Fix bug regarding search results not starting on page one when performing a search from subsequent pages

= 2.5.1 =
* Remove extraneous comma accidentally left in Javascript code

= 2.5.0 =
* New feature! Add ability to clone folders
* Add option for syncing upload folder dropdown (Wicked Folders Pro)

= 2.4.4 =
* Improve scroll behavior of folder pane
* Fix folder tree overflowing folder pane bug

= 2.4.3 =
* Fix bug regarding 'quick edit' link showing on folder pages for posts and custom post types
* Update readme file

= 2.4.2 =
* Add various fixes to folder select view to preserve selected state after changes to selection or underlying collection
* Minor CSS change to prevent edges from getting cut off when dragging items to last folder in media grid view  (Wicked Folders Pro)

= 2.4.1 =
* Add callouts for pro version to settings page
* Minor CSS change for pro version

= 2.4.0 =
* Changes to core plugin code to support new features in pro version

= 2.3.6 =
* Load core app Javascript when wp_enqueue_media is called to prevent errors in pro version with front-end editors
* Bug fix for utility function that checks if tax query is an array before manipulating

= 2.3.5 =
* Fix bug regarding folder browser not working for posts

= 2.3.4 =
* Prevent folder pane from being wider than folder browser
* Modify tree view UI to support checkboxes
* Minor bug fixes

= 2.3.3 =
* Minor bug fixes and changes for pro version

= 2.3.2 =
* Fix issue with version numbers

= 2.3.1 =
* Fix indentation level of top-level folders in new folder popup

= 2.3.0 =
* Add dynamic folders feature
* Add settings link to plugin links

= 2.2.2 =
* Update 'tested up to' tag for WordPress 4.8

= 2.2.1 =
* Hide folder tree in media modal when clicking edit link from Advanced Custom Fields image field

= 2.2.0 =
* Add support for posts
* Fix bug regarding folder screen state being overwritten by other folder pages
* Fix minor bug caused by checking for post type in request when saving settings

= 2.1.1 =
* All checked items are now moved when dragging a checked item
* Add "Folders" menu to admin toolbar so that folder actions such as add, edit, etc. can be accessed without having to scroll back up to top of screen

= 2.1.0 =
* Add feature allowing items that have been assigned to a folder to be hidden when viewing the root folder
* Add ability to search items on folder pages

= 2.0.7 =
* Fix version number on WordPress.org

= 2.0.6 =
* Prevent default action when closing folder dialog
* Fix get_terms call for WordPress 4.5 and earlier

= 2.0.5 =
* Change root folder to not be movable
* Replace pseudo element folder icons with span to fix bug regarding move cursor not displaying in IE

= 2.0.4 =
* Various bug fixes

= 2.0.3 =
* Fix display issues in Internet Explorer
* Fix FolderBrowser property not defined as function bug

= 2.0.2 =
* Various bug fixes

= 2.0.1 =
* Enable Backbone emulate HTTP option to support older servers

= 2.0.0 =
* Rebuild folders page as Backbone application
* Various bug fixes

= 1.1.0 =
* Add folder tree navigation to media modal (Wicked Folders Pro)

= 1.0.1 =
* Minor bug fixes

= 1.0.0 =
* Initial release
