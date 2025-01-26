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

        // Function to check if a username already exists in the database
        function checkUsernameExists($username, $connobject) {
            $query = "SELECT * FROM seller WHERE SellerUsername = '$username'";
            $result = $connobject->query($query);
            return $result && $result->num_rows > 0;
        }

     // Get seller details from the database based on the username
     public function getSellerDetails($username, $conn) {
        $sql = "SELECT * FROM seller WHERE SellerUsername = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();  // Return the seller's data as an associative array
    }

    // Update the seller's profile (including NID file) in the database
    public function updateSellerProfile($username, $email, $businessName, $productType, $fullname, $phone, $address, $district, $NID, $password, $conn) {
        $sql = "UPDATE seller SET 
                Email = ?, 
                BusinessName = ?, 
                ProductType = ?, 
                Fullname = ?, 
                Phone = ?, 
                Address = ?, 
                District = ?, 
                NID = ?, 
                Password = ? 
                WHERE SellerUsername = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $email, $businessName, $productType, $fullname, $phone, $address, $district, $NID, $password, $username);
        
        if ($stmt->execute()) {
            return true;  // Return true if the update is successful
        } else {
            return false;  // Return false if there is an error
        }
    }
        

        // Function to add a seller with the passed AccountID
        function addSeller($username, $password, $email, $businessName, $productType, $fullName, $phone, $address, $district, $nid, $accountID, $connobject) {
            // Insert into the seller table with the passed AccountID
            $sellerQuery = "INSERT INTO seller (SellerUsername, Password, Email, BusinessName, ProductType, Fullname, Phone, Address, District, NID, AccountID) 
                            VALUES ('$username', '$password', '$email', '$businessName', '$productType', '$fullName', '$phone', '$address', '$district', '$nid', '$accountID')";
            
            if ($connobject->query($sellerQuery) === TRUE) {
                return true; // Seller successfully added
            } else {
                return false; // Failed to insert into seller table
            }
        }


        // Function to check seller login credentials and handle sessions
        function checkSellerLogin($username, $password, $connobject) {
            // SQL query to check the seller's credentials
            $query = "SELECT * FROM seller WHERE SellerUsername = '$username' AND password = '$password'";

            // Execute the query
            $result = $connobject->query($query);

            if ($result && $result->num_rows === 1) {
                return true; // Login successful
            } else {
                return false; // Invalid credentials
            }
        }

        // Function to add a product
        function addProduct($sellerUsername, $pName, $price, $quantity, $picture, $details, $connobject) {
            $query = "INSERT INTO product (SellerUsername, PName, Price, Quantity, Picture, Details) VALUES ('$sellerUsername', '$pName', '$price', '$quantity', '$picture', '$details')";
            return $connobject->query($query);
        }

        // Function to get a specific product by PID
        function getProductById($pid, $connobject) {
            $query = "SELECT * FROM product WHERE PID = '$pid'";
            $result = $connobject->query($query);
            return $result->fetch_assoc(); // Returns single result row as associative array
        }

        // Function to update product details
        function updateProduct($pid, $pname, $price, $quantity, $picture, $details, $connobject) {
            if ($picture) {
                $query = "UPDATE product SET PName = '$pname', Price = '$price', Quantity = '$quantity', Picture = '$picture', Details = '$details' WHERE PID = '$pid'";
            } else {
                $query = "UPDATE product SET PName = '$pname', Price = '$price', Quantity = '$quantity', Details = '$details' WHERE PID = '$pid'";
            }

            return $connobject->query($query);
        }

        // Function to get all products from a seller
        function getSellerProducts($sellerUsername, $connobject) {
            $query = "SELECT * FROM product WHERE SellerUsername = '$sellerUsername'";
            $result = $connobject->query($query);
            $products = [];
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $products[] = $row; // Add each product to the products array
                }
            }
            return $products; // Return the array of products
        }

        // Function to delete a product
        function deleteProduct($pid, $connobject) {
            // First, get the product's image file name
            $query = "SELECT Picture FROM product WHERE PID = '$pid'";
            $result = $connobject->query($query);
            if ($result && $result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $imagePath = '../../images/' . $product['Picture'];

                // Delete the image file from the directory
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the image file
                }
            }

            // Now delete the product from the database
            $query = "DELETE FROM product WHERE PID = '$pid'";
            return $connobject->query($query); // Execute the delete query
        }

            // Function to search for products by name for a specific seller
            function searchProducts($sellerUsername, $searchTerm, $connobject) {
                // Sanitize the search term to prevent SQL injection
                $searchTerm = "%" . $connobject->real_escape_string($searchTerm) . "%";
                
                // SQL query to search products by name and match the seller
                $query = "SELECT * FROM product WHERE SellerUsername = '$sellerUsername' AND PName LIKE '$searchTerm'";
                
                // Execute the query
                $result = $connobject->query($query);
                $products = [];
                
                // Fetch all the matching products
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        $products[] = $row; // Add each matching product to the products array
                    }
                }
                
                return $products; // Return the array of products found
            }

            //seller account data
            function getAccountDetails($username, $conn) {
                $sql = "SELECT * FROM account WHERE username = '$username'";
                $result = $conn->query($sql);
        
                if ($result && $result->num_rows > 0) {
                    return $result->fetch_assoc(); // Fetching as an associative array
                } else {
                    return null; // No matching account found
                }
            }

            function getBalance($username, $conn) {
                $sql = "SELECT totalbalance FROM account WHERE username = '$username'";
                $result = $conn->query($sql);
        
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    return floatval($row['totalbalance']);
                }
                return 0; // Default balance if account is not found
            }
        
            function updateBalance($username, $amount, $action, $conn) {
                if ($action === 'add') {
                    $sql = "UPDATE account SET totalbalance = totalbalance + $amount WHERE username = '$username'";
                } elseif ($action === 'withdraw') {
                    $sql = "UPDATE account SET totalbalance = totalbalance - $amount WHERE username = '$username'";
                }
                return $conn->query($sql);
            }

            // Function to fetch the ordered product details for the seller with search and sort functionality
            function getProductHistory($sellerUsername, $searchTerm, $sortOrder, $connobject) {
                $searchTerm = "%" . $connobject->real_escape_string($searchTerm) . "%";
                $query = "SELECT op.order_id, o.BuyerUsername, op.pid, p.PName, op.price, op.quantity, (op.price * op.quantity) AS TotalPrice 
                          FROM orderedproduct op 
                          JOIN product p ON op.pid = p.PID 
                          JOIN orders o ON op.order_id = o.OID 
                          WHERE op.seller_username = ? AND p.PName LIKE ?";
                
                if ($sortOrder === 'asc') {
                    $query .= " ORDER BY p.PName ASC";
                } else {
                    $query .= " ORDER BY p.PName DESC";
                }
            
                $stmt = $connobject->prepare($query);
                $stmt->bind_param("ss", $sellerUsername, $searchTerm);
                $stmt->execute();
                $result = $stmt->get_result();
                $productHistory = [];
                while ($row = $result->fetch_assoc()) {
                    $productHistory[] = $row;
                }
                return $productHistory;
            }
        
    }
    ?>
