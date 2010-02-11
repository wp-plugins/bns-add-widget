<?php
/*
Plugin Name: BNS Add Widget
Plugin URI: http://buynowshop.com/plugins/bns-add-widget
Description: Add a widget area to the footer of any theme.
Version: 0.1
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
*/

/*
**
* Plugin Changelog: see readme.txt
*
* The CSS, XHTML and design is released under GPL:
* http://www.opensource.org/licenses/gpl-license.php
* 
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
**
*/

global $wp_version;
$exit_message = 'BNS Add Widget requires WordPress version 2.9 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please Update!</a>';
if (version_compare($wp_version, "2.9", "<")) {
	exit ($exit_message);
}

/* Hook BNS Widget into 'init' */
add_action( 'init', 'add_BNS_Add_Widget_Code' );
function add_BNS_Add_Widget_Code() {
  if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
      'name' => 'BNS Add Widget',
      'id' => 'bns-add-widget',
      'before_widget' => '
        <div class="bns-add-widget">
          <div class="bns-widget-before"></div>
          <div class="bns-widget-content">',
          
      'after_widget' => '
          </div><!-- .bns-widget-content -->
          <div class="bns-widget-after"></div>
        </div><!-- .bns-add-widget -->',
      'before_title' => '<h2 class="bns-widget-title">',
      'after_title' => '</h2>',
      ));
  }
}

/* Hook BNS Widget into wp_footer */
add_action('wp_footer', 'add_BNS_Widget_to_Footer');
function add_BNS_Widget_to_Footer() {
  if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'bns-add-widget' ) ) : else : ?>
    <span align="center">You are using the <a href="http://buynowshop.com/plugins/bns-add-widget/">BNS Add Widget</a> plugin! Thank You!</span>
  <?php endif;
}

?>