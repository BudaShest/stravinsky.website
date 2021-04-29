<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?> | Каталог</title>
    <script defer src="/js/script.js"></script>
    <script type="module" defer src="/ajax/ajax-main.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
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
                        <?php if(isset($_GET['category_id'])):?>
                        <label for="catalog-brand-select"></label>
                        <select name="" id="catalog-brand-select">
                            <option value="all">Все бренды</option>
                            <?php foreach($brandsInCategory as $brandInCategory):?>
                                <option value="<?=$brandInCategory->id?>"><?=$brandInCategory->name?></option>
                            <?php endforeach;?>
                        </select>
                        <?php elseif (isset($_GET['brand_id'])):?>
                            <label for="catalog-category-select"></label>
                            <select name="" id="catalog-category-select">
                                <option value="all">Все категории</option>
                                <?php foreach($categoriesInBrand as $categoryInBrand):?>
                                    <option value="<?=$categoryInBrand->id?>"><?=$categoryInBrand->name?></option>
                                <?php endforeach;?>
                            </select>
                        <?php endif;?>
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

