<?php
/*
 * Модель для талицы продукции Purchase
 */

/** Внесение в БД данных продуктов с привязкой к заказу
 * @param $orderId
 * @param $cart
 * @return boolean TRUE в случае успеха добавления в бд
 */

function setPurchaseForOrder($orderId, $cart){
 $sql = "INSERT INTO purchase
        (order_id, product_id, price, amount)
        VALUES ";
 $values = array();
    //формируем массив строк для запроса для каждого товара
    foreach($cart as $item){
        $values[] = "('{$orderId}', '{$item['id']}', '{$item['price']}', '{$item['cnt']}')";
    }
 //преобрауем массив в строку
    $sql .= implode($values, ', ');
    $rs = mysql_query($sql);

    return $rs;
}

function getPurchaseForOrder($orderId){
    $sql = "SELECT `pe`.*, `ps`.`name`
            FROM purchase as `pe`
            JOIN products as `ps` ON `pe`.product_id = `ps`.id
            WHERE `pe`.order_id = {$orderId}";
    //d($sql);
    $rs = mysql_query($sql);
    return createSmartyRsArray($rs);
}