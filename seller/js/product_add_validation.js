function validateProductName() {
    var PName = document.getElementById("PName").value;
    if (PName.trim() === "") {
        document.getElementById("PNameError").innerHTML = "Product name cannot be empty.";
        return false;
    } else if (/\d/.test(PName)) {
        document.getElementById("PNameError").innerHTML = "Product name cannot contain numbers.";
        return false;
    } else {
        document.getElementById("PNameError").innerHTML = "";
        return true;
    }
}

function validatePrice() {
    var Price = document.getElementById("Price").value;
    if (isNaN(Price) || Price <= 0) {
        document.getElementById("PriceError").innerHTML = "Price must be a valid number.";
        return false;
    } else {
        document.getElementById("PriceError").innerHTML = "";
        return true;
    }
}

function validateQuantity() {
    var Quantity = document.getElementById("Quantity").value;
    if (isNaN(Quantity) || Quantity <= 0) {
        document.getElementById("QuantityError").innerHTML = "Quantity must be a valid number.";
        return false;
    } else {
        document.getElementById("QuantityError").innerHTML = "";
        return true;
    }
}

function validatePicture() {
    var Picture = document.getElementById("Picture").value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (Picture === "") {
        document.getElementById("PictureError").innerHTML = "Please upload a product image.";
        return false;
    } else if (!allowedExtensions.exec(Picture)) {
        document.getElementById("PictureError").innerHTML = "Only JPG, JPEG, and PNG files are allowed.";
        return false;
    } else {
        document.getElementById("PictureError").innerHTML = "";
        return true;
    }
}

function validateProductForm() {
    return validateProductName() && validatePrice() && validateQuantity() && validatePicture();
}
