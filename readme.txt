=== TP Framework ===
Donate link:    
Contributors: quangdungtn90  
Tags: one click, one-click, import, importer, framework, toolkit, sidebar, cusotmizer, widget, dummy data    
Requires at least: 4.5    
Tested up to: 5.3
Stable tag: 1.1.2
License: GPLv3    
License URI: http://www.gnu.org/licenses/gpl-3.0.html    

Create Admin fields, metabox, widget, taxonomy, menu meta, customizer fields quickly and friendly.

== Description ==

**TP Fields** provides for developers basic and advanced fields in:    
1. Taxonomy custom fields        
2. Metabox custom fields    
3. Customizer fields    
4. Menu Meta fields    
5. Widget Fields    

Read document of Plugin : 

**With many field types:**    

1. textfield & textfield multiple    
2. checkbox & checkbox multiple
3. radio & radio multiple
4. select & select multiple
5. textarea
6. image_picker
7. image_select (Image radios)
8. icon_picker
9. link
10. datetime
11. map
12. autocomplete (Ajax auto search from post types, taxonomies and ... )
13. repeater
14. typography
15. upload (Upload single and multiple file upload with hash)

You can require tp-framework/sample/sample.php file in plugin to see the demo.

Besides TP Framework provide theme users a **One Click Importer Tool** to easily use dummy data with a few available options.
The plugin also provides a manual import by uploading from computer with some popular extensions (XML, JSON, WIE, DAT).
For theme developers, if you want to provide more dummy data options to your users, you can use some available hooks in the plugin. Dummy data files can come from anywhere on the Internet, of course you can push those files to your theme or plugin.


== Installation ==

1. Simply install as a normal WordPress plugin and activate.    
2. Go to Tools/Import  
3. Click on TP Importer from list
4. Plugin page will be showed, hope you enjoy with it.


== Frequently Asked Questions ==

= What are differences between TP Framework and other plugins, like Kirki Toolkit, Redux Framework or CMB2 WordPress plugin? =

Both Kirri and Redux don't support field building in Taxonomy, Metabox, Widget or Menu item meta, so you have to use alternative ones to do this.
About CMB2, it doesn't offer field building in Customizer. While all of them can be done in only one plugin like TP Framework.

= Does this plugin change the default WordPress API? =

No, TP Framework uses and extends the default WordPress methods and does not replace anything.

= Does the plugin resets my current data, or my data can be lost? =

No, The plugin just adds data and not resets or removes anything, your data won't be lost. But for safety you should backup current data before import 

== Screenshots ==

1. Some available dummy-data options
2. Manually import
3. Metabox field
4. Customizer fields
5. Taxonomy fields
6. Widget fields

== Upgrade Notice ==

* Initial version


== Changelog ==
= 1.0.15 (July 16, 2018): =
* Fix conflict with different plugin of quangdung

= 1.0.15 (February 12, 2018): =
* Add admin notice

= 1.0.14 (February 12, 2018): =
* Support optional for field datetime picker

= 1.0.13 (February 9, 2018): =
* Fix metabox in front_page, posts_page cannot saved
* Improve dependency in customizer

= 1.0.12 (January 25, 2018): =
* Fix metabox in front_page, posts_page cannot saved

= 1.0.11 (January 22, 2018): =
* Fix metabox in front_page is not display
* Add: Display metabox in page by Template Name of the page

= 1.0.10 (January 11, 2018): =
 * Fix dependency fields js in edit form taxonomy
 * Improve displaying metabox

= 1.0.9 (December 13, 2017): =
 * Support multiple for textfield

= 1.0.8 (December 12, 2017): =
 * Improve dependency fields

= 1.0.7 (November 30, 2017): =
 * Fix autocomplete field does not select multiple value in customizer
 * Improve styling Group fields in  Taxonomy, Category, Tags form add and edit
 * Fix field dependency with values are numbers does not work

= 1.0.6 (November 13, 2017): =
 * Fix image_picker field does not work in repeater field
 * Add: tpfw_build_link_attrs

= 1.0.5 (October 30, 2017): =
 * Update: autocomplete field with static data
 * Update: prevent upload wrong mimetype in field upload

= 1.0.4 (October 30, 2017): =
 * Fix dependency on radio field
 * Add field Upload (Single and Multiple File upload)

= 1.0.3 (September 22, 2017): =
 * Use tp_importer_get_http instead of wp_get_http
 * Disable button import when import.

= 1.0.2 (June 27, 2017): =
* Fix dependency in Customizer
* Deprecated tpfw_l10n_get_strings
* Add sanitize functions

= 1.0.1 (June 13, 2017): =
* Add import Placeholdit image option in  Available Imports 

= 1.0.0 (June 6, 2017): =
* Initial Public Release