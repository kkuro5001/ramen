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
        } else {
            echo "メールアドレスまたはパスワードが間違っています。";
        }
        

        // echo "メールアドレス: " . htmlspecialchars($email) . "<br>";
        // echo "パスワード: " . htmlspecialchars($password) . "<br>";
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
    <title>Myラーメン記録帳</title>
    <link rel="stylesheet" href="index.css?v=1.0.1">
</head>
<body>
    <div class="container">
        <h1>Myラーメン記録帳</h1>

        <div class="header-buttons">

            <button id="login-button">ログイン / 新規作成</button>
        </div>

        <section class="search">
    <h2>絞り込み検索</h2>
    <input type="text" id="search-bar" placeholder="店名">

    <!-- 味のプルダウン -->
    <div class="taste-filter">
    <label for="taste-select">味を選択:</label>
    <select id="taste-select">
        <option value="">選択してください</option>
        <option value="醤油">醤油</option>
        <option value="味噌">味噌</option>
        <option value="豚骨">豚骨</option>
        <option value="家系">家系</option>
        <option value="その他">その他</option>
    </select>
</div>

</section>


        <section id="ramen-list">
            <!-- ラーメン店のリストがここに表示されます -->
        </section>
    </div>

    <div id="overlay"></div>

    <div id="login-modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>ログイン</h2>
            <form id="login-form" method="POST">
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">ログイン</button>
                <button type="button" id="signup-button">新規作成</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="index.js"></script>
    <script src="footer.js"></script>
</body>
</html>
