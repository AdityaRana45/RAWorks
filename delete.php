<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn = new mysqli('localhost', 'root', '', 'project');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the record
    $sql = "DELETE FROM userdata WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully'); window.location.href='readdata.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
