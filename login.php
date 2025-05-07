<?php
session_start();
require_once __DIR__ . '/db.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM login WHERE EMAIL = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['PASSWORD'])) {
            $_SESSION['user_id'] = $user['ID'];
            $_SESSION['user_name'] = $user['NAME'];
            echo 'success'; // ログイン成功時
        } else {
            echo 'fail'; // ログイン失敗時
        }
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}
