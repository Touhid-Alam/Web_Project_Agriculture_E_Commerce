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

    function viewAdmin($table,$username,$connobject)
    {
        $sql="SELECT * FROM $table WHERE AdminUsername = '$username'";
        $result=$connobject->query($sql);
        return $result;
    }
    function updateAdmin($table, $username, $email, $password, $fullname, $idProofPath, $connobject) {
        
        $sql = "UPDATE $table SET Email = '$email',  Password = '$password', Fullname = '$fullname',NID = '$idProofPath' 
                WHERE AdminUsername = '$username'";                   
               
               return $connobject->query($sql);
    }
    function getAdminInfo($table, $username, $connobject) {
        $sql = "SELECT AdminUsername, Email, Fullname, NID FROM $table WHERE AdminUsername = '$username'";
        return $connobject->query($sql);
    }

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
    
    
}

?>
