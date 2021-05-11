<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();

if(isset($_SESSION['basket'])){
    $basketWorker->basketCreate($_SESSION['basket']);
    $basketProducts = $basketWorker->getBasket();

}

include $_SERVER['DOCUMENT_ROOT'] . "/route/basket/basket.view.php";
