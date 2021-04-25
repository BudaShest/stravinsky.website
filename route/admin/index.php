<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/bootstrap.php";
if(isset($_SESSION['is_admin_auth']) && $_SESSION['is_admin_auth'] == True){
    header('Location: /route/admin/admin-data.php');

}
require $_SERVER['DOCUMENT_ROOT'] . "/route/admin/admin_auth.view.php";



