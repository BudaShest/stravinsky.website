<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
use app\Validate;

//TODO эти две функии ниже перенести
function capitalize($str){ //TODO Крайне сомнительная функция(c русским языком) //TODO Теперь вроде норм
    $firstLetter = mb_strtoupper(mb_substr($str,0,1), "UTF-8");

    $str = mb_strtolower($str, "UTF-8");
    $resStr = $firstLetter . mb_substr($str,1,null, "UTF-8");
    return $resStr;
}

function checkName($dataHandler,$name, $tableName){
    if(in_array($name, $dataHandler->getAllNames($tableName))){
        return True;
    }else{
        return False;
    }
}

if(isset($_POST['btn_category_submit'])){
    $name = htmlentities(capitalize($_POST['category_name']));
    if(!checkName($dataCategory, $name, "categories")){
        $subcatId = htmlentities($_POST['category_sub_id']);
        $color = htmlentities($_POST['category_color']);
        $dataCategory->insertRecord($name, (int)$subcatId, $color); //TODO Сделать проверку на существование и если что не добавлять!
        //TODO СЕССИЯ И СООБЩЕНИЯ ОБ УДАЧНОМ СОЗДАНИИ ИЛИ ОШИБКЕ
    }
    header('Location: /route/admin');

}


if(isset($_POST['btn_brand_submit'])){
    $name = htmlentities(capitalize($_POST['brand_name']));
    $color = htmlentities($_POST['brand_color']);
    $categoryId = (int)$_POST['brand_cat_id'];
    if(isset($_FILES['brand_logo']) && $_FILES['brand_logo']['name'] == ""){
        $fileName = Validate::validateString($_POST['brand_img_str']);
    }else{
        $fileName = $fileWorker->uploadOneImg($_FILES['brand_logo'],'admin-data');
    }

    if(isset($_SESSION['update_brand'])){
        $dataBrand->updateBrand($_SESSION['update_brand']['id'],$name,$categoryId,$fileName,$color);
        unset($_SESSION['update_brand']);
    }else{
        if(!checkName($dataBrand, $name, "brands")){
            $dataBrand->insertRecord($name, $categoryId, $fileName, $color);
        }
    }

    header('Location: /route/admin');
}


if(isset($_POST['btn_product_submit'])){
    $productName = htmlentities($_POST['product_name']);
    $productCategoryId = (int)$_POST['product_cat_id'];
    $productBrandId = (int)$_POST['product_brand_id'];
    $productFeature = nl2br(htmlentities($_POST['product_feature']));
    $productDesc = nl2br(htmlentities($_POST['product_description']));
    $productPrice = (int)$_POST['product_price'];
    $productVideo = htmlentities($_POST['product_video']);

    $uploadedFiles = $fileWorker->uploadMultiImgs($_FILES['product_imgs'], 'admin-data');

    $dataProduct->insertRecord($productBrandId, $productCategoryId,$productName,$productFeature,$productDesc,$productPrice,$productVideo,$uploadedFiles);

    //TODO Вот эта часть нужна для отправки писем. Она работает, но необходимо сделать подтверждение maila
    $users = $dataUser->getAllRecords();
    foreach ($users as $user){
        sendMail($user->email,"{$productName}", "На наш сайт был доавблен новый товар");
    }

    header('Location: /route/admin');

}

if(isset($_GET['btn_delete_row'])){
    switch ($_GET['context_table_name']){
        case "admin-main-settings":
            $imgName = $dataBanner->getImageName($_GET['context_table_id']);
            $fileWorker->deleteOneImg($imgName, 'admin-data');
            $dataBanner->deleteOneRecord($_GET['context_table_id']);
            break;
        case "admin-brand-settings":
            $imgName = $dataBrand->getImageName($_GET['context_table_id']);
            $fileWorker->deleteOneImg($imgName,'admin-data');
            $dataBrand->deleteOneRecord($_GET['context_table_id']);
            break;
        case "admin-category-settings":
            $dataCategory->deleteOneRecord($_GET['context_table_id']);
            break;
        case "admin-product-settings":
            $imgNames = $dataProduct->getImageName($_GET['context_table_id']);
            $fileWorker->multiDelete($imgNames,'admin-data');
            $dataProduct->deleteOneRecord($_GET['context_table_id']);
            break;
        case "admin-users-settings":
            //TODO необходимо также сделать удаление картинок в комментарияхы
            $imgName = $dataUser->getImageName($_GET['context_table_id']);
            $fileWorker->deleteOneImg($imgName,'user-data');
            $dataUser->deleteOneRecord($_GET['context_table_id']);
            break;
        case "admin-users-applications":
        case "admin-one-user-settings":
            $dataApplication->deleteOneRecord($_GET['context_table_id']);
            break;

    }
    header('Location: /route/admin');
}

//Логика изменения постов
if(isset($_GET['btn_update_row'])){
    switch ($_GET['context_table_name']){
        case "admin-main-settings":
            $bannerRecord = $dataBanner->searchRecord($_GET['context_table_id'],true);
            $_SESSION['update_banner'] = $bannerRecord;
            break;
        case "admin-brand-settings":
            $brandRecord = $dataBrand->searchRecord($_GET['context_table_id'],true);
            $_SESSION['update_brand'] = $brandRecord;
            break;
        case "admin-category-settings":
            $categoryRecord = $dataCategory->searchRecord($_GET['context_table_id'],true);
            $_SESSION['update_category'] = $categoryRecord;
            break;
        case "admin-product-settings":

            break;
        case "admin-users-settings":

            break;
        case "admin-users-applications":
        case "admin-one-user-settings":

            break;

    }
//    header('Location: /route/admin');
}

if(isset($_POST['btn_banner_submit'])){
    $header = htmlentities(trim($_POST['banner_header']));
    $text = htmlentities(trim($_POST['banner_text']));
    if(isset($_FILES['banner_img']) && $_FILES['banner_img']['name']!=""){
        $img = $fileWorker->uploadOneImg($_FILES['banner_img'],'admin-data');
    }else if(isset($_SESSION['update_banner'])){
        $img = Validate::validateString($_POST['banner_img_str']);
    }
    $what = htmlentities(trim($_POST['banner_what']));
    $where = htmlentities(trim($_POST['banner_where']));
    $when = htmlentities(trim($_POST['banner_when']));
    $link = htmlentities(trim($_POST['banner_link']));

    if(isset($_SESSION['update_banner'])){
        $dataBanner->updateBanner($_SESSION['update_banner']['id'],$header,$text,$img,$what,$where,$when,$link);
        unset($_SESSION['update_banner']);
    }else{
        $dataBanner->insertRecord($header, $text, $img, $what, $where, $when, $link);
    }

    header('Location: /route/admin');
}

if(isset($_POST['btn_update_banner_delete'])){
    unset($_SESSION['update_banner']);
    header('Location: /route/admin');
}

if(isset($_POST['btn_update_brand_delete'])){
    unset($_SESSION['update_brand']);
    header('Location: /route/admin');
}

