document.addEventListener('DOMContentLoaded', () => {
    const ramenList = document.getElementById('ramen-list');
    const searchBar = document.getElementById('search-bar');
    const loginButton = document.getElementById('login-button');
    const signupButton = document.getElementById('signup-button');
    const overlay = document.getElementById('overlay');
    const loginModal = document.getElementById('login-modal');
    const closeButton = document.querySelector('.close-button');

    const ramenShops = [
        {
            id: 1,
            shopName: '麺屋 魂心家',
            price: 850,
            taste: '豚骨',
            address: '大阪市北区桐田3-1',
            comment: '濃厚スープに中太麺がよう絡んで最高！ライス無料もありがたい！',
            userName: 'ラーメン太郎',
            photo: 'ramen1.jpg',
            favorite: false
        },
        {
            id: 2,
            shopName: 'らーめん亀王',
            price: 780,
            taste: '醤油',
            address: '大阪市北区桐田3-1',
            comment: '昔ながらの味やけど、チャーシューがトロトロで虜になる！',
            userName: 'ラーメン次郎',
            photo: 'ramen2.jpg',
            favorite: true
        }
        // 他のラーメン店のデータ
    ];

    function displayRamenShops(shops) {
        ramenList.innerHTML = '';
        shops.forEach(shop => {
            const shopItem = document.createElement('div');
            shopItem.className = 'record';
            shopItem.innerHTML = `
                <h3>${shop.shopName}</h3>
                <p><strong>${shop.taste}</strong>　¥${shop.price}</p>
                <p>住所：${shop.address}</p>
                <a href="#">GoogleMapで開く</a>
                <p>${shop.comment}</p>
                <p>友達：${shop.userName}</p>
            `;
            ramenList.appendChild(shopItem);
        });
    }

    searchBar.addEventListener('input', () => {
        const searchTerm = searchBar.value.toLowerCase();
        const filteredShops = ramenShops.filter(shop => shop.shopName.toLowerCase().includes(searchTerm));
        displayRamenShops(filteredShops);
    });

    loginButton.addEventListener('click', () => {
        document.body.classList.add('dimmed');
        loginModal.style.display = 'block';
    });

    signupButton.addEventListener('click', () => {
        window.location.href = 'signup.html'; // Redirect to signup page
    });

    closeButton.addEventListener('click', () => {
        document.body.classList.remove('dimmed');
        loginModal.style.display = 'none';
    });

    overlay.addEventListener('click', () => {
        document.body.classList.remove('dimmed');
        loginModal.style.display = 'none';
    });

    displayRamenShops(ramenShops);
});
