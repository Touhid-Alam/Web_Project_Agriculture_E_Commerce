document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('form[method="get"]');
    const searchInput = searchForm.querySelector('input[name="search"]');

    searchForm.addEventListener('submit', function(event) {
        if (searchInput.value.trim() === '') {
            alert('Please enter a search term.');
            event.preventDefault();
        }
    });
});
