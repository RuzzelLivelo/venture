<?php

$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['model'])) {
    $model = trim($_GET['model']); 
   
    $sql = "SELECT * FROM motorcy WHERE model=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("s", $model);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_model = $row['model']; // Save the original product name for the update query
    } else {
        echo "No record found: " . htmlspecialchars($model);
        exit();
    }

    $stmt->close();
} else {
    echo "No product specified"; 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = mysqli_real_escape_string($conn, $_POST['Model']);
    $color = mysqli_real_escape_string($conn, $_POST['Color']);
    $quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $totalp = mysqli_real_escape_string($conn, $_POST['TotalPrice']);
 
  
    $updateSql = "UPDATE motorcy SET model=?, price=?, quantity=?, totalprice=?, color=? WHERE model=?";
    $stmt = $conn->prepare($updateSql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind the parameters, including the original product name at the end
    $stmt->bind_param("ssssss", $model, $price, $quantity, $totalp, $color, $original_model);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to the customer page
    header("Location: motorcy.php");
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
    <p><a href="motorcy.php">Go Back</a></p>
</div>


<form method="POST">
    <input type="text" class="textbox" id="Model" value="<?php echo ($row['model']); ?>" name="Model" placeholder="Product Name" required>
    
    <input type="number" class="textbox" id="Price" value="<?php echo ($row['price']); ?>" name="Price" placeholder="Price" step="0.01" required>
    
    <input type="number" id="Quantity" min="1" class="bilang" value="<?php echo ($row['quantity']); ?>" name="Quantity" required>
    
    <input type="hidden" id="TotalPrice" name="TotalPrice" value="<?php echo ($row['totalprice']); ?>">

   
    <form method="POST">
<select id="Color" name="Color" value="<?php echo ($row['color']); ?>" required>
	
		<option value ="Red">Red</option>
		<option value ="Blue">Blue</option>
		<option value ="Black">Black</option>
		<option value ="White">White</option>
		<option value ="Gray">Gray</option>
</select>
    
    <input type="submit" value="Update">
</form>
</body>
</html>
<script>
		document.getElementById('Price').addEventListener('input', calculateTotal);
		document.getElementById('Quantity').addEventListener('input', calculateTotal);

		function calculateTotal() {
			let price = parseFloat(document.getElementById('Price').value) || 0;
			let quantity = parseInt(document.getElementById('Quantity').value) || 1;
			let total = price * quantity;
			document.getElementById('TotalPrice').value = total.toFixed(2);
		}
	</script>