<?php include('conn.php');?>
<?php

session_start();

$model = "";
$color = "";
$Dte = "";
$AmountP = "";
$DOLP = "";
$Regown = "";
$adress = "";
$Phonenum = "";
$PenaltyP = "";
$Ref = "";

$errors = array(); 


$db = new mysqli('localhost', 'root', '', 'project');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if (isset($_POST['addcos'])) {

    $model = mysqli_real_escape_string($db, $_POST['Model']);
    $color = mysqli_real_escape_string($db, $_POST['Color']);
    $Dte  = mysqli_real_escape_string($db, $_POST['dte']);
    $AmountP = mysqli_real_escape_string($db, $_POST['AmountPayment']);
    $DOLP = mysqli_real_escape_string($db, $_POST['Dolp']);
    $Regown = mysqli_real_escape_string($db, $_POST['regown']);
    $adress = mysqli_real_escape_string($db, $_POST['Adress']);
    $Phonenum = mysqli_real_escape_string($db, $_POST['phonenumber']);
    $PenaltyP = mysqli_real_escape_string($db, $_POST['penaltypay']);
    $Ref = mysqli_real_escape_string($db, $_POST['ref']);

    $sql = "INSERT INTO repossess (model,color, dte, amountp, dateoflastp, registeredowner, adress, phonenum, penaltyp,ref) 
            VALUES ('$model', '$color', '$Dte', '$AmountP', '$DOLP', '$Regown', '$adress', '$Phonenum', '$PenaltyP', ' $Ref ')";
    
    if (mysqli_query($db, $sql)) {
      
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        
        array_push($errors, "Failed to insert data: " . mysqli_error($db));
    }
}


$db->close();
?>