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
add_action('admin_enqueue_scripts', 'load_gfsacl_admin_styles');

function load_gfsacl_admin_styles() {

wp_enqueue_style( 'admin-styles', plugin_dir_path(__FILE__) . 'admin/css/admin-style.css' );
}

function plugin_page_menu() {

	$parent_slug = 'gf_edit_forms';
	$page_title  = 'Gravity Forms Save and Continue List';
	$menu_title  = 'GF S&V List';
	$capability  = 'manage_options';
	$menu_slug   = 'gfsacl';
	$function    = 'gfsacl_page';

	add_submenu_page(
		$parent_slug,
		$page_title,
		$menu_title,
		$capability,
		$menu_slug,
		$function
	);
}
add_action( 'admin_menu', 'plugin_page_menu', 15 );

// Functie wordt geactiveerd door menu
function gfsacl_page() {

	global $wpdb;

	$results = $wpdb->get_results(
		"SELECT
		uuid,
		form_id,
		email,
		ip,
		source_url,
		date_created,
		DATE_FORMAT(date_created, '%d %M %Y %H:%i') as datetime
	FROM {$wpdb->prefix}gf_draft_submissions 
	ORDER BY date_created DESC"
	);

	?>
<div class="gfsac-wrap">
<h1>List of all GF Save and Continue links</h1>
<table class="gfsac-center">
	<tr>
	<th>Form ID</th>
		<th>Sent to</th>
		<th>IP-address</th>
		<th>Form title</th>
		<th>Link token</th>
		<th>Date created</th>
	</tr>
	<?php
	if ( is_array( $results ) || is_object( $results ) ) {
		foreach ( $results as $key => $value ) {
			?>
			<tr>
			<td class="center"><?php esc_html_e( $value->form_id ); ?></td>
			<td><?php esc_html_e( $value->email ); ?></td>
			<td><?php esc_html_e( $value->ip ); ?></td>
			<td><?php esc_html_e( basename( $value->source_url ) ); ?></td>
			<td><?php esc_html_e( $value->uuid ); ?></td>
			<td><?php esc_html_e( $value->datetime ); ?></td>
			</tr>
			<?php
		}
	}
	?>
</table>
</div>
	<?php
}
