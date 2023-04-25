<?php
    //PAGE DE CONNECTION A LA DB

    // $username = "jasonlve";
    // $password = "Difbec141021";
    // $host = "jasonlve.mysql.db";
    // $dbname = "jasonlve";

    $username = "root";
    $password = "";
    $host = "localhost";
    $dbname = "cota";

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    try {
        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    }
    catch(PDOException $ex){
        die("Failed to connect to the database: " . $ex->getMessage());
    }

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //header('Content-Type: text/html; charset=utf-8');
?>