<?php
/**
  Plugin Name: File Manager Advanced
  Plugin URI: https://wordpress.org/plugins/file-manager-advanced
  Description: Cpanel for files management in wordpress
  Author: modalweb
  Version: 3.1
  Author URI: https://profiles.wordpress.org/modalweb
**/
define('FMAFILEPATH', plugin_dir_path( __FILE__ ));
if(is_admin()) {
	include('application/class_fma_main.php');
	new class_fma_main;
}
include('application/class_fma_shortcode.php');
new class_fma_shortcode;