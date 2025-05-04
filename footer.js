// footer.js
document.addEventListener("DOMContentLoaded", function () {
    const nav = [
        { id: "account-display", url: "account.php" },
        { id: "record-button", url: "record.php" },
        { id: "current-screen-button", url: "index.php" },
        { id: "write-button", url: "comment.php" },
    ];

    nav.forEach(item => {
        const btn = document.getElementById(item.id);
        if (btn) {
            btn.addEventListener("click", () => {
                window.location.href = item.url;
            });
        }
    });
});
