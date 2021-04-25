<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();

if(isset($_SESSION['auth_user_id'])){
    $userApplications = $dataApplication->searchRecord($_SESSION['auth_user_id']);
}

include $_SERVER['DOCUMENT_ROOT'] . "/route/applications/applications.view.php";