<!-- footer.php -->
<div class="footer-buttons">
    <button id="current-screen-button">口コミ</button>
    <button id="write-button">書き込み</button>
    <button id="record-button">記録</button>
    <button id="account-display">アカウント情報</button>
</div>

<style>
    .footer-buttons {
    display: flex;
    justify-content: space-around;
    margin-top: 1rem;
    padding: 1rem;
    border-top: 2px solid #00bfff; /* 水色の枠組み */
}

.footer-buttons button {
    padding: 0.5rem 1rem;
    border: none;
    background-color: #007aff; /* 青色に変更 */
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
}

.footer-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    position: fixed;
    bottom: 0;
    width: 100%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #fff;
    padding: 1rem;
    border-top: 2px solid #00bfff;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
}

</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("account-display")?.addEventListener("click", function() {
        window.location.href = "account.php";
    });

    document.getElementById("record-button")?.addEventListener("click", function() {
        window.location.href = "record.php";
    });

    document.getElementById("current-screen-button")?.addEventListener("click", function() {
        window.location.href = "index.php";
    });

    document.getElementById("write-button")?.addEventListener("click", function() {
        window.location.href = "comment.php";
    });
});

</script>
