<?php
//~ Старт сессии
session_start();

include_once 'module.php';

//~ Параметры потключения к бд
$dsn ='mysql:host=192.168.137.106;dbname=db1063074_losta';
$dblogin = 'u1063074_losta';
$dbpassword = '4n9I)e_M.Y1&xX,s';

// подключаемся к бд
$db = new mysql();
$param = $db->connect($dsn, $dblogin, $dbpassword); // создали экземпляр коннекта БД
$auth = new auth($param); 							// передел экземпляр коннекта БД в класс авторизации
$appFormAction = new appFormAction($param); 		// передел экземпляр коннекта БД в класс экшенов анкеты (ApplicationForm)

DEFINE("SECRET_KEY", "LOL");
mb_internal_encoding("UTF-8");
?>
