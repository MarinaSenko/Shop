<?php

// Class for changing background from admin dashboard

class Color {


	/**
	 * @return array with colors
	 */
	public static function getColors() {

		$db = Db::getConnection();

		$result = $db->query( 'SELECT * FROM color ' );
		$colors = array();
		$i      = 0;
		while ( $row = $result->fetch() ) {
			$colors[ $i ]['id']        = $row['id'];
			$colors[ $i ]['name']      = $row['name'];
			$colors[ $i ]['is_active'] = $row['is_active'];

			$i ++;
		}

		return $colors;

	}


}