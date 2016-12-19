<?php


class User {

	/*
	 * user registration
	 */
	public static function register( $name, $email, $password ) {
		// connect to db
		$db = Db::getConnection();

		// query to db
		$sql = 'INSERT INTO user (name, email, password) '
		       . 'VALUES (:name, :email, :password)';

		// get and return results. Use prepare queries
		$result = $db->prepare( $sql );
		$result->bindParam( ':name', $name, PDO::PARAM_STR );
		$result->bindParam( ':email', $email, PDO::PARAM_STR );
		$result->bindParam( ':password', $password, PDO::PARAM_STR );

		return $result->execute();
	}

	/*
	 * Edit user's data
	 */
	public static function edit( $id, $name, $password ) {
		// connection ta db
		$db = Db::getConnection();

		// query to db
		$sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

		// get and return results. Use prepare queries
		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );
		$result->bindParam( ':name', $name, PDO::PARAM_STR );
		$result->bindParam( ':password', $password, PDO::PARAM_STR );

		return $result->execute();
	}

	/*
	 * Check $email and $password in db
	 */
	public static function checkUserData( $email, $password ) {
		// connect to db
		$db = Db::getConnection();

		// query to db
		$sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

		// get and return results. Use prepare queries
		$result = $db->prepare( $sql );
		$result->bindParam( ':email', $email, PDO::PARAM_INT );
		$result->bindParam( ':password', $password, PDO::PARAM_INT );
		$result->execute();

		// address to query
		$user = $result->fetch();

		if ( $user ) {

			return $user['id'];
		}

		return false;
	}

	/*
	 * Remember user
	 */
	public static function auth( $userId ) {
		// Write id in session
		$_SESSION['user'] = $userId;
	}

	/*
	 * Return id if user is auth
	 */
	public static function checkLogged() {
		// return id if session is
		if ( isset( $_SESSION['user'] ) ) {
			return $_SESSION['user'];
		}

		header( "Location: /user/login" );
	}

	/*
	 * Check user like guest
	 */
	public static function isGuest() {
		if ( isset( $_SESSION['user'] ) ) {
			return false;
		}

		return true;
	}

	/*
	 * validation name
	 */
	public static function checkName( $name ) {
		if ( strlen( $name ) >= 2 ) {
			return true;
		}

		return false;
	}

	/*
	 * * validation phone number
	 */
	public static function checkPhone( $phone ) {
		if ( strlen( $phone ) >= 10 ) {
			return true;
		}

		return false;
	}

	/*
	 * validation password
	 */
	public static function checkPassword( $password ) {
		if ( strlen( $password ) >= 6 ) {
			return true;
		}

		return false;
	}

	/*
	 * validation email
	 */
	public static function checkEmail( $email ) {
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
			return true;
		}

		return false;
	}

	/*
	 * validation email for unique
	 */
	public static function checkEmailExists( $email ) {
		// connect to db
		$db = Db::getConnection();

		// query to db
		$sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

		$result = $db->prepare( $sql );
		$result->bindParam( ':email', $email, PDO::PARAM_STR );
		$result->execute();

		if ( $result->fetchColumn() ) {
			return true;
		}

		return false;
	}

	/*
	 * Return info about user with specific id
	 */
	public static function getUserById( $id ) {
		// connect to db
		$db = Db::getConnection();

		// query to db
		$sql    = 'SELECT * FROM user WHERE id = :id';
		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		// Get data in array
		$result->setFetchMode( PDO::FETCH_ASSOC );
		$result->execute();

		return $result->fetch();
	}


}
