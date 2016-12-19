<!-- Сайдбар с категориями-->
<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Каталог</h2>
		<div class="panel-group category-products">
			<?php foreach ( $categories as $categoryItem ): ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a href="/category/<?php echo $categoryItem['id']; ?>"
							   class="<?php if ( $categoryId == $categoryItem['id'] ) {
								   echo 'active';
							   } ?> "
							>
								<?php echo $categoryItem['name']; ?>
							</a>
						</h4>
						<?php foreach ( $subcategories as $subcategory ): ?>
							<?php if ( $categoryItem['id'] == $subcategory['category_id'] ): ?>
								<h6 style="color: #666663">
									<a href="#"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;" . $subcategory['name']; ?></a>
								</h6>

							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endforeach; ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="/category/stock">
							Акции
						</a>
					</h4>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="/category/sale">
							Распродажа
						</a>
					</h4>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="/category/reduction">
							Уценка
						</a>
					</h4>
				</div>
			</div>
		</div>


	</div>
</div>




