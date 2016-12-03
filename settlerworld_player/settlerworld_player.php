<?php

/*
Plugin Name: SettlerWorld Player Module
Description: SettlerWorld WP Game - Player Module
Version:     0.5
Author:      Elijah Mills
Author URI:  http://settlerworld.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

register_activation_hook( __FILE__, 'settlerworld_activate');

add_action( 'user_register' , 'settlerworld_player_setup' );

// The setup for SettlerWorld Players ("Settlers")

function settlerworld_activate() {
	
	//Define "Settler capbilities

	$capabilities = array(
		'read' => true,
		'edit_posts' => false
	);

	//Create custom user role, "Settler"

	add_role( "settler" , "Settler" , $capabilities );

}

function settlerworld_player_setup( $userid ) {

	// Get an object containing the user data
	$userdata = get_userdata( $userid );

	// Get a list of the user's roles (should just be Settler)
	$userroles = $userdata->roles;

	// Make sure we're acting only on Settlers'
	if( in_array( 'settler', $userroles ) ) {

		// Now we can get down to business, adding the necessary user metaphone

		add_user_meta( $userid, '_health', 10 );
		add_user_meta( $userid, '_skills', array() );
		add_user_meta( $userid, '_inventory', array() );
		add_user_meta( $userid, '_location', 'start' );

	}

}