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
.footer-buttons button {
    padding: 0.5rem 1rem;
    border: none;
    background-color: #007aff;
    color: white;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
}
</style>
