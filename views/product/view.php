<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
	<div class="container">
		<div class="row">

			<?php include ROOT . '/views/layouts/side_bar.php'; ?>

			<div class="col-sm-9 padding-right">
				<div class="product-details"><!--product-details-->
					<div class="row">
						<div class="col-sm-5">
							<div class="view-product">
								<img src="<?php echo Product::getImage( $product['id'] ); ?>" alt=""/>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->


								<h2><?php echo $product['name']; ?></h2>
								<p>Код товара: <?php echo $product['code']; ?></p>
								<span>
                                    <span><?php echo $product['price']; ?></span>
                                    <a href="#" data-id="<?php echo $product['id']; ?>"
                                       class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </span>
								<p>
									<b>Наличие:</b> <?php echo Product::getAvailabilityText( $product['availability'] ); ?>
								</p>
								<p><b>Производитель:</b> <?php echo $product['brand']; ?></p>
							</div><!--/product-information-->
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<br/>
							<h5>Описание товара</h5>
							<?php echo $product['description']; ?>
						</div>
					</div>
				</div><!--/product-details-->


				<!-- Comments -->

				<hr>

				<h2 class="title text-center">Комментарии</h2>
				<?php if ( isset( $_SESSION['user'] ) ): ?>
					<form action="#" method="post">
						<textarea name='comment' placeholder="Оставьте ваш комментарий"></textarea>
						<br>
						<input type='hidden' name='page_id' value="<?php echo $product['id']; ?>">

						<input type="radio" name="is_recommended" id="is_recommended" value="1"><label
							for="is_recommended"> Рекомендую</label>
						<input type="radio" name="is_recommended" id="is_recommended" value="0"><label
							for="is_recommended"> Не рекомендую</label>

						<?php if ( $_POST['is_recommended'] == 0 ): ?>

							<input type="hidden" name="visible" id="visible" value="0">

						<?php elseif ( $_POST['is_recommended'] == 1 ): ?>

							<input type="hidden" name="visible" id="visible" value="1">

						<?php endif; ?>
						<br>
						<input type="submit" name='submit' value="отправить" class="btn btn-group-sm">
					</form>
				<?php else: ?>
					<p class=" alert alert-warning center"><a href="/user/login">Войдите</a>, чтобы оставлять
						комментарии</p>
				<?php endif; ?>
				<?php if ( ! $commentsList ): ?>
					<h5 class="center">Еще никто не оставил комментарий</h5>
				<?php endif; ?>
				<br>
				<br>


				<?php foreach ( $commentsList as $comment ): ?>
					<?php if ( $comment['parent_id'] == null ): ?>
						<div class="panel panel-success">
							<div class="panel-heading">
								<p class="panel-title"><?php echo $comment['name']; ?> оставил
									комментарий <?php echo $comment['date']; ?></p>
							</div>
							<div class="panel-body">
								<p><?php echo $comment['is_recommended'] ? 'Рекомендую!' : 'Не рекомендую!'; ?></p>
								<?php echo $comment['content']; ?>
							</div>
							<div class="panel-heading">
								<p>Рейтинг: <?php echo $comment['pluses']; ?></p>
								<form action="" method="post">
									<input type="submit" name="like" class="btn btn-xs btn-success" value="Нравится">
									<input type="submit" name="dislike" class="btn btn-xs btn-danger"
									       value="Не нравится">
									<input type='hidden' name='comment_id' value="<?php echo $comment['id']; ?>">
								</form>
								<br>

								<input type="button" class="btn btn-sm btn-default spoiler-title" value="ответить">

								<?php if ( isset( $_SESSION['user'] ) ): ?>
									<div class="spoiler-body">
										<br>
										<form method="post">
											<textarea name='comment_for'
											          placeholder="Оставьте ваш комментарий"></textarea>
											<br>
											<input type='hidden' name='parent_id' value="<?php echo $comment['id']; ?>">
											<input type="radio" name="is_recommended" id="is_recommended"
											       value="1"><label for="is_recommended">Рекомендую</label>
											<input type="radio" name="is_recommended" id="is_recommended"
											       value="0"><label for="is_recommended">Не рекомендую</label>


											<?php if ( $product['category_id'] ): ?>
												<input type='hidden' name='visible' value="1">
											<?php else: ?>
												<input type='hidden' name='visible' value="1">
											<?php endif; ?>
											<br>
											<input type="submit" name='submit_parent' value="Отправить"
											       class="btn btn-group-sm">
										</form>
									</div>
								<?php else: ?>
									<div class="spoiler-body">
										<br>
										<p><a href="/user/login">Войдите</a>,что бы оставить комментарий</p>
									</div>
								<?php endif; ?>



								<?php if ( ( $_COOKIE['user'] == $_SESSION['user'] ) && ( $_COOKIE['comment_id'] == $comment['id'] ) ): ?>
									<input type="button" class="btn btn-sm btn-default spoiler-title" value="Изменить">
									<div class="spoiler-body">
										<form action="" method="post">
											<textarea
												name='edited_comment'><?php echo $comment['content']; ?></textarea>
											<br>
											<input type='hidden' name='edited_id' value="<?php echo $comment['id']; ?>">
											<input type="submit" name='edited_submit' value="Сохранить">
										</form>
									</div>
								<?php endif; ?>


							</div>
						</div>
						<?php foreach ( $comment_child as $child ): ?>
							<?php if ( $child['parent_id'] == $comment['id'] ): ?>
								<div class="panel panel-default" style="margin-left: 40px;">
									<div class="panel-heading">
										<p class="panel-title"><?php echo $child['name']; ?>
											ответил <?php echo $child['date']; ?></p>
									</div>
									<div class="panel-body">
										<p><?php echo $comment['is_recommended'] ? 'Рекомендую!' : 'Не рекомендую!'; ?></p>
										<?php echo $child['content']; ?>
									</div>
									<div class="panel-heading">
										<p>Рейтинг: <?php echo $child['pluses']; ?></p>
										<form method="post">
											<input type="submit" name="like" class="btn btn-xs btn-success"
											       value="Нравится">
											<input type="submit" name="dislike" class="btn btn-xs btn-danger"
											       value="Не нравится">
											<input type='hidden' name='comment_id' value="<?php echo $child['id']; ?>">
										</form>
										<br>

										<?php if ( ( $_COOKIE['user'] == $_SESSION['user'] ) && ( $_COOKIE['comment_id'] == $child['id'] ) ): ?>
											<input type="button" class="btn btn-sm btn-default spoiler-title"
											       value="Изменить">
											<div class="spoiler-body">
												<form action="" method="post">
													<textarea
														name='edited_comment'><?php echo $child['content'] ?></textarea>
													<br>
													<input type='hidden' name='edited_id'
													       value="<?php echo $child['id']; ?>">
													<input type="submit" name='edited_submit' value="Сохранить">
												</form>
											</div>
										<?php endif; ?>

									</div>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	</div>


	</div>
	</div>
	</div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

<script type="text/javascript">
	$(document).ready(function () {
		$('.spoiler-body').hide();
		$('.spoiler-title').click(function () {
			$(this).next().toggle()
		});
	});
</script>

