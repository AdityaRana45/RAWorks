<?php
$conn = new mysqli('localhost', 'root', '', 'project');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle update form submission
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $company = $_POST['company'];
    $service = $_POST['service'];

    $sql = "UPDATE userdata SET Name=?, Contact=?, Company=?, Service=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissi", $name, $contact, $company, $service, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully'); window.location.href='readdata.php';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();
}

// Show existing data for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM userdata WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $row['Name']; ?>" required><br><br>
        Contact: <input type="text" name="contact" value="<?php echo $row['Contact']; ?>" required><br><br>
        Company: <input type="text" name="company" value="<?php echo $row['Company']; ?>" required><br><br>
        Service: <input type="text" name="service" value="<?php echo $row['Service']; ?>"><br><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>

<?php
$conn->close();
?>
