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
            $taste_name = $_POST['taste'];
            $user_id = $_SESSION['user_id'];

            // 味のIDを取得
            $taste_stmt = $pdo->prepare("SELECT ID FROM taste WHERE NAME = :name");
            $taste_stmt->bindParam(':name', $taste_name, PDO::PARAM_STR);
            $taste_stmt->execute();
            $taste_row = $taste_stmt->fetch(PDO::FETCH_ASSOC);
            $taste_id = $taste_row ? $taste_row['ID'] : null;

            // 写真データ取得
            $photo_data = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photo_data = file_get_contents($_FILES['photo']['tmp_name']);
            }

            if ($taste_id) {
                // レビュー情報を挿入
                $stmt = $pdo->prepare("INSERT INTO ramen_reviews (STORE_NAME, COMMENT, TASTE_ID, USER_ID) 
                                        VALUES (:store_name, :comment, :taste_id, :user_id)");
                $stmt->bindParam(':store_name', $store_name);
                $stmt->bindParam(':comment', $comment);
                $stmt->bindParam(':taste_id', $taste_id, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $stmt->execute();

                $review_id = $pdo->lastInsertId(); // 新しいレビューIDを取得

                // 画像があれば別テーブルに保存
                if ($photo_data) {
                    $photo_stmt = $pdo->prepare("INSERT INTO ramen_photos (REVIEW_ID, PHOTO) VALUES (:review_id, :photo)");
                    $photo_stmt->bindParam(':review_id', $review_id, PDO::PARAM_INT);
                    $photo_stmt->bindParam(':photo', $photo_data, PDO::PARAM_LOB);
                    $photo_stmt->execute();
                }
                echo "<p>レビューを保存しました！</p>";
            } else {
                echo "<p>味の選択が無効です。</p>";
            }
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
                    <input type="text" id="store-name" name="store_name" required>
                </div>
                <div class="form-group">
                    <label for="comment">コメント:</label>
                    <textarea id="comment" name="comment" required oninput="adjustTextareaHeight(this)"></textarea>
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

    </div>
    <?php include 'footer.php'; ?>
    <script src="scripts.js"></script>
    <script src="footer.js"></script>
    <script>
        function showTasteOptions() {
            document.getElementById('taste-options').style.display = 'flex';
        }
 
        function selectTaste(taste) {
            document.getElementById('taste').value = taste;
            document.getElementById('taste-button').textContent = taste;
            document.getElementById('taste-options').style.display = 'none';
        }
 
        function adjustTextareaHeight(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        }
    </script>
</body>

</html>