<?php

$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['product'])) {
    $product = trim($_GET['product']); 
   
    $sql = "SELECT * FROM hardcostumer WHERE product=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("s", $product);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_product = $row['product']; // Save the original product name for the update query
    } else {
        echo "No record found for product: " . htmlspecialchars($product);
        exit();
    }

    $stmt->close();
} else {
    echo "No product specified"; 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product = mysqli_real_escape_string($conn, $_POST['Product']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);
    $totalp = mysqli_real_escape_string($conn, $_POST['TotalPrice']);
    $dte = mysqli_real_escape_string($conn, $_POST['Dte']);
  
    $updateSql = "UPDATE hardcostumer SET product=?, price=?, quantity=?, totalprice=?, dte=? WHERE product=?";
    $stmt = $conn->prepare($updateSql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind the parameters, including the original product name at the end
    $stmt->bind_param("ssssss", $product, $price, $quantity, $totalp, $dte, $original_product);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to the customer page
    header("Location: hardwarecos.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="updatecos.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <title>Update Record</title>
</head>
<body>
<div class="heading">
    <h2>Update Record</h2>
    <p><a href="hardwarecos.php">Go Back</a></p>
</div>


<form method="POST">
    <input type="text" class="textbox" id="Product" value="<?php echo ($row['product']); ?>" name="Product" placeholder="Product Name" required>
    
    <input type="number" class="textbox" id="Price" value="<?php echo ($row['price']); ?>" name="Price" placeholder="Price" step="0.01" required>
    
    <input type="number" id="Quantity" min="1" class="bilang" value="<?php echo ($row['quantity']); ?>" name="Quantity" required>
    
    <input type="hidden" id="TotalPrice" name="TotalPrice" value="<?php echo ($row['totalprice']); ?>">

    <label for="date">Date</label>
    <input type="date" id="date" name="Dte" class="datepicker" value="<?php echo ($row['dte']); ?>" required>
    
    <input type="submit" value="Update">
</form>
</body>
</html>
