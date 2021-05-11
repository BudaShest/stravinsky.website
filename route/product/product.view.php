<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?> | <?=isset($product)?$product->name:""?></title>
    <script defer src="/js/script.js"></script>
    <script type="module" defer src="/ajax/ajax-main.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper wrapper-catalog">
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/header.view.php" ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/catalog.view.php"?>
        <main class="main">
            <div class="container">
                <?php if(true):?>
                    <div class="one-product col">
                        <h2><?=$product->name?></h2>
                        <div class="row one-product-top">
                            <div class="col one-product-imgs">
                                <img id="one-product-main-img" src="" alt="Основное изображение">
                                <div class="row mini-imgs">

                                    <?php foreach($productImgs as $productImg):?>
                                        <img src="../../imgs/admin-data/<?=$productImg?>" alt="Мини-изображение">
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="col one-product-feature text-drop">
                                <header class="row">
                                    <h4>Характеристики</h4>
                                    <img src="/imgs/togglers/down.png" alt="Стрелка вниз">
                                </header>
                                <p><?=$product->feature?></p>
                            </div>
                        </div>
                        <div class="col one-product-description text-drop">
                            <header class="row">
                                <h4>Описание</h4>
                                <img src="/imgs/togglers/down.png" alt="Стрелка вниз">
                            </header>
                            <p><?=$product->description?></p>
                        </div>
                        <?php if($product->video!==null && $product->video!==""):?>
                        <iframe width="560" height="315" src="<?=$product->video?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php endif;?>
                    </div>
                    <?php if($currentUser && isset($_SESSION['auth_user_id'])):?>
                    <div class="row one-product-bottom">
                        <form action="/route/basket/basket-logic.php" class="form-basket-control col" method="get">
                            <input type="number" name="product_id" value="<?=$_GET['product_id']?>" readonly hidden>
                            <div class="form-template-btns row">
                                <button type="submit" class="btn-postive" name="btn_basket_submit">Купить</button>
                            </div>
                        </form>
                        <div class="col product-cash">
                            <?php if(isset($product)):?>
                                <span class="row"><span id="one-product-price" class="product-price"><?=$product->price?></span>руб.</span>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php else:?>
                        <span>Для соверешения покупки <a href="/route/auth">авторизуйтесь</a></span>
                    <?php endif;?>
                <?php endif;?>
                <div class="one-product-rev col">
                    <?php if($currentUser && isset($_SESSION['auth_user_id'])):?>
                    <form class="col" action="/route/product/product-logic.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="product_id" value="<?=$_GET['product_id']?>" readonly hidden>
                        <label for="review-text-input">Текст отзыва</label>
                        <textarea name="review_text" id="review-text-input" cols="30" rows="10"></textarea>
                        <label for="review-imgs-input">Фото:</label>
                        <input name="review_imgs[]" type="file" id="review-imgs-input" multiple>
                        <div class="form-template-btns row">
                            <button type="submit" class="btn-postive" name="btn_review_submit">Отправить</button>
                            <button type="reset" class="btn-negative">Стереть</button>
                        </div>
                    </form>
                    <?php endif;?>
                    <div class="one-product-reviews col">
                        <h3>Комментарии</h3>
                        <?php if($reviews):?>
                        <?php foreach($reviews as $review):?>
                            <div class="review row">
                                <div class="row review-user">
                                    <img src="/imgs/user-data/<?=$review->user_image?>" alt="Аватар">
                                    <h4><?=$review->login?></h4>
                                </div>
                                <p><?=$review->text?></p>
                                <span class="review-date"><?=$review->created_at?></span>
                                <?php $reviewImgs=$dataReview->getImageName($review->id)?>
                                <?php if(isset($reviewImgs) && count($reviewImgs)>0):?>
                                    <div class="review-imgs col">
                                        <header>
                                            <h5>Показать вложения</h5>
                                        </header>
                                        <?php foreach($reviewImgs as $reviewImg):?>
                                            <img src="/imgs/user-data/<?=$reviewImg?>" alt="Прикрлённое изображение">
                                        <?php endforeach;?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <?php else:?>
                            <span>Данный товар ещё никто не комментировал</span>
                        <?php endif;?>
                    </div>
                    <h3>Вам также может быть интересно</h3>
                </div>
                <div class="row also-like">
                    <?php foreach($anotherProducts as $anotherProduct):?>
                        <a href="/route/product/index.php?product_id=<?=$anotherProduct->id?>">
                            <div class="product col">
                                <div class="front col">
                                    <h4><?=$anotherProduct->name?></h4>
                                    <span class="product-category"><?=$anotherProduct->cat_name?></span>
                                    <img src="../../imgs/admin-data/<?=$anotherProduct->image?>" alt="Изображение">
                                    <div class="row">
                                        <span class="old-price"><strike><?=$anotherProduct->price?> руб.</strike></span><span class="new-price"><?=$anotherProduct->price?> руб.</span>
                                    </div>
                                </div>
                                <div class="back col">
                                    <p><?=mb_strcut($anotherProduct->description,0,600)?>...</p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.view.php" ?>
    </div>
</body>
</html>