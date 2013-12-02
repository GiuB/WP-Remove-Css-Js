# WP Remove Css - Js

Download link: [Wordpress.org](http://wordpress.org/plugins/wp-remove-css-js/)

Often in Wordpress sites are installed many plugins and modern templates with too many styles and scripts that slow down the loading speed of your site.

Remove with WP CSS - Js you can simply exclude .css and .js resources from a few conditional pages and from all template files of your Wordpress theme (follow Warning instructions).

**WARNING:** This plugin detect styles and scripts only if they use the right functions: wp_register_style, wp_enqueue_style, wp_register_script, wp_enqueue_script.

## Screenshots

- Plugin Tabs to switch and managere sources.

![Plugin Tabs](http://giub.it/wp-content/uploads/2012/06/screenshot-1.jpg)

- Option Buttons

![Option Buttons](http://giub.it/wp-content/uploads/2012/06/screenshot-2.jpg)

- Example source list

![Source list](http://giub.it/wp-content/uploads/2012/06/screenshot-3.jpg)

## Manual Installation

1. Upload `wp-remove-css-js` directory to your `/wp-content/plugins/` folder or install
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to `Settings->WP Remove Css-Js` and switch to Style/Script tabs.
4. Use "Refresh" button to auto detect resources or active "Detect during navigation" to start the detection when you open your site pages

## Developers

* Daniele [GiuB](http://giub.it) Covallero

## Recommended Settings

Advance users likes this plugin because it speed up the page loading by remove usless resources but developers reccomended to use together a php cache plugin like [WP Super Cache](http://wordpress.org/plugins/wp-super-cache/).

## Frequently Asked Questions

= Why I can't see all .js and .css in plugin tabels? =

Because your theme or external plugins includes wrongly them.
You can easly edit wrong codes by follow theese function references:

* [wp_register_style()](http://codex.wordpress.org/Function_Reference/wp_register_style)
* [wp_enqueue_style()](http://codex.wordpress.org/Function_Reference/wp_enqueue_style)
* [wp_register_script()](http://codex.wordpress.org/Function_Reference/wp_register_script)
* [wp_enqueue_script()](http://codex.wordpress.org/Function_Reference/wp_enqueue_script)

Alternatively you can enable "Detect during navigation" to start the detection when you open your site pages from your browser (Remember to disable it to speed up your Wordpress).

## Want to contribute?

* [Github/Wp-Remove-Css-Js](https://github.com/GiuB/WP-Remove-Css-Js)

Want to thanks me on Twitter or follow me on my blog?

* [twitter.com/giub_bass](http://twitter.com/intent/tweet?text=Thanks+%40Giub_bass+to+help+me+speed+up+my+%23Wordpress+with+%23WP-Remove-Css-Js)
* [giub.it](http://giub.it)

## Changelog

= 1.0 =

Initial version