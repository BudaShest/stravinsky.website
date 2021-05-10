<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

//Логика добавления комментарией
if(isset($_POST['btn_review_submit'])){
    if(isset($_SESSION['auth_user_id'])){
        $authorId = (int)$_SESSION['auth_user_id'];
        $productId = (int)$_POST['product_id'];
        $reviewText = htmlentities(nl2br($_POST['review_text']));

        $fileNames = $fileWorker->uploadMultiImgs($_FILES['review_imgs'],'user-data');

        $dataReview->insertRecord($authorId,$productId,$reviewText,$fileNames);



        header("Location: /route/product/index.php?product_id={$productId}");

    }

}