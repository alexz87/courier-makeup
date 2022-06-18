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
            <div class="user-info mt-2 mb-2">
                <div class="photo">
                    <img id="photo" src="/public/img/<?=$data['user']['photo']?>">
                </div>
                <h1><?=$data['user']['login']?></h1><br>
                <div class="users"><b>Зареєстровано: <?=$data['count']?> users</b></div>
            </div>
            <div class="d-flex col mt-2 mb-2" id="users">
                    
                <?=$data['users_info']?>

            </div>
            <div class="hr"></div>
            <div class="reg">
                <div class="form-control d-flex col align-center">
                    <h1>Реєстрація користувача:</h1>
                    <input type="tel" id="login" pattern="[0-9]{10}" placeholder="Введіть телефон (формат 0931234567):" class="input-reg">
                    <input type="password" id="pass" placeholder="Введіть пароль:" class="input-reg">
                    <input type="password" id="re_pass" placeholder="Перевірка пароля:" class="input-reg">
                    <div class="error danger"><h4><?=$data['message']?></h4></div>
                    <button class="btn mob btn-warning" id="send">Реєстрація</button>
                </div>
            </div>
            <div class="hr"></div>
            <div class="mt-2 mb-2">
                <form class="d-flex col align-center mt-2 mb-2" action="/user/dashboard" enctype="multipart/form-data" method="post">
                    <p class="mb-1"><b>Завантажте ваше фото:</b></p>
                    <input type="file" name="uploadPhoto" id="uploadPhoto" class="border p-1 mb-1">
                    <input type="" name="id" class="border p-1 mb-1" placeholder="Введіть id користувача:">
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
                                "public/img/IMG_" . $_POST['id'] . ".jpg"
                            );
                        }
                    }
                ?>
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

            $('#send').click(function() {
                let login = $('#login').val();
                let pass = $('#pass').val();
                let re_pass = $('#re_pass').val();
                $('#send').attr('class', 'btn mob btn-success');
                $('#send').html('Додано');
                setTimeout(function() {
					$('#send').attr('class', 'btn mob btn-warning');
					$('#send').html('Реєстрація');
				}, 1000);

                $.ajax({
                    url: '/user/dashboard',
                    type: 'POST',
                    data: {'login' : login, 'pass' : pass, 're_pass' : re_pass},
                    dataType: 'html',
                    cache: false,
                    success: function(data) {
                        $('#login').val(null);
                        $('#pass').val(null);
                        $('#re_pass').val(null);
                        document.location.reload(true);
                    }
                });
            });

            function deleteUser(id) {
                if (confirm('Ви дійсно хочете видалити аккаунт?') == true) {
                    $.ajax({
                        url: '/user/dashboard',
                        type: 'POST',
                        data: {'user_id' : id},
                        dataType: 'html',
                        cache: false,
                        success: function(data) {
                            $('#' + id).remove();
                        } 
                    });
                }
            }
		</script>
    </body>
</html>
