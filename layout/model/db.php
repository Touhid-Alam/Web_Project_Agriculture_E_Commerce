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

    function checkAdminLogin($username, $password, $connobject) {
        $query = "SELECT * FROM admin WHERE AdminUsername = '$username' AND Password = '$password'";
        $result = $connobject->query($query);
        return $result && $result->num_rows === 1;
    }

    function checkSellerLogin($username, $password, $connobject) {
        $query = "SELECT * FROM seller WHERE SellerUsername = '$username' AND Password = '$password'";
        $result = $connobject->query($query);
        return $result && $result->num_rows === 1;
    }

    function checkEmployeeLogin($username, $password, $connobject) {
        $query = "SELECT * FROM employee WHERE EmployeeUsername = '$username' AND Password = '$password'";
        $result = $connobject->query($query);
        return $result && $result->num_rows === 1;
    }

    function checkDeliveryLogin($username, $password, $connobject) {
        $query = "SELECT * FROM deliveryman WHERE DeliveryUsername = '$username' AND Password = '$password'";
        $result = $connobject->query($query);
        return $result && $result->num_rows === 1;
    }

    function checkBuyerLogin($username, $password, $connobject) {
        $query = "SELECT * FROM buyer WHERE BuyerUsername = '$username' AND Password = '$password'";
        $result = $connobject->query($query);
        return $result && $result->num_rows === 1;
    }
}
?>