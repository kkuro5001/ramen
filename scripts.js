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
