<?php
/**
 * Модель для таблицы products
 */

/**
 * Получение последних добавленных товаров
 * @param null $limit лимит товаров
 * @return array|bool  массив товаров
*/
function getLastProducts($limit = null){
   $sql = "SELECT * FROM products ORDER BY id DESC";
   if($limit){
      $sql .= " LIMIT {$limit}";
   }
   $rs = mysql_query($sql);
   return createSmartyRsArray($rs);
}

/**
 * Получить продукты для категории $itemId
 * @param integer $itemId ID категории
 * @return array|bool массив продуктов
 */
function getProductsByCat($itemId){
    $itemId = intval($itemId);
    $sql = "SELECT * FROM products WHERE category_id = '{$itemId}'";
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}

/**
 * Фу получает данные о продукте по ID
 * @param integer $itemId ID пролукта
 * @return array массив данных продукта
 */
function getProductById($itemId){
    $itemId = intval($itemId);
    $sql = "SELECT * FROM products WHERE id = '{$itemId}'";
    $rs = mysql_query($sql);
    return mysql_fetch_assoc($rs);
}

/**
 * Получить списко продуктов из массива идентификаторов (ID)
 * @param array $itemsIds массив идентификаторов продуктов
 * @return array|bool массив данных продуктов
 */
function getProductsFromArray($itemsIds){
    $strIds = implode($itemsIds, ',');
    $sql = "SELECT * FROM products WHERE id in ({$strIds})";
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);

}

/**
 * Выбрать все продукты
 *
 * @return array|bool
 */
function getProducts(){
   $sql = "SELECT *
           FROM `products`
           ORDER BY category_id";

   $rs = mysql_query($sql);

   return createSmartyRsArray($rs);
}

/**
 * Добавление продукта в бд
 *
 * @param $itemName
 * @param $itemPrice
 * @param $itemDesc
 * @param $itemCat
 */
function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat){
   $sql = "INSERT INTO products
           SET 
               `name` = '{$itemName}',
               `price` = '{$itemPrice}',
               `description` = '{$itemDesc}',
               `category_id` = '{$itemCat}'";

   $rs = mysql_query($sql);
   return $rs;
}

/**
 * Обновление данных о продуктах
 *
 */
function updateProduct($itemId, $itemName, $itemPrice, $itemStatus,
                          $itemDesc, $itemCat, $newFileName = null){
   $set = array();

   if($itemName){
      $set[] = "`name` = '{$itemName}'";
   }
   if($itemPrice > 0){
      $set[] = "`price` = '{$itemPrice}'";
   }
   if($itemStatus !== null){
      $set[] = "`status` = '{$itemStatus}'";
   }
   if($itemDesc){
      $set[] = "`description` = '{$itemDesc}'";
   }
   if($itemCat){
      $set[] = "`category_id` = '{$itemCat}'";
   }
   if($newFileName){
      $set[] = "`image` = '{$newFileName}'";
   }

   //преобразуем в строку массив
   $setStr = implode($set, ", ");
   $sql = "UPDATE products
           SET {$setStr}
           WHERE id = '{$itemId}'";
   $rs = mysql_query($sql);
   return $rs;
}

/**
 * Обновление названия картинки
 */
function updateProductImage($itemId, $newFileName){
   $rs = updateProduct($itemId, null, null,
                        null, null, null, $newFileName);
   return $rs;
}

/**
 * Получение заказов
 */
function getOrders(){
   $sql = "SELECT o.*, u.name, u.email, u.phone, u.address
           FROM orders AS `o`
           LEFT JOIN users AS `u` ON o.user_id = u.id
           ORDER BY id DESC";

   $rs = mysql_query($sql);

   $smartyRs = array();
   while($row =mysql_fetch_assoc($rs)){

      //массив продуктов для каждого заказа
      $rsChildren = getProductsForOrder($row['id']);

      if($rsChildren){
         $row['children'] = $rsChildren;
         $smartyRs[] = $row;
      }
   }
   return $smartyRs;
}


