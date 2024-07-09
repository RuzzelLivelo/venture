<?php

include('conn.php');


session_start();

$Product = "";
$Price = "";

$Quantity = "";
$dte = "";


$errors = array(); 


$db = new mysqli('localhost', 'root', '', 'project');


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_POST['addcos'])) {

    $Product = mysqli_real_escape_string($db, $_POST['Product']);
    $Price = mysqli_real_escape_string($db, $_POST['Price']);
    $Quantity = mysqli_real_escape_string($db, $_POST['Quantity']);
    $dte = mysqli_real_escape_string($db, $_POST['Dte']);
   


    $sql = "INSERT INTO hardcostumer (product, price, quantity, dte) 
            VALUES ('$Product', '$Price', '$Quantity','$dte')";
    
    if (mysqli_query($db, $sql)) {
      
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        array_push($errors, "Failed to insert data: " . mysqli_error($db));
    }
}


$db->close(); 
?>