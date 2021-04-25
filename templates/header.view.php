<header class="header row">
    <a class="logo-container" href="/">
        <div class="logo row">
            <img src="/imgs/pre-logo.png" alt="Квадратик">
            <img src="/imgs/logo.png" alt="Стравинский">
        </div>
    </a>

    <nav class="nav row">
        <a href="/route/payment">Заказ и оплата</a>
        <a href="/index.php#contacts">Контакты</a>
        <a href="/index.php#about-us">О нас</a>
    </nav>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/current-user.view.php" ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/light-mode-btn.view.php" ?>
    <div class="mobile-menu-toggler col">
        <img src="/imgs/togglers/menu-left.png" alt="Открыть меню">
    </div>
</header>