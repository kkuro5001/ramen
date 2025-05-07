<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="footer-buttons">
    <a href="index.php" class="footer-button" id="index-button">口コミ</a>
    <a href="comment.php" class="footer-button" id="comment-button">書き込み</a>
    <a href="record.php" class="footer-button" id="record-button">記録</a>
    <?php if (isset($_SESSION['user_name'])): ?>
        <a href="account.php" class="footer-button" id="account-button"><?= htmlspecialchars($_SESSION['user_name']) ?></a>
    <?php else: ?>
        <a href="#" class="footer-button" id="login-button-footer">ログイン</a> <!-- 変更点 -->
    <?php endif; ?>
</div>

<script>
    // フッターのログインボタンがクリックされたとき、モーダルを表示
    document.getElementById('login-button-footer').addEventListener('click', function() {
        document.getElementById('login-modal').style.display = 'block'; // モーダルを表示
        document.getElementById('overlay').style.display = 'block'; // 背景オーバーレイを表示
    });

    // 画面外をクリックしたときにモーダルを閉じる処理
    document.getElementById('overlay').addEventListener('click', function() {
        document.getElementById('login-modal').style.display = 'none'; // モーダルを非表示
        document.getElementById('overlay').style.display = 'none'; // オーバーレイを非表示
    });
</script>

<style>
    .footer-buttons {
    display: flex;
    justify-content: space-around;
    align-items: center;
    position: fixed;
    bottom: 0;
    width: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ffffff;
    padding: 0.5rem 0;
    border-top: 2px solid #00bfff;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
    z-index: 999;
}

.footer-buttons a {
    flex: 1;
    margin: 0 0.2rem;
    padding: 0.8rem 0;
    background: linear-gradient(to right, #00aaff, #007aff);
    color: #fff;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    border-radius: 10px;
    transition: background 0.3s ease, transform 0.2s ease;
    box-shadow: 0 2px 5px rgba(0, 122, 255, 0.3);
}

.footer-buttons a:hover {
    background: linear-gradient(to right, #0088cc, #0056b3);
    transform: scale(1.03);
}

.footer-buttons a:active {
    transform: scale(0.98);
}

/* モーダル・オーバーレイのスタイル */
#overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #ffffff;
    padding: 2rem;
    border-radius: 12px;
    z-index: 1001;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.modal-content {
    position: relative;
    font-family: 'Helvetica Neue', 'Arial', sans-serif;
}

.close-button {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 1.5rem;
    cursor: pointer;
    background-color: #007aff;
    color: white;
    border: none;
    padding: 5px 12px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.close-button:hover {
    background-color: #0056b3;
}

</style>
