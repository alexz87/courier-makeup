<header class="header">

        <!-- BUTTON MENU -->

    <div class="header__box container">
        <div class="header__menu" id="open">
            <div class="header__line"></div>
            <div class="header__line"></div>
            <div class="header__line"></div>
        </div>
        
            <!-- LOGO -->

        <?php if ($_COOKIE['login'] != ''): ?>

            <div class="header__logo">
                <a href="/"><h1>MAKEUP</h1></a>
            </div>

            <!-- DATE -->

            <div class="header__date">

                <?php if (date('N') == 6 || date('N') == 7): ?>

                    <h3 class="warning"><?=date('d.m')?></h3>

                <?php else: ?>

                    <h3 class="success"><?=date('d.m')?></h3>

                <?php endif; ?>

            </div>

        <?php else: ?>

                <!-- ALTERNATIVE LOGO -->

            <div class="header__ua">
                <h4>Рускій воєнний корабль, іді нахуй</h4>
            </div>

        <?php endif; ?>
        
    </div>

            <!-- MENU -->

    <div class="menu" id="menu">
            <div class="close-menu" id="close"><h1 class="danger">X</h1></div>
            <div class="menu__logo">
                <a href="/"><h1 class="link link-logo warning">MAKEUP</h1></a>
            </div>

            <?php if ($_COOKIE['login'] != ''): ?>
                <?php if ($_COOKIE['login'] == '0939947369'): ?>
                
                    <div class="menu__link">
                        <a href="/admin/index"><h3 class="link danger">admin</h3></a>
                    </div>
                    
                <?php endif; ?>

                <div class="menu__link">
                    <a href="/"><h3 class="link">Головна</h3></a>
                </div>	
                <div class="menu__link">
                    <a href="/user/reports"><h3 class="link">Звіти</h3></a>
                </div>
                <div class="menu__link">
                    <a href="/home/contact"><h3 class="link">Контакт</h3></a>
                </div>
                <div class="menu__link">
                    <form action="/admin/index" method="post">
                        <input type="hidden" name="exit_btn">
                        <button type="submit" class="btn btn-danger" id="back">Вийти</button><br>
                        <label for="exit_btn" class="warning"><?=$_COOKIE['login']?></label>
                    </form>
                </div>

            <?php else: ?>

                <div class="menu__link">
                        <a href="/"><h3 class="link">Головна</h3></a>
                </div>
                <div class="menu__link">
                        <a href="/user/auth"><h3 class="link">Увійти</h3></a>
                </div>
                <div class="menu__link">
                        <a href="/"><h3 class="link">Контакт</h3></a>
                </div>
                
            <?php endif; ?>
    </div>
</header>

<script src="public/js/jquery360.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $('#open').click(function() {
        $('#menu').css({
            "display" : "flex"
        });
    });

    
    $('#close').click(function() {
        $('#menu').css({
            "display" : "none"
        });
    });
</script>