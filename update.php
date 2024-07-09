
<?php

$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['companyname'])) {
    $companyname = $_GET['companyname'];

   
    $sql = "SELECT * FROM manufacyouu WHERE companyname=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $companyname);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
        exit();
    }

    $stmt->close();
} else {
    echo "No ID specified";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $companyName = mysqli_real_escape_string($conn, $_POST['CompanyName']);
    $contactPerson = mysqli_real_escape_string($conn, $_POST['ContactPerson']);
    $adress = mysqli_real_escape_string($conn, $_POST['Adress']);
    $model = mysqli_real_escape_string($conn, $_POST['Model']);
    $color = mysqli_real_escape_string($conn, $_POST['Color']);
    $quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);

    $updateSql = "UPDATE manufacyouu SET companyname=?, contactperson=?, adress=?, model=?, color=?, quantity=? WHERE companyname=?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("sssssss", $companyName, $contactPerson, $adress, $model, $color, $quantity, $companyname); // Added the original companyname as the last parameter

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();

 
    header("Location: manufacyou.php");
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
    <link rel="stylesheet" type="text/css" href="update.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <title>Update Record</title>
</head>
<body>
<div class="heading">
    <h2>Update Record</h2>
    <p><a href="manufacyou.php">Go Back</a></p>
</div>
<div class="Grp">
    <div class="TB">
    <form method="post" action="">
        <label>Company Name:</label><br>
        <input type="text" autocomplete="off" name="CompanyName" value="<?php echo $row['companyname']; ?>"><br>
</div>
        <div class="TB">
    <form method="post" action="">
        <label>Contact Person:</label><br>
        <input type="text" autocomplete="off"name="ContactPerson" value="<?php echo $row['contactperson']; ?>"><br>
</div>
            <div class="Drop">
        <label>Address:</label><br>
<select name="Adress" value= "<?php echo $row['adress']; ?>"><br>
	<option value="Alag, Baco">Alag, Baco</option>	
	<option value="Bangkatan, Baco">Bangkatan, Baco</option>
	<option value="Baras, Baco">Baras, Baco</option>
	<option value="Bayanan, Baco">Bayanan, Baco</option>
	<option value="Burbuli, Baco">Burbuli, Baco</option>
</select>
</div>
<div class="Drop">
        <label>Model:</label><br>
    <select name="Model" value="<?php echo $row['model']; ?>"><br>
		<option value="Yamaha">Yamaha</option>
		<option value="Barako">Barako</option>
		<option value="Rider">Rider</option>
		<option value="Smash">Smash</option>
		<option value="Wave">Wave</option>
    </select>
</div>
<div class="Drop">
        <label>Color:</label><br>
<select id="Color" name="Color" value="<?php echo $row['color']; ?>"><br>
		<option value ="Red">Red</option>
		<option value ="Blue">Blue</option>
		<option value ="Black">Black</option>
		<option value ="White">White</option>
		<option value ="Gray">Gray</option>		
</select>
</div>
<div class="quan">
        <label>Quantity:</label><br>
        <input type="number" id="Color" value="1" min="1" max="100"class="bilang" name="Quantity" value="<?php echo $row['quantity']; ?>"><br><br>
        <div class="Submitbtn">
        <input type="submit" value="Update">
</div>
</div>
    </form>
</body>
</html>
