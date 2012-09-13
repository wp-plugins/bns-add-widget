<?php
/*
Plugin Name: BNS Add Widget
Plugin URI: http://buynowshop.com/plugins/bns-add-widget
Description: Add a widget area to the footer of any theme.
Version: 0.4.3
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
Textdomain: bns-aw
License: GNU General Public License v2
License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/**
 * BNS Add Widget plugin
 *
 * Add a widget area to the footer of any theme. Works just like the widget
 * areas commonly created with code in the functions.php template file.
 *
 * @package     BNS_Add_Widget
 * @link        http://buynowshop.com/plugins/bns-add-widget/
 * @link        https://github.com/Cais/bns-add-widget/
 * @link        http://wordpress.org/extend/plugins/bns-add-widget/
 * @version     0.4.2
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2010-2012, Edward Caissie
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.
 *
 * You may NOT assume that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to:
 *
 *      Free Software Foundation, Inc.
 *      51 Franklin St, Fifth Floor
 *      Boston, MA  02110-1301  USA
 *
 * The license for this software can also likely be found here:
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @date    August 2, 2012
 * Documentation updates
 * Added License references in 'readme'
 * Updated long description
 */

/**
 * Check installed WordPress version for compatibility
 *
 * @package     BNS_Add_Widget
 * @since       0.1
 *
 * @uses        (global) $wp_version
 *
 * @version     0.4
 * @internal    Version 2.7 being used in reference to the `load_plugin_textdomain`
 *
 * Last revised November 14, 2011.
 */
global $wp_version;
$exit_message = 'BNS Add Widget requires WordPress version 2.7 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please Update!</a>';
if ( version_compare( $wp_version, "2.7", "<" ) ) {
    exit ( $exit_message );
}

/**
 * BNS Add Widget TextDomain
 * Make plugin text available for translation (i18n)
 *
 * @package:    BNS_Add_Widget
 * @since:      0.4
 *
 * Note: Translation files are expected to be found in the plugin root folder / directory.
 * `bns-aw` is being used in place of `bns-add-widget`
 */
load_plugin_textdomain( 'bns-aw' );
// End: BNS Add Widget TextDomain

/**
 * Enqueue Plugin Scripts and Styles
 * Adds plugin stylesheet and allows for custom stylesheet to be added by end-user.
 *
 * @package BNS_Add_Widget
 * @since   0.4
 *
 * @uses    get_plugin_data
 * @uses    plugin_dir_path
 * @uses    plugin_dir_url
 * @uses    wp_enqueue_style
 *
 * @version 0.4.3
 * @date    September 12, 2012
 * Set versions to dynamically match the plugin version
 */
function BNSAW_Scripts_and_Styles() {
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    $bns_aw_data = get_plugin_data( __FILE__ );
    /** Enqueue Scripts */
    /** Enqueue Style Sheets */
    wp_enqueue_style( 'BNSAW-Style', plugin_dir_url( __FILE__ ) . 'bnsaw-style.css', array(), $bns_aw_data['Version'], 'screen' );
    if ( is_readable( plugin_dir_path( __FILE__ ) . 'bnsaw-custom-style.css' ) ) { /** Only enqueue if available */
        wp_enqueue_style( 'BNSAW-Custom-Style', plugin_dir_url( __FILE__ ) . 'bnsaw-custom-style.css', array(), $bns_aw_data['Version'], 'screen' );
    }
}
add_action( 'wp_enqueue_scripts', 'BNSAW_Scripts_and_Styles' );

/**
 * BNS Add Widget
 * The main section of code that sets the sidebar parameters to be used.
 *
 * @package BNS_Add_Widget
 * @since   0.1
 *
 * @uses    register_sidebar
 *
 * @version 0.4
 *
 * Last revised November 14, 2011
 */
function BNS_Add_Widget() {
    register_sidebar( array(
        'name'           => __( 'BNS Add Widget', 'bns-aw' ),
        'id'             => 'bns-add-widget',
        'description'    => __( 'This widget area will generally be found at the bottom of the page in the theme footer area.', 'bns-aw'),
        'before_widget'  => '<div class="bns-add-widget"><div id="%1$s" class="widget %2$s">',
        'after_widget'   => '</div><!-- #%1$s .widget .%2$s --></div><!-- .bns-add-widget -->',
        'before_title'   => '<h2 class="bns-add-widget-title">',
        'after_title'    => '</h2>',
    ) );
}
add_action( 'init', 'BNS_Add_Widget' );

/**
 * BNS Add Widget Hook
 * Provides default content for the `add_action` hook into `wp_footer`.
 *
 * @package BNS_Add_Widget
 * @since   0.1
 *
 * @uses    dynamic_sidebar
 * @internal REQUIRES `wp_footer` action hook to be available
 *
 * @version 0.4
 *
 * Last revised November 14, 2011
 */
function BNS_Add_Widget_Hook() { ?>
        <div class="bnsaw-credit">
            <?php if ( dynamic_sidebar( 'bns-add-widget' ) ) : else :
                printf( __( 'You are using the %1$s plugin. Thank You!', 'bns-aw' ), '<a href="http://buynowshop.com/plugins/bns-add-widget/">BNS Add Widget</a>' );
            endif; ?>
        </div>
<?php }
add_action('wp_footer', 'BNS_Add_Widget_Hook');