=== BNS Add Widget ===
Contributors: cais
Donate link: http://buynowshop.com
Tags: widget, footer, admin
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 0.1.2

Add a widget area to the footer of any theme.

== Description ==

Add a widget area to the footer of any theme. Works just like the widget areas commonly created with code in the functions.php template file.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `bns-add-widget.php` to the `/wp-content/plugins/` directory
2. Activate through the 'Plugins' menu.
3. Read http://wpfirstaid.com/2009/12/plugin-installation/
4. Add your widget choice to the BNS Add Widget area under Appearance | Widgets

-- or -

1. Go to 'Plugins' menu under your Dashboard
2. Click on the 'Add New' link
3. Search for bns-add-widget
4. Install.
5. Activate through the 'Plugins' menu.
6. Read http://wpfirstaid.com/2009/12/plugin-installation/
7. Add your widget choice to the BNS Add Widget area under Appearance | Widgets

== Frequently Asked Questions ==

= How can I style the plugin output? =

The plugin uses the register_sidebar() WordPress function; additional classes are added via the plugin code:

* bns-add-widget
* bns-widget-before
* h2.bns-widget-title
* bns-widget-content
* bns-widget-after

== Screenshots ==

1. The new blank widget area

== Other Notes ==
* Copyright 2010 Edward Caissie

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

== Upgrade Notice ==
* Initial release.

== Changelog ==
= 0.1.2 =
* compatible with WordPress version 2.9.2
* updated license declaration

= 0.1.1 =
* clarified the plugin's release under a GPL license

= 0.1 =
* Initial release.