<?php
session_start(); //Запуск сессии

//если в сессии нет массива корзины то создаём его
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

include_once '../config/config.php'; //инициализация настроек
include_once '../config/db.php'; //инициализация бд
include_once '../library/mainFunctions.php'; //основные функции

//С каким контроллером будем работать
$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) : 'Index';
//Определяем какая функция будет вызываться из контроллера и формировать стр..
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

//если в сессии есть даннын об юзере то передам их в шаблон
if(isset($_SESSION['user'])){
    $smarty->assign('arUser', $_SESSION['user']);
}

//инициализируем переменную шаблонизатора кол-ва элем. в корзине
$smarty->assign('cartCntItems', count($_SESSION['cart']));

loadPage($smarty, $controllerName, $actionName);
