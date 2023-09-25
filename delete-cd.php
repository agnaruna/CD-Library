<?php

require_once('database/connection.php');

$cdid = $_GET['id'];

$delete_cd = "DELETE FROM cd WHERE id='$cdid'";

if (mysqli_query($con, $delete_cd)) {

    header('Location: add-cd.php');

} 


?>