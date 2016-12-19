<?php

class Category {

	/** Return list of categories
	 * @return array
	 */
	public static function getCategoriesList() {
		$db = Db::getConnection();

		$result = $db->query( 'SELECT id, name FROM category  WHERE status = "1" ORDER BY sort_order, name ASC' );

		$i            = 0;
		$categoryList = array();
		while ( $row = $result->fetch() ) {
			$categoryList[ $i ]['id']   = $row['id'];
			$categoryList[ $i ]['name'] = $row['name'];
			$i ++;
		}

		return $categoryList;
	}

	/** Return list of subcategories
	 * @return array
	 */
	public static function getSubCategoriesList() {
		$db = Db::getConnection();

		$result = $db->query( 'SELECT id, name, category_id FROM subcategory ORDER BY name ASC' );

		$i               = 0;
		$subcategoryList = array();
		while ( $row = $result->fetch() ) {
			$subcategoryList[ $i ]['id']          = $row['id'];
			$subcategoryList[ $i ]['name']        = $row['name'];
			$subcategoryList[ $i ]['category_id'] = $row['category_id'];
			$i ++;
		}

		return $subcategoryList;
	}

	/** Return list of categories for admin dashboard
	 * @return array
	 */
	public static function getCategoriesListAdmin() {
		$db = Db::getConnection();

		$result = $db->query( 'SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC' );

		$categoryList = array();
		$i            = 0;
		while ( $row = $result->fetch() ) {
			$categoryList[ $i ]['id']         = $row['id'];
			$categoryList[ $i ]['name']       = $row['name'];
			$categoryList[ $i ]['sort_order'] = $row['sort_order'];
			$categoryList[ $i ]['status']     = $row['status'];
			$i ++;
		}

		return $categoryList;
	}

	/** Delete category by Id
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public static function deleteCategoryById( $id ) {
		$db = Db::getConnection();

		$sql = 'DELETE FROM category WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		return $result->execute();
	}

	/** Editing category by id
	 *
	 * @param $id
	 * @param $name
	 * @param $sortOrder
	 * @param $status
	 *
	 * @return bool
	 */
	public static function updateCategoryById( $id, $name, $sortOrder, $status ) {
		$db = Db::getConnection();

		$sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );
		$result->bindParam( ':name', $name, PDO::PARAM_STR );
		$result->bindParam( ':sort_order', $sortOrder, PDO::PARAM_INT );
		$result->bindParam( ':status', $status, PDO::PARAM_INT );

		return $result->execute();
	}

	/** Return category by Id
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public static function getCategoryById( $id ) {
		$db = Db::getConnection();

		$sql = 'SELECT * FROM category WHERE id = :id';

		$result = $db->prepare( $sql );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		$result->setFetchMode( PDO::FETCH_ASSOC );

		$result->execute();

		return $result->fetch();
	}

	/**Return status view of product
	 *
	 * @param $status
	 *
	 * @return string
	 */
	public static function getStatusText( $status ) {
		switch ( $status ) {
			case '1':
				return 'Отображается';
				break;
			case '0':
				return 'Скрыта';
				break;
		}
	}

	/** Adding new category
	 *
	 * @param $name
	 * @param $sortOrder
	 * @param $status
	 *
	 * @return bool
	 */
	public static function createCategory( $name, $sortOrder, $status ) {
		$db = Db::getConnection();

		$sql = 'INSERT INTO category (name, sort_order, status) '
		       . 'VALUES (:name, :sort_order, :status)';

		$result = $db->prepare( $sql );
		$result->bindParam( ':name', $name, PDO::PARAM_STR );
		$result->bindParam( ':sort_order', $sortOrder, PDO::PARAM_INT );
		$result->bindParam( ':status', $status, PDO::PARAM_INT );

		return $result->execute();
	}


}