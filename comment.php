<?php
    require_once __DIR__ . '/db.php';

    session_start(); // セッションを開始
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php"); // ログインしていない場合はログインページにリダイレクト
        exit;
    }

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $store_name = $_POST['store_name'];
            $comment = $_POST['comment'];
            $taste = $_POST['taste'];
            $user_id = $_SESSION['user_id']; // セッションからユーザーIDを取得
            //$date = date('Y-m-d H:i:s'); // 現在の日時を取得余裕があればやる

            //画像ファイルをアップロードする

        }

    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>店舗レビュー</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>店舗レビュー</h1>
        <div class="form-container">
            <form id="review-form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="store-name">店名:</label>
                    <input type="text" id="store-name" name="store-name" required>
                </div>
                <div class="form-group">
                    <label for="comment">コメント:</label>
                    <textarea id="comment" name="comment" required></textarea>
                </div>
                <div class="form-group">
                    <label for="taste">味:</label>
                    <button type="button" onclick="showTasteOptions()">味を選択</button>
                    <div class="tags" id="taste-options" style="display: none;">
                        <button type="button" onclick="selectTaste('醤油')">醤油</button>
                        <button type="button" onclick="selectTaste('味噌')">味噌</button>
                        <button type="button" onclick="selectTaste('豚骨')">豚骨</button>
                        <button type="button" onclick="selectTaste('家系')">家系</button>
                        <button type="button" onclick="selectTaste('その他')">その他</button>
                    </div>
                    <input type="hidden" id="taste" name="taste" required>
                </div>
                <div class="form-group">
                    <label for="photo">写真:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <button type="submit">送信</button>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $storeName = htmlspecialchars($_POST['store-name']);
            $comment = htmlspecialchars($_POST['comment']);
            $taste = htmlspecialchars($_POST['taste']);
            $photo = $_FILES['photo'];

            if ($photo['error'] == 0) {
                $photoPath = 'uploads/' . basename($photo['name']);
                move_uploaded_file($photo['tmp_name'], $photoPath);
                echo "<div class='review'>
                        <h2>$storeName</h2>
                        <p><strong>コメント:</strong> $comment</p>
                        <p><strong>味:</strong> $taste</p>
                        <img src='$photoPath' alt='写真'>
                      </div>";
            } else {
                echo "<p>写真のアップロードに失敗しました。</p>";
            }
        }
        ?>
    </div>
    <script src="scripts.js"></script>
</body>
</html>