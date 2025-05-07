<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myラーメン記録帳</title>
    <link rel="stylesheet" href="index.css?v=1.0.1">
</head>
<body>
<?php if (isset($_SESSION['user_id'])): ?>
    <div class="login-info">
        ようこそ、<?php echo htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8'); ?>さん！
        <form action="logout.php" method="post" style="display:inline;">
        </form>
    </div>
<?php endif; ?>

<div class="container">
    <h1>Myラーメン記録帳</h1>

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

<div id="overlay" style="display:none;"></div>

<!-- ログインモーダル部分 -->
<div id="login-modal" class="modal" style="display:none;">
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
<script src="login.js"></script>
</body>
</html>
