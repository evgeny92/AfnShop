<?php
/**
 * Контроллер страницы товара {/product/1}
 */

//подключение моделей
include_once '../models/ProductsModel.php';
include_once '../models/CategoriesModel.php';

/**
 * Формирование страницы продукта
 */
function indexAction($smarty){
    $itemId = isset($_GET['id']) ? $_GET['id'] : null;
    if ($itemId == null) exit();

    //получить данные продукта
    $rsProduct = getProductById($itemId);

    //Получить все категории
    $rsCategories = getAllMainCatsWithChildren();

    //Если эл-т есть в массиве то выводим
    $smarty->assign('itemInCart', 0);
    if(in_array($itemId, $_SESSION['cart'])){
        $smarty->assign('itemInCart', 1);
    }

    $smarty->assign('pageTitle', '');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProduct', $rsProduct);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'product');
    loadTemplate($smarty, 'footer');
}
