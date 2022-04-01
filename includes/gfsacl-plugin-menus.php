<?php

if ( ! function_exists( 'gfsacl_plugin_page_menu' ) ) {
	function gfsacl_plugin_page_menu() {

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
}
add_action( 'admin_menu', 'gfsacl_plugin_page_menu', 15 );

// Functie wordt geactiveerd door menu.

if ( ! function_exists( 'gfsacl_page' ) ) {
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
		<th>Sent To</th>
		<th>IP-address</th>
		<th>Form Title</th>
		<th>Link Token</th>
		<th>Date Created</th>
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
}
