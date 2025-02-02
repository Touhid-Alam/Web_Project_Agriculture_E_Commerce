<?php

class mydb {
    // Method to open database connection
    function openCon() {
        $dbhost = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "project"; // Database name

        // Create a new connection to the database
        $connobject = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
        
        // Check if the connection was successful
        if ($connobject->connect_error) {
            die("Connection failed: " . $connobject->connect_error);
        }
        
        // Return the connection object
        return $connobject;
    }

    // Method to add an admin
    function addAdmin($table, $username, $email, $password, $fullname, $idProofPath, $connobject) {
        // Prepare SQL query to insert a new admin record
        $sql = "INSERT INTO $table ( AdminUsername,Email , Password,Fullname, NID) 
                VALUES ( '$username', '$email', '$password', '$fullname', '$idProofPath')";
        
        // Execute the query and return the result
        return $connobject->query($sql);
    }
    
    function loginAdmin($table, $username, $password, $connobject) {
        // Prepare SQL query to check for the username and password
        $sql = "SELECT AdminUsername,Password FROM $table WHERE AdminUsername = '$username' AND Password = '$password'";
        
        // Execute the query
        $result = $connobject->query($sql);

        return $result;
    }
    function deleteAdmin($table, $username, $conn) {
        $sql = "DELETE FROM $table WHERE AdminUsername = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        return $stmt->execute();
    }
    
    function showAlladmin($table,$connobject)
    {
        $sql="SELECT* FROM $table";
        $result=$connobject->query($sql);
        return $result;
    }

    public function searchAdmin($table, $username, $conn) {
        // Secure the username input to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $username);

        // SQL query to search for the admin by username
        $sql = "SELECT * FROM $table WHERE AdminUsername = '$username' LIMIT 1";

        // Execute the query and return the result
        $result = $conn->query($sql);
        return $result;
    }
    function viewAdmin($table,$username,$connobject)
    {
        $sql="SELECT * FROM $table WHERE AdminUsername = '$username'";
        $result=$connobject->query($sql);
        return $result;
    }
    function updateAdmin($table, $AdminUsername, $email, $password, $fullname, $NID, $connobject) {
        
        $sql = "UPDATE $table SET Email = '$email',  Password = '$password', Fullname = '$fullname',NID = '$NID' 
                WHERE AdminUsername = '$AdminUsername'";                   
               
               return $connobject->query($sql);
    }
    function getAdminInfo($table, $username, $connobject) {
        $sql = "SELECT AdminUsername, Email, Fullname, NID FROM $table WHERE AdminUsername = '$username'";
        return $connobject->query($sql);
    }

    //Seller

    public function showAllseller($table, $connobject) {
        $sql = "SELECT * FROM $table";
        $result = $connobject->query($sql);
        return $result;
    }
    function searchSeller($table,$username,$connobject)
    {
        $sql="SELECT * FROM $table WHERE SellerUsername  = '$username'";
        $result=$connobject->query($sql);
        return $result;


    }   function deleteSeller($table, $username, $conn) {
        $sql = "DELETE FROM $table WHERE SellerUsername = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        return $stmt->execute();
    }
    function getSellerProducts($sellerUsername, $conn) {
        $sql = $conn->prepare("SELECT * FROM products WHERE SellerUsername = ?");
        $sql->bind_param("s", $sellerUsername);
        $sql->execute();
        return $sql->get_result();
    }

    public function updateSeller($table, $SellerUsername, $Email, $Password, $BusinessName, $ProductType, $Fullname, $Phone, $Address, $District, $NID, $conn) {
        $sql = "UPDATE $table SET 
                    Email = '$Email',  
                    Password = '$Password',                                       
                    BusinessName = '$BusinessName', 
                    ProductType = '$ProductType', 
                    Fullname = '$Fullname', 
                    Phone = '$Phone', 
                    Address = '$Address', 
                    District = '$District', 
                    NID = '$NID' 
                WHERE SellerUsername = '$SellerUsername'";
    
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    
    


    //Delibvey Man
    public function searchDeliveryman($table, $username, $conn) {
        $sql = "SELECT * FROM $table WHERE DeliveryUsername = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function showAllDeliveryPersons($table, $conn) {
        $sql = "SELECT * FROM $table";
        return $conn->query($sql);
    }

    public function updateDeliveryPerson($table, $data, $username, $conn) {
        $sql = "UPDATE $table SET Email = ?, Password = ?, Fullname = ?, Phone = ?, Vehicle = ?, CV = ?, Age = ? WHERE DeliveryUsername = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssis", $data['Email'], $data['Password'], $data['Fullname'], $data['Phone'], $data['Vehicle'], $data['CV'], $data['Age'], $username);
        return $stmt->execute();
    }

    function deleteDeliveryman($table, $DeliveryUsername, $conn) {
        $sql = $conn->prepare("DELETE FROM $table WHERE DeliveryUsername = ?");
        $sql->bind_param("s", $DeliveryUsername);
        return $sql->execute();
    }

    public function updateDeliveryMan($table, $DeliveryUsername, $Email, $Password, $Fullname, $Phone, $vehicle,$CV, $Age, $conn) {
        // Update query for the delivery man
        $sql = "UPDATE $table SET 
                    Email = '$Email',
                    Password = '$Password', 
                    Fullname = '$Fullname', 
                    Phone = '$Phone', 
                    Vehicle = '$vehicle',                                    
                    CV = '$CV',
                    Age = '$Age'               

                WHERE DeliveryUsername = '$DeliveryUsername'";
    
        // Execute the query and return the result
        if ($conn->query($sql) === TRUE) {
            return true; // Return true if update is successful
        } else {
            return false; // Return false if there is an error
        }
    }
    

//buyer

public function showAllBuyer($table, $conn) {
    // Query to fetch all buyers from the 'buyer' table
    $sql = "SELECT * FROM $table";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        // Return the result set
        return $stmt->get_result();
    } else {
        return null; // If query fails, return null
    }
}
function deleteBuyer($table, $buyerUsername, $conn) {
    $sql = $conn->prepare("DELETE FROM $table WHERE BuyerUsername = ?");
    $sql->bind_param("s", $buyerUsername);
    return $sql->execute();
}

public function searchBuyer($table, $username, $conn) {
    // Query to search for a buyer by their username
    $sql = "SELECT * FROM $table WHERE BuyerUsername = ?";
    
    // Prepare the query
    $stmt = $conn->prepare($sql);
    
    // Bind the parameter (buyer username)
    $stmt->bind_param("s", $username);
    
    // Execute the query
    if ($stmt->execute()) {
        // Return the result set
        return $stmt->get_result();
    } else {
        return null; // If query fails, return null
    }
}

public function updateBuyer($table, $BuyerUsername, $Email, $Password, $Fullname, $Phone, $DateOfBirth, $conn) {
    if (empty($DateOfBirth) || !DateTime::createFromFormat('Y-m-d', $DateOfBirth)) {
        return "Please enter a valid date in the format YYYY-MM-DD.";
    }

    $sql = "UPDATE `$table` SET 
                `Email` = '$Email', 
                `Password` = '$Password', 
                `Fullname` = '$Fullname', 
                `Phone` = '$Phone', 
                `DateOfBirth` = '$DateOfBirth'             
            WHERE `BuyerUsername` = '$BuyerUsername'";

    if ($conn->query($sql) === TRUE) {
        return true; 
    } else {
        return "Error: " . $conn->error; 
    }
}




//Employee

public function showAllEmployee($table, $conn) {
    $sql = "SELECT * FROM $table"; // Retrieve all employees
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        return $stmt->get_result();
    } else {
        return null; // If query fails, return null
    }
}

public function searchEmployee($table, $username, $conn) {
    $sql = "SELECT * FROM $table WHERE EmployeeUsername = ?"; // Search for employee by username
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    if ($stmt->execute()) {
        return $stmt->get_result();
    } else {
        return null; // If query fails, return null
    }
}
function deleteEmployee($table, $employeeUsername, $conn) {
    $sql = $conn->prepare("DELETE FROM $table WHERE EmployeeUsername = ?");
    $sql->bind_param("s", $employeeUsername);
    return $sql->execute();
}

// Update employee details
public function updateEmployee($table, $empUsername, $empEmail,$empPassword, $empFullName, $empPhone, $empWorkShift,  $empCV,$empAge, $conn) {
    // Update query for the employee
    $sql = "UPDATE $table SET 
                Password = '$empPassword',                
                Email = '$empEmail',                 
                Fullname = '$empFullName', 
                Phone = '$empPhone', 
                Workshift = '$empWorkShift', 
                CV = '$empCV',
                Age = '$empAge'
            WHERE EmployeeUsername = '$empUsername'";

    // Execute the query and return the result
    if ($conn->query($sql) === TRUE) {
        return true; // Return true if update is successful
    } else {
        return false; // Return false if there is an error
    }
}

// Method to show all products
function showAllProducts($table, $connobject) {
    $sql = "SELECT * FROM $table";
    $result = $connobject->query($sql);
    return $result;
}

// Method to show all orders
function showAllOrders($table, $connobject) {
    $sql = "SELECT * FROM $table";
    $result = $connobject->query($sql);
    return $result;
}

    
}

?>
