<?php
add_action('wp_ajax_bgiiwpve_tinymce', 'bgiiwpve_ajax_tinymce');
function bgiiwpve_ajax_tinymce() {
	if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') )
	die(__("You are not allowed to be here"));
include_once( dirname( dirname(__FILE__) ) . '/tinymce/window.php');
}
?>