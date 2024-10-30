<?php
/**
 * Plugin Name:	Header Image Clickable
 * Description:	Make the header image clickable to any link.
 * Version:		1.0
 * Author:		dithemes
 * Author URI:	https://dithemes.com
 * Text Domain: header-image-clickable
 * Domain Path: /languages
 * Requires at least: 4.7
 * Requires PHP: 5.6
 *
 */

// Exit if directly accessed files.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants.

define( 'Header_Image_Clickable_VERSION' , '1.0' ); // Return version of this plugin.

define( 'Header_Image_Clickable_FILE', __FILE__ ); // Return 'path of this file'.
define( 'Header_Image_Clickable_PATH', wp_normalize_path( plugin_dir_path( Header_Image_Clickable_FILE ) ) ); // Return 'path of this directory'.

define( 'Header_Image_Clickable_URL', plugin_dir_url( Header_Image_Clickable_FILE ) ); // Return 'URL of this directory'.

define( 'Header_Image_Clickable_BASENAME', plugin_basename( Header_Image_Clickable_FILE ) ); // Return base name like 'plugin-name/plugin-name.php'
define( 'Header_Image_Clickable_DIR_NAME', dirname( Header_Image_Clickable_BASENAME ) ); // Return name of directory like 'plugin-name'

// Load text domain.
add_action( 'init', 'Header_Image_Clickable_load_textdomain' );
function Header_Image_Clickable_load_textdomain() {
	load_plugin_textdomain( 'header-image-clickable', false, Header_Image_Clickable_PATH . 'languages' );
}

// Load the init file.
require( Header_Image_Clickable_PATH . 'inc/init.php' );
