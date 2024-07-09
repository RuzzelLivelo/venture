<?php include('conn.php');?>
<?php

session_start();

$companyName = "";
$contactPerson = "";
$adress = "";
$model = "";
$color = "";
$quantity = "";

$errors = array(); 


$db = new mysqli('localhost', 'root', '', 'project');


if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_POST['add'])) {
    $companyName = mysqli_real_escape_string($db, $_POST['CompanyName']);
    $contactPerson = mysqli_real_escape_string($db, $_POST['ContactPerson']);
    $adress = mysqli_real_escape_string($db, $_POST['Adress']);
    $model = mysqli_real_escape_string($db, $_POST['Model']);
    $color = mysqli_real_escape_string($db, $_POST['Color']);
    $quantity = mysqli_real_escape_string($db, $_POST['Quantity']);

   
    $sql = "INSERT INTO manufacyouu (companyname, contactperson, adress, model, color, quantity) 
            VALUES ('$companyName', '$contactPerson', '$adress', '$model', '$color', '$quantity')";
    
    if (mysqli_query($db, $sql)) {
       
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        array_push($errors, "Failed to insert data: " . mysqli_error($db));
    }
}

$db->close();
?>


