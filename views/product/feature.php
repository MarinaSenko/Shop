<?php include ROOT . '/views/layouts/header.php'; ?>

	<section>
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="/">Главная</a></li>
					<li class="active">Категории</li>
				</ol>
			</div>
			<div class="row">
				<?php include ROOT . '/views/layouts/side_bar.php'; ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Товары</h2>

						<?php foreach ( $findList as $product ): ?>
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo Product::getImage( $product['id'] ); ?>" alt=""/>
											<h2><?php echo $product['price']; ?></h2>
											<p>
												<a href="/product/<?php echo $product['id']; ?>">
													<?php echo $product['name']; ?>
												</a>
											</p>

											<a href="#" data-id="<?php echo $product['id']; ?>"
											   class="btn btn-default add-to-cart">
												<i class="fa fa-shopping-cart"></i>В корзину
											</a>
										</div>
										<?php if ( $product['is_stock'] ): ?>
											<img src="/template/images/home/sale.png" class="new" alt=""/>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>

					</div><!--features_items-->


				</div>
			</div>
		</div>
	</section>

<?php include ROOT . '/views/layouts/footer.php'; ?><?php
/**
 * Created by PhpStorm.
 * User: marina
 * Date: 15.12.16
 * Time: 17:32
 */