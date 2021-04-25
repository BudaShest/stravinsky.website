<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

if(isset($_POST['category_id'])){
    if($_POST['category_id'] == 'all'){
        $brandsInCategories = $dataBrand->getAllRecords();

    }else{
        $brandsInCategories = $dataBrand->getBrandsByCategory($_POST['category_id']);

    }
    echo json_encode($brandsInCategories);
}


if(isset($_POST['supercategory_id'])){
    if($_POST['supercategory_id'] == 'all'){
        $categories = $dataCategory->getAllRecords();
    }else{
        $categories = $dataCategory->getCategoriesBySuper($_POST['supercategory_id']);
    }
    echo json_encode($categories);
}

if(isset($_POST['prod_category_id'])){
    $productBrands = $dataBrand->getBrandsByCategory($_POST['prod_category_id']);
    echo json_encode($productBrands);
}

if(isset($_POST['prod_brand_id'])){
    $productsInBrand = $dataProduct->getProductsByBrand($_POST['prod_brand_id']);
    echo json_encode($productsInBrand);
}

if(isset($_POST['main_supercat_id'])){
    $mainCategories = $dataCategory->getCategoriesBySuper($_POST['main_supercat_id']);
    echo json_encode($mainCategories);
}

if(isset($_POST['catalog_brand_id'])){
    if($_POST['catalog_brand_id'] == 'all'){
        if(isset($_SESSION['category_query_id'])){
            $productsInCatalog = $dataProduct->getProductsByCategory($_SESSION['category_query_id']);
        }else{
            $productsInCatalog = $dataProduct->getAllRecords();
        }
    }else{
        if(isset($_SESSION['category_query_id'])){
            $productsInCatalog = $dataProduct->getProductsByBrandAndCategory($_SESSION['category_query_id'],$_POST['catalog_brand_id']);
        }else{
            $productsInCatalog = $dataProduct->getProductsByBrand($_POST['catalog_brand_id']);
        }

    }
    echo json_encode($productsInCatalog);
}

if(isset($_POST['app_update_id'])){
    if(isset($_POST['app_update_id']) && isset($_POST['app_update_status'])){
        $dataApplication->changeStatus($_POST['app_update_id'], $_POST['app_update_status']);
    }
    echo json_encode('yes');
}

if(isset($_POST['app_status_id'])){
    if($_POST['app_status_id'] == 'all'){
        $applicationInStatus = $dataApplication->getAllRecords();
    }else{
        $applicationInStatus = $dataApplication->getApplicationByStatusId($_POST['app_status_id']);
    }
    echo json_encode($applicationInStatus, JSON_UNESCAPED_UNICODE);
}

if(isset($_POST['all_statuses'])){

    $allStatuses = $dataApplication->getStatuses();
    echo json_encode($allStatuses, JSON_UNESCAPED_UNICODE);
}
