<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();


if(isset($_GET['product_id'])){
    $product = $dataProduct->getOneProduct($_GET['product_id']);
    $productImgs = $dataProduct->getImageName($product->id);
    $reviews = $dataReview->getReviewByProductId($_GET['product_id']);
}


$anotherProducts = $dataProduct->getProductsTop(3);

require $_SERVER['DOCUMENT_ROOT'] . "/route/product/product.view.php";