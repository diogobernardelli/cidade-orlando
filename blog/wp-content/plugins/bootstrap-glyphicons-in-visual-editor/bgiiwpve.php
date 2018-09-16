<?php
/*
Plugin Name: Bootstrap Glyphicons in Visual Editor
Plugin URI: http://www.509tech.com/bootstrap-glyphicons-wordpress-plugin/
Description: Adds the <a href="http://glyphicons.com">Glyphicons</a> included with <a href="http://getbootstrap.com">Twitter Bootstrap 3</a> to the visual editor. All credit goes to those 2 places for their awesome work!
Version: 1.1
Author: Jon @ 509Tech
Author URI: http://www.509tech.com
*/
//Don't allow direct navigation of plugin
if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );


include_once (dirname (__FILE__) . '/tinymce/tinymce.php');
require_once (dirname (__FILE__) . '/tinymce/ajax.php');

//Load Bootstrap & Glyphicons
function bgiiwpve_bootstrap()
{
	wp_register_style( 'bgiiwpve-css', plugins_url( '/css/bgiiwpve.css', __FILE__ ), array(),'3.0', 'all' );  
	wp_enqueue_style( 'bgiiwpve-css' ); 
}
add_action( 'wp_enqueue_scripts', 'bgiiwpve_bootstrap' );

//Define Shortcode
function bgiiwpve_glyphicon($atts) {
	extract(shortcode_atts(array(
		"icon" => ''
	), $atts));
	return '<span class="glyphicon glyphicon-'.$icon.'"></span>';
}
add_shortcode("glyphicon", "bgiiwpve_glyphicon");