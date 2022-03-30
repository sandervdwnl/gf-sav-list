<?php
/**
 * Plugin Name: GF Save and Continue List
 * Description: Displays a list of currently used Gravity Forms Save and Continue links.
 * Author: Sander van der Windt
 * Version: 0.1
 */

add_action( 'admin_menu', 'plugin_page_menu' );

function plugin_page_menu() {
	add_menu_page(
		'Gravity Forms Save and Continue List',
		'GF S&V List',
		'manage_options',
		'gfsacl',
		// Callback function test_init:
		'gfsacl_page'
	);
}

// Functie wordt geactiveerd door menu
function gfsacl_page() {
	echo '<h1>List of all GF Save and Continue links</h1>';

	global $wpdb;

	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}gf_draft_submissions");

	?>
<div class="wrap">
<table>
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
			echo '<tr>
			<td>' . $value->form_id . '</td>
            <td>' . $value->email . '</td>
			<td>' . $value->ip . '</td>
			<td>' . basename($value->source_url) . '</td>
			<td>' . $value->uuid . '</td>
			<td>' . $value->date_created . '</td>
            </tr>';
		}
	}
	?>
</table>
</div>
	<?php
}
