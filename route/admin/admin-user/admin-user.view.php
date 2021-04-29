<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?> | <?=$user->login??""?></title>
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
            <section id="admin-one-user-settings">
                <div class="container col">
                    <h2>Информация о пользователе</h2>
                    <div class="admin-user-info row">
                        <div class="row admin-user-info-img"><img src="/imgs/user-data/<?=$user->image?>" alt=""></div>
                        <div class="col">
                            <h3>Логин: <?=$user->login?></h3>
                            <span>Email: <?=$user->email?></span>
                            <span>Роль: <?=$user->role_name?></span>
                            <span>IP: <?=$user->user_ip?></span>
                            <form action="/route/admin/admin-logic.php" method="post">
                                <button name="user_ban_id" value="<?=$user->id?>">Забанить</button>
                            </form>
                        </div>
                    </div>
                    <h3>Завявки пользователя <?=$user->login?></h3>
                    <div class="all-records admin-user-application col">
                        <?php foreach($usersApplications as $usersApplication):?>
                            <a class="row line-row" href="#"  id="<?=$usersApplication->id?>">
                                <div class="row"><span>Завявка №<?=$usersApplication->id?></span></div>
                                <div class="row"><span><?=$usersApplication->sum_price?></span></div>
                                <div class="row"><span><?=$usersApplication->name?></span></div>
                                <div class="row"><span><?=$usersApplication->created_at?></span></div>
                            </a>
                        <?php endforeach;?>
                    </div>
                    <h3>Комментарии пользователя <?=$user->login?></h3>
                    <div class="all-records admin-user-reviews col">
                        <?php foreach($usersReviews as $usersReview):?>
                            <a class="row line-row" href="#"  id="<?=$usersReview->id?>" data-isreview="true">
                                <div class="row">картинки</div>
                                <div class="row admin-user-review-text"><span><?=mb_strcut($usersReview->text,0,80)?>...</span></div>
                                <div class="row"><span><?=$usersReview->created_at?></span></div>
                                <div class="row"><span></span></div>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </section>
        </main>
        <footer class="footer row"></footer>
    </div>
</body>
</html>
