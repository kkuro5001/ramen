<?php
session_start(); // セッションを開始
// DB接続情報
$host = 'localhost';
$dbname = 'anything';
$username = 'kkuro';
$password = '5001';

// セッションの確認
if (isset($_SESSION['user_id'])) {
    echo "ログイン中: ユーザーID = " . $_SESSION['user_id'] . ", ユーザー名 = " . $_SESSION['user_name'];
} else {
    echo "ログインしていません";
}

try {
    // api_record.php
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("
        SELECT 
            ramen_reviews.ID AS REVIEW_ID,
            ramen_reviews.STORE_NAME, 
            ramen_reviews.COMMENT, 
            taste.NAME AS TASTE_NAME, 
            ramen_reviews.DATE,
            ramen_photos.PHOTO
        FROM ramen_reviews
        JOIN taste ON ramen_reviews.TASTE_ID = taste.ID
        LEFT JOIN ramen_photos ON ramen_reviews.ID = ramen_photos.REVIEW_ID
        WHERE ramen_reviews.USER_ID = :user_id
        ORDER BY ramen_reviews.DATE DESC
    ");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 写真をbase64にエンコード
    foreach ($reviews as &$review) {
        if ($review['PHOTO']) {
            $review['PHOTO'] = 'data:image/jpeg;base64,' . base64_encode($review['PHOTO']);
        } else {
            $review['PHOTO'] = null;
        }
    }

    echo json_encode($reviews);
} else {
    echo json_encode(['error' => 'User not logged in']);
}

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
