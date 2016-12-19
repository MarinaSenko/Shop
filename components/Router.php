<?php

/*
 * Work with routes
 */

class Router {

	/*
	 * Array with routes
	 * @var array
	 */
	private $routes;

	/**
	 * Constructor
	 */
	public function __construct() {
		// Path to the file with routes
		$routesPath = ROOT . '/config/routes.php';

		//Get routes from file
		$this->routes = include( $routesPath );
	}

	/**
	 * Return string of query
	 */
	private function getURI() {
		if ( ! empty( $_SERVER['REQUEST_URI'] ) ) {
			return trim( $_SERVER['REQUEST_URI'], '/' );
		}
	}

	/*
	 * Work with query string
	 */
	public function run() {
		// get query string
		$uri = $this->getURI();

		// Check the array with routes for the same query(routes.php)
		foreach ( $this->routes as $uriPattern => $path ) {

			// Compare $uriPattern и $uri
			if ( preg_match( "~$uriPattern~", $uri ) ) {

				// Get inner path from outer with rule.
				$internalRoute = preg_replace( "~$uriPattern~", $path, $uri );

				// define controller, action, parameters

				$segments = explode( '/', $internalRoute );

				$controllerName = array_shift( $segments ) . 'Controller';
				$controllerName = ucfirst( $controllerName );

				$actionName = 'action' . ucfirst( array_shift( $segments ) );

				$parameters = $segments;

				// Include file class-controller
				$controllerFile = ROOT . '/controllers/' .
				                  $controllerName . '.php';

				if ( file_exists( $controllerFile ) ) {
					include_once( $controllerFile );
				}

				// Make object and call action
				$controllerObject = new $controllerName;

				/* Call $actionName from $controllerObject with $parameters
				 */
				$result = call_user_func_array( array( $controllerObject, $actionName ), $parameters );

				// If success then exit
				if ( $result != null ) {
					break;
				}
			}
		}
	}

}
