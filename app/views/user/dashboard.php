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
            <div class="user-info">
                <div class="photo">
                    <img id="photo" src="/public/img/<?=$data['user']['photo']?>">
                </div>
                <h1>Привіт, <?=$data['user']['login']?></h1><br>
                <div class="users">Зареєстровано: <?=count($data['users'])?> users</div>
                <div class="edit-btns">        
                    <button class="btn btn-success" id="ok">Готово</button>
                    <button class="btn btn-warning" id="edit">Змінити</button>
                    <form action="/user/dashboard" method="post">
                        <input type="hidden" name="exit_btn">
                        <button type="submit" class="btn btn-danger" id="back">Вийти</button>
                    </form>
                </div>
                <div class="edit">
                    <form class="upload" action="/user/dashboard" enctype="multipart/form-data" method="post">
                        <p>Завантажте ваше фото:</p>
                        <input type="file" name="uploadPhoto" id="uploadPhoto" class="add-photo"><br>
                        <input type="hidden" name="add_photo">
                        <button type="submit" class="btn btn-ligth" name="submit">Завантажити</button>
                    </form>

                    <?php
                        $target_dir = 'public/img/';
                        $target_file = $target_dir . basename($_FILES["uploadPhoto"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                        if (isset($_POST["submit"])) {
                            $check = getimagesize($_FILES["uploadPhoto"]["tmp_name"]);
                            if ($check !== false) {
                                $uploadOk = 1;
                            } else {
                                echo "Це не фото";
                                $uploadOk = 0;
                            }
                        }

                        if ($uploadOk == 0) {
                            echo "Фото не завантажено";
                        } else {
                            if (move_uploaded_file($_FILES["uploadPhoto"]["tmp_name"], $target_file)) {
                                echo "Фото завантажено";
                                rename(
                                    "public/img/" . htmlspecialchars( basename( $_FILES["uploadPhoto"]["name"])),
                                    "public/img/IMG_" . $data['user']['id'] . ".jpg"
                                );
                            }
                        }
                    ?>

                </div>
            </div>
        </div>

        <?php require 'public/blocks/footer.php'; ?>

        <script src="public/js/jquery360.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$('#edit').click(function() {
                $('#ok').css({"display" : "inline"});
                $('.edit').css({"display" : "flex"});
                $(this).css({"display" : "none"});
            });

            $('#ok').click(function() {
                $('#edit').css({"display" : "inline"});
                $('.edit').css({"display" : "none"});
                $(this).css({"display" : "none"});
            });
		</script>
    </body>
</html>
