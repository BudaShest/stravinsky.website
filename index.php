<?php
session_start();
require "bootstrap.php";

$topProducts = $dataProduct->getProductsTop(6);
$brands = $dataBrand->getAllRecords(6);
$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();
$banner = $dataBanner->getRandomBanner();

$currentUser = isset($_SESSION['auth_user_id'])?$dataUser->getUser($_SESSION['auth_user_id']):null;

require $_SERVER['DOCUMENT_ROOT'] . "/index.view.php";