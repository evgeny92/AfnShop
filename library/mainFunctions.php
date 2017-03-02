<?php
/*Основные функции*/

/**
 * С каким контроллером будем работать
 * Формирование запрашиваемой страницы
 * @param $controllerName
 * @param string $actionName название функции обработ страницы
 */
function loadPage($smarty, $controllerName, $actionName = 'index'){
    include_once PathPrefix . $controllerName . PathPostfix;
    $function = $actionName . 'Action';
    $function($smarty);
}

/**
 * Загрузка шаблона
 * @param object $smarty объект шаблонизатора
 * @param string $templateName название файла шаблона
 */
function loadTemplate($smarty, $templateName){
  //  $templateName .= TemplatePostfix;
    $smarty->display($templateName . TemplatePostfix);
}

/**
 * Фу отладки. Останавливает работу прораммы выводя значение переменой
 * @param null $value переменная для вывода её на страницу
 * @param int $die
 */
function d($value = null, $die = 1){
   function debugOut($a){
      echo '<br><b>'. basename($a['file']) . '</b>'
            ."&nbsp;<font color='red'>({$a['line']})</font>"
            ."&nbsp;<font color='green'>{$a['function']}()</font>"
            ."&nbsp; -- ". dirname($a['file']);
   }

   echo '<pre>';
         $trace = debug_backtrace();
         array_walk($trace, 'debugOut');
         echo "\n\n";
         var_dump($value);
   echo '</pre>';

   if($die) die;
}

/**
 * Преобразование результата работы функции выборки в ассоц массив
 * @param $rs  строк - результат работы SELECT
 * @return array|bool
 */
function createSmartyRsArray($rs){
    if(!$rs) return false;
    $smartyRs = array();
    while($row = mysql_fetch_assoc($rs)){
        $smartyRs[] = $row;
    }
    return $smartyRs;
}

/**
 * Редирект
 * @param string $url адресс для перенаправления
 */
function redirect($url){
    if(! $url) $url = '/';
    header("Location: {$url}");
    exit;
}