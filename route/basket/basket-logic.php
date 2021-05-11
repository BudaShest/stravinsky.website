<?php
session_start();
require $_SERVER['DOCUMENT_ROOT']. "/bootstrap.php";

//Обработка добавления товара в корзину
if(isset($_GET['btn_basket_submit'])){
    if(isset($_GET['product_id'])){
        $_SESSION['basket'][$_GET['product_id']] = 1;
    }
    header('Location: /route/basket');
}

//Обработка удаления товара из корзины
if(isset($_GET['basket_product_del_btn'])){
    if(key_exists($_GET['basket_product_id'],$_SESSION['basket'])){
        unset($_SESSION['basket'][$_GET['basket_product_id']]);
    }
    header('Location: /route/basket');
}

//Обработка подтверждения заказа
if(isset($_GET['btn_application_submit'])){
    if(isset($_SESSION['basket']) && isset($_SESSION['auth_user_id'])){
        $dataApplication->insertRecord($_SESSION['auth_user_id'], $_SESSION['basket'], $_GET['application_sum_price']);
        $basketWorker->clearBasket();
    }
    header('Location: /route/applications/');
}

//Обработка очистки коризны
if(isset($_GET['btn_basket_clear'])){
    $basketWorker->clearBasket();

}