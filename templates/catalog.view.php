<section class="catalog catalog-nonactive">
    <h2>Каталог</h2>
    <div class="container row">
        <div class="col sub-cat">
            <h3>Категории</h3>
            <ul class="col">
                <?php foreach($subCategories as $subCategory):?>
                    <li><a href="#" class="super-category-link" data-super-id="<?=$subCategory->id?>"><?=$subCategory->name?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <div class="col cat">
            <h3>Подкатегории</h3>
            <select name="" id="mobile-supercat-menu">
                <?php foreach($subCategories as $subCategory):?>
                    <option value="<?=$subCategory->id?>"><?=$subCategory->name?></option>
                <?php endforeach;?>
            </select>
            <div class="row">
                <ul class="col" id="main-all-categories">
                    <?php foreach($categories as $category):?>
                        <li><a href="/route/catalog/index.php?category_id=<?=$category->id?>"><?=$category->name?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="section-control row">
        <div class="section-toggler col" id="catalog-toggler">
            <div class="section-toggler-line"></div>
            <div class="section-toggler-line"></div>
            <div class="section-toggler-line"></div>
        </div>
    </div>
</section>