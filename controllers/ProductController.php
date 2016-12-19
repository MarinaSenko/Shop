<?php


class ProductController {
	/** Action for view of single product
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public function actionView( $id ) {
		$categories    = Category::getCategoriesList();
		$subcategories = Category::getSubCategoriesList();
		$product       = Product::getProductById( $id );

		// section comments
		if ( $id ) {
			$product = Product::getProductById( $id );
			// check for user in session
			if ( $_SESSION['user'] ) {
				if ( isset( $_POST['submit'] ) ) {
					$comment        = $_POST['comment'];
					$user_id        = $_SESSION['user'];
					$is_recommended = $_POST['is_recommended'];
					if ( $is_recommended ) {
						$visible = 1;
					} else {
						$visible = 0;
					}
					// adding options from form to db
					$result = Product::AddNewsComment( $comment, $id, $user_id, $is_recommended, $visible );
					// set cookie for editing during 1 minute
					setcookie( 'user', $user_id, time() + 60 );
					setcookie( 'comment_id', $result['id'], time() + 60 );
					header( 'Location: /product/' . $id );
				}
				if ( isset( $_POST['submit_parent'] ) ) {
					$comment   = $_POST['comment_for'];
					$parent_id = $_POST['parent_id'];
					$user_id   = $_SESSION['user'];
					$visible   = $_POST['visible'];
					$answer_id = Product::AddNewsAnswer( $comment, $parent_id, $user_id, $id, $visible );
					// set cookie for editing during 1 minute
					setcookie( 'user', $user_id, time() + 60 );
					setcookie( 'comment_id', $answer_id['id'], time() + 60 );
					header( 'Location:/product/' . $id );
				}
				if ( isset( $_POST['edited_submit'] ) ) {
					$edited_comment = $_POST['edited_comment'];
					$edited_id      = $_POST['edited_id'];
					$user_id        = $_SESSION['user'];
					Product::EditComment( $edited_comment, $edited_id, $user_id );
				}
			}
			$commentsList  = Product::ShowComments( $id );
			$comment_child = Product::ShowComments( $id );
			if ( ( isset( $_POST['like'] ) ) || ( isset( $_POST['dislike'] ) ) ) {
				$like       = isset( $_POST['like'] ) ? $_POST['like'] : 0;
				$dislike    = isset( $_POST['dislike'] ) ? $_POST['dislike'] : 0;
				$comment_id = $_POST['comment_id'];
				// section of likes and dislikes
				Product::AddLikes( $like, $dislike, $comment_id );
				header( "Location: /product/{$id}" );

			}

			require_once( ROOT . '/views/product/view.php' );
		}

		return true;
	}


	/** Action for page ...
	 *
	 * @param $feature
	 *
	 * @return bool
	 */
	public function actionFeatures( $feature ) {

		$findList = Product::getProductsItemByFeatures( $feature );

		require_once( ROOT . '/views/product/feature.php' );

		return true;
	}


	/**Action for filter (доработать)
	 * @return bool
	 */
	public function actionFilter() {
		$productsByFilter = Product::getProductsByFilter();
		$categories       = Category::getCategoriesList();
		$subcategories    = Category::getSubCategoriesList();

		$features = Product::getFeatures();


		require_once( ROOT . '/views/product/filter.php' );

		return true;
	}


	/*Search with ajax
	 * @param $id
	 *
	 * @return bool
	 */
	public static function actionAddAjax() {

		$result = Product::resultSearch();

		return true;
	}

}
