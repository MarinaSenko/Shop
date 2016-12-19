<?php

class CabinetController {

	/**
	 * Action for page 'Cabinet'
	 */
	public function actionIndex() {
		// Get user Id from session
		$userId = User::checkLogged();

		// Get user info fron db
		$user = User::getUserById( $userId );

		require_once( ROOT . '/views/cabinet/index.php' );

		return true;
	}


	public function actionHistory() {
		// Get user Id from session
		$id = User::checkLogged();

		// Get data of specific order
		$ordersList = Order::getOrdersList();

		require_once( ROOT . '/views/cabinet/history.php' );

		return true;
	}

	/**
	 * Action for page 'Edit user info'
	 */
	public function actionEdit() {
		// Get user Id from session
		$userId = User::checkLogged();

		// Get user info fron db
		$user = User::getUserById( $userId );

		$name     = $user['name'];
		$password = $user['password'];

		$result = false;

		if ( isset( $_POST['submit'] ) ) {
			$name     = $_POST['name'];
			$password = $_POST['password'];

			$errors = false;

			if ( ! User::checkName( $name ) ) {
				$errors[] = 'Имя не должно быть короче 2-х символов';
			}
			if ( ! User::checkPassword( $password ) ) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов';
			}

			if ( $errors == false ) {
				$result = User::edit( $userId, $name, $password );
			}
		}

		require_once( ROOT . '/views/cabinet/edit.php' );

		return true;
	}

}
