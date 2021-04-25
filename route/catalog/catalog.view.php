<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=PROJNAME?> | Каталог</title>
    <link rel="stylesheet" href="https://faviconka.ru/ico/1/faviconka.ru_1_142741.ico">
    <link rel="stylesheet" href="../../css/style.css">
    <script defer src="../../js/script.js"></script>
    <script defer src="/ajax/ajax-main.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper wrapper-catalog">
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/header.view.php"?>
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/catalog.view.php"?>
        <div class="main row">
            <div class="catalog-products col">
                <header>
                    <form action="">
                        <label for="catalog-brand-select"></label>
                        <select name="" id="catalog-brand-select">
                            <option value="all">Все бренды</option>
                            <?php foreach($brandsInCategory as $brandInCategory):?>
                                <option value="<?=$brandInCategory->id?>"><?=$brandInCategory->name?></option>
                            <?php endforeach;?>
                        </select>
                    </form>
                </header>
                <div class="catalog-products-container row">
                    <?php foreach($products as $product):?>
                        <a href="/route/product/index.php?product_id=<?=$product->id?>">
                            <div class="product col">
                                <div class="front col">
                                    <h4><?=$product->name?></h4>
                                    <span class="product-category"><?=$product->cat_name?></span>
                                    <img src="../../imgs/admin-data/<?=$product->image?>" alt="Картинка товара">
                                    <span><?=$product->rating?></span>
                                    <div class="row">
                                        <span class="old-price"><strike><?=$product->price?> руб.</strike></span><span class="new-price"><?=$product->price?> руб.</span>
                                    </div>
                                </div>
                                <div class="back col">
                                    <p><?=mb_strcut($product->description,0,600)?>...</p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
                <footer>

                </footer>
            </div>
        </div>
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/footer.view.php"?>
    </div>
</body>
</html>

