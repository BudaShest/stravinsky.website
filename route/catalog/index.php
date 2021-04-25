<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();
$brands = $dataBrand->getAllRecords();


if(isset($_GET['category_id']) && isset($_GET['brand_id'])){
    $products = $dataProduct->getProductsByBrandAndCategory($_GET['category_id'],$_GET['brand_id']);
}elseif(isset($_GET['category_id'])){
    if(is_numeric($_GET['category_id']) && $_GET['category_id']>=0){
        $_SESSION['category_query_id'] = $_GET['category_id'];
        $products = $dataProduct->getProductsByCategory($_GET['category_id']);
        $brandsInCategory = $dataBrand->getBrandsByCategory($_GET['category_id']);
;
    }
}elseif(isset($_GET['brand_id'])){
    if(is_numeric($_GET['brand_id']) && $_GET['brand_id']>=0){
        $products = $dataProduct->getProductsByBrand($_GET['brand_id']);
    }
}else{
    $products = $dataProduct->getAllRecords();
}


require $_SERVER['DOCUMENT_ROOT'] . "/route/catalog/catalog.view.php";