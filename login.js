document.addEventListener('DOMContentLoaded', function() {
    const loginButton = document.getElementById('login-button'); // ヘッダーのログインボタン
    const loginButtonFooter = document.getElementById('login-button-footer'); // フッターのログインボタン
    const loginModal = document.getElementById('login-modal');
    const overlay = document.getElementById('overlay');
    const closeButton = document.querySelector('.close-button');
    const loginForm = document.getElementById('login-form');

    // モーダルを表示する共通関数
    function showLoginModal() {
        loginModal.style.display = 'block';
        overlay.style.display = 'block';
    }

    // ヘッダーのログインボタンイベント
    if (loginButton) {
        loginButton.addEventListener('click', showLoginModal);
    }

    // フッターのログインボタンイベント
    if (loginButtonFooter) {
        loginButtonFooter.addEventListener('click', showLoginModal);
    }

    // ×ボタンでモーダルを閉じる
    if (closeButton) {
        closeButton.addEventListener('click', function() {
            loginModal.style.display = 'none';
            overlay.style.display = 'none';
        });
    }

    // オーバーレイクリックでモーダルを閉じる
    if (overlay) {
        overlay.addEventListener('click', function() {
            loginModal.style.display = 'none';
            overlay.style.display = 'none';
        });
    }

    // ログインフォーム送信処理
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch('login.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'email': email,
                    'password': password
                })
            })
            .then(response => response.text())
            .then(data => {
                if (data === 'success') {
                    loginModal.style.display = 'none';
                    overlay.style.display = 'none';
                    location.reload(); // ページをリロード
                } else {
                    alert('ログインに失敗しました。再度お試しください。');
                }
            })
            .catch(error => {
                console.error('ログインエラー:', error);
            });
        });
    }
});
