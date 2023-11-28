function filterProducts() {
    
    var selectedCategory = document.getElementById("categories").value;
    var products = document.getElementsByClassName("product");

    for (var i = 0; i < products.length; i++) {
        products[i].style.display = "none";
    }

    if (selectedCategory === "tout") {
        for (var i = 0; i < products.length; i++) {
            products[i].style.display = "block";
        }
    } else {
        var selectedCategoryProducts = document.getElementsByClassName("category-" + selectedCategory);
        for (var i = 0; i < selectedCategoryProducts.length; i++) {
            selectedCategoryProducts[i].style.display = "block";
        }
    }
}