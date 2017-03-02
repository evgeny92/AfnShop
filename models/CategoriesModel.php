<?php
/**
 * Модель для таблицы (categories)
 */

/**
 * Получить дочерние категории для категории $catId
 * @param integer $catId id категории
 * @return array массив дочерних категорий
 */
function getChildrenForCat($catId){
    $sql = "SELECT * FROM categories WHERE parent_id='{$catId}'";
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}

/**
 * Получить главные категории с привязками дочерних
 * @return array массив категорий
 */
function getAllMainCatsWithChildren(){
    $sql = 'SELECT * FROM categories WHERE parent_id = 0';
    $rs = mysql_query($sql);
    $smartyRs = array();
    while($row = mysql_fetch_assoc($rs)) {
        $rsChildren = getChildrenForCat($row['id']);
        if ($rsChildren) {
            $row['children'] = $rsChildren;
        }
        $smartyRs[] = $row;
    }
    return $smartyRs;
}

/**
 * ПОлучитьданные категории по id
 * @param integer $catId ID катеории
 * @return array массив -строка категории
 */
function getCatById($catId){
    $catId = intval($catId);
    $sql = "SELECT * FROM categories WHERE id = '{$catId}'";
    $rs = mysql_query($sql);
    return mysql_fetch_assoc($rs);
}

/**
 * Получить все главные категории, которые не явл дочерними
 * return array массив категории
 */
function getAllMainCategories(){
   $sql = "SELECT *
           FROM categories
           WHERE parent_id = 0";
   $rs = mysql_query($sql);
   return createSmartyRsArray($rs);
}

/**
 * Добавление новой категории
 * @param $catName
 * @param int $catParentId
 * return integer id новой категрии
 */
function insertCat($catName, $catParentId = 0){
   //запрос
   $sql = "INSERT INTO
           categories (`parent_id`, `name`)
           VALUES ('{$catParentId}', '{$catName}')";
   //выполняем запрос
   mysql_query($sql);

   //получаем Id доб. записи
   $id = mysql_insert_id();
   return $id;
}

/**
 *Получить все категории
 *
 * @return array|bool массив категорий
 */
function getAllCategories(){
   $sql = 'SELECT * 
           FROM categories
           ORDER BY parent_id ASC';

   $rs = mysql_query($sql);

   return createSmartyRsArray($rs);
}

/**
 * Обновление категории
 *
 * @param $itemId ид категории
 * @param int $parentId ид главной кат
 * @param string $newName новое имя кат
 * @return resource
 */
function updateCategoryData($itemId, $parentId = -1, $newName = ''){
   $set = array();

   if($newName){
      $set[] = "`name` = '{$newName}'";
   }
   if($parentId > -1){
      $set[] = "`parent_id` = '{$parentId}'";
   }

   $setStr = implode($set, ", ");

   $sql = "UPDATE categories
           SET {$setStr}
           WHERE id = '{$itemId}'";

   $rs = mysql_query($sql);

   return $rs;
}