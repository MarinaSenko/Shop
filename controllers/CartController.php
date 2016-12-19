<?php


class CartController {

	/**Adding to the cart without ajax
	 *
	 * @param $id
	 */
	public function actionAdd( $id ) {
		Cart::addProduct( $id );
		$referrer = $_SERVER['HTTP_REFERER'];
		header( "Location: $referrer" );
	}

	/*
	 * Adding to cart with ajax
	 * @param integer $id
	 */
	public function actionAddAjax( $id ) {
		//Adding to cart end print quantity of products in the cart
		echo Cart::addProduct( $id );

		return true;
	}

	/**
	 * Delete from cart without ajax
	 *
	 * @param integer $id
	 */
	public function actionDelete( $id ) {

		Cart::deleteProduct( $id );
		header( "Location: /cart" );
	}

	/**
	 * Action for page 'Cart'
	 */
	public function actionIndex() {
		$categories     = Category::getCategoriesList();
		$productsInCart = Cart::getProducts();

		if ( $productsInCart ) {
			// if there are products in the cart, get info
			//Get array with only ids
			$productsIds = array_keys( $productsInCart );

			// Array with whole info about products
			$products = Product::getProdustsByIds( $productsIds );

			// Get total price
			$totalPrice = Cart::getTotalPrice( $products );
		}

		require_once( ROOT . '/views/cart/index.php' );

		return true;
	}

	/**
	 * Action for page 'Make order'
	 */
	public function actionCheckout() {
		// Get data from cart
		$productsInCart = Cart::getProducts();
		if ( $productsInCart == false ) {
			header( "Location: /" );
		}

		$categories = Category::getCategoriesList();
		// Total sum
		$productsIds = array_keys( $productsInCart );
		$products    = Product::getProdustsByIds( $productsIds );
		$totalPrice  = Cart::getTotalPrice( $products );
		// Quantity of products
		$totalQuantity = Cart::countItems();

		$userName    = false;
		$userPhone   = false;
		$userComment = false;

		$result = false;

		// Check user
		if ( ! User::isGuest() ) {
			$userId   = User::checkLogged();
			$user     = User::getUserById( $userId );
			$userName = $user['name'];
		} else {
			$userId = false;
		}

		$registration = null;

		if ( ! $userId ) {
			$registration = 'Пройдите регистрацию, чтобы получить скидку!';
		}


		if ( isset( $_POST['submit'] ) ) {
			$userName    = $_POST['userName'];
			$userPhone   = $_POST['userPhone'];
			$userComment = $_POST['userComment'];

			$errors = false;

			if ( ! User::checkName( $userName ) ) {
				$errors[] = 'Неправильное имя';
			}
			if ( ! User::checkPhone( $userPhone ) ) {
				$errors[] = 'Неправильный телефон';
			}


			if ( $errors == false ) {
				$result = Order::save( $userName, $userPhone, $userComment, $userId, $productsInCart );
				if ( $result ) {
					$adminEmail = 'php.start@mail.ru';
					$message    = '<a href="http://digital-mafia.net/admin/orders">Список заказов</a>';
					$subject    = 'Новый заказ!';
					mail( $adminEmail, $subject, $message );

					// Clear the cart
					Cart::clear();
				}
			}
		}


		require_once( ROOT . '/views/cart/checkout.php' );

		return true;
	}

}
