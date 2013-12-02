=== WP Remove Css - Js ===
Contributors: GiuB
Donate link: https://www.paypal.com/uk/cgi-bin/webscr?cmd=_flow&dispatch=5885d80a13c0db1f8e263663d3faee8def8934b92a630e40b7fef61ab7e9fe63&SESSION=UklyODvnG0uWIQPHSwYGuaQimVP7misqpOCHfT0cgq8DViM1u7Nds0RZ4Ja
Tags: plugin, css, script, remove, javascript, speed
Author URI: http://giub.it
Author: Daniele Covallero
Requires at least: 3.2
Tested up to: 3.6
Stable tag: 4.3
License: GPLv3
License URI: http://opensource.org/licenses/GPL-3.0

Remove useless Css - Js files from some conditionals and theme pages.

== Description ==

In Wordpress sites there are often installed many plugins and modern templates with too many styles and scripts that slow down the loading time of your site.

With Remove WP CSS - Js you can simply exclude .css and .js resources from a few conditional pages and from all template files of your Wordpress theme (follow Warning instructions).

**WARNING:** This plugin detect styles and scripts only if they use the right functions: wp_register_style(), wp_enqueue_style(), wp_register_script(), wp_enqueue_script().

Want to contribute?

* [Github/Wp-Remove-Css-Js](https://github.com/GiuB/WP-Remove-Css-Js)

Want to thanks me on Twitter or follow me on my blog?

* [twitter.com/giub_bass](http://twitter.com/intent/tweet?text=Thanks+%40Giub_bass+to+help+me+speed+up+my+%23Wordpress+with+%23WP-Remove-Css-Js)
* [giub.it](http://giub.it)

= Recommended Settings =
Advance users likes this plugin because it speed up the page loading by remove usless resources but developers reccomended to use together a php cache plugin like [WP Super Cache](http://wordpress.org/plugins/wp-super-cache/).

== Installation ==

1. Upload `wp-remove-css-js` directory to your `/wp-content/plugins/` folder
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to `Settings->WP Remove Css-Js` and switch to Style/Script tabs.
1. Use "Refresh" button to auto detect resources or active "Detect during navigation" to start the detection when you open your site pages


== Frequently Asked Questions ==

= Why I can't see all .js and .css in plugin tabels? =

Because your theme or external plugins includes wrongly them.
You can easly edit wrong codes by follow theese function references:

1. [wp_register_style()](http://codex.wordpress.org/Function_Reference/wp_register_style)
1. [wp_enqueue_style()](http://codex.wordpress.org/Function_Reference/wp_enqueue_style)
1. [wp_register_script()](http://codex.wordpress.org/Function_Reference/wp_register_script)
1. [wp_enqueue_script()](http://codex.wordpress.org/Function_Reference/wp_enqueue_script)

Alternatively you can enable "Detect during navigation" to start the detection when you open your site pages from your browser (Remember to disable it to speed up your Wordpress).

== Screenshots ==

1. Plugin Tabs to switch and managere sources.
2. Option Buttons
3. Example source list

== Changelog ==

= 1.0 =
Initial version
