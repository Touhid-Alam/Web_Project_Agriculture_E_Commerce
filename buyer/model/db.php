<?php
class mydb {

    // Function to open a connection to the database
    function openCon() {
        $dbhost = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project";

        // Create a new connection object
        $connobject = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($connobject->connect_error) {
            die("Connection failed: " . $connobject->connect_error);
        }

        return $connobject;
    }

    public function closeCon($conn) {
        $conn->close();
    }

 // Get buyer details from the database based on the username
 public function getBuyerDetails($username, $conn) {
    $sql = "SELECT * FROM buyer WHERE BuyerUsername = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


public function updateBuyerProfile($username, $fullName, $email, $phone, $dateOfBirth, $password, $conn) {
    $sql = "UPDATE buyer SET fullName = ?, email = ?, phone = ?, dateOfBirth = ?, password = ? WHERE BuyerUsername = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fullName, $email, $phone, $dateOfBirth, $password, $username);
    $stmt->execute();
}



    // Function to add a buyer to the database
    function addBuyer($username, $password, $email, $fullName, $phone, $dateOfBirth, $connobject) {
        $query = "INSERT INTO buyer(BuyerUsername, password, email, fullName, phone, dateOfBirth) 
                  VALUES ('$username', '$password', '$email', '$fullName', '$phone', '$dateOfBirth')";
        
        return $connobject->query($query);
    }

    // Function to check buyer login credentials
    function checkBuyerLogin($username, $password, $connobject) {
        $query = "SELECT * FROM buyer WHERE BuyerUsername = '$username' AND password = '$password'";

        // Execute the query
        $result = $connobject->query($query);

        if ($result && $result->num_rows === 1) {
            return true; // Login successful
        } else {
            return false; // Invalid credentials
        }
    }

    // Function to fetch all available products
    function getAllAvailableProducts($connobject) {
        $query = "SELECT * FROM product WHERE Quantity > 0";
        $result = $connobject->query($query);
        $products = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        
        return $products;
    }

    // Function to search available products based on search term
    function searchAvailableProducts($searchTerm, $connobject) {
        $query = "SELECT * FROM product WHERE PName LIKE '%$searchTerm%' AND Quantity > 0";
        $result = $connobject->query($query);
        $products = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        
        return $products;
    }

        // Function to get a specific product by PID
        function getProductById($pid, $connobject) {
            $query = "SELECT * FROM product WHERE PID = '$pid'";
            $result = $connobject->query($query);
            return $result->fetch_assoc(); // Returns single result row as associative array
        }

    // Function to add a product to the cart
    function addProductToCart($username, $pid, $quantity, $connobject) {
        $query = "INSERT INTO cart (BuyerUsername, PID, Quantity) VALUES ('$username', '$pid', '$quantity')
                  ON DUPLICATE KEY UPDATE Quantity = Quantity + '$quantity'";
        return $connobject->query($query);
    }

    // Function to fetch products in the cart
    function getCartProducts($username, $connobject) {
        $query = "SELECT p.PName, p.Price, c.Quantity, (p.Price * c.Quantity) AS TotalPrice 
                  FROM cart c 
                  JOIN product p ON c.PID = p.PID 
                  WHERE c.BuyerUsername = '$username'";
        $result = $connobject->query($query);
        $cartProducts = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cartProducts[] = $row;
            }
        }
        
        return $cartProducts;
    }

    // Function to create a new order
    function createOrder($buyerUsername, $totalPrice, $connobject) {
        $query = "INSERT INTO orders (BuyerUsername, TotalPrice, Status) VALUES ('$buyerUsername', '$totalPrice', 'verifying')";
        $connobject->query($query);
        return $connobject->insert_id;
    }

    // Function to add a product to the orderedproduct table
    function addOrderedProduct($orderId, $pid, $quantity, $price, $sellerUsername, $connobject) {
        $query = "INSERT INTO orderedproduct (order_id, pid, quantity, price, seller_username) VALUES ('$orderId', '$pid', '$quantity', '$price', '$sellerUsername')";
        return $connobject->query($query);
    }

    // Function to update product quantity
    function updateProductQuantity($pid, $quantity, $connobject) {
        $query = "UPDATE product SET Quantity = '$quantity' WHERE PID = '$pid'";
        return $connobject->query($query);
    }

    // Function to get buyer account details
    function getBuyerAccountDetails($username, $conn) {
        $sql = "SELECT * FROM account WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc(); // Fetching as an associative array
        } else {
            return null; // No matching account found
        }
    }

    // Function to get buyer balance
    function getBuyerBalance($username, $conn) {
        $sql = "SELECT totalbalance FROM account WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return floatval($row['totalbalance']);
        }
        return 0; // Default balance if account is not found
    }

    // Function to update buyer balance
    function updateBuyerBalance($username, $amount, $action, $conn) {
        if ($action === 'add') {
            $sql = "UPDATE account SET totalbalance = totalbalance + $amount WHERE username = '$username'";
        } elseif ($action === 'withdraw') {
            $sql = "UPDATE account SET totalbalance = totalbalance - $amount WHERE username = '$username'";
        }
        return $conn->query($sql);
    }

    // Function to fetch the order history for the buyer
    function getOrderHistory($buyerUsername, $connobject) {
        $query = "SELECT OID, TotalPrice, Status FROM orders WHERE BuyerUsername = '$buyerUsername'";
        $result = $connobject->query($query);
        $orders = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        
        return $orders;
    }

    // Function to fetch the details of a specific order
    function getOrderDetails($oid, $connobject) {
        $query = "SELECT op.pid, p.PName, op.price, op.quantity, (op.price * op.quantity) AS TotalPrice, op.seller_username 
                  FROM orderedproduct op 
                  JOIN product p ON op.pid = p.PID 
                  WHERE op.order_id = '$oid'";
        $result = $connobject->query($query);
        $orderDetails = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orderDetails[] = $row;
            }
        }
        
        return $orderDetails;
    }
}
?>
