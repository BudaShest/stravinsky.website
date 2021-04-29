<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?> | <?=$currentUser->login??""?></title>
    <script defer src="/js/admin-panel.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
    <script type="module" defer src="/ajax/ajax-admin.js"></script>
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
                <div class="current-application">
                    <h3>Завявка № <?=$currentApplication->id?></h3>
                    <form action="/route/admin/admin-logic.php" method="post" class="current-application-controll row">
                        <input name="app_update_id" type="number" value="<?=$currentApplication->id?>" readonly hidden>
                        <select name="app_update_status" class="application-update-select">
                            <?php foreach ($statuses as $status):?>
                                <option <?=$currentApplication->status_id == $status->id?"selected":""?> value="<?=$status->id?>"><?=$status->name?></option>
                            <?php endforeach;?>
                        </select>
                        <button name="application_id" value="<?=$currentApplication->id?>">Удалить</button>
                    </form>
                    <div class="app-row row">
                        <div class="current-application-user col">
                            <h3>Контактная информация</h3>
                            <h4><?=$currentUser->login?></h4>
                            <img src="/imgs/user-data/<?=$currentUser->image?>" alt="">
                            <span>Email: <?=$currentUser->email?></span>
                        </div>
                        <div class="current-application-info col">
                            <span>Дата создания: <?=$currentApplication->created_at?></span>
                            <span>Общая стоимость: <?=$currentApplication->sum_price?> руб</span>
                            <span>Текущий статус: <?=$currentApplication->name?></span>
                        </div>
                    </div>
                    <div class="current-application-products row">
                        <?php foreach ($productsInApplication as $key=>$prod):?>
                            <?php 
                            $product = $dataProduct->getOneProduct($prod['product_id']); 
                            $productImgs = $dataProduct->getImageName($prod['product_id']);
                            ?>
                            <div class="application-product col">
                                <h4><?=$product->name?></h4>
                                <img src="/imgs/admin-data/<?=$productImgs[0]?>" alt="">
                                <span><?=$product->cat_name?></span>
                                <span>Цена <?=$product->price?></span>
                                <span>Кол-во <?=$prod['quantity']?>шт.</span>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer row"></footer>
</div>
</body>
</html>