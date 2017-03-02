<?php
/**
 * Файл для подключения к бд
 */
$dblocation = 'localhost';
$dbname = 'afanshop';
$dbuser = 'root';
$dbpasswd = '';

//соединение с бд
$db = mysql_connect($dblocation, $dbuser, $dbpasswd);
//проверка на ошибки
if(!$db){
    echo 'Ошибка доступа к Mysql';
    exit();
}
//кодировка по умолчанию
mysql_set_charset('utf8');

if(!mysql_select_db($dbname, $db)){
    echo "Ошибка доступа к базе{$dbname}";
    exit;
}