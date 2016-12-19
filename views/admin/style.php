<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление стилем</li>
                </ol>
            </div>


            <h4>Добавить новую категорию</h4>

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

                        <p>Изменить цвет шапки сайта</p>
                        <input type="radio" name="colorHead" value="red" id="1"> <label for="1"><span style="color: red">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorHead" value="#ebccd1" id="1"> <label for="1"><span style="color: #ebccd1">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorHead" value="#faebcc" id="1"> <label for="1"><span style="color: #faebcc">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorHead" value="#bce8f1" id="1"> <label for="1"><span style="color: #bce8f1">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorHead" value="#C2C2C1" id="1"> <label for="1"><span style="color: #C2C2C1">Синий, красный, голубой - выбирай себе любой!</span></label>

                        <br><br><br>

                        <p>Изменить основной цвет сайта</p>
                        <input type="radio" name="colorBody" value="red" id="1"> <label for="1"><span style="color: red">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorBody" value="#ebccd1" id="1"> <label for="1"><span style="color: #ebccd1">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorBody" value="#faebcc" id="1"> <label for="1"><span style="color: #faebcc">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorBody" value="#bce8f1" id="1"> <label for="1"><span style="color: #bce8f1">Синий, красный, голубой - выбирай себе любой!</span></label>
                        <input type="radio" name="colorBody" value="#C2C2C1" id="1"> <label for="1"><span style="color: #C2C2C1">Синий, красный, голубой - выбирай себе любой!</span></label>

                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>




        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

