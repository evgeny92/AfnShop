<?php
/**
 * Модель для табл пользоватлей
 */

/**
 * Регистрация нового пользователя
 * @param string $email почта
 * @param string $pwdMD5 пароль
 * @param string $name имя пользователя
 * @param string $phone телефон
 * @param string $address адрес пользователя
 * return array массив данных нов пользователя
 */
function registerNewUser($email, $pwdMD5, $name, $phone, $address){
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $name = htmlspecialchars(mysql_real_escape_string($name));
    $phone = htmlspecialchars(mysql_real_escape_string($phone));
    $address = htmlspecialchars(mysql_real_escape_string($address));

    $sql = "INSERT INTO 
            users(`email`, `pwd`, `name`, `phone`, `address`)
            VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$address}')";
    $rs = mysql_query($sql);

    if($rs){
        $sql = "SELECT * FROM users 
                WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}')
                LIMIT 1";
        $rs = mysql_query($sql);
        $rs = createSmartyRsArray($rs);

        if(isset($rs[0])){
            $rs['success'] = 1;
        }else{
            $rs['success'] = 0;
        }
    }else{
        $rs['success'] = 0;
    }
    return $rs;
}

/**
 * Проверка параметров для регистрации пользователя
 * @param string $email
 * @param string $pwd1
 * @param string $pwd2
 * @return array null
 */
function checkRegisterParams($email, $pwd1, $pwd2){

    $res = null;

    if(!$email){
        $res['success'] = false;
        $res['message'] = 'Введите e-mail';
    }

    if(!$pwd1){
        $res['success'] = false;
        $res['message'] = 'Введите пароль';
    }

    if(!$pwd2){
        $res['success'] = false;
        $res['message'] = 'Повторите пароль';
    }

    if($pwd1 != $pwd2){
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
    }

    return $res;

}

/**
 * Проверка почты есть e-mail в бд
 * @param string $email
 * @return array|bool|resource массив строка из табд users либо пустой массив
 */
function checkUserEmail($email){
    $email = mysql_real_escape_string($email);
    $sql = "SELECT id FROM users WHERE email = '{$email}'";

    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);

    return $rs;
}

/**
 * Авторизация пользователя
 * @param string $email
 * @param string $pwd
 * @return array|bool|resource массив данных пользователя
 */
function loginUser($email, $pwd){
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $pwd = md5($pwd);

    $sql = "SELECT * FROM users
            WHERE (`email` = '{$email}' and `pwd` = '{$pwd}')
            LIMIT 1";

    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);
    if(isset($rs[0])){
        $rs['success'] = 1;
    }else{
        $rs['success'] = 0;
    }
    return $rs;
}

function security($data){
    htmlspecialchars(mysql_real_escape_string($data));
    return $data;
}
/**
 * Изменение данных пользователя
 * @param string $name
 * @param string $phone
 * @param string $address
 * @param string $pwd1
 * @param string $pwd2
 * @param string $curPwd
 * return boolean TRUE в случае успеха
 */
function updateUserData($name, $phone, $address, $pwd1, $pwd2, $curPwd){
    $email = security($_SESSION['user']['email']);
    $name = security($name);
    $phone = security($phone);
    $address = security($address);
    $pwd1 = trim($pwd1);
    $pwd2 = trim($pwd2);

    $newPwd = null;
    if($pwd1 && ($pwd1 == $pwd2)){
        $newPwd = md5($pwd1);
    }

    $sql = "UPDATE users
            SET ";
    if($newPwd){
        $sql .= "`pwd` = '{$newPwd}', ";
    }

    $sql .= " `name` = '{$name}',
              `phone` = '{$phone}',
              `address` = '{$address}'
            WHERE
              `email` = '{$email}' AND `pwd` = '{$curPwd}'
            LIMIT 1";
    $rs = mysql_query($sql);

    return $rs;
}

/**
 * Получить данные заказа текущего пользователя
 * return array массив закащов с привязкой к подуктам
 */
function getCurUserOrders(){
    $userId = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;
    $rs = getOrdersWithProductsByUser($userId);
    return $rs;

}