<?php


// class for working with cart

class Cart {

	/**
	 * Add product to the cart (session)
	 *
	 * @param int $id <p>id product</p>
	 *
	 * @return integer <p>quantity of products in the cart</p>
	 */
	public static function addProduct( $id ) {
		//  $id to integer
		$id = intval( $id );

		// Empty array of products in the cart
		$productsInCart = array();

		// Check the cart for availability of products (they store in session)
		if ( isset( $_SESSION['products'] ) ) {
			// If they are then fill an array
			$productsInCart = $_SESSION['products'];
		}

		// Check the cart for the same product
		if ( array_key_exists( $id, $productsInCart ) ) {
			// if there is then increase +1 product in cart
			$productsInCart[ $id ] ++;
		} else {
			// If there is non the same product then add new product to the cart with quantity = 1
			$productsInCart[ $id ] = 1;
		}

		// Write an array with products in session
		$_SESSION['products'] = $productsInCart;

		// Return quantity of products in the cart
		return self::countItems();
	}

	/**
	 * Count quantity of products in the cart (in session)
	 * @return int <p>quantity of products in the cart</p>
	 */
	public static function countItems() {
		// Check the cart for availability of products
		if ( isset( $_SESSION['products'] ) ) {
			// If there is an array with products then count them and return total
			$count = 0;
			foreach ( $_SESSION['products'] as $id => $quantity ) {
				$count = $count + $quantity;
			}

			return $count;
		} else {
			// If there are not products then return 0;
			return 0;
		}
	}

	/**
	 * Return an array with id and quantity of products
	 * If there are not products then return false;
	 * @return mixed: boolean or array
	 */
	public static function getProducts() {
		if ( isset( $_SESSION['products'] ) ) {
			return $_SESSION['products'];
		}

		return false;
	}

	/**
	 * Get total cost of products
	 *
	 * @param array $products <p>Array with products</p>
	 *
	 * @return integer <p>Total cost</p>
	 */
	public static function getTotalPrice( $products ) {
		// Get an array with id and quantity of products in the cart
		$productsInCart = self::getProducts();

		// Calculate total sum
		$total = 0;
		if ( $productsInCart ) {
			// If cart is not empty then pass through the array of products
			foreach ( $products as $item ) {
				//Total sum: price * quantity of product
				$total += $item['price'] * $productsInCart[ $item['id'] ];
			}
		}

		return $total;
	}

	/**
	 * Clear the cart
	 */
	public static function clear() {
		if ( isset( $_SESSION['products'] ) ) {
			unset( $_SESSION['products'] );
		}
	}

	/**
	 * Delete the product with id from the cart
	 *
	 * @param integer $id <p>id product</p>
	 */
	public static function deleteProduct( $id ) {
		// Get an array with id and quantity of products in the cart
		$productsInCart = self::getProducts();

		// Delete product with id from the array
		unset( $productsInCart[ $id ] );

		// Write an array with deleting product to session
		$_SESSION['products'] = $productsInCart;
	}

}
