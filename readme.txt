=== WP Twitter/Facebook Style Pagination ===
Contributors: webgig,Pravash Chamling Rai
Plugin Site: http://www.thewebgig.com
Tags: twitter,facebook,load more, ajax, ajax pagination, facebook style pagination, twitter style pagination
Requires at least: 3.0+
Tested up to: 3.2
Stable tag: 1.0.1

== Description ==

[Author Site](http://www.thewebgig.com)|
[Plugin Home Page](http://www.thewebgig.com/wp-twitterfacebook-style-pagination)

WordPress plugin for implementing Twitter and Facebook style 'Load More' pagination.

Some of its features are:

* Easy setup.

* Minimal Configuration.

* Option to define the file from which the posts/content will be loaded. This can be defined individualy via the function parameter and globally via the admin options.

* Option to define the element to which the posts/content will be rendered. This can be defined individualy via the function parameter and globally via the admin options.
 
* Option to override the output via action hook.Use 'twg_tfsp_query_posts' to add a custom hook.
	
   `add_action('twg_tfsp_query_posts','twg_tfsp_custom_query_posts');


	
   function twg_tfsp_custom_query_posts(){
  
	global $paged;
	# You can add any parameters here but the 'paged' parameter is a must	
  
	query_posts(array('post_type' => 'custom_post_type', 'paged' => $paged));

   }`

== Installation ==
Intallation is easy. Install it normally as you do with rest of the plugins.

1. Download and unzip the plugin .zip.
2. Copy the unzipped folder in your Plugins directory under wordpress installation. (wp-content/plugins)
3. Activate the plugin through the plugin window in the admin panel.
4. Configure the settings through Settings->WP Twitter/Facebook Style Pagination in the admin panel.
5. Set the loop file  and content el value in the options form. The description of these parameters are in the options page.


== Screenshots ==
1. Frontend View
2. Admin View


== Changelog ==

= 1.0.0 =
* First Release

= 1.0.0.1 =
* Fixed some bugs