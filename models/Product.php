<?php


class Product {

	// Amount products by default
	const SHOW_BY_DEFAULT = 5;

	/*
	 * Return array of last products
	 * @param type $count [optional] <p>Count</p>
	 * @param type $page [optional] <p>Number of current page</p>
	 * @return array <p>Array with products</p>
	 */
	public static function getLatestProducts( $count = self::SHOW_BY_DEFAULT ) {
		$db = Db::getConnection();

		$sql = 'SELECT id, name, price, is_stock FROM product '
		       . 'WHERE status = "1" ORDER BY id DESC '
		       . 'LIMIT :count';

		$result = $db->prepare( $sql );
		$result->bindParam( ':count', $count, PDO::PARAM_INT );


		$result->setFetchMode( PDO::FETCH_ASSOC );

		$result->execute();

		// get and return results
		$i            = 0;
		$productsList = array();
		while ( $row = $result->fetch() ) {
			$productsList[ $i ]['id']       = $row['id'];
			$productsList[ $i ]['name']     = $row['name'];
			$productsList[ $i ]['price']    = $row['price'];
			$productsList[ $i ]['is_stock'] = $row['is_stock'];
			$i ++;
		}

		return $productsList;
	}

	/*
	 * Return list of products with specify category
	 * @param type $categoryId <p>id category</p>
	 * @param type $page [optional] <p>number of page</p>
	 * @return type <p>array with products/p>
	 */
	public static function getProductsListByCategory( $categoryId, $page = 1 ) {
		$limit = Product::SHOW_BY_DEFAULT;
		// offset for query
		$offset = ( $page - 1 ) * self::SHOW_BY_DEFAULT;

		// connect to db
		$db = Db::getConnection();

		$sql = 'SELECT id, name, price, sale_price, is_stock FROM product '
		       . 'WHERE status = 1 AND category_id = :category_id '
		       . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

		$result = $db->prepare( $sql );
		$result->bindParam( ':category_id', $categoryId, PDO::PARAM_INT );
		$result->bindParam( ':limit', $limit, PDO::PARAM_INT );
		$result->bindParam( ':offset', $offset, PDO::PARAM_INT );

		$result->execute();

		$i        = 0;
		$products = array();
		while ( $row = $result->fetch() ) {
			$products[ $i ]['id']         = $row['id'];
			$products[ $i ]['name']       = $row['name'];
			$products[ $i ]['price']      = $row['price'];
			$products[ $i ]['sale_price'] = $row['sale_price'];
			$products[ $i ]['is_stock']   = $row['is_stock'];
			$i ++;
		}

		return $products;
	}


	/**
	 * @param $categoryId
	 * @param int $page
	 *
	 * @return array with products
	 */
	public static function getProductsStockListByCategory( $categoryId, $page = 1 ) {
		$limit = 3;
		// offset for query
		$offset = ( $page - 1 ) * self::SHOW_BY_DEFAULT;

		// connect to db
		$db = Db::getConnection();

		$sql = 'SELECT id, name, price, sale_price, is_stock FROM product '
		       . 'WHERE status = 1 AND category_id = :category_id AND is_stock = 1 '
		       . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

		$result = $db->prepare( $sql );
		$result->bindParam( ':category_id', $categoryId, PDO::PARAM_INT );
		$result->bindParam( ':limit', $limit, PDO::PARAM_INT );
		$result->bindParam( ':offset', $offset, PDO::PARAM_INT );

		$result->execute();

		$i        = 0;
		$products = array();
		while ( $row = $result->fetch() ) {
			$products[ $i ]['id']         = $row['id'];
			$products[ $i ]['name']       = $row['name'];
			$products[ $i ]['price']      = $row['price'];
			$products[ $i ]['sale_price'] = $row['sale_price'];
			$products[ $i ]['is_stock']   = $row['is_stock'];
			$i ++;
		}

		return $products;
	}

	/**
	 * @param $categoryId
	 * @param int $page
	 *
	 * @return array
	 */
	public static function getProductsOutStockListByCategory( $categoryId, $page = 1 ) {
		$limit = 2;
		// offset for query
		$offset = ( $page - 1 ) * self::SHOW_BY_DEFAULT;

		// connect to db
		$db = Db::getConnection();

		$sql = 'SELECT id, name, price, sale_price, is_stock FROM product '
		       . 'WHERE status = 1 AND category_id = :category_id AND is_stock = 0 '
		       . 'ORDER BY id ASC LIMIT :limit OFFSET :offset';

		$result = $db->prepare( $sql );
		$result->bindParam( ':category_id', $categoryId, PDO::PARAM_INT );
		$result->bindParam( ':limit', $limit, PDO::PARAM_INT );
		$result->bindParam( ':offset', $offset, PDO::PARAM_INT );

		$result->execute();

		$i        = 0;
		$products = array();
		while ( $row = $result->fetch() ) {
			$products[ $i ]['id']         = $row['id'];
			$products[ $i ]['name']       = $row['name'];
			$products[ $i ]['price']      = $row['price'];
			$products[ $i ]['sale_price'] = $row['sale_price'];
			$products[ $i ]['is_stock']   = $row['is_stock'];
			$i ++;
		}

		return $products;
	}


	/**
	 * @return array
	 */
	public static function getProducts() {
		$limit = 100;

		$db = Db::getConnection();

		$sql = 'SELECT id, name, price, sale_price, is_stock, category_id FROM product '
		       . 'WHERE status = 1 '
		       . 'ORDER BY id ASC LIMIT :limit';

		$result = $db->prepare( $sql );
		$result->bindParam( ':limit', $limit, PDO::PARAM_INT );

		$result->execute();

		$i        = 0;
		$products = array();
		while ( $row = $result->fetch() ) {
			$products[ $i ]['id']          = $row['id'];
			$products[ $i ]['name']        = $row['name'];
			$products[ $i ]['price']       = $row['price'];
			$products[ $i ]['sale_price']  = $row['sale_price'];
			$products[ $i ]['is_stock']    = $row['is_stock'];
			$products[ $i ]['category_id'] = $row['category_id'];
			$i ++;
		}

		return $products;
	}


	/*
	 * Return product with specify id
	 * @param integer $id <p>id product</p>
	 * @return array <p>Array with info about product</p>
	 */
	public static function getProductById( $id ) {
		$db = Db::getConnection();

		$sql = 'SELECT * FROM product WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		$result->setFetchMode( PDO::FETCH_ASSOC );

		$result->execute();

		return $result->fetch();
	}

	/*
	 * Return count of products in specify category
	 * @param integer $categoryId
	 * @return integer
	 */
	public static function getTotalProductsInCategory( $categoryId ) {
		$db = Db::getConnection();

		$sql = 'SELECT count(id) AS count FROM product WHERE status="1" AND category_id = :category_id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':category_id', $categoryId, PDO::PARAM_INT );

		$result->execute();

		$row = $result->fetch();

		return $row['count'];
	}

	/*
	 * Return list of products with specify ids
	 * @param array $idsArray <p>Array with ids</p>
	 * @return array <p>Array with list of products</p>
	 */
	public static function getProdustsByIds( $idsArray ) {
		$db = Db::getConnection();

		$idsString = implode( ',', $idsArray );

		$sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

		$result = $db->query( $sql );

		$result->setFetchMode( PDO::FETCH_ASSOC );


		$i        = 0;
		$products = array();
		while ( $row = $result->fetch() ) {
			$products[ $i ]['id']         = $row['id'];
			$products[ $i ]['code']       = $row['code'];
			$products[ $i ]['name']       = $row['name'];
			$products[ $i ]['price']      = $row['price'];
			$products[ $i ]['sale_price'] = $row['sale_price'];
			$i ++;
		}

		return $products;
	}


	/**
	 * @param $feature
	 *
	 * @return array
	 */
	public static function getProductsItemByFeatures( $feature ) {
		if ( $feature ) {
			$offset   = 5;
			$db       = Db::getConnection();
			$findList = array();
			$result   = $db->query( "SELECT id,title,image,content,features,date FROM product WHERE features LIKE \"%{$feature}%\"  ORDER BY DATE DESC LIMIT 5 OFFSET {$offset}" );
			$result->setFetchMode( PDO::FETCH_ASSOC );
			$i = 0;
			while ( $row = $result->fetch() ) {
				$a = explode( ', ', $row['features'] );
				foreach ( $a as $b ) {
					if ( $b === $feature ) {
						$findList[ $i ]['id']         = $row['id'];
						$findList[ $i ]['code']       = $row['code'];
						$findList[ $i ]['name']       = $row['name'];
						$findList[ $i ]['price']      = $row['price'];
						$findList[ $i ]['sale_price'] = $row['sale_price'];
						$i ++;
					}
				}
			}

			return $findList;
		}
	}


	/**
	 * @return array
	 */
	public static function getFeatures() {
		$db    = Db::getConnection();
		$limit = 5;

		$sql = 'SELECT features FROM product LIMIT :limit';

		$result = $db->prepare( $sql );
		$result->bindParam( ':limit', $limit, PDO::PARAM_INT );

		$result->execute();

		$i        = 0;
		$features = array();
		while ( $row = $result->fetch() ) {
			$a = explode( ', ', $row['features'] );
			foreach ( $a as $b ) {
				$features[ $i ]['features'] = $row['features'];
				$i ++;
			}
		}

		return $features;
	}


	/**
	 * @param $id
	 *
	 * @return array
	 */
	public static function ShowComments( $id ) {
		$db     = Db::getConnection();
		$result = $db->prepare( 'SELECT com.content,com.parent_id,com.id,com.pluses,com.date,u.name, com.is_recommended FROM comment com,user u WHERE com.product_id=:id AND com.user_id=u.id AND com.visible=1 ORDER BY com.pluses DESC' );
		$result->bindParam( ':id', $id );
		$result->execute();
		$commentsList = $result->fetchAll( PDO::FETCH_ASSOC );

		return $commentsList;
	}


	/**
	 * @param $comment
	 * @param $id
	 * @param $user_id
	 * @param $is_recommended
	 * @param $visible
	 *
	 * @return mixed
	 */
	public static function AddNewsComment( $comment, $id, $user_id, $is_recommended, $visible ) {
		$db     = Db::getConnection();
		$sql    = 'INSERT INTO comment(content,user_id,product_id, is_recommended, visible) VALUES (:content,:user_id,:product_id, :is_recommended, :visible)';
		$result = $db->prepare( $sql );
		$result->bindParam( ':content', $comment );
		$result->bindParam( ':user_id', $user_id );
		$result->bindParam( ':product_id', $id );
		$result->bindParam( ':is_recommended', $is_recommended );
		$result->bindParam( ':visible', $visible );
		$result->execute();

		$res = $db->prepare( 'SELECT id FROM comment WHERE user_id =:user_id AND product_id=:product_id ORDER BY date DESC LIMIT 1' );
		$res->bindParam( ':user_id', $user_id );
		$res->bindParam( ':product_id', $id );
		$res->execute();
		$for = $res->fetch( PDO::FETCH_ASSOC );

		return $for;
	}

	/**
	 * @param $comment
	 * @param $parent_id
	 * @param $user_id
	 * @param $id
	 * @param $visible
	 *
	 * @return mixed
	 */
	public static function AddNewsAnswer( $comment, $parent_id, $user_id, $id, $visible ) {
		$db     = Db::getConnection();
		$sql    = 'INSERT INTO comment(content,user_id,product_id,parent_id, visible) VALUES (:content,:user_id,:product_id,:parent_id,:visible)';
		$result = $db->prepare( $sql );
		$result->bindParam( ':content', $comment );
		$result->bindParam( ':user_id', $user_id );
		$result->bindParam( ':product_id', $id );
		$result->bindParam( ':parent_id', $parent_id );
		$result->bindParam( ':visible', $visible );
		$result->execute();

		$res = $db->prepare( 'SELECT id FROM comment WHERE user_id =:user_id AND product_id=:product_id ORDER BY date DESC LIMIT 1' );
		$res->bindParam( ':user_id', $user_id );
		$res->bindParam( ':product_id', $id );
		$db_res = $res->fetch( PDO::FETCH_ASSOC );

		return $db_res;
	}

	/**
	 * @param $edited_comment
	 * @param $edited_id
	 * @param $user_id
	 *
	 * @return bool
	 */
	public static function EditComment( $edited_comment, $edited_id, $user_id ) {
		$db     = Db::getConnection();
		$sql    = 'UPDATE comment SET content=:content WHERE user_id=:user_id AND id=:edited_id';
		$result = $db->prepare( $sql );
		$result->bindParam( ':content', $edited_comment );
		$result->bindParam( ':user_id', $user_id );
		$result->bindParam( ':edited_id', $edited_id );

		return $result->execute();
	}

	/**
	 * @param $like
	 * @param $dislike
	 * @param $comment_id
	 *
	 * @return bool
	 */
	public static function AddLikes( $like, $dislike, $comment_id ) {
		if ( $like ) {
			$db  = Db::getConnection();
			$res = $db->prepare( 'UPDATE comment SET pluses = pluses + 1 WHERE id=:comment_id' );
			$res->bindParam( ':comment_id', $comment_id );
			$res->execute();
		} elseif ( $dislike ) {
			$db  = Db::getConnection();
			$res = $db->prepare( 'UPDATE comment SET pluses = pluses - 1 WHERE id=:comment_id' );
			$res->bindParam( ':comment_id', $comment_id );
			$res->execute();
		}

		return true;
	}


	/**
	 * @return array
	 */
	public static function getTopCommentProducts() {
		$db          = Db::getConnection();
		$result      = $db->query( 'SELECT p.name,p.id, p.image FROM comment com, product p WHERE com.product_id = p.id ORDER BY count(com.product_id) DESC LIMIT 5;' );
		$topProducts = $result->fetchAll( PDO::FETCH_ASSOC );

		return $topProducts;


	}


	/**
	 * @param $id
	 *
	 * @return mixed
	 */
	public static function getCommentById( $id ) {
		$db = Db::getConnection();

		$sql = 'SELECT * FROM comment WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		$result->setFetchMode( PDO::FETCH_ASSOC );

		$result->execute();

		return $result->fetch();
	}


	/**
	 * @return array
	 */
	public static function getCommentsList() {

		$db = Db::getConnection();

		$result       = $db->query( 'SELECT * FROM comment ORDER BY `date` DESC ' );
		$commentsList = array();
		$i            = 0;
		while ( $row = $result->fetch() ) {
			$commentsList[ $i ]['id']             = $row['id'];
			$commentsList[ $i ]['date']           = $row['date'];
			$commentsList[ $i ]['content']        = $row['content'];
			$commentsList[ $i ]['user_id']        = $row['user_id'];
			$commentsList[ $i ]['product_id']     = $row['product_id'];
			$commentsList[ $i ]['pluses']         = $row['pluses'];
			$commentsList[ $i ]['parent_id']      = $row['product_id'];
			$commentsList[ $i ]['visible']        = $row['visible'];
			$commentsList[ $i ]['is_recommended'] = $row['is_recommended'];

			$i ++;
		}

		return $commentsList;
	}


	/**
	 * @param $options
	 *
	 * @return int|string
	 */
	public static function createComment( $options ) {

		$db = Db::getConnection();

		$sql = 'INSERT INTO comment '
		       . '(content, is_recommended, product_id, visible, user_id)'
		       . 'VALUES '
		       . '(:content, :is_recommended, :product_id, :visible, :user_id)';

		$result = $db->prepare( $sql );
		$result->bindParam( ':content', $options['content'], PDO::PARAM_STR );
		$result->bindParam( ':is_recommended', $options['is_recommended'], PDO::PARAM_INT );
		$result->bindParam( ':product_id', $options['product_id'], PDO::PARAM_INT );
		$result->bindParam( ':visible', $options['visible'], PDO::PARAM_INT );
		$result->bindParam( ':user_id', $options['user_id'], PDO::PARAM_INT );
		if ( $result->execute() ) {
			// if success
			return $db->lastInsertId();
		}

		// if fail
		return 0;
	}


	/**
	 * @param $id
	 * @param $content
	 * @param $visible
	 * @param $is_recommended
	 *
	 * @return bool
	 */
	public static function updateComment( $id, $content, $visible, $is_recommended ) {
		$db = Db::getConnection();

		$sql = "UPDATE comment
            SET 
                content = :content, 
                is_recommended = :is_recommended, 
                visible = :visible
            WHERE id = :id";

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );
		$result->bindParam( ':content', $content, PDO::PARAM_STR );
		$result->bindParam( ':visible', $visible, PDO::PARAM_INT );
		$result->bindParam( ':is_recommended', $is_recommended, PDO::PARAM_INT );

		return $result->execute();
	}


	/**
	 * Return an array with stock products
	 * @return array <p>array with products</p>
	 */
	public static function getStockProducts() {
		$db = Db::getConnection();

		$result       = $db->query( 'SELECT id, name, price, sale_price, is_stock FROM product '
		                            . 'WHERE status = "1" AND is_stock = "1" '
		                            . 'ORDER BY id DESC ' );
		$i            = 0;
		$productsList = array();
		while ( $row = $result->fetch() ) {
			$productsList[ $i ]['id']         = $row['id'];
			$productsList[ $i ]['name']       = $row['name'];
			$productsList[ $i ]['price']      = $row['price'];
			$productsList[ $i ]['sale_price'] = $row['sale_price'];
			$productsList[ $i ]['is_stock']   = $row['is_stock'];
			$i ++;
		}

		return $productsList;
	}

	/**
	 * Return an array with sale products
	 * @return array <p>array with products</p>
	 */
	public static function getSaleProducts() {
		$db = Db::getConnection();

		$result       = $db->query( 'SELECT id, name, price, sale_price, is_sale FROM product '
		                            . 'WHERE status = "1" AND is_sale = "1" '
		                            . 'ORDER BY id DESC' );
		$i            = 0;
		$productsList = array();
		while ( $row = $result->fetch() ) {
			$productsList[ $i ]['id']         = $row['id'];
			$productsList[ $i ]['name']       = $row['name'];
			$productsList[ $i ]['price']      = $row['price'];
			$productsList[ $i ]['sale_price'] = $row['sale_price'];
			$productsList[ $i ]['is_sale']    = $row['is_sale'];
			$i ++;
		}

		return $productsList;
	}

	/**
	 * Return an array with reduction products
	 * @return array <p>array with products</p>
	 */
	public static function getReductionProducts() {
		$db = Db::getConnection();

		$result       = $db->query( 'SELECT id, name, price, sale_price, is_reduction FROM product '
		                            . 'WHERE status = "1" AND is_reduction = "1" '
		                            . 'ORDER BY id DESC' );
		$i            = 0;
		$productsList = array();
		while ( $row = $result->fetch() ) {
			$productsList[ $i ]['id']           = $row['id'];
			$productsList[ $i ]['name']         = $row['name'];
			$productsList[ $i ]['price']        = $row['price'];
			$productsList[ $i ]['sale_price']   = $row['sale_price'];
			$productsList[ $i ]['is_reduction'] = $row['is_reduction'];
			$i ++;
		}

		return $productsList;
	}

	/**
	 * Return list of products
	 * @return array <p>Array with products</p>
	 */
	public static function getProductsList() {
		$db = Db::getConnection();

		$result       = $db->query( 'SELECT id, name, price, sale_price, code FROM product ORDER BY id ASC' );
		$productsList = array();
		$i            = 0;
		while ( $row = $result->fetch() ) {
			$productsList[ $i ]['id']     = $row['id'];
			$productsList[ $i ]['name']   = $row['name'];
			$productsList[ $i ]['code']   = $row['code'];
			$productsList[ $i ]['price']  = $row['price'];
			$products[ $i ]['sale_price'] = $row['sale_price'];
			$i ++;
		}

		return $productsList;
	}

	/*
	 * Delete product with specific id
	 * @param integer $id <p>id product</p>
	 * @return boolean <p>Result</p>
	 */
	public static function deleteProductById( $id ) {
		$db = Db::getConnection();

		$sql = 'DELETE FROM product WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		return $result->execute();
	}

	/*
	 * Edit product with specific id
	 * @param integer $id <p>id product</p>
	 * @param array $options <p>Array with info about the product</p>
	 * @return boolean <p>Result</p>
	 */
	public static function updateProductById( $id, $options ) {
		$db = Db::getConnection();

		$sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                sale_price = :sale_price,
                category_id = :category_id, 
                brand = :brand, 
                features = :features,
                availability = :availability, 
                description = :description, 
                is_stock = :is_stock, 
                is_sale = :is_sale, 
                is_reduction = :is_reduction,
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );
		$result->bindParam( ':name', $options['name'], PDO::PARAM_STR );
		$result->bindParam( ':code', $options['code'], PDO::PARAM_STR );
		$result->bindParam( ':price', $options['price'], PDO::PARAM_STR );
		$result->bindParam( ':sale_price', $options['sale_price'], PDO::PARAM_STR );
		$result->bindParam( ':category_id', $options['category_id'], PDO::PARAM_INT );
		$result->bindParam( ':brand', $options['brand'], PDO::PARAM_STR );
		$result->bindParam( ':features', $options['features'], PDO::PARAM_STR );
		$result->bindParam( ':availability', $options['availability'], PDO::PARAM_INT );
		$result->bindParam( ':description', $options['description'], PDO::PARAM_STR );
		$result->bindParam( ':is_stock', $options['is_stock'], PDO::PARAM_INT );
		$result->bindParam( ':is_reduction', $options['is_reduction'], PDO::PARAM_INT );
		$result->bindParam( ':is_sale', $options['is_sale'], PDO::PARAM_INT );
		$result->bindParam( ':is_recommended', $options['is_recommended'], PDO::PARAM_INT );
		$result->bindParam( ':status', $options['status'], PDO::PARAM_INT );

		return $result->execute();
	}

	/*
	 * Add new product
	 * @param array $options <p>Array with info about new product</p>
	 * @return integer <p>id last insert</p>
	 */
	public static function createProduct( $options ) {

		$db = Db::getConnection();

		$sql = 'INSERT INTO product '
		       . '(name, code, price, sale_price, category_id, is_sale, is_reduction, brand, features, availability,'
		       . 'description, is_stock, is_recommended, status)'
		       . 'VALUES '
		       . '(:name, :code, :price, :sale_price, :category_id, :brand, :features, :availability,'
		       . ':description, :is_stock, :is_sale, :is_reduction, :is_recommended, :status)';

		$result = $db->prepare( $sql );
		$result->bindParam( ':name', $options['name'], PDO::PARAM_STR );
		$result->bindParam( ':code', $options['code'], PDO::PARAM_STR );
		$result->bindParam( ':price', $options['price'], PDO::PARAM_STR );
		$result->bindParam( ':sale_price', $options['sale_price'], PDO::PARAM_STR );
		$result->bindParam( ':category_id', $options['category_id'], PDO::PARAM_INT );
		$result->bindParam( ':brand', $options['brand'], PDO::PARAM_STR );
		$result->bindParam( ':features', $options['features'], PDO::PARAM_STR );
		$result->bindParam( ':availability', $options['availability'], PDO::PARAM_INT );
		$result->bindParam( ':description', $options['description'], PDO::PARAM_STR );
		$result->bindParam( ':is_stock', $options['is_stock'], PDO::PARAM_INT );
		$result->bindParam( ':is_reduction', $options['is_reduction'], PDO::PARAM_INT );
		$result->bindParam( ':is_sale', $options['is_sale'], PDO::PARAM_INT );
		$result->bindParam( ':is_recommended', $options['is_recommended'], PDO::PARAM_INT );
		$result->bindParam( ':status', $options['status'], PDO::PARAM_INT );
		if ( $result->execute() ) {
			// if success
			return $db->lastInsertId();
		}

		// if fail
		return 0;
	}


	/**
	 * @param $availability
	 *
	 * @return string
	 */
	public static function getAvailabilityText( $availability ) {
		switch ( $availability ) {
			case '1':
				return 'В наличии';
				break;
			case '0':
				return 'Под заказ';
				break;
		}
	}


	/**
	 * @param $id
	 *
	 * @return string with path to image
	 */
	public static function getImage( $id ) {
		// Name of image-empty
		$noImage = 'no-image.jpg';

		// Path to the folder with images
		$path = '/upload/images/products/';

		// Path to the folder with product
		$pathToProductImage = $path . $id . '.jpg';

		if ( file_exists( $_SERVER['DOCUMENT_ROOT'] . $pathToProductImage ) ) {
			// if image exist
			// return path to image of product
			return $pathToProductImage;
		}

		// return path of image-empty
		return $path . $noImage;
	}


	public static function getProductsByFilter() {
		$sql = "SELECT * FROM `product`";

		if ( ! empty( $_POST["submit"] ) ) {
			$where = "";
			if ( $_POST["price_start"] ) {
				$where = self::addWhere( $where, "price > '" . htmlspecialchars( $_POST["price_start"] ) ) . "'";
			}
			if ( $_POST["price_end"] ) {
				$where = self::addWhere( $where, "price < '" . htmlspecialchars( $_POST["price_end"] ) ) . "'";
			}
			if ( $_POST["features"] ) {
				$where = self::addWhere( $where, "features LIKE %(" . htmlspecialchars( implode( ",", $_POST["categories"] ) ) . ")%" );
			}
			if ( $_POST["is_stock"] ) {
				$where = self::addWhere( $where, "is_stock = '" . htmlspecialchars( $_POST["is_stock"] ) ) . "'";
			}
			if ( $_POST["is_sale"] ) {
				$where = self::addWhere( $where, "is_sale = '" . htmlspecialchars( $_POST["is_sale"] ) ) . "'";
			}
			if ( $_POST["is_reduction"] ) {
				$where = self::addWhere( $where, "is_reduction = '" . htmlspecialchars( $_POST["is_reduction"] ) ) . "'";
			}


			if ( $where ) {
				$sql .= " WHERE $where";
			}


			$db = Db::getConnection();

			$result       = $db->query( $sql );
			$productsList = array();
			$i            = 0;
			while ( $row = $result->fetch() ) {
				$productsList[ $i ]['id']         = $row['id'];
				$productsList[ $i ]['name']       = $row['name'];
				$productsList[ $i ]['price']      = $row['price'];
				$productsList[ $i ]['sale_price'] = $row['sale_price'];
				$productsList[ $i ]['is_stock']   = $row['is_stock'];
				$i ++;
			}

			return $productsList;


		}


	}


	public static function addWhere( $where, $add, $and = true ) {
		if ( $where ) {
			if ( $and ) {
				$where .= " AND $add";
			} else {
				$where .= " OR $add";
			}
		} else {
			$where = $add;
		}

		return $where;
	}


	/* Return array with search result
	 *
	 */
	public static function resultSearch() {

		$db = Db::getConnection();
		if ( ! empty( $_GET['query'] ) ) {
			$query   = (string) $_GET['query'];
			$array   = array();
			$request = $db->query( "SELECT `name` FROM `product` WHERE `name` LIKE '%" . $db->real_escape_string( $query ) . "%' OR `name` LIKE '%" . $db->real_escape_string( $query ) . "%' LIMIT 0, 10" );
			while ( $data = $db->fetch_assoc( $request ) ) {
				$array[] = $data['name'];
			}

			echo "['" . implode( "','", $array ) . "']";
		}
		exit();

	}


	public static function getSearch () {
		$search = '';

		if ( $_POST['search'] ) {
			$search = $_POST['search'];
		}
		if ( $search == '' ) {
			exit( "Начните вводить запрос" );
		}

		$db  = Db::getConnection();
		$sql = $db->query( "SELECT features FROM product WHERE features LIKE \"%{$search}%\"" );
		if ( $sql->rowCount() > 0 ) {
			$i     = 0;
			$finds = [];
			while ( $row = $sql->fetch() ) {
				$finds[ $i ]['features'] = explode( ', ', $row['features'] );
				$i ++;
			}
			$tags_for_filter = [];
			foreach ( $finds as $find ) {
				foreach ( $find['features'] as $find_tag ) {
					$tags_for_filter[] = $find_tag;
				}

			}

			return $tags_for_filter;
		}

	}
}
