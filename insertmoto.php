<?php

include('conn.php');


session_start();



$model = "";
$color = "";
$price="";
$quantity = "";
$totalprice="";
$errors = array(); 


$db = new mysqli('localhost', 'root', '', 'project');


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_POST['addmoto'])) {

    
    $model = mysqli_real_escape_string($db, $_POST['Model']);
    $price = mysqli_real_escape_string($db, $_POST['Price']);
    $color = mysqli_real_escape_string($db, $_POST['Color']);
    $quantity = mysqli_real_escape_string($db, $_POST['Quantity']);
    $totalprice= mysqli_real_escape_string($db, $_POST['TotalPrice']);

    $sql = "INSERT INTO motorcy ( model,color,price, quantity,totalprice) 
            VALUES ('$model','$color','$price',  '$quantity','$totalprice')";
    
    if (mysqli_query($db, $sql)) {
      
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        array_push($errors, "Failed to insert data: " . mysqli_error($db));
    }
}


$db->close();
?>