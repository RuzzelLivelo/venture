<?php

$conn = new mysqli('localhost', 'your_username', 'your_password', 'project');
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['model'])) {
    $model = $_GET['model'];
   
    $sql = "SELECT * FROM repossess WHERE model=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $model);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $original_model = $row['model']; // Save the original fullname for the update query
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
    $model = mysqli_real_escape_string($conn, $_POST['Model']);
    $color = mysqli_real_escape_string($conn, $_POST['Color']);
    $Dte  = mysqli_real_escape_string($conn, $_POST['dte']);
    $AmountP = mysqli_real_escape_string($conn, $_POST['AmountPayment']);
    $DOLP = mysqli_real_escape_string($conn, $_POST['Dolp']);
    $Regown = mysqli_real_escape_string($conn, $_POST['regown']);
    $adress = mysqli_real_escape_string($conn, $_POST['Adress']);
    $Phonenum = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $PenaltyP = mysqli_real_escape_string($conn, $_POST['penaltypay']);
    $Ref = mysqli_real_escape_string($conn, $_POST['ref']);
 
    $updateSql = "UPDATE repossess SET model=?, color=?, dte=?, amountp=?, dateoflastp=?, registeredowner=?, adress=?, phonenum=?, penaltyp=?, ref=? WHERE model=?";
    $stmt = $conn->prepare($updateSql);

    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    } 

    // Bind the parameters, including the original fullname at the end
    $stmt->bind_param("sssssssssss", $model, $color, $Dte, $AmountP, $DOLP, $Regown, $adress, $Phonenum, $PenaltyP,$Ref, $original_model);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to the customer page
    header("Location: repossess.php");
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
    <p><a href="repossess.php">Go Back</a></p>
</div>
<form method="POST">
				<select <?php echo $row['model']; ?>  name="Model"required>
						
						<option value="Yamaha">Yamaha</option>
						<option value="Barako">Barako</option>
						<option value="Rider">Rider</option>
						<option value="Smash">Smash</option>
						<option value="Wave">Wave</option>
				</select>

				<select name="Adress"  value=<?php echo $row['adress']; ?> required>
	<form method="POST">
=
	<option value="Alag, Baco">Alag, Baco</option>	
	<option value="Bangkatan, Baco">Bangkatan, Baco</option>
	<option value="Baras, Baco">Baras, Baco</option>
	<option value="Bayanan, Baco">Bayanan, Baco</option>
	<option value="Burbuli, Baco">Burbuli, Baco</option>
    </select>
	
					<form method="POST">
<select id="Color" value=<?php echo $row['color']; ?> name="Color"required>
		
		<option value ="Red">Red</option>
		<option value ="Blue">Blue</option>
		<option value ="Black">Black</option>
		<option value ="White">White</option>
		<option value ="Gray">Gray</option>
</select>

	<form method="POST">
    <input type="text" class="textbox" id="Amount Payment" name="AmountPayment" placeholder="Amount Payment" value=<?php echo $row['amountp']; ?> required>						

<form method="POST">
<input type="text" class="textbox" id="regown" name="regown" placeholder="Registered Owner" value=<?php echo $row['registeredowner']; ?> required>	



	<form method="POST"> 
	<input type="text" class="textbox" id="phonenumber" name="phonenumber" placeholder="phonenumber"value=<?php echo $row['phonenum']; ?> required>

	<form method="POST">
	<input type="text" class="textbox" id="penaltypay" name="penaltypay" placeholder="penaltypay" value=<?php echo $row['penaltyp']; ?> required>	

	<form method="POST">
	<input type="text" class="textbox" id="ref" name="ref" placeholder="Reference Number"value=<?php echo $row['ref']; ?> required>	
	<div class="dit">
	<label for="date">Date of Last Pay</label>
	<div>
<input type="date" id="date" name="Dolp" value=<?php echo $row['dateoflastp']; ?> class="datepicker">
</div>
	<label for="date">Date</label>
	<div>
	<input type="date" id="date" name="dte" class="datepicker" value=<?php echo $row['dte']; ?> required>
</div>
<form metod="POST">
<input type="submit" value="Update">
</div>
</form>