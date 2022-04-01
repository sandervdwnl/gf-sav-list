<?php

function gfsacl_admin_styles() {

	wp_enqueue_style( 'gfasc-admin', GFSACL_PLUGIN_URL . 'admin/css/admin-style.css', array(), time() );
}
add_action( 'admin_enqueue_scripts', 'gfsacl_admin_styles' );
