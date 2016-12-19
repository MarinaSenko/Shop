<?php

class CatalogController {

	/**
	 * Action for page products in catalog
	 */
	public function actionIndex() {
		$categories = Category::getCategoriesList();

		$latestProducts = Product::getLatestProducts( 12 );

		require_once( ROOT . '/views/catalog/index.php' );

		return true;
	}

	/**
	 * Action for page products of category
	 */
	public function actionCategory( $categoryId, $page = 1 ) {
		$categories       = Category::getCategoriesList();
		$subcategories    = Category::getSubCategoriesList();
		$categoryProducts = Product::getProductsListByCategory( $categoryId, $page );
		// total products for pagination
		$total      = Product::getTotalProductsInCategory( $categoryId );
		$pagination = new Pagination( $total, $page, Product::SHOW_BY_DEFAULT, 'page-' );

		require_once( ROOT . '/views/catalog/category.php' );

		return true;
	}


	/**
	 * Action for page 'Sale'
	 */
	public function actionSale() {
		$categories    = Category::getCategoriesList();
		$saleProducts  = Product::getSaleProducts();
		$subcategories = Category::getSubCategoriesList();

		require_once( ROOT . '/views/catalog/sale.php' );

		return true;
	}

	/**
	 * Action for page Stock
	 */
	public function actionStock() {
		$categories    = Category::getCategoriesList();
		$stockProducts = Product::getStockProducts();
		$subcategories = Category::getSubCategoriesList();

		require_once( ROOT . '/views/catalog/stock.php' );

		return true;
	}

	/**
	 * Action for page 'Reduction'
	 */
	public function actionReduction() {
		$categories        = Category::getCategoriesList();
		$subcategories     = Category::getSubCategoriesList();
		$reductionProducts = Product::getReductionProducts();

		require_once( ROOT . '/views/catalog/reduction.php' );

		return true;
	}

}
