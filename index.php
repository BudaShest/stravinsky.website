<?php
session_start();
require "bootstrap.php";

if(in_array($_SERVER['REMOTE_ADDR'], $dataUser->getBannedIpList())){
    header('Location: https://studme.org/297698/psihologiya/destruktivnoe_povedenie');
}

$topProducts = $dataProduct->getProductsTop(6);
$brands = $dataBrand->getAllRecords(6);
$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();
$banner = $dataBanner->getRandomBanner();

$currentUser = isset($_SESSION['auth_user_id'])?$dataUser->getUser($_SESSION['auth_user_id']):null;

require $_SERVER['DOCUMENT_ROOT'] . "/index.view.php";