<?php
/**
 * Модель для таблицы заказов (orders)
 */

/**
 * Создание заказа (без привязки товара)
 * @param $name
 * @param $phone
 * @param $address
 * @return integer ID созданного заказа
 */
function makeNewOrder($name, $phone, $address){
    //инициализация переменных
    $userId = $_SESSION['user']['id'];
    $comment = "id пользователя:{$userId}<br>
               Имя:{$name}<br>
               Тел:{$phone}<br>
               Адрес:{$address}";
    $dateCreated = date('Y.m.d H:i:s');
    $userIp = $_SERVER['REMOTE_ADDR'];

    //запрос к бд
    $sql = "INSERT INTO 
            orders (`user_id`, `date_created`, `date_payment`,
            `status`, `comment`, `user_ip`)
            VALUES ('{$userId}', '{$dateCreated}', null, '0', '{$comment}', '{$userIp}')";
    $rs = mysql_query($sql);

    //получить id создаваемого заказа
    if($rs){
        $sql = "SELECT id
                FROM orders
                ORDER BY id DESC
                LIMIT 1";
        $rs = mysql_query($sql);
        //преобразование результатов запроса
        $rs = createSmartyRsArray($rs);
        //возвращаем id созданного запроса
        if(isset($rs[0])){
            return $rs[0]['id'];
        }
    }
    return false;
}

/**Получить список заказов с привязкой к продуктам для пользователя
 * @param $userId
 * @return array массив закзаов с привязкой к продуктам
 */
function getOrdersWithProductsByUser($userId){
    $userId = intval($userId);
    $sql = "SELECT * FROM orders
            WHERE `user_id` = '{$userId}'
            ORDER BY id DESC";

    $rs = mysql_query($sql);

    $smartyRs = array();
    while($row = mysql_fetch_assoc($rs)){
        $rsChildren = getPurchaseForOrder($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row;
        }
    }

    return $smartyRs;
}

/**
 * Получить продукты заказа
 *
 * @param integer $orderId ID заказа
 * return array массив даннх товаров
 */
function getProductsForOrder($orderId){

   $sql = "SELECT *
           FROM purchase AS pe 
           LEFT JOIN products AS ps
           ON pe.product_id = ps.id
           WHERE (`order_id` = '{$orderId}')";

   $rs = mysql_query($sql);
   return createSmartyRsArray($rs);
}

/**
 * Обновление статуса заказа
 */
function updateOrderStatus($itemId, $status){
   $status = intval($status);
   $sql = "UPDATE orders 
           SET `status` = '{$status}'
           WHERE id = '{$itemId}'";

   $rs = mysql_query($sql);
   return $rs;
}

/**
 * Обновление даты оплаты закзаа
 */
function updateOrderDatePayment($itemId, $datePayment){
   $sql = "UPDATE orders
           SET `date_payment` = '{$datePayment}'
           WHERE id = '{$itemId}'";

   $rs = mysql_query($sql);

   return $rs;
}