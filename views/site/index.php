<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">

			<!--Подключаем сайд-бар с категориями-->

			<?php include ROOT . '/views/layouts/side_bar.php'; ?>

			<!--Выводим категории и товары в категории: 2 из раздела акция и 3 случайных-->

			<div class="col-sm-9 padding-right">
				<div class="features_items">
					<h2 class="title text-center"> Товары</h2>


					<?php foreach ( $categories as $category ): ?>


						<div class="col-sm-12 text-center">
							<h4 "panel-title">
							<a href="/category/<?php echo $category['id']; ?>">
								<?php echo $category['name']; ?></a>
							<br>

							</h4>
						</div>


						<?php $i = 0;
						$j = 0 ?>
						<?php foreach ( $products as $product ): ?>
							<?php if ( $category['id'] == $product['category_id'] ): ?>
								<?php if ( $product['is_stock'] && $i < 2 ): ?>
									<div class="col-sm-4">
										<div class="item">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">


														<img src="<?php echo Product::getImage( $product['id'] ); ?>"
														     alt=""
														     style="width: 200px"/>
														<?php if ( $product['sale_price'] ): ?>
															<h6 style="color: #393B3B; font-size: 10px">Старая
																цена: <?php echo( $product['price'] ); ?></h6>
															<h4 style="font-size: 16px; color: crimson">Новая
																цена: <?php echo( $product['sale_price'] ); ?></h4>
														<?php else: ?>
															<h4>Цена: <?php echo( $product['price'] ); ?></h4>
														<?php endif; ?>
														<a href="/product/<?php echo $product['id']; ?>">
															<?php echo $product['name']; ?>
														</a>
														<br>
														<br>
														<a href="#" data-id="<?php echo $product['id']; ?>"
														   class="btn btn-default add-to-cart">
															<i class="fa fa-shopping-cart"></i>В корзину</a>

														<?php $i ++ ?>


													</div>
												</div>
											</div>
										</div>
									</div>

								<?php endif; ?>


								<?php if ( ( $product['is_stock'] == 0 ) && $j < 3 ): ?>
									<div class="col-sm-4">
										<div class="item">
											<div class="product-image-wrapper">
												<div class="single-products">
													<div class="productinfo text-center">


														<img src="<?php echo Product::getImage( $product['id'] ); ?>"
														     alt=""
														     style="width: 200px"/>
														<?php if ( $product['sale_price'] ): ?>
															<h6 style="color: #393B3B; font-size: 10px">Старая
																цена: <?php echo( $product['price'] ); ?></h6>
															<h4 style="font-size: 16px; color: crimson">Новая
																цена: <?php echo( $product['sale_price'] ); ?></h4>
														<?php else: ?>
															<h4>Цена: <?php echo( $product['price'] ); ?></h4>
														<?php endif; ?>
														<a href="/product/<?php echo $product['id']; ?>">
															<?php echo $product['name']; ?>
														</a>
														<br>
														<br>
														<a href="#" data-id="<?php echo $product['id']; ?>"
														   class="btn btn-default add-to-cart">
															<i class="fa fa-shopping-cart"></i>В корзину</a>

														<?php $j ++ ?>


													</div>
												</div>
											</div>
										</div>
									</div>

								<?php endif; ?>

							<?php endif; ?>


						<?php endforeach; ?>

					<?php endforeach; ?>
				</div>


				<!-- Слайдер акционных товаров -->

				<div class="recommended_items">
					<h2 class="title text-center">Акционные товары</h2>

					<div class="cycle-slideshow"
					     data-cycle-fx=carousel
					     data-cycle-timeout=5000
					     data-cycle-carousel-visible=3
					     data-cycle-carousel-fluid=true
					     data-cycle-slides="div.item"
					     data-cycle-prev="#prev"
					     data-cycle-next="#next"
					>


						<?php for ( $i = 0; $i < 4; $i ++ ): ?>
							<?php $count = count( $sliderProducts ); ?>
							<?php $number = rand( 0, $count ); ?>
							<div class="item">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<img
												src="<?php echo Product::getImage( $sliderProducts[ $number ]['id'] ); ?>"
												alt=""/>
											<?php if ( $sliderProducts[ $number ]['sale_price'] ): ?>
												<h6 style="color: #393B3B; font-size: 10px"> Старая
													цена: <?php echo( $sliderProducts[ $number ]['price'] ); ?></h6>
												<h4 style="font-size: 16px; color: crimson">Новая
													цена: <?php echo( $sliderProducts[ $number ]['sale_price'] ); ?></h4>
											<?php else: ?>
												<h4>Цена: <?php echo( $sliderProducts[ $number ]['price'] ); ?></h4>
											<?php endif; ?>
											<a href="/product/<?php echo $sliderProducts[ $number ]['id']; ?>">
												<?php echo $sliderProducts[ $number ]['name']; ?>
											</a>
											<br/><br/>
										</div>
										<?php if ( $sliderProducts[ $number ]['is_stock'] ): ?>
											<img src="/template/images/home/sale.png" class="new" alt=""/>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endfor; ?>
					</div>

					<a class="left recommended-item-control" id="prev" href="#recommended-item-carousel"
					   data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a class="right recommended-item-control" id="next" href="#recommended-item-carousel"
					   data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>


					<h2 class="title text-center">ТОП-5 товаров</h2>


					<?php foreach ( $topProducts as $product ): ?>


						<div class="col-sm-4">
							<div class="item">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">


											<img src="<?php echo Product::getImage( $product['id'] ); ?>" alt=""
											     style="width: 200px"/>
											<a href="/product/<?php echo $product['id']; ?>">
												<?php echo $product['name']; ?>
											</a>

											<?php $i ++ ?>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php endforeach; ?>


				</div>
			</div>

		</div>
	</div>


</section>

<!--Подключаем футер-->


<?php include ROOT . '/views/layouts/footer.php'; ?>


