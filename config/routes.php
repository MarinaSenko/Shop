<?php

return array(


	// Product:
	'product/([0-9]+)'                => 'product/view/$1', // actionView в ProductController
	'product/filter'                  => 'product/filter',
	'product/addAjax'                 =>'product/addAjax', // actionAddAjax в CartController
	"features/([a-z]+)/([0-9]+)"      => "product/features/$1/$2",
	"features/([a-z]+)"               => "product/features/$1/1",

	// Catalog:
	'catalog'                         => 'catalog/index', // actionIndex в CatalogController

	//Categories:
	'category/sale'                   => 'catalog/sale',
	'category/stock'                  => 'catalog/stock',
	'category/reduction'              => 'catalog/reduction',
	'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController
	'category/([0-9]+)'               => 'catalog/category/$1', // actionCategory в CatalogController


	// Cart:
	'cart/checkout'                   => 'cart/checkout', // actionAdd в CartController
	'cart/delete/([0-9]+)'            => 'cart/delete/$1', // actionDelete в CartController
	'cart/add/([0-9]+)'               => 'cart/add/$1', // actionAdd в CartController
	'cart/addAjax/([0-9]+)'           => 'cart/addAjax/$1', // actionAddAjax в CartController
	'cart'                            => 'cart/index', // actionIndex в CartController

	// User:

	'user/register' => 'user/register',
	'user/login'    => 'user/login',
	'user/logout'   => 'user/logout',


	'cabinet/history/([0-9]+)' => 'cabinet/history/$1',
	'cabinet/edit'             => 'cabinet/edit',
	'cabinet'                  => 'cabinet/index',


	// Manage background

	'admin/style'                    => 'admin/style',
	'admin/menu'                     => 'admin/menu',


	// Manage comments
	'admin/comments/update/([0-9]+)' => 'adminComments/update/$1',
	'admin/comments/create'          => 'adminComments/create',

	'admin/comments/delete/([0-9]+)' => 'adminComments/delete/$1',
	'admin/comments'                 => 'adminComments/index',


	// Manage products:
	'admin/product/create'           => 'adminProduct/create',
	'admin/product/update/([0-9]+)'  => 'adminProduct/update/$1',
	'admin/product/delete/([0-9]+)'  => 'adminProduct/delete/$1',
	'admin/product'                  => 'adminProduct/index',

	//Manage categories:
	'admin/category/create'          => 'adminCategory/create',
	'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
	'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
	'admin/category'                 => 'adminCategory/index',

	// Manage orders:
	'admin/order/update/([0-9]+)'    => 'adminOrder/update/$1',
	'admin/order/delete/([0-9]+)'    => 'adminOrder/delete/$1',
	'admin/order/view/([0-9]+)'      => 'adminOrder/view/$1',
	'admin/order'                    => 'adminOrder/index',

	// Dashboard:
	'admin'                          => 'admin/index',

	// About shop
	'contacts'                       => 'site/contact',
	'about'                          => 'site/about',

	// Main page
	'index.php'                      => 'site/index', // actionIndex в SiteController
	''                               => 'site/index', // actionIndex в SiteController
);
