<?php
/*
Plugin Name: BNS Add Widget
Plugin URI: http://buynowshop.com/plugins/bns-add-widget
Description: Add a widget area to the footer of any theme.
Version: 0.6.2
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
Text Domain: bns-aw
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
 * @version     0.6.2
 * @author      Edward Caissie <edward.caissie@gmail.com>
 * @copyright   Copyright (c) 2010-2013, Edward Caissie
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
 * @version 0.6
 * @date    November 26, 2012
 * Removed load_plugin_textdomain as redundant
 *
 * @version 0.6.1
 * @date    February 12, 2013
 * Documentation and comments
 *
 * @version 0.6.2
 * @date    May 6, 2013
 * Version number compatibility updates
 */

class BNS_Add_Widget {
    /**
     * Constructor
     * This is where the go-go juice is squeezed out of the code
     */
    function __construct() {
        /**
         * Check installed WordPress version for compatibility
         *
         * @package BNS_Add_Widget
         * @since   0.1
         *
         * @uses    (global) $wp_version
         *
         * @version 0.4
         * @date    November 14, 2011.
         * @internal Version 2.7 being used in reference to the textdomain
         */
        global $wp_version;
        $exit_message = 'BNS Add Widget requires WordPress version 2.7 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please Update!</a>';
        if ( version_compare( $wp_version, "2.7", "<" ) ) {
            exit ( $exit_message );
        } /** End if - version compare */

        /** Enqueue Scripts and Styles */
        add_action( 'wp_enqueue_scripts', array( $this, 'BNSAW_Scripts_and_Styles' ) );

        /** Add Widget Definition */
        add_action( 'init', array( $this, 'BNS_Add_Widget_Definition' ) );

        /** Hook into footer */
        add_action('wp_footer', array( $this, 'BNS_Add_Widget_Hook') );

    }
    /** End: Constructor ---------------------------------------------------- */

    /**
     * Enqueue Plugin Scripts and Styles
     * Adds plugin stylesheet and allows for custom stylesheet to be added by
     * end-user.
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
        } /** End if - is readable */
    } /** End function - scripts and styles */


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
     * @date    November 14, 2011
     */
    function BNS_Add_Widget_Definition() {
        register_sidebar( array(
            'name'           => __( 'BNS Add Widget', 'bns-aw' ),
            'id'             => 'bns-add-widget',
            'description'    => __( 'This widget area will generally be found at the bottom of the page in the theme footer area.', 'bns-aw'),
            'before_widget'  => '<div class="bns-add-widget"><div id="%1$s" class="widget %2$s">',
            'after_widget'   => '</div><!-- #%1$s .widget .%2$s --></div><!-- .bns-add-widget -->',
            'before_title'   => '<h2 class="bns-add-widget-title">',
            'after_title'    => '</h2>',
        ) );
    } /** End function - add widget definition */


    /**
     * BNS Add Widget Hook
     * Provides default content for the `add_action` hook into `wp_footer`.
     *
     * @package BNS_Add_Widget
     * @since   0.1
     *
     * @uses    apply_filters
     * @uses    dynamic_sidebar
     * @internal REQUIRES `wp_footer` action hook to be available
     *
     * @version 0.6
     * @date    November 26, 2012
     * Added filter hook and CSS wrapper to text
     *
     * @version 0.6.1
     * @date    February 13, 2013
     * Fixed misread token issue
     */
    function BNS_Add_Widget_Hook() { ?>
        <div class="bnsaw-credit">
            <?php
            if ( ! dynamic_sidebar( 'bns-add-widget' ) ) {
                echo apply_filters( 'bnsaw_credit_text', sprintf( '<span class="bnsaw-credit-text">%1$s</span>', sprintf( __( 'You are using the %1$s plugin. Thank You!', 'bns-aw' ), '<a href="http://buynowshop.com/plugins/bns-add-widget/">BNS Add Widget</a>' ) ) );
            } /** End if - not dynamic widget */ ?>
        </div>
    <?php } /** End function - add widget hook */

} /** End class */


/** @var $bns_add_widget - new instance of the class */
$bns_add_widget = new BNS_Add_Widget();