<?php include('conn.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Manufacture</title>
	<div class="title">
		<h1>Sold Hardware</h1>
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
		<thead>
			<tr>
				<th>Product</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total Price</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT product, price, quantity, (price * quantity) AS total_price, dte FROM hardcostumer";
			$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr>";
					echo "<td>" . $row["product"] . "</td>";
					echo "<td>PHP" . number_format($row["price"], 2) . "</td>";
					echo "<td>" . $row["quantity"] . "</td>";
					echo "<td>PHP" . number_format($row["total_price"], 2) . "</td>";
					echo "<td>" . $row["dte"] . "</td>";
					echo "</tr>";
				}
			} else {
				echo "<tr><td colspan='7'>No records found</td></tr>";
			}
			$conn->close();
			?>
		</tbody>
	</table>