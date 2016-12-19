<?php

class AdminController extends AdminBase {
	/**
	 * Action for the page "Admin dashboard"
	 */
	public function actionIndex() {
		// Checking access
		self::checkAdmin();

		// Get list of comments
		$commentsList = Product::getCommentsList();

		require_once( ROOT . '/views/admin/index.php' );

		return true;
	}


	public function actionStyle() {
		$colorBody = '';
		$colorHead = '';

		if ( isset( $_POST['submit'] ) ) {
			$colorBody = $_POST['colorBody'];
			$colorHead = $_POST['colorHead'];
		}

		$colors = Color::getColors();


		require_once( ROOT . '/views/admin/style.php' );

		return true;
	}


	public function actionMenu() {

		require_once( ROOT . '/views/admin/menu.php' );

		return true;
	}


	public function actionComments() {

		require_once( ROOT . '/views/admin/index.php' );

		return true;
	}

}
