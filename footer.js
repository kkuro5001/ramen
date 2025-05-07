//使用していない
window.onload = function () {
    console.log("Page Loaded and window.onload event fired (footer.js)");

    const nav = [
        { id: "account-button", url: "account.php" },
        { id: "record-button", url: "record.php" },
        { id: "index-button", url: "index.php" },
        { id: "comment-button", url: "comment.php" },
    ];

    nav.forEach(item => {
        const btn = document.getElementById(item.id);
        if (btn) {
            btn.addEventListener("click", function (event) {
                event.preventDefault(); // デフォルトのリンク遷移を防止
                console.log(`Button clicked: ${item.id}`);
                console.log(`Redirecting to: ${item.url}`);

                // ページ遷移を遅らせるためにsetTimeoutを使用
                setTimeout(function () {
                    window.location.href = item.url; // ページ遷移を実行
                }, 500); // 500ms遅延させてリダイレクト
            });
        } else {
            console.log(`ボタンが見つかりません: ${item.id}`);
        }
    });
};