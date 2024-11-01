<?php
/**
 * @package WP Twitter/Facebook Style Pagination
 * @version 1.0.1
 * @author Sagar Bhandari <webgig.sagar@gmail.com>
 */
 
/*
	Plugin Name: WP Twitter/Facebook Style Pagination
	Description: WordPress plugin for implementing Twitter and Facebook style 'Load More' pagination. 
	Author: Sagar Bhandari
	Author URI: http://www.thewebgig.com
	Plugin URI: http://www.thewebgig.com/wp-twitterfacebook-style-pagination/
	Version: 1.0.1
	License: GPL
*/


require_once 'wp-twitterfacebook-style-pagination-admin.php';
require_once 'wp-twitterfacebook-style-pagination-front.php';



/* Runs when plugin is activated */
register_activation_hook(__FILE__,'twg_tfsp_install_plugin'); 

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'twg_tfsp_uninstall_plugin' );


function twg_tfsp_install_plugin(){

	add_option("twg_tfsp_loop_file", 'loop', '', 'yes');
	add_option("twg_tfsp_content_el_id", 'content', '', 'yes');

}

function twg_tfsp_uninstall_plugin() {
	
	delete_option("twg_tfsp_loop_file");
	delete_option("twg_tfsp_content_el_id");

}