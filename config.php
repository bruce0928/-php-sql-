<?php

//時區設定
date_default_timezone_set('Asia/Taipei');


//主機,帳號, 密碼,資料庫名稱
$mysqli = new mysqli("localhost","root","","db_final");

//編碼設定
$mysqli->set_charset("utf8");



?>

