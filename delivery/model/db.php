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

    function addDelivery($username, $password, $email, $fullName, $phone, $vehicle, $idProof, $age, $connobject) {

        // SQL query to insert a new delivery
        $query = "INSERT INTO deliveryman (DeliveryUsername, Password, Email, Fullname, Phone, Vehicle, CV, Age) 
                  VALUES ('$username', '$password', '$email', '$fullName', '$phone', '$vehicle', '$idProof', '$age')";
        return $connobject->query($query);
    }

    // Function to check delivery login credentials
    function checkDeliveryLogin($username, $password, $connobject) {
        $query = "SELECT * FROM deliveryman WHERE DeliveryUsername = '$username' AND Password = '$password'";
        $result = $connobject->query($query);

        if ($result && $result->num_rows === 1) {
            return true; // Login successful
        } else {
            return false; // Invalid credentials
        }
    }

    // Function to fetch all delivery data with a limit of 10 records
    function getAllDeliveries($connobject) {
        $query = "SELECT * FROM deliveryman LIMIT 10";
        $result = $connobject->query($query);
        $deliveries = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $deliveries[] = $row; // Add each delivery to the deliveries array
            }
        }
        return $deliveries; // Return the array of deliveries
    }

    // Function to search delivery data by multiple fields
    function searchDeliveries($searchTerm, $connobject) {
        $searchTerm = "%" . $connobject->real_escape_string($searchTerm) . "%";
        $query = "SELECT * FROM deliveryman WHERE 
                  DeliveryUsername LIKE '$searchTerm' OR 
                  Fullname LIKE '$searchTerm' OR 
                  Email LIKE '$searchTerm' OR 
                  Phone LIKE '$searchTerm' OR 
                  Vehicle LIKE '$searchTerm'";
        $result = $connobject->query($query);
        $deliveries = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $deliveries[] = $row; // Add each matching delivery to the deliveries array
            }
        }
        return $deliveries; // Return the array of deliveries found
    }
    
    // Function to fetch pending orders for a specific deliveryman
    function getPendingOrdersForDeliveryman($deliveryUsername, $connobject) {
        $query = "SELECT * FROM orders WHERE DeliveryUsername = '$deliveryUsername'";
        $result = $connobject->query($query);
        $orders = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }
    
    public function assignOrderToDelivery($orderId, $deliveryUsername, $conn) {
        $sql = "UPDATE orders SET DeliveryUsername = ? WHERE OID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $deliveryUsername, $orderId);
        return $stmt->execute();
    }

    public function updateDeliveryStatus($orderId, $status, $conn) {
        $sql = "UPDATE orders SET status = ? WHERE OID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $orderId);
        return $stmt->execute();
    }

    // Function to delete a delivery profile
    function deleteDelivery($deliveryId, $connobject) {
        $query = "DELETE FROM deliveryman WHERE DeliveryUsername = ?";
        $stmt = $connobject->prepare($query);
        $stmt->bind_param("s", $deliveryId);
        return $stmt->execute();
    }

    // Function to update a delivery profile
    function updateDelivery($deliveryId, $fullName, $email, $phone, $vehicle, $age, $connobject) {
        $query = "UPDATE deliveryman SET Fullname = ?, Email = ?, Phone = ?, Vehicle = ?, Age = ? WHERE DeliveryUsername = ?";
        $stmt = $connobject->prepare($query);
        $stmt->bind_param("ssssss", $fullName, $email, $phone, $vehicle, $age, $deliveryId);
        return $stmt->execute();
    }

    // Function to fetch a delivery profile by ID
    function getDeliveryById($deliveryId, $connobject) {
        $query = "SELECT * FROM deliveryman WHERE DeliveryUsername = ?";
        $stmt = $connobject->prepare($query);
        $stmt->bind_param("s", $deliveryId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Function to fetch a delivery profile by username
    function getDeliveryDetails($username, $connobject) {
        $stmt = $connobject->prepare("SELECT * FROM deliveryman WHERE DeliveryUsername = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function deleteOrder($orderId, $conn) {
        $sql = "DELETE FROM orders WHERE OID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        return $stmt->execute();
    }
}
?>
