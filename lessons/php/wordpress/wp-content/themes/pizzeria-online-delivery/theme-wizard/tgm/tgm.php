<?php require get_template_directory() . '/theme-wizard/tgm/class-tgm-plugin-activation.php';

function pizzeria_online_delivery_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Woocommerce', 'pizzeria-online-delivery' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
		array(
			'name'             => __( 'Classic Widgets', 'pizzeria-online-delivery' ),
			'slug'             => 'classic-widgets',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'pizzeria_online_delivery_register_recommended_plugins' );