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

    // Function to add a new employee
    function addEmployee($username, $password, $email, $fullName, $phone, $workShift, $cvPath, $age, $connobject) {
        $query = "INSERT INTO employee (EmployeeUsername, Password, Email, Fullname, Phone, WorkShift, CV, Age) 
                  VALUES ('$username', '$password', '$email', '$fullName', '$phone', '$workShift', '$cvPath', '$age')";
        return $connobject->query($query);
    }

    // Function to check employee login credentials
    function checkEmployeeLogin($username, $password, $connobject) {
        $query = "SELECT * FROM employee WHERE EmployeeUsername = '$username' AND Password = '$password'";

        // Execute the query
        $result = $connobject->query($query);

        if ($result && $result->num_rows === 1) {
            return true; // Login successful
        } else {
            return false; // Invalid credentials
        }
    }

    // Function to fetch employee profile
    function getEmployeeProfile($username, $connobject) {
        $query = "SELECT * FROM employee WHERE EmployeeUsername = '$username'";
        $result = $connobject->query($query);
        return $result->fetch_assoc();
    }

    // Function to update employee profile
    function updateEmployeeProfile($username, $fullname, $email, $phone, $workshift, $connobject) {
        $query = "UPDATE employee SET Fullname = '$fullname', Email = '$email', Phone = '$phone', WorkShift = '$workshift' WHERE EmployeeUsername = '$username'";
        return $connobject->query($query);
    }

    // Function to fetch all employees with a limit
    function viewAllEmployees($connobject, $limit = 100) {
        $query = "SELECT * FROM employee LIMIT $limit";
        $result = $connobject->query($query);
        $employees = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
        }
        return $employees;
    }

    // Function to search employees by username
    function searchEmployeesByUsername($searchTerm, $connobject) {
        $searchTerm = "%" . $connobject->real_escape_string($searchTerm) . "%";
        $query = "SELECT * FROM employee WHERE EmployeeUsername LIKE '$searchTerm'";
        $result = $connobject->query($query);
        $employees = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $employees[] = $row;
            }
        }
        return $employees;
    }

    // Function to fetch pending orders
    function getPendingOrders($connobject) {
        $query = "SELECT * FROM orders WHERE DeliveryUsername IS NULL";
        $result = $connobject->query($query);
        $orders = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

    // Function to assign order to delivery person
    function assignOrderToDelivery($orderId, $deliveryUsername, $connobject) {
        $query = "UPDATE orders SET DeliveryUsername = '$deliveryUsername' WHERE OID = '$orderId'";
        return $connobject->query($query);
    }

    // Function to fetch all delivery profiles
    function getAllDeliveries($connobject) {
        $query = "SELECT * FROM deliveryman";
        $result = $connobject->query($query);
        $deliveries = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $deliveries[] = $row;
            }
        }
        return $deliveries;
    }

    // Function to fetch employee profiles with pagination

}
?>
