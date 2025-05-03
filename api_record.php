<?php
// DB接続情報
$host = 'localhost';
$dbname = 'anything';
$username = 'kkuro';
$password = '5001';

session_start(); // セッション開始

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ログインユーザーのIDを取得
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // レビュー情報を取得
        $stmt = $pdo->prepare("
            SELECT
                ramen_reviews.STORE_NAME,
                ramen_reviews.COMMENT,
                taste.NAME AS TASTE_NAME,
                ramen_reviews.DATE
            FROM ramen_reviews
            JOIN taste ON ramen_reviews.TASTE_ID = taste.ID
            WHERE ramen_reviews.USER_ID = :user_id
            ORDER BY ramen_reviews.DATE DESC
        ");
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // JSON形式で出力
        echo json_encode($reviews);
    } else {
        echo json_encode(['error' => 'User not logged in']);
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
