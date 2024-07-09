<?php

$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['fullname'])) {
    $fullname = $_GET['fullname'];
   
    $sql = "SELECT * FROM costumertb WHERE fullname=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fullname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_fullname = $row['fullname']; // Save the original fullname for the update query
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
    $fullname = mysqli_real_escape_string($conn, $_POST['Fullname']);
    $adress = mysqli_real_escape_string($conn, $_POST['Adress']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['Phonenumber']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $dte = mysqli_real_escape_string($conn, $_POST['Dte']);
    $model = mysqli_real_escape_string($conn, $_POST['Model']);
    $Enumber = mysqli_real_escape_string($conn, $_POST['Enumber']);
    $color = mysqli_real_escape_string($conn, $_POST['Color']);
    $quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);

    $updateSql = "UPDATE costumertb SET fullname=?, adress=?, phonenumber=?, email=?, dte=?, model=?, Enumber=?, color=?, quantity=? WHERE fullname=?";
    $stmt = $conn->prepare($updateSql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    // Bind the parameters, including the original fullname at the end
    $stmt->bind_param("ssssssssss", $fullname, $adress, $phonenumber, $email, $dte, $model, $Enumber, $color, $quantity, $original_fullname);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to the customer page
    header("Location: customer.php");
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
    <p><a href="customer.php">Go Back</a></p>
</div>
<div class="TBpannel">
                    <div class="TB">
                    <form method="POST">
                        <label>Full Name</label><br>
                            <input type="text" class="textbox" id="Fullname" name="Fullname" placeholder="FullName"  value="<?php echo $row['fullname']; ?>"required><br>
                    </div>	
                   
                    <div class="TB">
						<form method="POST">
                        <label>Phone Number</label><br>
                            <input type="text" class="textbox" id="Phonenumber" name="Phonenumber" placeholder="Phonenumber"value="<?php echo $row['phonenumber']; ?>" required><br>
                    </div>
                            
                    <div class="TB">
						<form method="POST">
                        <label>Email</label><br>
                            <input type="text" class="textbox" id="Email" name="Email" placeholder="Email"value="<?php echo $row['email']; ?>" required><br>
                    </div>
                 

                <div class="TB">
					<form method="POST">
                    <label>Engine Number</label><br>
                    <input type="text" class="textbox" id="Enumber" name="Enumber" placeholder="Enumber" value="<?php echo $row['Enumber']; ?>"required><br>
                </div>
</div>

<div class="Gdrop">
                <div class="Drop">				
							<form method="POST">
                            <label>Address</label><br>
                            <select name="Adress"value="<?php echo $row['adress']; ?>" required><br>
	<option value="Alag, Baco">Alag, Baco</option>	
	<option value="Bangkatan, Baco">Bangkatan, Baco</option>
	<option value="Baras, Baco">Baras, Baco</option>
	<option value="Bayanan, Baco">Bayanan, Baco</option>
	<option value="Burbuli, Baco">Burbuli, Baco</option>
                            </select>
</div>

                <div class="Drop">	
								<form method="POST">
                                <label>Model</label><br>
					<select name="Model"value="<?php echo $row['model']; ?>"required><br>
					
						<option value="Yamaha">Yamaha</option>
						<option value="Barako">Barako</option>
						<option value="Rider">Rider</option>
						<option value="Smash">Smash</option>
						<option value="Wave">Wave</option>
					</select>
                </div>

<div class="Drop">
<form method="POST">
<label>Color</label><br>
	<select id="Color" name="Color"value="<?php echo $row['color']; ?>"required><br>
		<option value ="Red">Red</option>
		<option value ="Blue">Blue</option>
		<option value ="Black">Black</option>
		<option value ="White">White</option>
		<option value ="Gray">Gray</option>
		
    </select>
</div>
<div class="date">
<form metod="POST">
								<div><label for="date">Date</label></div>
								<input type="date" id="date" name="Dte"value="<?php echo $row['dte']; ?>"><br>
</div>      
<div class="quan">
	<form method="POST">
    <label>Quantity</label><br>
	<input type="number" id="Color"value="1" min="1" max="100"class="bilang" name="Quantity"value="<?php echo $row['quantity']; ?>"><br><br>
</div>

<div class="Submitbtn">
<input type="submit" value="Update">
</div>
</div>
</form></body>
</html>
<style>

   