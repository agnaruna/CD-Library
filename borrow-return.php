<?php

require_once('database/connection.php');
session_start();

if (!isset($_SESSION['adminid'])) {
    header('Location: index.php');
}

$get_fee = "SELECT * FROM `settings` WHERE id = '1'";
$result_getfee = mysqli_query($con, $get_fee);
$row_gellfee = mysqli_fetch_assoc($result_getfee);

$fee = $row_gellfee['paneltyfee'];

$borrowid = $_GET['id'];

$select_borrow_data = "SELECT * FROM `borrowcd` WHERE id = '$borrowid'";
$select_borrow_data_result = mysqli_query($con, $select_borrow_data);
$row_borrow_data = mysqli_fetch_assoc($select_borrow_data_result);

$cdid = $row_borrow_data['cdid'];
$userid = $row_borrow_data['userid'];
$returndate = $row_borrow_data['returndate'];


$select_all_cd = "SELECT * FROM `cd` WHERE id = '$cdid' ORDER BY id DESC LIMIT 1";
$select_all_cd_result = mysqli_query($con, $select_all_cd);
$row_cds = mysqli_fetch_assoc($select_all_cd_result);

$cd_title = $row_cds['title'];
$cd_price = $row_cds['price'];
$cd_category = $row_cds['category'];


$select_all_users = "SELECT * FROM `user` WHERE userid = '$userid' ORDER BY userid DESC LIMIT 1";
$select_all_user_result = mysqli_query($con, $select_all_users);
$row_users = mysqli_fetch_assoc($select_all_user_result);

$user_name = $row_users['name'];
$user_mobile = $row_users['mobile'];
$user_nic = $row_users['nic'];

$today = date('Y-m-d');

$datetime1 = strtotime($today);
$datetime2 = strtotime($returndate);

$calculate_seconds = $datetime2 - $datetime1;// == <seconds between the two times>
$days = floor($calculate_seconds / (24 * 60 * 60 ));

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-color.min.css" >

    <!-- Additional CSS -->
    <link rel="stylesheet" href="css/main.css" >

    <title>CD LIBRARY - Borrow Success</title>
  </head>
  <body>

    <div class="container d-flex h-100">
        <div class="row align-self-center w-100">
            <div class="col-10 mx-auto">
               
            <div class="card ">
                    <div class="card-header">
                        <a class="btn btn-info btn-sm" href="dashboard.php" role="button"> Back </a> 
                        <span>Borrow Success</span>
                        <a class="btn btn-danger" href="logout.php" role="button" style="float: right; margin-left:5px;">LOGOUT</a> 
                        <a class="btn btn-dark" href="settings.php" role="button" style="float: right;">Settings</a> 
                    </div>
                    <div class="card-body">
                  
                      <div class="row text-center mt-2">
                          
                          <div class="col-md-3 col-6"> <a class="btn btn-success btn-block" href="borrow-cd.php" role="button">Borrow CD</a> </div>
                          <div class="col-md-3 col-6"> <a class="btn btn-success btn-block" href="add-user.php" role="button">Add new user</a> </div>
                          <div class="col-md-3 col-6"> <a class="btn btn-success btn-block" href="borrow-history.php" role="button">Borrow history</a> </div>
                          <div class="col-md-3 col-6"> <a class="btn btn-warning btn-block" href="add-cd.php" role="button">Add new CD</a> </div>
               
                      </div>
                      <hr>
                      <div class="row">
                       
                        <div class="col-12">
                        
                                                       
                                <div class="row  mt-3">                                    
                                  
                                    <div class="col">
                                    <h2> <?php echo $cd_title; ?> <span class="badge badge-secondary"> <?php echo $cd_category; ?> </span> </h2> 
                                    <h5 class="text-dark"> Issue Date : <?php echo $row_borrow_data['issuedate']; ?> </h5>
                                    <h5 <?php if($days < 0){ echo 'class="text-danger"'; }else{ echo 'class="text-success"'; } ?> > Return Date : <?php echo $row_borrow_data['returndate']; ?> </h5>

                                      
                                    </div>

                                   <?php
                                   if($days < 0){
                                     ?>
                                      <div class="col">
                                    <h1 class="text-danger"> <?php $withouddash =  substr($days, 1); echo $withouddash; ?> Days Late </h1> 
                                    <h3 class="text-dark"> Penalty Fee: <?php $noofdays = (int)$withouddash;  echo $noofdays;?> X Rs. <?php echo number_format($fee,2); ?> </h3>
                                    <span class="badge badge-success"> <h1> <?php $feecal =  $noofdays*$fee; echo "Rs. ".number_format($feecal,2); ?> </h1> </span>
                                        
                                    </div>
                                     <?php
                                   }
                                   ?>

                                    <div class="col">

                                    <?php
                                    if($days < 0){

                                      ?> <br> <br> <a class="btn btn-primary " href="borrow-return-query.php?id=<?php echo $borrowid; ?>" role="button">PAY & RETURN</a> <?php

                                    }else{
                                      ?> <a class="btn btn-primary " href="borrow-return-query.php?id=<?php echo $borrowid; ?>" role="button">RETURN</a> <?php
                                    }
                                    
                                    ?>
                                   
                                        

                                    </div>
                                  
                                </div>
                          
                        </div>
                      
                      </div>

                    
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>