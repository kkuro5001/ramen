<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Ramen Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>My Ramen Reviews</h1>
    <div id="reviews"></div>

    <script>
        // ページ読み込み時にレビュー情報を取得
        window.addEventListener('DOMContentLoaded', function() {
            fetch('api_record.php')
                .then(response => response.json())
                .then(reviews => {
                    const reviewsContainer = document.getElementById('reviews');
                    if (reviews.error) {
                        reviewsContainer.innerHTML = '<p>レビューの読み込みに失敗しました。</p>';
                    } else {
                        reviews.forEach(review => {
                            const reviewElement = document.createElement('div');
                            reviewElement.classList.add('review');
                            reviewElement.innerHTML = `
                                <h2>${review.STORE_NAME}</h2>
                                <p><strong>コメント:</strong> ${review.COMMENT}</p>
                                <p><strong>味:</strong> ${review.TASTE_NAME}</p>
                                <p><strong>投稿日:</strong> ${new Date(review.DATE).toLocaleString()}</p>
                            `;
                            reviewsContainer.appendChild(reviewElement);
                        });
                    }
                })
                .catch(error => {
                    const reviewsContainer = document.getElementById('reviews');
                    reviewsContainer.innerHTML = '<p>レビューの読み込みに失敗しました。</p>';
                });
        });
    </script>
</body>
</html>
