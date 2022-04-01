<?php
/**
 * Plugin Name: GF Save and Continue List
 * Description: Displays a list of currently used Gravity Forms Save and Continue links.
 * Plugin URI: https://github.com/sandervdwnl/gf-sav-list
 * Author: Sander van der Windt
 * Version: 0.1
 * Textdomain: gfsacl
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GFSACL_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require plugin_dir_path( __FILE__ ) . 'includes/gfsacl-plugin-menus.php';

require plugin_dir_path( __FILE__ ) . 'includes/gfascl-admin-styles.php';
