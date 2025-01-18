<script>
    document.addEventListener'DOMContentLoaded', () = {
        document.querySelectorAll('.fas.fa-heart').forEach(heart => {
            heart.addEventListener('click', function (e) {
                e.preventDefault();

                const productId = this.closest('.icons').querySelector('.cart-btn').dataset.id;
                const action = this.classList.contains('active') ? 'remove' : 'add';

                fetch('wishlist.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ action, productId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'added') {
                            this.classList.add('active');
                            alert('Added to wishlist!');
                        } else if (data.status === 'removed') {
                            this.classList.remove('active');
                            alert('Removed from wishlist!');
                        } else {
                            alert('Error processing request.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        })
    }
</script>
