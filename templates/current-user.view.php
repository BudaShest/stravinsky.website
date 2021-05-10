<?php if(isset($currentUser)):?>
    <div class="current-user-info row">
        <span><?=$currentUser->login?></span><img src="/imgs/user-data/<?=$currentUser->image?>" alt="Аватар">
        <div class="current-user-control">
            <form class="col user-info-form" action="/route/auth/user-logic.php" method="get">
                <button name="btn_basket">Корзина</button>
                <button name="btn_applications">Мои заявки</button>
                <button name="btn_logout">Выйти</button>
            </form>
        </div>
    </div>
<?php else:?>
    <a href="/route/auth" id="login-btn">LOGIN</a>
<?php endif;?>