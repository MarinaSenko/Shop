<?php


abstract class AdminBase {

	// check user for admin role

	public static function checkAdmin() {
		// Check user authorisation
		$userId = User::checkLogged();

		// Get info about user
		$user = User::getUserById( $userId );

		// if users' role is admin then give an access to admin dashboard
		if ( $user['role'] == 'admin' ) {
			return true;
		}

		// if users' role is not admin then output message
		die( 'Отказано в доступе' );
	}

}
