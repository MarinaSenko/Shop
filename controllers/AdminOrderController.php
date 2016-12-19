<?php

/**
 * Manage orders
 */
class AdminOrderController extends AdminBase {

	/**
	 * Action for page "Manage Orders"
	 */
	public function actionIndex() {
		// Checking access
		self::checkAdmin();

		// Get list of orders
		$ordersList = Order::getOrdersList();

		// Include the view
		require_once( ROOT . '/views/admin_order/index.php' );

		return true;
	}

	/**
	 * Action for page "Edit order"
	 */
	public function actionUpdate( $id ) {
		// Checking access
		self::checkAdmin();

		// Get data about specific order
		$order = Order::getOrderById( $id );

		// form processing
		if ( isset( $_POST['submit'] ) ) {
			// Get data from form
			$userName    = $_POST['userName'];
			$userPhone   = $_POST['userPhone'];
			$userComment = $_POST['userComment'];
			$date        = $_POST['date'];
			$status      = $_POST['status'];

			// Save the changes
			Order::updateOrderById( $id, $userName, $userPhone, $userComment, $date, $status );
			header( "Location: /admin/order/view/$id" );
		}

		// Include the view
		require_once( ROOT . '/views/admin_order/update.php' );

		return true;
	}

	/**
	 * Action for page "View order"
	 */
	public function actionView( $id ) {
		// Checking access
		self::checkAdmin();

		// Get data of specific order
		$order = Order::getOrderById( $id );

		//Get array with ids and quantity of products
		$productsQuantity = json_decode( $order['products'], true );

		// Get array with ids products
		$productsIds = array_keys( $productsQuantity );

		// Get list of products in order
		$products = Product::getProdustsByIds( $productsIds );

		// Include the view
		require_once( ROOT . '/views/admin_order/view.php' );

		return true;
	}

	/**
	 * Action for page 'Delete order'
	 */
	public function actionDelete( $id ) {
		// Checking access
		self::checkAdmin();

		// Обработка формы
		if ( isset( $_POST['submit'] ) ) {
			// Delete order
			Order::deleteOrderById( $id );
			header( "Location: /admin/order" );
		}

		// Include the view
		require_once( ROOT . '/views/admin_order/delete.php' );

		return true;
	}

}
