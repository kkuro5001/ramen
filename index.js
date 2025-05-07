document.addEventListener('DOMContentLoaded', () => {
    const ramenList = document.getElementById('ramen-list');
    const searchBar = document.getElementById('search-bar');
    const tasteSelect = document.getElementById('taste-select');
    const overlay = document.getElementById('overlay');
    const loginModal = document.getElementById('login-modal');
    const newLoginModal = document.getElementById('new-login-modal');
    const closeButtons = document.querySelectorAll('.close-button');
    
    let ramenShops = [];
    let selectedTaste = '';

    // ラーメン店リストを表示する関数
    function displayRamenShops(shops) {
        ramenList.innerHTML = '';
        shops.forEach(shop => {
            const shopItem = document.createElement('div');
            shopItem.className = 'record';
            shopItem.innerHTML = `
                <p><strong>${shop.STORE_NAME}</strong></p>
                <p>${shop.TASTE}</p>
                <p>コメント：${shop.COMMENT}</p>
                <p>投稿者：${shop.USER_NAME}</p>
                ${shop.PHOTO ? `<img src="${shop.PHOTO}" alt="ラーメン写真" style="width:200px;">` : ''}
                <h3>
                    <a href="https://www.google.com/maps/search/?q=${encodeURIComponent('ラーメン ' + shop.STORE_NAME)}" target="_blank" style="color: blue;">Google Mapで表示する</a>
                </h3>

                <p>投稿日：${new Date(shop.DATE).toLocaleString()}</p>
            `;
            ramenList.appendChild(shopItem);
        });
    }

    // ラーメン店をフィルタリングする関数
    function filterRamenShops() {
        const nameTerm = searchBar.value.toLowerCase();
        const selectedTasteValue = tasteSelect.value;

        const filteredShops = ramenShops.filter(shop => {
            const nameMatch = shop.STORE_NAME.toLowerCase().includes(nameTerm) || shop.COMMENT.toLowerCase().includes(nameTerm);
            const tasteMatch = selectedTasteValue === '' || shop.TASTE === selectedTasteValue;

            return nameMatch && tasteMatch;
        });

        displayRamenShops(filteredShops);
    }

    // ラーメン店データを取得する関数
    function fetchRamenShops() {
        fetch('get_ramen_data.php')
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    ramenShops = data;
                    displayRamenShops(ramenShops);
                } else {
                    console.error('取得エラー:', data.error);
                }
            })
            .catch(error => console.error('通信エラー:', error));
    }

    // 検索・フィルタリングのイベント設定
    searchBar.addEventListener('input', filterRamenShops);
    tasteSelect.addEventListener('change', filterRamenShops);

    // 閉じるボタンの処理
    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.body.classList.remove('dimmed');
            loginModal.style.display = 'none';
            newLoginModal.style.display = 'none';
        });
    });

    // オーバーレイクリック時の処理
    overlay.addEventListener('click', () => {
        document.body.classList.remove('dimmed');
        loginModal.style.display = 'none';
        newLoginModal.style.display = 'none';
    });

    // 初期データ取得
    fetchRamenShops();
});

// 新規作成ボタンをクリックした場合の遷移
document.getElementById('signup-button').addEventListener('click', function () {
    window.location.href = 'signup.php';
});
