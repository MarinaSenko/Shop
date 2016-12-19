<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление комментариями</li>
                </ol>
            </div>

            <a href="/admin/comments/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить комментарий</a>

            <h4>Список комментариев</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID комментария</th>
                    <th>Дата</th>
                    <th>Комментарий</th>
                    <th>Рейтинг</th>
                    <th>Рекомендация</th>
                    <th>Видимость</th>
                    <th></th>
                </tr>
                <?php foreach ($commentsList as $comment): ?>
                    <tr>
                        <td><?php echo $comment['id']; ?></td>
                        <td><?php echo $comment['date']; ?></td>
                        <td><?php echo $comment['content']; ?></td>
                        <td><?php echo $comment['pluses']; ?></td>
                        <td><?php echo ($comment['is_recommended']) ? 'Да' : 'Нет' ?></td>
                        <td><?php echo ($comment['visible']) ? '+' : '-'; ?></td>
                        <td><a href="/admin/comments/update/<?php echo $comment['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

