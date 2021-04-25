<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=PROJNAME?> | имя сюда вставить июзера</title>
    <link rel="stylesheet" href="/css/style.css">
    <script defer src="/js/admin-panel.js"></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/admin-modal-context.view.php"?>
<div class="admin-wrapper">
    <header class="header row">
        <div class="logo">
            <img src="/imgs/logo.png" alt="">
        </div>
        <a href="/route/admin" class="menu-back-btn col">
            <img src="/imgs/cancel.png" alt="">
        </a>
    </header>
    <main class="main col">
        <section id="admin-one-application">
            <div class="container col">

            </div>
        </section>
    </main>
    <footer class="footer row"></footer>
</div>
</body>
</html>