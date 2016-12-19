<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/comments">Управление комментариями</a></li>
                    <li class="active">Добавить комментарий</li>
                </ol>
            </div>


            <h4>Добавить новый комментарий</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Текст комментария</p>
                        <input type="text" name="content" placeholder="" value="">
                        <p>Рекомендую (1 или 0)</p>
                        <select name="is_recommended">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        <br>
                        <br>
                        <p>ID товара</p>
                        <input type="text" name="product_id" placeholder="" value="">
                        <p>Видимость</p>
                        <select name="visible">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>



                        <br/><br/>


                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

