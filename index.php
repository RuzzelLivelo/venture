<?php include('conn.php');?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php
	$totalFullnames = 0;
	$total_quantity = 0;
	$totalsold = 0;
	$totalmotor = 0;
	

	// First query to get the sum of quantity from the manufacyouu table
	$sql1 = "SELECT SUM(quantity) AS total_quantity FROM manufacyouu";
	$result1 = $conn->query($sql1);
	
	// Check if the query was successful and fetch the result
	if ($result1 && $result1->num_rows > 0) {
		$row1 = $result1->fetch_assoc();
		$total_quantity = $row1['total_quantity'];
	}
	
	// Second query to get the count of fullname from the costumertb table
	$sql2 = "SELECT COUNT(fullname) AS total FROM costumertb";
	$result2 = $conn->query($sql2);
	
	// Check if the query was successful and fetch the result
	if ($result2 && $result2->num_rows > 0) {
		$row2 = $result2->fetch_assoc();
		$totalFullnames = $row2['total'];
	}
	$sql3 = "SELECT SUM(quantity) AS total FROM costumertb";
	$result3 = $conn->query($sql3);
	
	// Check if the query was successful and fetch the result
	if ($result3 && $result3->num_rows > 0) {
		$row3 = $result3->fetch_assoc();
		$totalsold = $row3['total'];
	}
	$sql4 = "SELECT SUM(quantity) AS total_quantity FROM motorcy";
	$result4 = $conn->query($sql4);
	
	// Check if the query was successful and fetch the result
	if ($result4 && $result4->num_rows > 0) {
		$row4 = $result4->fetch_assoc();
		$totalmotorcy = $row4['total_quantity'];
	}
	// Close the connection
	$conn->close();
	 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="stylesheet" type="text/css" href="desaynnn.css">
</head>
<body>

<div class="header">
	<h2>Venture</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
	 <div class="headerhome">
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p1> <a href="login.php?logout='1'" style="color: #ffffff;">logout</a> </p1>
    <?php endif ?>
	<div class="nav">
	<ul>
	<li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Manufacturer</a>
                <div class="dropdown-content">
                    <a href="manufacyou.php">Motorcycles</a> 
					<a href="hardwaremanufacyou.php">Hardware</a> 

                </div>
            </li>
      
		<li class="dropdown">
		<a href="javascript:void(0)" class="dropbtn">Customer</a>
		<div class="dropdown-content">
		<a href="customer.php" >Motorcycles Customer</a>
		<a href="hardwarecos.php" >Hardwares</a>
		</div>
		</li>
		<li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Sold</a>
                <div class="dropdown-content">
                    <a href="sold.php">Motorcycle</a> 
					<a href="soldhard.php">Hardware</a> 

                </div>
            </li>
			<li class="dropdown">
		<a href="javascript:void(0)" class="dropbtn">Inventory</a>
                <div class="dropdown-content">
                    <a href="hardwareinventory.php">Hardware</a>   
					<a href="motorcy.php">Motorcycle</a>
                </div>
            </li>
		<li class="Drop-Gender"><a href="repossess.php" >Repossessed</a></li>
		<li class="Drop-Gender"><a href="" >Reports</a></li>
		<li class="Drop-Gender"><a href="" >Account</a></li>
    </ul>
</div>
<div class="contain">
	<div class="dash">
		<label>Dash Board</label> <a href="vieG.php">View Graph</a>
	</div>
	<div class="dsh">
	<h1>New Delivered:</h1> 
	<div class="total">
	<h2><i class="fa-solid fa-motorcycle"></i><?php echo $total_quantity; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Total Costumer:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-person"></i> <?php echo $totalFullnames; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Total Sold:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-money-bill"></i> <?php echo $totalsold; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Motorcycles Available:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-motorcycle"></i> <?php echo $totalmotorcy; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Motorcycles Available:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-motorcycle"></i> <?php echo $totalmotorcy; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Motorcycles Available:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-motorcycle"></i> <?php echo $totalmotorcy; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Motorcycles Available:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-motorcycle"></i> <?php echo $totalmotorcy; ?></h2>
	</div>
	</div>
	<div class="dsh">
	<h1>Motorcycles Available:</h1>
	<div class="total">
		<h2><i class="fa-solid fa-motorcycle"></i> <?php echo $totalmotorcy; ?></h2>
	</div>
	</div>


	

	
</div>
</body>
</html>