<?php include('conn.php');?>
<?php include ('insertrepos.php')?>
<!DOCTYPE html>
<html>
<head>
	<title>Manufacture</title>
	<div class= "title">
	<h1>Repossess</h1>
	<a href="index.php">Back</a>
</div>
	<meta charset="UTF-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="child.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<body>
	<div class="components">
<button type="button"class="addbtn" data-toggle="modal" data-target="#insertModal">Add</button>
</div>
<table id=dataGrid class="table table-hover table-bordered table-striped">
	<tbody>
<thread>
			<tr>
			<th>Model</th>
			<th>Color</th>
			<th>Date</th>
			<th>Amount Payment</th>
			<th>Date of Last Pay</th>
			<th>Registered Owner</th>
			<th>Address</th>
			<th>Phone Number</th>
			<th>penalty Payment</th>
            <th>Reference Number</th>
			<th>update</th>
			<th>delete</th>
</tr>
</thread>
<?php
	$sql = "SELECT model,color,dte,amountp,dateoflastp, registeredowner,adress,phonenum,penaltyp,ref FROM repossess";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["model"] . "</td>";
			echo "<td>" . $row["color"] . "</td>";
			echo "<td>" . $row["dte"] . "</td>";
			echo "<td>" . $row["amountp"] . "</td>";
			echo "<td>" . $row["dateoflastp"] . "</td>";
			echo "<td>" . $row["registeredowner"] . "</td>";
			echo "<td>" . $row["adress"] . "</td>";
			echo "<td>" . $row["phonenum"] . "</td>";
			echo "<td>" . $row["penaltyp"] . "</td>";
			echo "<td>" . $row["ref"] . "</td>";
			echo "<td><a href='updaterep.php?model=" . $row['model'] . "'>Update</a> </td>";
			echo "<td><a href='deleterep.php?model=" . $row['model'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a> </td>";
			echo "</tr>";
			
		}
	} else {
		echo "<tr><td colspan='3'>No records found</td></tr>";
	}
	echo "</table>";
	echo "</body>";
	echo "</html>";

	$conn->close();
		?>
		<div class="modal fade" id="insertModal" tabindex="1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Repossessed Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form autocomplete="off"  method="POST" action="repossess.php">

				<form method="POST">
				<select name="Model"required>
						<option id=Color value=""disable select hidden>Model</option>
						<option value="Yamaha">Yamaha</option>
						<option value="Barako">Barako</option>
						<option value="Rider">Rider</option>
						<option value="Smash">Smash</option>
						<option value="Wave">Wave</option>
				</select>

				<select name="Adress" required>
	<form method="POST">
    <option value=""disabled selected hidden>Address</option>	
	<option value="Alag, Baco">Alag, Baco</option>	
	<option value="Bangkatan, Baco">Bangkatan, Baco</option>
	<option value="Baras, Baco">Baras, Baco</option>
	<option value="Bayanan, Baco">Bayanan, Baco</option>
	<option value="Burbuli, Baco">Burbuli, Baco</option>
    </select>
	
					<form method="POST">
<select id="Color" name="Color"required>
		<option id="Color"value=""disable select hidden>Color</option>
		<option value ="Red">Red</option>
		<option value ="Blue">Blue</option>
		<option value ="Black">Black</option>
		<option value ="White">White</option>
		<option value ="Gray">Gray</option>
</select>

	<form method="POST">
    <input type="text" class="textbox" id="Amount Payment" name="AmountPayment" placeholder="Amount Payment" required>						

<form method="POST">
<input type="text" class="textbox" id="regown" name="regown" placeholder="Registered Owner" required>	



	<form method="POST">
	<input type="text" class="textbox" id="phonenumber" name="phonenumber" placeholder="phonenumber" required>

	<form method="POST">
	<input type="text" class="textbox" id="penaltypay" name="penaltypay" placeholder="penaltypay" required>	

	<form method="POST">
	<input type="text" class="textbox" id="ref" name="ref" placeholder="Reference Number" required>	
	<div class="dit">
	<label for="date">Date of Last Pay</label>
	<div>
<input type="date" id="date" name="Dolp" class="datepicker">
</div>
	<label for="date">Date</label>
	<div>
	<input type="date" id="date" name="dte" class="datepicker" required>
</div>
<form metod="POST">
<input type="submit" class="submitbtn" name="addcos"value="Submit" required>
</div>
</form>

	<style>
.textbox{
	border:1px solid #gray;
	border-radius:10px;
	margin:5px;
	width:300px;
	height:40px;
	font-size:15px;
	outline:none;
} 
	 select{
      outline:none ;
        padding:8px 16px;
        font-size: 16px;
        border: 1px solid #gray;
        border-radius: 30px;
        background-color: #fff;
        cursor: pointer;
      margin:10px;
      }
    option{
      font-size:small;
    }
    .bilang{
      margin:10px;
      border:1px solid #gray;
      border-radius:30px;
      font-size:16px;
    }.submitbtn{background-color:green;
		margin:10px;
	border:1px solid #black;
border-radius:10px;
color:white;
font-size:15px;
width:100px;
height:30px;}
.datepicker{
	outline:none;
	border:1px solid #black;
	border-radius:5px;
}

	</style>
	
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>							
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
