<?php

/*
Plugin Name: SettlerWorld Dashboard Module
Description: SettlerWorld WP Game - Dashboard Module
Version:     0.5
Author:      Elijah Mills
Author URI:  http://settlerworld.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_action( 'wp_dashboard_setup', 'remove_dashboard_meta' ); // Clear default dashboard widgets
add_action( 'wp_dashboard_setup', 'settlerworld_add_dash_widgets' ); // Add our custom widgets for the game

function remove_dashboard_meta() {

	//remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );

	if( ! current_user_can( 'edit_posts' ) ) {

		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );

	}

}

// Let's add our custom widgets

function settlerworld_add_dash_widgets() {
	
	// This widget displays basic status for the player (hp, location, etc...)
	wp_add_dashboard_widget(
		'settlerworld_user_status', // Widget slug.
		'My Status', // Title.
		'settlerworld_user_status_function' // Display function.
	);

	// This widget is used for inventory display and management.
	wp_add_dashboard_widget(
		'settlerworld_user_inventory',
		'Inventory',
		'settlerworld_user_inventory_function'
	);

}

function settlerworld_user_status_function() {

	echo "Hello there, I'm a great Dashboard Widget. Edit me!";
	echo "Health: " . get_user_meta( get_current_user_id(), '_health', true );

}

function settlerworld_user_inventory_function() {

	$newinventory = array(
		'cash' => 100,
		'wood' => 10,
		'gold' => 23,
		'food' => 5
	);

	update_user_meta( get_current_user_id(), '_inventory', $newinventory );

	print_r( get_user_meta( get_current_user_id(), '_inventory', false) );

}