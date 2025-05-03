<?php
    //db接続
    $host = 'localhost';
    $dbname = 'anything';
    $username = 'kkuro';
    $password = '5001';

    //PDOを接続したデータベース接続
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '接続成功: ';
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
?>