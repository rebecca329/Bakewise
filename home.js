
const searchBtn = document.getElementById("search-btn");
const searchBar = document.getElementById("search-bar");
const searchInput = document.getElementById("search-input");
const searchSubmit = document.getElementById("search-submit");


searchBtn.addEventListener("click", () => {
    searchBar.style.display = "block";
    searchInput.focus();
});


searchSubmit.addEventListener("click", () => {
    const query = searchInput.value.trim();
    if (query) {
        
        alert("Searching for: " + query);
       
        window.location.href = `products.php?search=${encodeURIComponent(query)}`;
    } else {
        alert("Please enter a search term.");
    }
});
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        searchBar.style.display = "none";
    }
});
