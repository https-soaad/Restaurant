const searchInput = document.getElementById('searchInput');
// const categoryFilter = document.getElementById('categoryFilter');
const menuItems = document.getElementById('.menu-item');

document.getElementById('searchInput').addEventListener('input', function () {
    const searchText = this.value.toLowerCase();
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const itemName = item.querySelector('.card-title').textContent.toLowerCase();
        if (itemName.includes(searchText)) {
            item.style.display = 'block'; // Show item if it matches the search text
        } else {
            item.style.display = 'none'; // Hide item if it doesn't match
        }
    });
});

document.getElementById('categoryFilter').addEventListener('change', function () {
    const selectedCategory = this.value;
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        if (selectedCategory === 'all' || itemCategory === selectedCategory) {
            item.style.display = 'block'; // Show item if it matches the category
        } else {
            item.style.display = 'none'; // Hide item if it doesn't match
        }
    });
});