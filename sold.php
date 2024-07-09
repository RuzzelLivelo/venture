<?php include('conn.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Manufacture</title>
	<div class= "title">
	<h1>Sold Motorcycles</h1>
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
<table id=dataGrid class="table table-hover table-bordered table-striped">
	<tbody>
<thread>
			<tr>
			
			<th>Date</th>
			<th>Model</th>
			<th>EngineNumber</th>
			<th>Color</th>
			<th>Quantity</th>
</tr>
</thread>

<?php
	$sql = "SELECT dte, model,Enumber,color,quantity FROM costumertb";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
		
			echo "<td>" . $row["dte"] . "</td>";
			echo "<td>" . $row["model"] . "</td>";
			echo "<td>" . $row["Enumber"] . "</td>";
			echo "<td>" . $row["color"] . "</td>";
			echo "<td>" . $row["quantity"] . "</td>";
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