document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('form[method="get"]');
    const searchInput = searchForm.querySelector('input[name="search"]');

    searchForm.addEventListener('submit', function(event) {
        if (searchInput.value.trim() === '') {
            alert('Please enter a search term.');
            event.preventDefault();
        } else {
            event.preventDefault(); // Prevent the default form submission

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById("searchResults").innerHTML = xhr.responseText;
                }
            };

            xhr.open("GET", searchForm.action + "?search=" + encodeURIComponent(searchInput.value), true);
            xhr.send();
        }
    });
});
