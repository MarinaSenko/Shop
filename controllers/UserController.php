<?php

class UserController {
	/**
	 * Action for page 'Registration'
	 */
	public function actionRegister() {
		// Vars for form
		$name     = false;
		$email    = false;
		$password = false;
		$result   = false;

		if ( isset( $_POST['submit'] ) ) {
			$name     = $_POST['name'];
			$email    = $_POST['email'];
			$password = $_POST['password'];

			// Flag errors
			$errors = false;

			// Validation
			if ( ! User::checkName( $name ) ) {
				$errors[] = 'Имя не должно быть короче 2-х символов';
			}
			if ( ! User::checkEmail( $email ) ) {
				$errors[] = 'Неправильный email';
			}
			if ( ! User::checkPassword( $password ) ) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов';
			}
			if ( User::checkEmailExists( $email ) ) {
				$errors[] = 'Такой email уже используется';
			}

			if ( $errors == false ) {
				// If no errors
				// Register user
				$result = User::register( $name, $email, $password );
			}
		}

		require_once( ROOT . '/views/user/register.php' );

		return true;
	}

	/**
	 * Action for page 'Access to cabinet'
	 */
	public function actionLogin() {
		// Vars for form
		$email    = false;
		$password = false;

		if ( isset( $_POST['submit'] ) ) {

			$email    = $_POST['email'];
			$password = $_POST['password'];

			$errors = false;

			// Validation
			if ( ! User::checkEmail( $email ) ) {
				$errors[] = 'Неправильный email';
			}
			if ( ! User::checkPassword( $password ) ) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов';
			}

			// Check for user in database
			$userId = User::checkUserData( $email, $password );

			if ( $userId == false ) {
				// if no user then show error
				$errors[] = 'Неправильные данные для входа на сайт';
			} else {
				// if user is then authorise
				User::auth( $userId );

				header( "Location: /cabinet" );
			}
		}

		require_once( ROOT . '/views/user/login.php' );

		return true;
	}


	/**
	 * Logout
	 */
	public function actionLogout() {
		//delete info about user from session
		unset( $_SESSION["user"] );
		header( "Location: /" );
	}

}
