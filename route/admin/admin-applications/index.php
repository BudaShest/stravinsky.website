<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if(isset($_GET['application_id'])){
    $currentApplication = $dataApplication->getApplication($_GET['application_id']);
    $currentUser = $dataUser->getUser($currentApplication->user_id);
    $statuses = $dataApplication->getStatuses();
    $productsInApplication = $dataApplication->getProductsInApplication($_GET['application_id']);
}

include $_SERVER['DOCUMENT_ROOT'] . "/route/admin/admin-applications/applications.view.php";