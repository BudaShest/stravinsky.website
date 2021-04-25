<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stravinsky</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/script.js"></script>
    <script defer src="/ajax/ajax-main.js"></script>
</head>
<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/main-modal.view.php"?>
    <div class="wrapper">
        <?php include $_SERVER["DOCUMENT_ROOT"] . "/templates/header.view.php"?>
        <section class="banner">
            <div class="banner-block col">
                <span class="banner-company-name">STRAVINSKY MUSIC</span>
                <span class="banner-slogan">STAY LOUD</span>
                <span class="banner-slogan">BE YOURSELF</span>
            </div>>
        </section>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/catalog.view.php"?>
        <section class="brands col">
            <h2>Бренды</h2>
            <div class="container row">
                <?php foreach($brands as $brand):?>
                    <a href="route/catalog/index.php?brand_id=<?=$brand->id?>"><div class="brand row" style="box-shadow:inset 1px 4px 4px <?=$brand->color?>"><img src="imgs/admin-data/<?=$brand->image?>" alt=""></div></a>
                <?php endforeach?>
            </div>
        </section>
        <section class="advert row">
            <?php if(isset($banner) && $banner != null):?>
                <div class="container row">
                    <div class="advert-img-block row">
                        <a class="row" href="/route/product/index.php?product_id=<?=$banner->link?>"><img src="imgs/admin-data/<?=$banner->image?>" alt="Рекламный баннер"></a>
                    </div>
                    <div class="advert-text col">
                        <h2><?=$banner->header?></h2>
                        <p><?=$banner->text?></p>
                        <span>Что?</span>
                        <p><?=$banner->what?></p>
                        <span>Где?</span>
                        <p><?=$banner->where?></p>
                        <span>Когда?</span>
                        <p><?=$banner->when?></p>
                    </div>
                </div>
            <?php else:?>
                <div class="container row">
                    <div class="advert-img-block row">
                        <a href=""><img src="imgs/advert.jpg" alt="Рекламное изображение"></a>
                    </div>
                    <div class="advert-text col">
                        <h2>Легенда уже здесь!</h2>
                        <p>Берегите свои уши и кошельки, потому что Marshal JCM9000 410 уже у нас в наличии!</p>
                        <span>Что?</span>
                        <p>Ламповый гитарный усилитель, классика рока.</p>
                        <span>Где?</span>
                        <p>У нас на сайте, в разделе <a href="">гитарное усиление</a></p>
                        <span>Когда?</span>
                        <p>Начиная с 5 апреля усилитель доступен к заказу!</p>
                    </div>
                </div>
            <?php endif;?>
        </section>
        <section class="top col">
            <h2>Топ</h2>
            <div class="container row">
                <?php foreach($topProducts as $topProduct):?>
                    <a href="/route/product/index.php?product_id=<?=$topProduct->id?>">
                        <div class="top-product col">
                            <div class="front col">
                                <h4><?=$topProduct->name?></h4>
                                <span class="product-category"><?=$topProduct->cat_name?></span>
                                <img src="imgs/admin-data/<?=$topProduct->image?>" alt="">
                                <span><?=$topProduct->rating?></span>
                                <div class="row">
                                    <span class="old-price"><strike><?=$topProduct->price?> руб.</strike></span><span class="new-price"><?=$topProduct->price?> руб.</span>
                                </div>
                            </div>
                            <div class="back col">
                                <p><?=mb_strcut($topProduct->description,0,600)?>...</p>
                            </div>
                        </div>
                    </a>
                <?php endforeach;?>
            </div>
        </section>
        <section class="about-us col" id="about-us">
            <h2>О нас</h2>
            <div class="container col">
                <div class="about-msg about-question">
                    <p>Кто мы такие?</p>
                </div>
                <div class="about-msg">
                    <p>Мы компания, занимающаяся продажей премиальной музыкальной техники. У нас даже самый искушённый слушатель сможет удовлетворить свои аудиофильские потребности.</p>
                    <div><img src="imgs/logo.png" alt=""></div>
                </div>
                <div class="about-msg about-question">
                    <p>В чём наша цель?</p>
                </div>
                <div class="about-msg">
                    <p>Мы хотим полностью изменить представление людей о музыке и звуке! Наша продукция - не просто акдиотехника. Это ворота в новый мир притняых волновых частот!</p>
                    <div><img src="imgs/pngegg.png" alt=""></div>
                </div>
                <div class="about-msg about-question">
                    <p>Где мы находимся?</p>
                </div>
                <div class="about-msg">
                    <p>Наш главный офис находится в городе Челябинск по адресу ул. героя Росии Александра Яковлева, д. 1, кв. 56</p>
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1877.1108600262892!2d61.369635734609886!3d55.17069012858032!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43c592ce2a4d0731%3A0x1129612d75078f94!2z0JbQmiDQnNCw0L3RhdGN0YLRgtC10L0!5e0!3m2!1sru!2sru!4v1617961188288!5m2!1sru!2sru" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
        <section class="contacts" id="contacts">
            <h2>Контакты</h2>
            <div class="container col">
                <div class="row all-links">
                    <a href=""><img src="imgs/links/vk.png" alt=""></a>
                    <a href=""><img src="imgs/links/fb.png" alt=""></a>
                    <a href=""><img src="imgs/links/inst.png" alt=""></a>
                    <a href=""><img src="imgs/links/tg.png" alt=""></a>
                </div>
                <div class="row main-phone">
                    <div class="col">
                        <h4>ТЕЛЕФОН:</h4>
                        <span>8-800-555-35-35</span>
                    </div>
                </div>
                <div class="row all-mails">
                    <div class="col">
                        <h4>EMAIL:</h4>
                        <span>stravinsky@gmail.com</span>
                    </div>
                    <div class="col">
                        <h4>ПОДДЕРЖКА:</h4>
                        <span>stravinsky.support@gmail.com</span>
                    </div>
                    <div class="col">
                        <h4>ДЛЯ ПАРТНЁРОВ:</h4>
                        <span>stravinsky.partners@gmail.com</span>
                    </div>
                </div>
            </div>
        </section>
        <?php include $_SERVER['DOCUMENT_ROOT']."/templates/footer.view.php"?>
    </div>
</body>
</html>