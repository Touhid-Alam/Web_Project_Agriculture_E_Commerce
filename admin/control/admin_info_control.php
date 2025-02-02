<?php
include '../model/admindb.php';
session_start();

$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if a search request is made
if (isset($_GET['AdminUsername'])) {
    $username = trim($_GET['AdminUsername']); // Get the username from the form

    if (!empty($username)) {
        $result = $mydb->searchAdmin("admin", $username, $connobject);

        if ($result && $result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Admin Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>ID</th>
                        <th>Action</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['AdminUsername']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Fullname']) . "</td>
                        <td><a href='" .htmlspecialchars($row['NID']) . "' target='_blank'>View ID Proof</a></td>
                        <td>
                            <a href='update_admin.php?AdminUsername=" . urlencode($row['AdminUsername']) . "'>Update</a> |
                            <a href='../control/delete_admin.php?AdminUsername=" . urlencode($row['AdminUsername']) . "'>Delete</a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No admin found with username: " . htmlspecialchars($username) . "</p>";
        }
    } else {
        echo "<p>Please enter a valid username to search.</p>";
    }
} 
// Check if "View All" request is made
elseif (isset($_GET['viewAll'])) {
    $result = $mydb->showAllAdmin('admin', $connobject);

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Admins:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>Admin Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>ID</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['AdminUsername']) . "</td>
                    <td>" . htmlspecialchars($row['Email']) . "</td>
                    <td>" . htmlspecialchars($row['Fullname']) . "</td>
                    <td><a href='" .htmlspecialchars($row['NID']) . "' target='_blank'>View ID Proof</a></td>
                    </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No admins found in the database.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the search or view all options.</p>";
}

// Close the connection
$connobject->close();
?>
