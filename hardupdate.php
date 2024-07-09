<?php

$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['product'])) {
    $product = $_GET['product'];
   
    $sql = "SELECT * FROM hardmanufacyouu WHERE product=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the correct variable
    $stmt->bind_param("s", $product);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_product = $row['product']; // Save the original product name for the update query
    } else {
        echo "No record found";
        exit();
    }

    $stmt->close();
} else {
    echo "No product specified";
    exit();
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Product = mysqli_real_escape_string($conn, $_POST['Product']);
    $Price = mysqli_real_escape_string($conn, $_POST['Price']);
    $Quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);
    $Serial = mysqli_real_escape_string($conn, $_POST['Serial']);
    $Dte = mysqli_real_escape_string($conn, $_POST['Dte']);
    $Manufacturer = mysqli_real_escape_string($conn, $_POST['Manufacturer']);
  
    $updateSql = "UPDATE hardmanufacyouu SET product=?, price=?, quantity=?, serial=?, dte=?, manufacturer=? WHERE product=?";
    $stmt = $conn->prepare($updateSql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    } 

    // Bind the parameters, including the original product name at the end
    $stmt->bind_param("sssssss", $Product, $Price, $Quantity, $Serial, $Dte, $Manufacturer, $original_product);
    
    // Execute the update statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to the hardware page
    header("Location: hardwaremanufacyou.php");
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
    <p><a href="hardwaremanufacyou.php">Go Back</a></p>
</div>


	<form method="POST">
    <input type="text" class="textbox" id="Product" name="Product" placeholder="Product Name" value=<?php echo $row['product']; ?> required><br>		

    
	<form method="POST">
    <input type="text" class="textbox" id="Price" name="Price" placeholder="Price" value=<?php echo $row['price']; ?> required><br>		

    
	<form method="POST">
    <input type="text" class="textbox" id="Serial" name="Serial" placeholder="Serial Number" value=<?php echo $row['serial']; ?> required><br>		

    
	<form method="POST">
    <input type="text" class="textbox" id="Manufacturer" name="Manufacturer" placeholder="Manufacturer" value=<?php echo $row['manufacturer']; ?> required><br>		


    <form method="POST">
    <label>Quantity</label><br>
	<input type="number" id="quantity"value="1" min="1" max="100"class="bilang" name="Quantity"><br><br>

    
    <label for="date">Date</label>
								<input type="date" id="date" name="Dte" class="datepicker" required>

<form metod="POST">
<input type="submit" value="Update">
</div>
</form>