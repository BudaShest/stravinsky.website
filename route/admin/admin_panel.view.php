<!doctype html>
<html lang="ru">
<head>
    <?php require $_SERVER['DOCUMENT_ROOT'] . "/templates/page-headers.php"?>
    <title><?=PROJNAME?>| Admin-панель</title>
    <script defer src="/js/admin-panel.js"></script>
    <script type="module" defer src="/ajax/functions.js"></script>
    <script type="module" defer src="/ajax/ajax-admin.js"></script>
    <script src="https://cdn.tiny.cloud/1/lx1k5gva7psp1ywffg4ujjonc5dk9q44notypc4ns36d6s45/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/admin-modal-context.view.php"?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/admin-modal.view.php"?>
<div class="admin-wrapper">
    <header class="header row">
        <div class="logo">
            <img src="/imgs/logo.png" alt="Логотип">
        </div>
        <div class="menu-toggler col">
            <div class="menu-line"></div>
            <div class="menu-line"></div>
            <div class="menu-line"></div>
        </div>
    </header>
    <main class="main col">
        <section id="admin-main-start">
            <div class="container col">
                <h2>Текущие записи для редактирования</h2>
                <?php if(isset($_SESSION['update_banner'])):?>
                    <h4>Реклама</h4>
                    <div class="current-banner-update line-row row">
                        <div class="row"><img src="/imgs/admin-data/<?=$_SESSION['update_banner']['image']?>" alt=""></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_banner']['header'],0,75)?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_banner']['what'],0,75) ?></div>
                        <div class="row">
                            <form method="post" action="/route/admin/admin-logic.php">
                                <button name="btn_update_banner_delete">Отменить изменения</button>
                            </form>
                        </div>
                    </div>
                <?php endif;?>
                <?php if(isset($_SESSION['update_brand'])):?>
                    <h4>Бренды:</h4>
                    <div class="current-brand-update line-row row">
                        <div class="row"><img src="/imgs/admin-data/<?=$_SESSION['update_brand']['image']?>" alt="Логотип"></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_brand']['cat_name'],0,75)?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_brand']['name'],0,75) ?></div>
                        <div class="row">
                            <form method="post" action="/route/admin/admin-logic.php">
                                <button name="btn_update_brand_delete">Отменить изменения</button>
                            </form>
                        </div>
                    </div>
                <?php endif;?>
                <?php if(isset($_SESSION['update_category'])):?>
                    <h4>Категории:</h4>
                    <div class="current-category-update line-row row">
                        <div class="row"><?=$_SESSION['update_category']['name']?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_category']['sub_name'],0,75)?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_category']['color'],0,75) ?></div>
                        <div class="row">
                            <form method="post" action="/route/admin/admin-logic.php">
                                <button name="btn_update_category_delete">Отменить изменения</button>
                            </form>
                        </div>
                    </div>
                <?php endif;?>
                <?php if(isset($_SESSION['update_product'])):?>
                    <h4>Товары:</h4>
                    <div class="current-category-update line-row row">
                        <div class="row"><?=$_SESSION['update_product']['name']?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_product']['cat_name'],0,75)?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_product']['price'],0,75) ?></div>
                        <div class="row">
                            <form method="post" action="/route/admin/admin-logic.php">
                                <button name="btn_update_product_delete">Отменить изменения</button>
                            </form>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </section>
        <section id="admin-main-settings" class="row">
            <div class="container col">
                <header>
                    <?php if(isset($_SESSION['update_banner'])):?>
                    <h4>Текующий баннер для редактирования</h4>
                    <div class="current-banner-update line-row row">
                        <div class="row"><img src="/imgs/admin-data/<?=$_SESSION['update_banner']['image']?>" alt=""></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_banner']['header'],0,75)?></div>
                        <div class="row"><?=mb_strcut($_SESSION['update_banner']['what'],0,75) ?></div>
                        <div class="row">
                            <form method="post" action="/route/admin/admin-logic.php">
                                <button name="btn_update_banner_delete">Отменить изменения</button>
                            </form>
                        </div>
                    </div>
                    <?php endif;?>
                </header>
                <h2>Настройки рекламы</h2>
                <form action="/route/admin/admin-logic.php" class="col" method="post" enctype="multipart/form-data">
                    <label for="banner-header-input">Заголовок баннера</label>
                    <input name="banner_header" type="text" id="banner-header-input" required value="<?=$_SESSION['update_banner']['header']??""?>">
                    <label for="banner-text-input">Текст</label>
                    <textarea name="banner_text" id="banner-text-input" required><?=$_SESSION['update_banner']['text']??""?></textarea>
                    <label for="banner-img-input">Картинка</label>
                    <input name="banner_img" type="file" id="banner-img-input" <?=!isset($_SESSION['update_banner']['image'])?"required":""?>>
                    <label for="banner-what-input">Что(текст)</label>
                    <input name="banner_what" type="text" id="banner-what-input" required  value="<?=$_SESSION['update_banner']['what']??""?>">
                    <label for="banner-where-input">Где(текст)</label>
                    <input name="banner_where" type="text" id="banner-where-input" required  value="<?=$_SESSION['update_banner']['where']??""?>">
                    <label for="banner-when-input">Когда(текст)</label>
                    <input name="banner_when" type="text" id="banner-when-input" required  value="<?=$_SESSION['update_banner']['when']??""?>">
                    <label for="banner-link-select">Ссылка на продукт</label>
                    <select name="banner_link" id="banner-link-select" required>
                        <?php foreach ($products as $product):?>
                            <?php if(isset($_SESSION['update_banner'])):?>
                                <option <?=$_SESSION['update_banner']['link']==$product->id?"selected":""?> value="<?=$product->id?>"><?=$product->name?></option>
                            <?php else:?>
                                <option value="<?=$product->id?>"><?=$product->name?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                    <div class="form-template-btns row">
                        <button type="submit" class="btn-postive" name="btn_banner_submit">Отправить</button>
                        <button type="reset" class="btn-negative">Стереть</button>
                    </div>
                </form>
                <div class="all-records col">
                    <header>

                    </header>
                    <a href="#" class="row line-row line-row-example">
                        <div class="row">Изображение</div>
                        <div class="row">Заголовок</div>
                        <div class="row">Что?</div>
                        <div class="row">Текст</div>
                    </a>
                    <div id="admin-all-adverts">
                        <?php foreach($banners as $banner):?>
                            <a href="#" class="row line-row" id="<?=$banner->id?>">
                                <div class="row"><img src="/imgs/admin-data/<?=$banner->image?>" alt="Баннер"></div>
                                <div class="row"><?=mb_strcut($banner->header,0,75)?></div>
                                <div class="row"><?=mb_strcut($banner->what,0,75) ?></div>
                                <div class="row"><?=mb_strcut($banner->text,0,100)?></div>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
        <section id="admin-brand-settings" class="row">
            <div class="container col">
                <header>
                    <?php if(isset($_SESSION['update_brand'])):?>
                        <h4>Текующий бренд для редактирования</h4>
                        <div class="current-brand-update line-row row">
                            <div class="row"><img src="/imgs/admin-data/<?=$_SESSION['update_brand']['image']?>" alt="Логотип"></div>
                            <div class="row"><?=mb_strcut($_SESSION['update_brand']['cat_name'],0,75)?></div>
                            <div class="row"><?=mb_strcut($_SESSION['update_brand']['name'],0,75) ?></div>
                            <div class="row">
                                <form method="post" action="/route/admin/admin-logic.php">
                                    <button name="btn_update_brand_delete">Отменить изменения</button>
                                </form>
                            </div>
                        </div>
                    <?php endif;?>
                </header>
                <h2>Настройки бренда:</h2>
                <form action="/route/admin/admin-logic.php" class="col" method="post" enctype="multipart/form-data">
                    <label for="brand-name-input">Название бренда:</label>
                    <input type="text" id="brand-name-input" name="brand_name" value="<?=$_SESSION['update_brand']['name']??''?>">
                    <label for="brand-category-input">Категория бренда: </label>
                    <select name="brand_cat_id" id="brand-category-input">
                        <?php foreach ($categories as $category):?>
                            <?php if(isset($_SESSION['update_brand'])):?>
                                <option <?= $_SESSION['update_brand']['category_id']==$category->id?"selected":""?> value="<?=$category->id?>"><?=$category->name?></option>
                            <?php else:?>
                                <option value="<?=$category->id?>"><?=$category->name?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                    <label for="brand-logo-input">Логотип бренда</label>
                    <input type="file" id="brand-logo-input" name="brand_logo" accept="image/gif, image/jpeg, image/png, image/pjpeg, image/svg">
                    <label for="brand-color-input">Цвет бренда</label>
                    <input type="color" id="brand-color-input" name="brand_color" value="<?=$_SESSION['update_brand']['color']??''?>">
                    <div class="form-template-btns row">
                        <button type="submit" class="btn-postive" name="btn_brand_submit">Отправить</button>
                        <button type="reset" class="btn-negative">Стереть</button>
                    </div>
                </form>
                <div class="all-records col">
                    <header>
                        <form action="">
                            <label for="brands-query-input">Выберите категорию</label>
                            <select name="brands_ajax_category" id="brands-query-input">
                                    <option selected value="all">Все категории</option>
                                <?php foreach($categories as $category):?>
                                    <option value="<?=$category->id?>"><?=$category->name?></option>
                                <?php endforeach;?>
                            </select>
                        </form>
                    </header>
                    <a href="#" class="row line-row line-row-example">
                        <div class="row">Изображение</div>
                        <div class="row">Категория</div>
                        <div class="row">Имя бренда</div>
                        <div class="row">Цвет</div>
                    </a>
                    <div id="admin-all-brands">
                        <?php foreach ($brands as $brand): ?>
                            <a href="#" class="row line-row" id="<?=$brand->id?>">
                                <div class="row"><img src="/imgs/admin-data/<?=$brand->image?>" alt="Логотип"></div>
                                <div class="row"><?=$brand->cat_name?></div>
                                <div class="row"><?=$brand->name?></div>
                                <div class="row" style="color:<?=$brand->color?>"><?=$brand->color?></div>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
        <section id="admin-category-settings" class="row">
            <div class="container col">
                <header>
                    <?php if(isset($_SESSION['update_category'])):?>
                        <h4>Текующая категория для редактирования</h4>
                        <div class="current-category-update line-row row">
                            <div class="row"><?=$_SESSION['update_category']['name']?></div>
                            <div class="row"><?=mb_strcut($_SESSION['update_category']['sub_name'],0,75)?></div>
                            <div class="row"><?=mb_strcut($_SESSION['update_category']['color'],0,75) ?></div>
                            <div class="row">
                                <form method="post" action="/route/admin/admin-logic.php">
                                    <button name="btn_update_category_delete">Отменить изменения</button>
                                </form>
                            </div>
                        </div>
                    <?php endif;?>
                </header>
                <h2>Настройки категорий:</h2>
                <form action="/route/admin/admin-logic.php" class="col" method="POST">
                    <label for="category-name-input">Название категории:</label>
                    <input type="text" id="category-name-input" name="category_name" value="<?=$_SESSION['update_category']['name']??""?>">
                    <label for="category-sub-select">Подкатегория:</label>
                    <select id="category-sub-select" name="category_sub_id">
                        <?php foreach ($subcategories as $subcategory):?>
                            <?php if(isset($_SESSION['update_category'])):?>
                                <option <?=$_SESSION['update_category']['sub_category_id']==$subcategory->id?"selected":""?> value="<?=$subcategory->id?>"><?=$subcategory->name?></option>
                            <?php else:?>
                                <option value="<?=$subcategory->id?>"><?=$subcategory->name?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                    <label for="category-color-input">Цвет категории</label>
                    <input type="color" id="category-color-input" name="category_color" value="<?=$_SESSION['update_category']['color']??'#000000'?>">
                    <div class="form-template-btns row">
                        <button type="submit" class="btn-postive" name="btn_category_submit">Отправить</button>
                        <button type="reset" class="btn-negative">Стереть</button>
                    </div>
                </form>
                <div class="all-records col">
                    <header>
                        <form action="">
                            <label for="categories-query-input">Выберите надкатегорию</label>
                            <select name="category_ajax_supercategory" id="categories-query-input">
                                <option selected value="all">Все надкатегории</option>
                                <?php foreach($subcategories as  $subcategory):?>
                                    <option value="<?=$subcategory->id?>"><?=$subcategory->name?></option>
                                <?php endforeach;?>
                            </select>
                        </form>
                    </header>
                    <a href="#" class="row line-row line-row-example">
                        <div class="row">Имя категории</div>
                        <div class="row">Имя надкатегории</div>
                        <div class="row">Цвет</div>
                        <div class="row"></div>
                    </a>
                    <div id="admin-all-categories">
                        <?php foreach ($categories as $category): //TODO вместо # в ссылке будет категория?>
                            <a href="#" class="row line-row" id="<?=$category->id?>">
                                <div class="row"><?=$category->name?></div>
                                <div class="row"><?=$category->sub_name?></div>
                                <div class="row"><?=$category->color?></div>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
        <section id="admin-product-settings" class="row">
            <div class="container col">
                <header>
                    <?php if(isset($_SESSION['update_product'])):?>
                        <h4>Текующий товар для редактирования</h4>
                        <div class="current-category-update line-row row">
                            <div class="row"><?=$_SESSION['update_product']['name']?></div>
                            <div class="row"><?=mb_strcut($_SESSION['update_product']['cat_name'],0,75)?></div>
                            <div class="row"><?=mb_strcut($_SESSION['update_product']['price'],0,75) ?></div>
                            <div class="row">
                                <form method="post" action="/route/admin/admin-logic.php">
                                    <button name="btn_update_product_delete">Отменить изменения</button>
                                </form>
                            </div>
                        </div>
                    <?php endif;?>
                </header>
                <h2>Настройки товара:</h2>
                <form action="/route/admin/admin-logic.php" class="col" method="post" enctype="multipart/form-data">
                    <label for="product-name-input">Название товара:</label>
                    <input type="text" id="product-name-input" name="product_name" value="<?=$_SESSION['update_product']['name']??""?>">
                    <label for="product-category-input">Категория:</label>
                    <select name="product_cat_id" id="product-category-input">
                        <?php foreach ($categories as $category):?>
                            <?php if(isset($_SESSION['update_product'])):?>
                                <option <?=$_SESSION['update_product']['category_id']==$category->id?"selected":""?> value="<?=$category->id?>"><?=$category->name?></option>
                            <?php else:?>
                                <option value="<?=$category->id?>"><?=$category->name?></option>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </select>
                    <label for="product-brand-input">Бренд-прозводитель:</label>
                    <select name="product_brand_id" id="product-brand-input">
                        <?php foreach($brands as $brand): ?>
                            <?php if(isset($_SESSION['update_product'])): ?>
                                <option <?=$_SESSION['update_product']['brand_id']==$brand->id?"selected":""?> value="<?=$brand->id?>"><?=$brand->name?></option>
                            <?php else:?>
                                <option value="<?=$brand->id?>"><?=$brand->name?></option>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </select>
                    <label for="product-imgs-input">Изображения:</label>
                    <input type="file" id="product-imgs-input" name="product_imgs[]" multiple accept="image/gif, image/jpeg, image/png, image/pjpeg, image/svg+xml">
                    <label for="product-video-input">Видео</label>
                    <input type="text" id="product-video-input" name="product_video" value="<?=$_SESSION['update_product']['video']??""?>">
                    <label for="product-feature-input">Характеристики</label>
                    <textarea data-editor="ClassicEditor" wrap="hard" name="product_feature" id="product-feature-input" cols="30" rows="10"><?=$_SESSION['update_product']['feature']??""?></textarea>
                    <label for="product-description-input">Описание:</label>
                    <textarea wrap="hard" name="product_description" id="product-description-input" cols="30" rows="10"><?=$_SESSION['update_product']['description']??""?></textarea>
                    <label for="product-price-input">Цена:</label>
                    <input type="number" id="product-price-input" name="product_price" value="<?=$_SESSION['update_product']['price']??""?>">
                    <div class="form-template-btns row">
                        <button type="submit" class="btn-postive" name="btn_product_submit">Отправить</button>
                        <button type="reset" class="btn-negative">Стереть</button>
                    </div>
                </form>
                <div class="all-records col">
                    <header>
                        <form action="">
                            <label for="products-brand-query-input">Выберите бренд</label>
                            <select name="products_ajax_prod" id="products-brand-query-input">
                                <option selected value="all">Все бренды</option>
                                <?php foreach ($brands as $brand):?>
                                    <option value="<?=$brand->id?>"><?=$brand->name?></option>
                                <?php endforeach;?>
                            </select>
                        </form>
                    </header>
                    <a href="#" class="row line-row line-row-example">
                        <div class="row">Имя продукта</div>
                        <div class="row">Рейтинг</div>
                        <div class="row">Цена</div>
                        <div class="row">Имя категории</div>
                    </a>
                    <div id="admin-all-products">
                        <?php foreach ($products as $product):?>
                            <a class="row line-row" href="#" id="<?=$product->id?>">
                                <div class="row"><?=$product->name?></div>
                                <div class="row"><span><?=$product->rating?></span></div>
                                <div class="row"><span><?=$product->price?> руб.</span></div>
                                <div class="row"><span><?=$product->cat_name?></span></div>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
        <section id="admin-users-settings" class="row">
            <div class="container col">
                <h2>Все пользователи:</h2>
                <div class="all-records col">
                    <?php foreach ($users as $user): //TODO вместо # в ссылке будет просмотр пользователя?>
                        <a class="row line-row" href="/route/admin/admin-user/index.php?user_id=<?=$user->id?>"  id="<?=$user->id?>">
                            <div class="row"><img src="../../imgs/user-data/<?=$user->image?>" alt="Аватар"></div>
                            <div class="row"><span><?=$user->login?></span></div>
                            <div class="row"><span><?=$user->email?></span></div>
                            <div class="row"><span><?=$user->role_name?></span></div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </section>
        <section id="admin-users-applications" class="row">
            <div class="container col">
                <h2>Заявки пользователей</h2>
                <div class="all-records col">
                    <header>
                        <form action="">
                            <select name="" id="applications-status-query-input">
                                <option value="all">Все статусы</option>
                                <?php foreach($statuses as $status):?>
                                    <option value="<?=$status->id?>"><?=$status->name?></option>
                                <?php endforeach;?>
                            </select>
                        </form>
                    </header>
                    <div id="admin-all-applications">
                        <?php foreach ($applications as $application):?>
                            <a class="row line-row" href="/route/admin/admin-applications/index.php?application_id=<?=$application->id?>"  id="<?=$application->id?>">
                                <div class="row"><span>Заявка №<?=$application->id?></span></div>
                                <div class="row"><span><?=$application->created_at?></span></div>
                                <span class="row"><span><?=$application->login?></span></span>
                                <div class="row">
                                    <form action="" class="row" method="post">
                                        <input name="app_update_id" type="number" value="<?=$application->id?>" readonly hidden>
                                        <select name="app_update_status" class="application-update-select">
                                            <?php foreach ($statuses as $status):?>
                                                <option <?=$application->status_id == $status->id?"selected":""?> value="<?=$status->id?>"><?=$status->name?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </form>
                                </div>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer row"></footer>
</div>
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>
</body>
</html>