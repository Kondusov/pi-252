<?php
/**
 * Settings for theme wizard
 *
 * @package Whizzie
 * @author Catapult Themes
 * @since 1.0.0
 */

/**
 * Define constants
 **/
if ( ! defined( 'WHIZZIE_DIR' ) ) {
	define( 'WHIZZIE_DIR', dirname( __FILE__ ) );
}
// Load the Whizzie class and other dependencies
require trailingslashit( WHIZZIE_DIR ) . 'whizzie.php';
// Gets the theme object
$current_theme = wp_get_theme();
$theme_title = $current_theme->get( 'Name' );


/**
 * Make changes below
 **/

// Change the title and slug of your wizard page
$config['page_slug'] 	= 'pizzeria-online-delivery';
$config['page_title']	= 'TI Setup Wizard';

// You can remove elements here as required
// Don't rename the IDs - nothing will break but your changes won't get carried through
$config['steps'] = array(
	'intro' => array(
		'id'			=> 'intro', 
		'title'			=> __( 'Welcome to ', 'pizzeria-online-delivery' ) . $theme_title, // Section title
		'icon'			=> 'dashboard', 
		'can_skip'		=> false 
	),
	'plugins' => array(
		'id'			=> 'plugins',
		'title'			=> __( 'Plugins', 'pizzeria-online-delivery' ),
		'icon'			=> 'admin-plugins',
		'button_text'	=> __( 'Install Plugins', 'pizzeria-online-delivery' ),
		'can_skip'		=> false
	),
	'widgets' => array(
		'id'			=> 'widgets',
		'title'			=> __( 'Demo Importer', 'pizzeria-online-delivery' ),
		'icon'			=> 'welcome-widgets-menus',
		'button_text'	=> __( 'Import Demo', 'pizzeria-online-delivery' ),
		'can_skip'		=> false
	),
	'done' => array(
		'id'			=> 'done',
		'title'			=> __( 'All Done', 'pizzeria-online-delivery' ),
		'icon'			=> 'yes',
	)
);

/**
 * This kicks off the wizard
 **/
if( class_exists( 'Whizzie' ) ) {
	$Whizzie = new Whizzie( $config );
}
