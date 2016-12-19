<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                </ol>
            </div>
        </div>
        <div class="row">

            <h2 class="text-center">Добрый день, администратор!</h2>


       <div class="col-sm-4">
           </br>
           </br>
           <h4 class="text-center">Вам доступны такие возможности:</h4>
           </br>
                <div id="dashboard">
                    <table class="table-bordered table-striped table">
                        <tr><td><a href="/admin/product">Управление товарами</a></td></tr>
                        <tr><td><a href="/admin/category">Управление категориями</a></td></tr>
                        <tr><td><a href="/admin/order">Управление заказами</a></td></tr>
                        <tr><td><a href="/admin/comments">Управление комментариями</a></td></tr>
                        <tr><td><a href="/admin/menu">Управление меню</a></td></tr>
                        <tr><td><a href="/admin/style">Управление стилем</a></td></tr>
                    </table>
                </div>
            </div>

            <div class="col-sm-8">
                </br>
                </br>
                <h4 class="text-center">Ожидающие комментарии</h4>
                </br>
                <div id="dashboard">
                    <table class="table-bordered table-striped table">
                            <tr>
                                <th>Дата</th>
                                <th>Комментарий</th>
                                <th>Рейтинг</th>
                                <th>Рекомендация</th>
                                <th>Видимость</th>
                                <th></th>
                            </tr>
                            <?php foreach ($commentsList as $comment): ?>
                                <?php if ($comment['is_recommended'] == 0):?>
                                <tr>
                                    <td><?php echo $comment['date']; ?></td>
                                    <td><?php echo $comment['content']; ?></td>
                                    <td><?php echo $comment['pluses']; ?></td>
                                    <td><?php echo ($comment['is_recommended']) ? 'Да' : 'Нет' ?></td>
                                    <td><?php echo ($comment['visible']) ? '+' : '-'; ?></td>
                                    <td><a href="/admin/comments/update/<?php echo $comment['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                                </tr>
                                 <?php endif;?>
                            <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>





<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

