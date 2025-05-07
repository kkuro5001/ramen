<?php
    // セッションを開始
    session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ラーメンログ</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .review {
            border: 2px solid #00bfff; /* Light blue border */
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            display: flex;
            align-items: flex-start;
            gap: 15px; /* Space between the text and the image */
        }

        .review img {
            max-width: 150px; /* Adjusted width for better alignment */
            display: block;
            margin-top: 0; /* Remove top margin to align with text */
            order: 2; /* Move image to the right */
        }

        .review-content {
            display: flex;
            flex-direction: column;
            gap: 10px; /* Space between text elements */
        }

        .review-content p {
            margin: 0; /* Remove default margin */
        }
    </style>
</head>
<body>
    <h1>ラーメン思い出ノート</h1>
    <div id="reviews">読み込み中...</div>

    <?php include 'footer.php'; ?>
    <script>
        // ページ読み込み時にレビュー情報を取得
        window.addEventListener('DOMContentLoaded', function() {
            fetch('api_record.php')
                .then(response => response.json())
                .then(reviews => {
                    const reviewsContainer = document.getElementById('reviews');
                    reviewsContainer.innerHTML = ''; // 初期化

                    if (reviews.error) {
                        reviewsContainer.innerHTML = '<p>レビューの読み込みに失敗しました。</p>';
                    } else if (reviews.length === 0) {
                        reviewsContainer.innerHTML = '<p>レビューがまだありません。</p>';
                    } else {
                        reviews.forEach(review => {
                            const reviewElement = document.createElement('div');
                            reviewElement.classList.add('review');

                            let photoHTML = '';
                            if (review.PHOTO) {
                                photoHTML = `<img src="${review.PHOTO}" alt="ラーメンの写真">`;
                            }

                            reviewElement.innerHTML = `
                                <div class="review-content">
                                    <h2>
                                        ${review.STORE_NAME}
                                        <a href="https://www.google.com/maps/search/?q=${encodeURIComponent(review.STORE_NAME)}" target="_blank" style="margin-left: 10px; font-size: 14px; color: blue;">
                                            Google Mapで表示する
                                        </a>
                                    </h2>
                                    <p><strong>コメント:</strong> ${review.COMMENT}</p>
                                    <p><strong>味:</strong> ${review.TASTE_NAME}</p>
                                    <p><strong>投稿日:</strong> ${new Date(review.DATE).toLocaleString()}</p>
                                </div>
                                ${photoHTML}
                            `;
                            reviewsContainer.appendChild(reviewElement);
                        });

                    }
                })
                .catch(error => {
                    const reviewsContainer = document.getElementById('reviews');
                    reviewsContainer.innerHTML = '<p>レビューの読み込みに失敗しました。</p>';
                    console.error('Fetch error:', error);
                });
        });
    </script>
    <script src="footer.js"></script>
</body>
</html>
