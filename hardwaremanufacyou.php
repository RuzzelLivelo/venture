<?php include('insertharddaddy.php');?>
<?php include('conn.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Manufacture</title>
	<div class= "title">
	<h1>Hardware Manufacturer</h1>
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
			<th>Product</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Serial</th> 
			<th>Date</th>
            <th>Manufacturer</th>
			<th>update</th>
			<th>delete</th>
</tr>
</thread>
<?php
	$sql = "SELECT product,price,quantity,serial,dte,manufacturer FROM hardmanufacyouu";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["product"] . "</td>";
	    	echo "<td>" . $row["price"] . "</td>";
			echo "<td>" . $row["quantity"] . "</td>";
			echo "<td>" . $row["serial"] . "</td>";
			echo "<td>" . $row["dte"] . "</td>";
			echo "<td>" . $row["manufacturer"] . "</td>";
			echo "<td><a href='hardupdate.php?product=" . $row['product'] . "'>Update</a> </td>";
			echo "<td><a href='deletehard.php?product=" . $row['product'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a> </td>";
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
</tbody>
</table>
<div class="modal fade" id="insertModal" tabindex="1" role="dialog" aria-labelledby="insertModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertModalLabel">Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form autocomplete="off"  method="POST" action="hardwaremanufacyou.php">

						<form method="POST">
                            <input type="text" class="textbox" id="Product" name="Product" placeholder="Product Name"required>
			

						<form method="POST">
                            <input type="text" class="textbox" id="Price" name="Price" placeholder="Price" required>

						<form method="POST">
                            <input type="text" class="textbox" id="Serial" name="Serial" placeholder="Serial number" required>		


							<label for="date">Date</label>
								<input type="date" id="date" name="Dte" class="datepicker" required>


								<form method="POST">
								<input type="text" class="textbox" id="Manufacturer" name="Manufacturer" placeholder="Manufacturer" required>

							<form method="POST">
								<label>Quantity</label>
							<input type="number" id="quantity"value="1" min="1" max="100"class="bilang" name="Quantity">

								
				
			

	<form metod="POST">
<input type="submit" class="submitbtn" name="addcos"value="Submit">
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
            </div>
         </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
