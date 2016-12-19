<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php include ROOT . '/views/layouts/side_bar.php'; ?>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Товары</h2>

                    <?php foreach ($categoryProducts as $product): ?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="<?php echo Product::getImage($product['id']); ?>" alt="" />
                                        <?php if($product['sale_price']):?>
                                            <h6>Старая цена: <?php echo ($product['price']); ?></h6>
                                            <h2>Новая цена: <?php echo ($product['sale_price']); ?></h2>
                                        <?php else: ?>
                                            <h2>Цена: <?php echo ($product['price']); ?></h2>
                                        <?php endif;?>
                                        <p>
                                            <a href="/product/<?php echo $product['id']; ?>">
                                                <?php echo $product['name']; ?>
                                            </a>
                                        </p>
                                        <a href="/cart/add/<?php echo $product['id']; ?>" class="btn btn-default add-to-cart" data-id="<?php echo $product['id']; ?>"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_stock']): ?>
                                        <img src="/template/images/home/sale.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>                              

                </div><!--features_items-->
                
                <!-- Постраничная навигация -->
                <?php echo $pagination->get(); ?>



                <div class="col-md-4"></div>
                <div class="col-md-4 pag"></div>
                <div class="col-md-4"></div>



            </div>
        </div>
    </div>
    
</section>


<?php include ROOT . '/views/layouts/footer.php'; ?>