<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=PROJNAME?>| Admin-панель</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="admin-wrapper">
        <header class="header row">
            <div class="logo">
                <img src="../../imgs/logo.png" alt="">
            </div>
            <div class="menu-toggler col">
                <div class="menu-line"></div>
                <div class="menu-line"></div>
                <div class="menu-line"></div>
            </div>
        </header>
        <main class="main row">
            <form action="../../route/admin/auth.php" method="post" class="form-template auth-admin-form col">
                <?php if(isset($_SESSION['admin_auth_error'])):?>
                    <span class="auth-error">
                        <?=$_SESSION['admin_auth_error']?>
                    </span>
                <?php endif;?>
                <label for="admin-login">Логин:</label>
                <input id="admin-login" name="admin_login" type="text">
                <label for="admin-password">Пароль:</label>
                <input id="admin-password" name="admin_password" type="password">
                <div class="form-template-btns row ">
                    <button class="btn-postive" type="submit" name="btn_submit">Войти</button>
                    <button class="btn-negative" type="reset">Стереть</button>
                </div>
            </form>
        </main>
        <footer class="footer row"></footer>
    </div>
</body>
</html>