<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";

$user = $dataUser->getUser($_GET['user_id']);
$usersApplications = $dataApplication->searchRecord($_GET['user_id']);
$usersReviews = $dataReview->searchRecord($_GET['user_id']);
$bannedIdList = $dataUser->getBannedIdList();
//var_dump($user);
//var_dump($usersApplications);
//var_dump($usersReviews);
include $_SERVER['DOCUMENT_ROOT'] . "/route/admin/admin-user/admin-user.view.php";