<?php

class AdminCategoryController extends AdminBase {

	/**
	 * Action for page "Manage categories"
	 */
	public function actionIndex() {
		// Checking access
		self::checkAdmin();

		// Get list of categories
		$categoriesList = Category::getCategoriesListAdmin();

		// Include the view
		require_once( ROOT . '/views/admin_category/index.php' );

		return true;
	}

	/**
	 * Action for page "Add category"
	 */
	public function actionCreate() {
		// Checking access
		self::checkAdmin();

		// forms processing
		if ( isset( $_POST['submit'] ) ) {
			// if form submit
			// get data from form
			$name      = $_POST['name'];
			$sortOrder = $_POST['sort_order'];
			$status    = $_POST['status'];

			// flag form errors
			$errors = false;

			// Validation
			if ( ! isset( $name ) || empty( $name ) ) {
				$errors[] = 'Заполните поля';
			}


			if ( $errors == false ) {
				// If no errors
				// Add new category
				Category::createCategory( $name, $sortOrder, $status );

				// redirect to page "Manage categories"
				header( "Location: /admin/category" );
			}
		}

		require_once( ROOT . '/views/admin_category/create.php' );

		return true;
	}

	/**
	 * Action for page "Edit category"
	 */
	public function actionUpdate( $id ) {
		// Checking access
		self::checkAdmin();

		// Get data about category
		$category = Category::getCategoryById( $id );


		if ( isset( $_POST['submit'] ) ) {
			$name      = $_POST['name'];
			$sortOrder = $_POST['sort_order'];
			$status    = $_POST['status'];


			Category::updateCategoryById( $id, $name, $sortOrder, $status );
			header( "Location: /admin/category" );
		}


		require_once( ROOT . '/views/admin_category/update.php' );

		return true;
	}

	/**
	 * Action for page "Delete category"
	 */
	public function actionDelete( $id ) {
		// Checking access
		self::checkAdmin();

		if ( isset( $_POST['submit'] ) ) {
			Category::deleteCategoryById( $id );
			header( "Location: /admin/category" );
		}

		require_once( ROOT . '/views/admin_category/delete.php' );

		return true;
	}

}
