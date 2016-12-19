<?php

class Order {


	/** Save order
	 *
	 * @param $userName
	 * @param $userPhone
	 * @param $userComment
	 * @param $userId
	 * @param $products
	 *
	 * @return bool
	 */
	public static function save( $userName, $userPhone, $userComment, $userId, $products ) {
		// Connect to db
		$db = Db::getConnection();

		// text of query to db
		$sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
		       . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

		$products = json_encode( $products );

		$result = $db->prepare( $sql );
		$result->bindParam( ':user_name', $userName, PDO::PARAM_STR );
		$result->bindParam( ':user_phone', $userPhone, PDO::PARAM_STR );
		$result->bindParam( ':user_comment', $userComment, PDO::PARAM_STR );
		$result->bindParam( ':user_id', $userId, PDO::PARAM_STR );
		$result->bindParam( ':products', $products, PDO::PARAM_STR );

		return $result->execute();
	}


	/**
	 * @return array with orders
	 */
	public static function getOrdersList() {

		$db = Db::getConnection();

		$result     = $db->query( 'SELECT * FROM product_order ORDER BY id DESC' );
		$ordersList = array();
		$i          = 0;
		while ( $row = $result->fetch() ) {
			$ordersList[ $i ]['id']         = $row['id'];
			$ordersList[ $i ]['user_name']  = $row['user_name'];
			$ordersList[ $i ]['user_id']    = $row['user_id'];
			$ordersList[ $i ]['user_phone'] = $row['user_phone'];
			$ordersList[ $i ]['date']       = $row['date'];
			$ordersList[ $i ]['status']     = $row['status'];
			$ordersList[ $i ]['products']   = $row['products'];
			$i ++;
		}

		return $ordersList;
	}


	/** Return status of order
	 *
	 * @param $status
	 *
	 * @return string
	 */
	public static function getStatusText( $status ) {
		switch ( $status ) {
			case '1':
				return 'Новый заказ';
				break;
			case '2':
				return 'В обработке';
				break;
			case '3':
				return 'Доставляется';
				break;
			case '4':
				return 'Закрыт';
				break;
		}
	}


	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public static function getOrderById( $id ) {

		$db = Db::getConnection();


		$sql = 'SELECT * FROM product_order WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		// data in array
		$result->setFetchMode( PDO::FETCH_ASSOC );

		$result->execute();

		// return data
		return $result->fetch();
	}

	/** Delete order by Id
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public static function deleteOrderById( $id ) {
		$db = Db::getConnection();

		$sql = 'DELETE FROM product_order WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		return $result->execute();
	}


	/** Edit order by id
	 *
	 * @param $id
	 * @param $userName
	 * @param $userPhone
	 * @param $userComment
	 * @param $date
	 * @param $status
	 *
	 * @return bool
	 */
	public static function updateOrderById( $id, $userName, $userPhone, $userComment, $date, $status ) {
		$db = Db::getConnection();

		$sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );
		$result->bindParam( ':user_name', $userName, PDO::PARAM_STR );
		$result->bindParam( ':user_phone', $userPhone, PDO::PARAM_STR );
		$result->bindParam( ':user_comment', $userComment, PDO::PARAM_STR );
		$result->bindParam( ':date', $date, PDO::PARAM_STR );
		$result->bindParam( ':status', $status, PDO::PARAM_INT );

		return $result->execute();
	}

}
