<?php
// Connect to the database
$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is set in the URL
if (isset($_GET['model'])) {
    $model = $_GET['model'];

    // Prepare the delete statement
    $sql = "DELETE FROM repossess WHERE model=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $model);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "No record specified";
}

$conn->close();

header("Location:repossess.php");
exit();
?>
