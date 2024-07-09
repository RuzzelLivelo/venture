<?php

include('conn.php');


session_start();

$fullname = "";
$adress = "";
$phonenumber = "";
$email = "";
$dte = "";
$model = "";
$Enumber = "";
$color = "";
$quantity = "";

$errors = array(); 


$db = new mysqli('localhost', 'root', '', 'project');


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_POST['addcos'])) {

    $fullname = mysqli_real_escape_string($db, $_POST['Fullname']);
    $adress = mysqli_real_escape_string($db, $_POST['Adress']);
    $phonenumber = mysqli_real_escape_string($db, $_POST['Phonenumber']);
    $email = mysqli_real_escape_string($db, $_POST['Email']);
    $dte = mysqli_real_escape_string($db, $_POST['Dte']);
    $model = mysqli_real_escape_string($db, $_POST['Model']);
    $Enumber = mysqli_real_escape_string($db, $_POST['Enumber']);
    $color = mysqli_real_escape_string($db, $_POST['Color']);
    $quantity = mysqli_real_escape_string($db, $_POST['Quantity']);


    $sql = "INSERT INTO costumertb (fullname, adress, phonenumber, email, dte, model, Enumber, color, quantity) 
            VALUES ('$fullname', '$adress', '$phonenumber', '$email', '$dte', '$model', '$Enumber', '$color', '$quantity')";
    
    if (mysqli_query($db, $sql)) {
      
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        array_push($errors, "Failed to insert data: " . mysqli_error($db));
    }
}


$db->close();
?>