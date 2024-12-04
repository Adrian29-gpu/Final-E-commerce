import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function addToFavorites(productId) {
    fetch(`/buyer/favorites`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ product_id: productId }),
    })
    .then(response => {
        if (response.ok) {
            alert('Product added to favorites!');
        } else {
            alert('Failed to add product to favorites.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
