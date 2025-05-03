<?php
    require_once __DIR__ . '/db.php';
    // DB接続
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myラーメン記録帳</title>
    <link rel="stylesheet" href="samp.css">
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
            
            <div class="tags">
                <button>味</button>
                <button>醤油</button>
                <button>味噌</button>
                <button>豚骨</button>
                <button>家系</button>
                <button>その他</button>
            </div>
            
            <input type="text" placeholder="エリア">
            <label><input type="checkbox"> お気に入りのみ</label>
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
            <form id="login-form">
                <label for="email">メールアドレス:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">パスワード:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">ログイン</button>
                <button id="signup-button">新規作成</button>
            </form>
        </div>
    </div>
    
    <script src="samp.js"></script>
</body>
</html>
