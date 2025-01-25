// JavaScript to toggle search bar visibility
const searchBtn = document.getElementById("search-btn");
const searchBar = document.getElementById("search-bar");
const searchInput = document.getElementById("search-input");
const searchSubmit = document.getElementById("search-submit");

// Show the search bar when the search icon is clicked
searchBtn.addEventListener("click", () => {
    searchBar.style.display = "block";
    searchInput.focus();
});

// Close the search bar when the user submits a search
searchSubmit.addEventListener("click", () => {
    const query = searchInput.value.trim();
    if (query) {
        // Perform the search action (e.g., redirect to a search results page or filter products)
        alert("Searching for: " + query);
        // Redirect to a products page or filter function (replace with actual search logic)
        window.location.href = `products.php?search=${encodeURIComponent(query)}`;
    } else {
        alert("Please enter a search term.");
    }
});
// Close search bar when "Esc" is pressed
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        searchBar.style.display = "none";
    }
});
