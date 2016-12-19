<?php

/**
 * Class for work with database
 */
class Db {

	/**
	 * Set a connection to database
	 * @return \PDO <p>object of class PDO </p>
	 */
	public static function getConnection() {
		// Get parameters for connection from config file
		$paramsPath = ROOT . '/config/db_params.php';
		$params     = include( $paramsPath );

		// Set a connection
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$db  = new PDO( $dsn, $params['user'], $params['password'] );

		// Set encoding
		$db->exec( "set names utf8" );

		return $db;
	}

	/**
	 * @param $query
	 *
	 * @return array|null
	 */
	public static function select_list( $query ) {
		$q = mysqli_query( $query );
		if ( ! $q ) {
			return null;
		}
		$ret = array();
		while ( $row = mysqli_fetch_assoc( $q ) ) {
			array_push( $ret, $row );
		}
		mysqli_free_result( $q );

		return $ret;
	}

}
