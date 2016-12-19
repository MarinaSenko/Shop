<?php


class SiteController {

	/**
	 * Action for main page
	 */
	public function actionIndex() {
		$categories        = Category::getCategoriesList();
		$subcategories     = Category::getSubCategoriesList();
		$products          = Product::getProducts();
		$sliderProducts    = Product::getStockProducts();
		$topProducts       = Product::getTopCommentProducts();
		$saleProducts      = Product::getSaleProducts();
		$reductionProducts = Product::getReductionProducts();
		$features          = Product::getFeatures();

		require_once( ROOT . '/views/site/index.php' );

		return true;
	}

	/**
	 * Action for page 'Contacts'
	 */
	public function actionContact() {
		// Vars for form
		$userEmail = false;
		$userText  = false;
		$result    = false;

		if ( isset( $_POST['submit'] ) ) {

			$userEmail = $_POST['userEmail'];
			$userText  = $_POST['userText'];

			$errors = false;

			if ( ! User::checkEmail( $userEmail ) ) {
				$errors[] = 'Неправильный email';
			}

			if ( $errors == false ) {

				$adminEmail = 'marina_senko@ukr.net';
				$message    = "Текст: {$userText}. От {$userEmail}";
				$subject    = 'Тема письма';
				$result     = mail( $adminEmail, $subject, $message );
				$result     = true;
			}
		}

		require_once( ROOT . '/views/site/contact.php' );

		return true;
	}

	/**
	 * Action for page 'About'
	 */
	public function actionAbout() {
		require_once( ROOT . '/views/site/about.php' );

		return true;
	}

}
