<!DOCTYPE html>
<html lang="<?=$data['lang']?>">

    <?php require 'public/blocks/head.php'; ?>

    <body>

        <?php require 'public/blocks/header.php'; ?>

        <div class="container">
            <div class="reg">
                <form action="/user/reg" method="post" class="form-control">
                    <h1>Реєстрація користувача:</h1>
                    <input type="tel" name="login" pattern="[0-9]{10}" placeholder="Введіть телефон (0931234567):" value="<?=$_POST['login']?>"  class="input-reg"><br>
                    <input type="password" name="pass" placeholder="Введіть пароль:"  value="<?=$_POST['pass']?>"  class="input-reg"><br>
                    <input type="password" name="re_pass" placeholder="Перевірка пароля:"  value="<?=$_POST['re_pass']?>"  class="input-reg"><br>
                    <div class="error danger"><h4><?=$data['message']?></h4></div><br>

                    <?php if ($data['message'] == 'Такий login вже зареєстровано'): ?>
                    
                        <h3 id="auth">Ви можете <a href="/user/auth" class="success">авторизуватися</a></h3>
                        
                    <?php endif; ?>

                    <button class="btn mob btn-warning" id="send">Реєстрація</button>
                </form>
            </div>
        </div>

        <?php require 'public/blocks/footer.php'; ?>

    </body>
</html>