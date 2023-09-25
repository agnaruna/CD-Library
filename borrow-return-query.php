<?php

require_once('database/connection.php');

$borrowid    = $_GET['id'];


$select_borrow_data = "SELECT * FROM `borrowcd` WHERE id = '$borrowid'";
$select_borrow_data_result = mysqli_query($con, $select_borrow_data);
$row_borrow_data = mysqli_fetch_assoc($select_borrow_data_result);

$cdid = $row_borrow_data['cdid'];
$userid = $row_borrow_data['userid'];

$update_bcd = "UPDATE `borrowcd` SET `status` = 'finish' WHERE `id` = '$borrowid'";

$update_cd = "UPDATE `cd` SET `status` = 'available' WHERE `id` = '$cdid'";
$update_result = mysqli_query($con, $update_cd);


if (mysqli_query($con, $update_bcd)) {
    // echo "New record created successfully";
  
    header('Location: borrow-history.php');

} else {
    echo "Error: " . $update_bcd . "<br>" . mysqli_error($con);
}

?>