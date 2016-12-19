<?php

// for automatic load classes
function __autoload( $class_name ) {
	// array of folders where can be the class
	$array_paths = array(
		'/models/',
		'/components/',
		'/controllers/',
	);

	// check array for necessary file class
	foreach ( $array_paths as $path ) {

		// Make name and path to the file class
		$path = ROOT . $path . $class_name . '.php';

		// if necessary file exists then include it
		if ( is_file( $path ) ) {
			include_once $path;
		}
	}
}
