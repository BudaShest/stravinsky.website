<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script type="module" defer src="/ajax/ajax-main.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
    <script type="module" defer src="/ajax/ajax-validate.js"></script>
    <script defer src="/js/auth.js"></script>
    <script defer src="/js/script.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper wrapper-main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.view.php"?>
        <main class="main col">
            <div class="rotate-control row">
                <button id="auth-show-btn">Авторизация</button>
                <button id="reg-show-btn">Регистрация</button>
            </div>

            <div class="rotating">


                <div class="front row">
                    <form action="/route/auth/user-logic.php" class="col" method="post">
                        <?php if(isset($_SESSION['auth_error'])):?>
                            <div class="error"><?=$_SESSION['auth_error']?></div>
                        <?php endif; ?>
                        <label for="auth-login-input">Логин:</label>
                        <input type="text" name="auth_login" id="auth-login-input" required>
                        <label for="auth-password-input">Пароль:</label>
                        <input type="password" name="auth_password" id="auth-password-input" required>
                        <div class="form-template-btns row">
                            <button class="btn-postive" type="submit" name="log_submit_btn">Войти</button>
                            <button class="btn-negative" type="reset">Стереть</button>
                        </div>
                    </form>
                </div>
                <div class="back row">
                    <form id="register-form" action="/route/auth/user-logic.php" class="col" method="post" enctype="multipart/form-data">
                        <?php if(isset($_SESSION['reg_error'])):?>
                            <div class="error"><?=$_SESSION['reg_error']?></div>
                        <?php endif; ?>
                        <label for="user-login-input">Логин:</label>
                        <span></span>
                        <input type="text" name="user_login" id="user-login-input" required minlength="4" maxlength="11">
                        <label for="user-email-input">Email:</label>
                        <span></span>
                        <input type="email" name="user_email" id="user-email-input">
<!--                        <div class="email-register-confirm col">-->
<!--                            <label for="user-email-code">Код подтвеждения</label>-->
<!--                            <input type="text" name="user_email_code_confirm" id="user-code-confirm" placeholder="Введите код подвтерждения">-->
<!--                            <input name="user_email_code" type="text" id="user-email-code" readonly hidden>-->
<!--                        </div>-->
                        <label for="user-password-input">Пароль:</label>
                        <span></span>
                        <input type="password" name="user_password" id="user-password-input" required>
                        <label for="user-password-confirm-input">Повторите пароль:</label>
                        <span></span>
                        <input type="password" id="user-password-confirm-input" required>
                        <label for="user-img-input">Аватар:</label>
                        <input type="file" name="user_img" id="user-img-input">
                        <div class="form-template-btns row">
                            <button class="btn-postive" type="submit" name="reg_submit_btn">Регистрация</button>
                            <button class="btn-negative" type="reset">Стереть</button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.view.php"?>
    </div>
</body>
</html>
<?php
unset($_SESSION['reg_error']);
unset($_SESSION['auth_error']);

?>