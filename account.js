document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_accounts.php')
        .then(response => response.json())
        .then(data => {
            const accountInfoDiv = document.getElementById('account-info');
            data.forEach(account => {
                const accountDiv = document.createElement('div');
                accountDiv.innerHTML = `<strong>Username:</strong> ${account.USERNAME} <br> <strong>Password:</strong> ${account.PASSWORD}`;
                accountInfoDiv.appendChild(accountDiv);
            });
        })
        .catch(error => console.error('Error fetching account data:', error));
});
