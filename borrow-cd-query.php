<?php

require_once('database/connection.php');

$cd        = $_POST['cd'];
$user      = $_POST['user'];
$return    = $_POST['returndate'];

$today = date('Y-m-d');

$insert_bcd = "INSERT INTO `borrowcd`(`cdid`, `userid`, `issuedate`, `returndate`) VALUES ('$cd','$user','$today','$return')";

if (mysqli_query($con, $insert_bcd)) {
    // echo "New record created successfully";
    $last_id = mysqli_insert_id($con);
    header('Location: borrow-cd-finish.php?borrowid='.$last_id);

} else {
    echo "Error: " . $insert_bcd . "<br>" . mysqli_error($con);
}

?>