<!DOCTYPE html>
<html lang="<?=$data['lang']?>">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="container">
            <div class="auth">
                <form action="/user/auth" method="post" class="form-control">
                    <h1>Авторизація користувача:</h1>
                    <input type="text" name="login" placeholder="Введіть login:" value="<?=$data['login']?>" class="input-auth"><br>
                    <input type="password" name="pass" placeholder="Введіть пароль:" value="<?=$data['pass']?>" class="input-auth"><br>
                    <div class="error danger"><h4><?=$data['message']?></h4></div><br>
                    <button class="btn btn-success" id="load">Увійти</button><br>
                    <h3 id="reg">Ви можете <a href="/user/reg" class="warning">зареєструватися</a></h3>
                </form>
                
            </div>
        </div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>
</html>