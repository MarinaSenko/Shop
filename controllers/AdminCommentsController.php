<?php


class adminCommentsController extends AdminBase {

	/**Action for Admin dashboard section comments'
	 * @return bool
	 */
	public function actionIndex() {
		//Check access
		self::checkAdmin();

		//Get list of comments
		$commentsList = Product::getCommentsList();

		require_once( ROOT . '/views/admin_comments/index.php' );

		return true;
	}


	/**Action for admin dashboard 'add comment'
	 * @return bool
	 */
	public function actionCreate() {
		//Check access
		self::checkAdmin();
		//Get id
		$user_id = User::checkLogged();

		if ( isset( $_POST['submit'] ) ) {
			$options['user_id']        = $user_id;
			$options['content']        = $_POST['content'];
			$options['is_recommended'] = $_POST['is_recommended'];
			$options['product_id']     = $_POST['product_id'];
			$options['visible']        = $_POST['visible'];

			$errors = false;

			if ( ! isset( $options['content'] ) || empty( $options['content'] ) ) {
				$errors[] = 'Заполните поля';
			}

			if ( $errors == false ) {
				$id = Product::createComment( $options );
				header( "Location: /admin/comments" );
			}
		}

		require_once( ROOT . '/views/admin_comments/create.php' );

		return true;
	}


	/**Action for admin dashboard 'edit comment'
	 *
	 * @param $id
	 *
	 * @return bool
	 */
	public function actionUpdate( $id ) {
		//Check access
		self::checkAdmin();

		$comment = Product::getCommentById( $id );

		if ( isset( $_POST['submit'] ) ) {
			$content        = $_POST['content'];
			$is_recommended = $_POST['is_recommended'];
			$visible        = $_POST['visible'];

			Product::updateComment( $id, $content, $visible, $is_recommended );

			header( "Location: /admin/comments" );
		}


		require_once( ROOT . '/views/admin_comments/update.php' );

		return true;
	}


}