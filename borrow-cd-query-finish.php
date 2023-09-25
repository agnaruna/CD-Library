<?php

require_once('database/connection.php');

$borrowid    = $_POST['borrowid'];
$cdid        = $_POST['cdid'];
$userid      = $_POST['userid'];
$cd_price    = $_POST['cd_price'];

$date = date('Y-m-d');

$update_bcd = "UPDATE `borrowcd` SET `status` = 'active' WHERE `id` = '$borrowid'";
$update_cd = "UPDATE `cd` SET `status` = 'notavailable' WHERE `id` = '$cdid'";
$update_result = mysqli_query($con, $update_cd);

$insert_inoice = "INSERT INTO `invoices`(`borrowid`, `userid`, `amount`, `date`, `status`) VALUES ('$borrowid','$userid','$cd_price','$date', 'paid')";
$insert_result = mysqli_query($con, $insert_inoice);

if (mysqli_query($con, $update_bcd)) {
    // echo "New record created successfully";
  
    header('Location: borrow-success.php');

} else {
    echo "Error: " . $update_bcd . "<br>" . mysqli_error($con);
}

?>