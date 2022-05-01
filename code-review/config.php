<?php

$db_host = 'localhost';
$db_name = 'host1837391_task1';
$db_user = 'host1837391_codereview';
$db_pasword = 'yNfHKzgN';

try {
    $pdo = new PDO('mysql:host='. $db_host .';db_name='.$db_name, $db_user, $db_pasword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage() . '<br>';
    die();
}