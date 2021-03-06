<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?> | Корзина</title>
    <script defer src="/js/script.js"></script>
    <script type="module" defer src="/ajax/ajax-main.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper wrapper-catalog">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.view.php"?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/catalog.view.php"?>
        <main class="main">
            <div class="container">
                <?php if(isset($_SESSION['basket']) && $basketProducts):?>
                <h2>Корзина</h2>
                <div class="basket-container">
                    <header>
                        <span>Суммарная стоимость <span id="basket-sum-price"></span> руб.</span>
                    </header>
                    <?php foreach($basketProducts['products'] as $key=>$basketProduct):?>
                        <?php $basketImg = $dataProduct->getImageName($basketProduct->id)?>
                        <div class="basket-product row">
                            <img src="/imgs/admin-data/<?=$basketImg[0]?>" alt="Изображение товара">
                            <span><?=$basketProduct->name?></span>
                            <span><?=$basketProduct->cat_name?></span>
                            <span class="product-price-span"><?=$basketProduct->price?> руб.</span>
                            <span><input type="number" data-prod-price="<?=$basketProduct->price?>" data-prod-id="<?=$basketProduct->id?>" class="product-quantity" min="1" max="10" value="<?=$basketProducts['quantity'][$key]?>">шт.</span>
                            <form action="/route/basket/basket-logic.php" method="get">
                                <input type="number" name="basket_product_id" value="<?=$basketProduct->id?>" readonly hidden>
                                <button name="basket_product_del_btn">Удалить</button>
                            </form>

                        </div>
                    <?php endforeach;?>
                    <footer>
                        <form action="/route/basket/basket-logic.php" class="row form-application-confirm">
                            <input type="number" name="application_sum_price" id="application-sum-price" value="" readonly hidden>
                            <div class="form-template-btns row">
                                <button class="btn-postive" name="btn_application_submit">Подвтердить</button>
                                <button class="btn-negative" name="btn_basket_clear">Очистить</button>
                            </div>
                        </form>
                    </footer>
                </div>
                <?php else:?>
                    <span>Вы ещё ничего не добавили в корзину</span>
                <?php endif;?>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.view.php"?>
    </div>
</body>
</html>



