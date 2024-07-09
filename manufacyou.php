
<?php include('header.php');?>
<?php include('conn.php');?>
<?php include('insert.php');?>

<tbody>
<?php

	$sql = "SELECT companyname,contactperson, adress, model,color,quantity FROM manufacyouu";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["companyname"] . "</td>";
			echo "<td>" . $row["contactperson"] . "</td>";
			echo "<td>" . $row["adress"] . "</td>";
			echo "<td>" . $row["model"] . "</td>";
			echo "<td>" . $row["color"] . "</td>";
			echo "<td>" . $row["quantity"] . "</td>";
			echo "<td><a href='update.php?companyname=" . $row['companyname'] . "'>Update</a> </td>";
			echo "<td><a href='delete.php?companyname=" . $row['companyname'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a> </td>";
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
                    <h5 class="modal-title" id="insertModalLabel">New Manufacturer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <form autocomplete="off"  method="POST" action="manufacyou.php">
						<form method="POST">
                            <input type="text" class="textbox" id="CompanyName" name="CompanyName" placeholder="Company Name"required>
						<form method="POST">
                            <input type="text" class="textbox" id="ContactPerson" name="ContactPerson" placeholder="Contact Person" required>
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
							<select name="Model"required>
						<option id=Color value=""disable select hidden>Model</option>
						<option value="Yamaha">Yamaha</option>
						<option value="Barako">Barako</option>
						<option value="Rider">Rider</option>
						<option value="Smash">Smash</option>
						<option value="Wave">Wave</option>
</select>
<div>
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
	<input type="number" id="Color"value="1" min="1" max="100"class="bilang" name="Quantity">
</div>

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

	</style>


                        <input type="submit" class="submitbtn" name="add"value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   
</body>
