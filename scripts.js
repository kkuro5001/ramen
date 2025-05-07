function showTasteOptions() {
    document.getElementById('taste-options').style.display = 'flex';
}

function selectTaste(taste) {
    document.getElementById('taste').value = taste;
    document.getElementById('taste-options').style.display = 'none';
    alert('選択された味: ' + taste);
}

document.getElementById('review-form').addEventListener('submit', function(event) {
    const tasteInput = document.getElementById('taste');
    if (tasteInput.value === '') {
        alert('味を選択してください。');
        event.preventDefault();
    }

    const photoInput = document.getElementById('photo');
    if (photoInput.files.length === 0) {
        alert('写真を選択してください。');
        event.preventDefault();
    }
});

document.addEventListener("DOMContentLoaded", () => {
    fetch("api_reviews.php")
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("reviews");

            if (Array.isArray(data)) {
                data.forEach(r => {
                    const div = document.createElement("div");
                    div.className = "review";
                    div.innerHTML = `
                        <h3>${r.STORE_NAME}</h3>
                        <p><strong>コメント:</strong> ${r.COMMENT}</p>
                        <p><strong>味:</strong> ${r.TASTE_NAME}</p>
                        <p><strong>投稿日時:</strong> ${r.DATE}</p>
                        <hr>
                    `;
                    container.appendChild(div);
                });
            } else {
                container.innerHTML = `<p>ログインしていないか、データが取得できませんでした。</p>`;
            }
        })
        .catch(err => {
            console.error("読み込みエラー:", err);
            document.getElementById("reviews").innerHTML = "<p>レビューの取得中にエラーが発生しました。</p>";
        });
});


