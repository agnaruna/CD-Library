<?php

require_once('database/connection.php');

$title       = $_POST['title'];
$author     = $_POST['author'];
$fee        = $_POST['fee'];
$category    = $_POST['category'];

$insert_cd = "INSERT INTO `cd`(`title`, `author`, `price`, `category`, `status`) VALUES ('$title','$author','$fee','$category','Available')";
if (mysqli_query($con, $insert_cd)) {
    // echo "New record created successfully";
    header('Location: add-cd.php');

} else {
    echo "Error: " . $insert_cd . "<br>" . mysqli_error($con);
}

?>