<?php
/**
 * Контроллер админки сайта
 */

//подключение моделей
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

$smarty->setTemplateDir(TemplateAdminPrefix);
$smarty->assign('templateWebPath', TemplateAdminWebPath);

//экшн для главной странички
function indexAction($smarty){

   $rsCategories = getAllMainCategories();

   $smarty->assign('rsCategories', $rsCategories);
   $smarty->assign('pageTitle', 'Управление сайтом');

   loadTemplate($smarty, 'adminHeader');
   loadTemplate($smarty, 'admin');
   loadTemplate($smarty, 'adminFooter');

}

/**
 * Добавление новой категории
 */
function addnewcatAction(){
   $catName = $_POST['newCategoryName'];
   $catParentId = $_POST['generalCatId'];

   $res = insertCat($catName, $catParentId);
   if($res){
      $resData['success'] = 1;
      $resData['message'] = 'Категория добавлена';
   }else{
      $resData['success'] = 0;
      $resData['message'] = 'Ошибка добавления категории';
   }

   echo json_encode($resData);
   return;
}

/**
 * Страница упр. категориями
 * @param $smarty
 */
function categoryAction($smarty){
   $rsCategories = getAllCategories();
   $rsMainCategories = getAllMainCategories();

   $smarty->assign('rsCategories', $rsCategories);
   $smarty->assign('rsMainCategories', $rsMainCategories);
   $smarty->assign('pageTitle', 'Управление сайтом');

   loadTemplate($smarty, 'adminHeader');
   loadTemplate($smarty, 'adminCategory');
   loadTemplate($smarty, 'adminFooter');
}

/**
 * Обновление категории
 */
function updatecategoryAction(){
   $itemId = $_POST['itemId'];
   $parentId = $_POST['parentId'];
   $newName = $_POST['newName'];

   $res = updateCategoryData($itemId, $parentId, $newName);

   if($res){
      $resData['success'] = 1;
      $resData['message'] = 'Категория обнавлена';
   }else{
      $resData['success'] = 0;
      $resData['message'] = 'Ошибка изменения данных категории';
   }

   echo json_encode($resData);
   return;
}

/**
 * Страница упр товарами
 *
 * @param $smarty
 */
function productsAction($smarty){
   $rsCategories = getAllCategories();
   $rsProducts = getProducts();

   $smarty->assign('rsCategories', $rsCategories);
   $smarty->assign('rsProducts', $rsProducts);
   $smarty->assign('pageTitle', 'Управление сайтом');

   loadTemplate($smarty, 'adminHeader');
   loadTemplate($smarty, 'adminProducts');
   loadTemplate($smarty, 'adminFooter');
}

/**
 * Добавление товара c помощью ajax
 */
function addproductAction(){
   $itemName = $_POST['itemName'];
   $itemPrice = $_POST['itemPrice'];
   $itemDesc = $_POST['itemDesc'];
   $itemCat = $_POST['itemCatId'];

   $res = insertProduct($itemName, $itemPrice, $itemDesc, $itemCat);

   if($res){
      $resData['success'] = 1;
      $resData['message'] = 'Изменения успешно внесены';
   }else{
      $resData['success'] = 0;
      $resData['message'] = 'Ошибка изменения данных';
   }

   echo json_encode($resData);
   return;
}

/**
 * Обновление продуктов
 */
function updateproductAction(){
   $itemId = $_POST['itemId'];
   $itemName = $_POST['itemName'];
   $itemPrice = $_POST['itemPrice'];
   $itemStatus = $_POST['itemStatus'];
   $itemDesc = $_POST['itemDesc'];
   $itemCat = $_POST['itemCatId'];

   $res = updateProduct($itemId, $itemName, $itemPrice,
                              $itemStatus, $itemDesc, $itemCat);

   if($res){
      $resData['success'] = 1;
      $resData['message'] = 'Изменения успешно внесены';
   }else{
      $resData['success'] = 0;
      $resData['message'] = 'Ошибка изменения данных';
   }

   echo json_encode($resData);
   return;
}

/**
 * Загрузка изображения
 */
function uploadAction(){
   $maxSize = 2 * 1024 * 1024;

   $itemId = $_POST['itemId'];
   //получаем расширение загружаемого файла
   $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
   //создам имя файла
   $newFileName = $itemId . '.' . $ext;

   if($_FILES["filename"]["size"] > $maxSize){
      echo ("Размер файла превышает два мб");
      return;
   }
   //Загружен ли файл
   if(is_uploaded_file($_FILES['filename']['tmp_name'])){

      //Если файл загружен то перемещаем его из временной директории в конечную
      $res = move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/images/products/' . $newFileName);
      if($res){
         $res = updateProductImage($itemId, $newFileName);
         if($res){
            redirect('/admin/products/');
         }
      }
   }else{
      echo ("Ошибка загрузки файла");
   }
}

/**
 * Страница заказов
 */
function ordersAction($smarty){

   $rsOrders = getOrders();

   $smarty->assign('rsOrders', $rsOrders);
   $smarty->assign('pageTitle', 'Заказы');

   loadTemplate($smarty, 'adminHeader');
   loadTemplate($smarty, 'adminOrders');
   loadTemplate($smarty, 'adminFooter');
}

/**
 * Экшн для установки нового статуса заказа
 */
function setorderstatusAction(){
   $itemId = $_POST['itemId'];
   $status = $_POST['status'];

   $res = updateOrderStatus($itemId, $status);

   if($res){
      $resData['success'] = 1;
   }else{
      $resData['success'] = 0;
      $resData['message'] = 'Ошибка установки статуса';
   }

   echo json_encode($resData);
   return;
}

/**
 * Экшн для обнвления даты оплаты
 */
function setorderdatepaymentAction(){
   $itemId = $_POST['itemId'];
   $datePayment = $_POST['datePayment'];

   $res = updateOrderDatePayment($itemId, $datePayment);

   if($res){
      $resData['success'] = 1;
   }else{
      $resData['success'] = 0;
      $resData['message'] = 'Ошибка установки статуса';
   }

   echo json_encode($resData);
   return;
}

/**
 * Экоспорт в XML
 */
function createxmlAction(){
   $rsProducts = getProducts();

   $xml = new DomDocument('1.0', utf-8);
   $xmlProducts = $xml->appendChild($xml->createElement('products'));

   foreach($rsProducts as $product){
      $xmlProduct = $xmlProducts->appendChild($xml->createElement('product'));
      foreach($product as $key => $val){
         $xmlName = $xmlProduct->appendChild($xml->createElement($key));
         $xmlName->appendChild($xml->createTextNode($val));
      }
   }
   $xml->save($_SERVER["DOCUMENT_ROOT"] . '/xml/products.xml');
   echo 'ok';
}