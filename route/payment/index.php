<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$subCategories = $dataCategory->getSubCategories();
$categories = $dataCategory->getAllRecords();



include $_SERVER['DOCUMENT_ROOT'] . "/route/payment/payment.view.php";