<?php
include('../model/admindb.php');

// Create a new instance of the database class
$mydb = new mydb();
$connobject = $mydb->openCon();

// Check if a search request is made by EmployeeUsername
if (isset($_GET['EmployeeUsername'])) {
    $username = trim($_GET['EmployeeUsername']); // Get the username from the search form

    if (!empty($username)) {
        $result = $mydb->searchEmployee("employee", $username, $connobject); // Search for the employee

        if ($result && $result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1' cellspacing='0' cellpadding='5'>
                    <tr>
                        <th>Employee Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Work Shift</th>
                        <th>CV</th>
                        <th>Age</th>
                        <th>Actions</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['EmployeeUsername']) . "</td>
                        <td>" . htmlspecialchars($row['Email']) . "</td>
                        <td>" . htmlspecialchars($row['Fullname']) . "</td>
                        <td>" . htmlspecialchars($row['Phone']) . "</td>
                        <td>" . htmlspecialchars($row['WorkShift']) . "</td>
                        <td><a href='" . htmlspecialchars($row['CV']) . "' target='_blank'>View CV</a></td>
                        <td>" . htmlspecialchars($row['Age']) . "</td>
                        <td>
                            <a href='update_employee.php?EmployeeUsername=" . urlencode($row['EmployeeUsername']) . "'>Update</a> | 
                            <a href='../control/delete_employee.php?EmployeeUsername=" . urlencode($row['EmployeeUsername']) . "'>Delete</a>
                        </td>
                        </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No employee found with username: " . htmlspecialchars($username) . "</p>";
        }
    } else {
        echo "<p>Please enter a valid username to search.</p>";
    }
} 
// Check if "View All" request is made
elseif (isset($_GET['viewAll'])) {
    $result = $mydb->showAllEmployee('employee', $connobject); // Retrieve all employee data

    if ($result && $result->num_rows > 0) {
        echo "<h3>All Employees:</h3>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>
                <tr>
                    <th>Employee Username</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Work Shift</th>
                    <th>CV</th>
                    <th>Age</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['EmployeeUsername']) . "</td>
                    <td>" . htmlspecialchars($row['Email']) . "</td>
                    <td>" . htmlspecialchars($row['Fullname']) . "</td>
                    <td>" . htmlspecialchars($row['Phone']) . "</td>
                    <td>" . htmlspecialchars($row['WorkShift']) . "</td>
                    <td><a href='" . htmlspecialchars($row['CV']) . "' target='_blank'>View CV</a></td>
                    <td>" . htmlspecialchars($row['Age']) . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No employees found in the database.</p>";
    }
} else {
    echo "<p>Invalid request. Please use the search or view all options.</p>";
}

// Close the connection
$connobject->close();
?>
