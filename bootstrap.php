<?php
//Данный файл нужен для подключения всех необходимых для сайта модулей и классов.
require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
require $_SERVER['DOCUMENT_ROOT'] . "/database/config.php";
require $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";
require $_SERVER['DOCUMENT_ROOT'] . "/services/mail/mail.php";

//Пространства имён
use app\User;
use database\Connect;
use app\Category;
use app\Product;
use app\FileWorker;
use app\Brand;
use app\Review;
use app\Basket;
use app\Application;
use app\Banner;


$dataUser = new User(Connect::makeConn(CONNECTION));
$dataCategory = new Category(Connect::makeConn(CONNECTION));
$dataProduct = new Product(Connect::makeConn(CONNECTION));
$dataBrand = new Brand(Connect::makeConn(CONNECTION));
$dataReview = new Review(Connect::makeConn(CONNECTION));
$dataApplication = new Application(Connect::makeConn(CONNECTION));
$dataBanner = new Banner(Connect::makeConn(CONNECTION));
$basketWorker = new Basket(new Product(Connect::makeConn(CONNECTION)));
$fileWorker = new FileWorker();

$currentUser = isset($_SESSION['auth_user_id'])?$dataUser->getUser($_SESSION['auth_user_id']):null;