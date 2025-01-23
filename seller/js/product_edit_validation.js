function validateProductName() {
    var PName = document.getElementById("PName").value;
    if (/\d/.test(PName)) {
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
    if (Picture !== "" && !allowedExtensions.exec(Picture)) {
        document.getElementById("PictureError").innerHTML = "Only JPG, JPEG, and PNG files are allowed.";
        return false;
    } else {
        document.getElementById("PictureError").innerHTML = "";
        return true;
    }
}

function validateProductType() {
    var productType = document.getElementById("ProductType").value;
    if (productType.trim() === "") {
        document.getElementById("ProductTypeError").innerHTML = "Product type cannot be empty.";
        return false;
    } else {
        document.getElementById("ProductTypeError").innerHTML = "";
        return true;
    }
}

function validateProductForm() {
    return validateProductName() && validatePrice() && validateQuantity() && validatePicture() && validateProductType();
}
