<?php

require_once 'config.php';

try {
    $pdo = new PDO('mysql:host='. $db_host .';db_name='.$db_name, $db_user, $db_pasword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    // Debug
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage() . '<br>';
    die();
}