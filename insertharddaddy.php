<?php

include('conn.php');


session_start();

$Product = "";
$Price = "";
$Serial = "";
$Quantity = "";
$dte = "";
$Manufacturer = "";

$errors = array(); 


$db = new mysqli('localhost', 'root', '', 'project');


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_POST['addcos'])) {

    $Product = mysqli_real_escape_string($db, $_POST['Product']);
    $Price = mysqli_real_escape_string($db, $_POST['Price']);
    $Serial = mysqli_real_escape_string($db, $_POST['Serial']);
    $Quantity = mysqli_real_escape_string($db, $_POST['Quantity']);
    $dte = mysqli_real_escape_string($db, $_POST['Dte']);
    $Manufacturer = mysqli_real_escape_string($db, $_POST['Manufacturer']);


    $sql = "INSERT INTO hardmanufacyouu (product, price, quantity, serial, dte, manufacturer) 
            VALUES ('$Product', '$Price', '$Quantity', '$Serial', '$dte', '$Manufacturer')";
    
    if (mysqli_query($db, $sql)) {
      
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        array_push($errors, "Failed to insert data: " . mysqli_error($db));
    }
}


$db->close();
?>