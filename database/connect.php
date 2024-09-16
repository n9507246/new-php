<?php


function openConnection(){



    $dsn = 'mysql:host=database;dbname=mydb';
    $username = 'myuser';
    $password = 'mypassword';


    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        exit();
    }
    return $pdo;
}

?>