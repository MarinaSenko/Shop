<?php include ROOT . '/views/layouts/header.php'; ?>

	<section>
		<div class="container">
			<div class="row">
				<?php include ROOT . '/views/layouts/side_bar.php'; ?>

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Товары</h2>

						<div class="panel panel-default panel-group category-products">


							<form name="form" action="" method="post">
								<label for="price_start">Цена от</label>
								<input type="text" name="price_start"/></td>

								<label for="price_end">Цена до</label>
								<input type="text" name="price_end"/></td>
								<br>
								<br>
								<label for="">Категории</label>
								<br>
								<?php foreach ( $categories as $categoryItem ): ?>

									<input type="checkbox" name="categories[]"
									       value="<?php echo $categoryItem['id'] ?>"/>
									<label for="category_name"><?php echo $categoryItem['name']; ?></label>
									<br>
								<?php endforeach; ?>
								<br>
								<label for="">Характеристики</label>
								<br>

								<?php foreach ( $features as $feature ): ?>
									<?php if ( $feature['features'] ): ?>
										<?php $featuresArray = explode( ',', $feature['features'] ); ?>
										<?php foreach ( $featuresArray as $char ): ?>

											<input type="checkbox" name="features[]" value="<?php echo $char; ?>"/>
											<label for="category_name"><?php echo $char; ?></label>
											<br>
										<?php endforeach; ?>

									<?php endif; ?>
								<?php endforeach; ?>
								<br>
								<input type="checkbox" name="is_stock" value="1"/></td>
								<label for="is_stock">Акция</label>
								<br>

								<br>
								<input type="checkbox" name="is_sale" value="1"/></td>
								<label for="is_stock">Распродажа</label>
								<br>

								<br>
								<input type="checkbox" name="is_reduction" value="1"/></td>
								<label for="is_reduction">Уценка</label>
								<br>

								<input class="btn btn-default" type="submit" name="submit" value="Применить фильтр">

							</form>
						</div>


						<?php

						echo var_dump( $_REQUEST['features'] );

						?>




						<?php if ( isset( $_POST['submit'] ) ): ?>

							<?php foreach ( $productsByFilter as $product ): ?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo Product::getImage( $product['id'] ); ?>" alt=""/>
												<?php if ( $product['sale_price'] ): ?>
													<h6>Старая цена: <?php echo( $product['price'] ); ?></h6>
													<h2>Новая цена: <?php echo( $product['sale_price'] ); ?></h2>
												<?php else: ?>
													<h2>Цена: <?php echo( $product['price'] ); ?></h2>
												<?php endif; ?>
												<p>
													<a href="/product/<?php echo $product['id']; ?>">
														<?php echo $product['name']; ?>
													</a>
												</p>
												<a href="/cart/add/<?php echo $product['id']; ?>"
												   class="btn btn-default add-to-cart"
												   data-id="<?php echo $product['id']; ?>"><i
														class="fa fa-shopping-cart"></i>В корзину</a>
											</div>
											<?php if ( $product['is_stock'] ): ?>
												<img src="/template/images/home/sale.png" class="new" alt=""/>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>

						<?php endif; ?>

					</div><!--features_items-->


				</div>
			</div>
		</div>

	</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>