<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"]."/bootstrap.php";

if(isset($_SESSION["is_admin_auth"]) && $_SESSION["is_admin_auth"]===true){
    $users = $dataUser->getAllRecords();
    $subcategories = $dataCategory->getSubCategories();
    $categories = $dataCategory->getAllRecords();
    $brands = $dataBrand->getAllRecords();
    $products = $dataProduct->getAllRecords();
    $applications = $dataApplication->getAllRecords();
    $statuses = $dataApplication->getStatuses();
    $banners = $dataBanner->getAllRecords();

    require $_SERVER['DOCUMENT_ROOT'] . "/route/admin/admin_panel.view.php";
}else{
    header('Location: /route/admin');
}
