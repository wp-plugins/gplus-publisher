<?php
/*
Plugin Name: Gplus Publisher
Plugin URI: http://giga4.es/gplus-publisher.zip
Description: Puts rel="publisher" code related to Google+ in the without-autor-pages of your blog.
Author: FranTorres
Author URI: http://frantorres.es/
Version: 0.99
License: GPL2

@TODO: Let those nice people choose if they want the code just in the page without author or in the whole site.
*/

// If we are at WordPress Admin side, load the file for option page
if ( is_admin() )
	require plugin_dir_path( __FILE__ ).'admin.php';

add_action( 'wp_head', 'gplus_publisher' );

function gplus_publisher()
{
	$options = get_option('gplus_publisher');	
  	$id = $options['id'];	

	if ( ( is_home() || is_category() || is_tag() || is_tax() || is_archive() || is_search()) && !empty($id) ) {

          echo "\n\n<!-- Gplus Publisher --><link href=\"https://plus.google.com/".$id."/\" rel=\"publisher\" />\n\n";
	} 

}
