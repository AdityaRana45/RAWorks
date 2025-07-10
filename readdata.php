<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'project');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the userdata table
$sql = "SELECT id, Name, Contact, Company, Service FROM userdata";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">User Data List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Company</th>
        <th>Service</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>

    <?php
    // Check and display records
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['Name']}</td>
                    <td>{$row['Contact']}</td>
                    <td>{$row['Company']}</td>
                    <td>{$row['Service']}</td>
                    <td><a href='edit.php?id={$row['id']}'>Update</a></td>
                    <td><a href='delete.php?id={$row['id']}'>Delete</a></td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    }
    ?>

</table>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>

</body>
</html>

<?php
// Close connection
$conn->close();
?>
