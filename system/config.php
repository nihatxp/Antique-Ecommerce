<?php 
require_once('function.php');
require_once('db.php');
session_start();
ob_start('compress');
date_default_timezone_set('Europe/Istanbul');

try {
    $conn = new PDO("mysql:host=127.0.0.1;dbname=antika-satis;charset=utf8", 'root', 'secret');
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
##giriş kontrolleri

function IP2(){

    if(getenv("HTTP_CLIENT_IP")){
        $ip = getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}
