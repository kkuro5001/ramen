document.addEventListener('DOMContentLoaded', function() {
    fetch('fetch_user_reviews.php')
        .then(response => response.json())
        .then(data => {
            const reviewsDiv = document.getElementById('reviews');
            if (data.error) {
                reviewsDiv.innerHTML = `<strong>Error:</strong> ${data.error}`;
            } else {
                data.forEach(review => {
                    const reviewDiv = document.createElement('div');
                    reviewDiv.innerHTML = `<strong>Store Name:</strong> ${review.STORE_NAME} <br> 
                                           <strong>Comment:</strong> ${review.COMMENT} <br> 
                                           <strong>Taste:</strong> ${review.TASTE_NAME} <br> 
                                           <strong>Date:</strong> ${review.DATE}`;
                    reviewsDiv.appendChild(reviewDiv);
                });
            }
        })
        .catch(error => console.error('Error fetching reviews:', error));
});
