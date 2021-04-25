<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=PROJNAME?> | <?=isset($product)?$product->name:""?></title>
    <link rel="stylesheet" href="../../css/style.css">
    <script defer src="../../js/script.js"></script>
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
                                <img id="one-product-main-img" src="" alt="">
                                <div class="row mini-imgs">

                                    <?php foreach($productImgs as $productImg):?>
                                        <img src="../../imgs/admin-data/<?=$productImg?>" alt="">
                                    <?php endforeach;?>
                                </div>
                            </div>
                            <div class="col">
                                <p><?=$product->feature?></p>
                            </div>
                        </div>
                        <p><?=$product->description?></p>
                        <?php if($product->video!==null && $product->video!==""):?>
                        <iframe width="560" height="315" src="<?=$product->video?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <?php endif;?>
                    </div>
                    <?php if(isset($_SESSION['auth_user_id'])):?>
                    <form action="/route/basket/basket-logic.php" class="form-basket-control col" method="get">
                        <input type="number" name="product_id" value="<?=$_GET['product_id']?>" readonly hidden>
                        <label for="product-num-input">Кол-во товара:</label>
                        <input type="number" min="1" max="10" id="product-num-input" name="product_basket_num">
                        <div class="form-template-btns row">
                            <button type="submit" class="btn-postive" name="btn_basket_submit">Отправить</button>
                        </div>
                    </form>
                    <?php endif;?>
                <?php endif;?>
                <div class="one-product-rev col">
                    <?php if($currentUser):?>
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
                                    <img src="/imgs/user-data/<?=$review->user_image?>" alt="">
                                    <h4><?=$review->login?></h4>
                                </div>
                                <p><?=$review->text?></p>
                                <span class="review-date"><?=$review->created_at?></span>
                                <?php $reviewImgs=$dataReview->getImageName($review->id)?>
                                <?php if(isset($reviewImgs) && $reviewImgs !== null):?>
                                    <div class="review-imgs col">
                                        <?php foreach($reviewImgs as $reviewImg):?>
                                            <img src="/imgs/user-data/<?=$reviewImg?>" alt="">
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
                    <div class="row also-like">
                        <?php foreach($anotherProducts as $anotherProduct):?>
                            <a href="/route/product/index.php?product_id=<?=$anotherProduct->id?>">
                                <div class="product col">
                                    <div class="front col">
                                        <h3><?=$anotherProduct->name?></h3>
                                        <span class="product-category"><?=$anotherProduct->cat_name?></span>
                                        <img src="../../imgs/admin-data/<?=$anotherProduct->image?>" alt="">
                                        <span><?=$anotherProduct->rating?></span>
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
            </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/footer.view.php" ?>
    </div>
</body>
</html>