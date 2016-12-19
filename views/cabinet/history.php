<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/cabinet">Личный кабинет</a></li>
                    <li><a class="active">История заказов</a></li>
                </ol>
            </div>

            <br/>
            <h4>История заказов</h4>
            <br/>


            <?php foreach ($ordersList as $order): ?>
            <?php $productsQuantity = json_decode($order['products'], true);?>
            <?php  $productsIds = array_keys($productsQuantity);?>
            <?php $products = Product::getProdustsByIds($productsIds); ?>
                <br>
                <h5>Заказ №<?php echo $order['id']?> от <?php echo $order['date']; ?></h5>
            <table class="table-admin-medium table-bordered table-striped table ">
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Сумма</th>
                </tr>
                <?php $j=1; ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $j; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $productsQuantity[$product['id']]; ?></td>
                        <td><?php echo ($product['price'])*($productsQuantity[$product['id']]);?></td>
                    </tr>
                    <?php $j++;?>
                <?php endforeach; ?>
            </table>
            <?php endforeach; ?>

            <a href="/cabinet/" class="btn btn-default back"><i class="fa fa-arrow-left"></i> Назад</a>
        </div>


</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

