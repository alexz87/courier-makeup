<?php

    if ($_COOKIE['login'] == '') {
        header('Location: /user/auth');
        exit();
    }

?>
    
<!DOCTYPE html>
<html lang="ua">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="container">
            <div class="courier">
                <div class="mt-3"><a href="/admin" class="btn btn-success">Назад</a></div>
                <?=$data['courier']?>

            </div>
        </div>

        <?php require 'public/blocks/footer.php'; ?>
        <?php require 'public/php/scripts.php'; ?>

</body>
</html>