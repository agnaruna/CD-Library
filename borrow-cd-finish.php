<?php

require_once('database/connection.php');
session_start();

if (!isset($_SESSION['adminid'])) {
    header('Location: index.php');
}

if (!isset($_GET['borrowid'])) {
    header('Location: borrow-cd.php');
}

$borrowid = $_GET['borrowid'];

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

    <title>CD LIBRARY - Borrow CD</title>
  </head>
  <body>

    <div class="container d-flex h-100">
        <div class="row align-self-center w-100">
            <div class="col-10 mx-auto">
               
            <div class="card ">
                    <div class="card-header">
                        <a class="btn btn-info btn-sm" href="dashboard.php" role="button"> Back </a> 
                        <span>Borrow CD</span>
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
                            <form method="POST" action="borrow-cd-query-finish.php">
                            <span> <strong> CD Details </strong> </span>
                            
                                <div class="row mt-3">
                                    
                                  
                                    <div class="col">
                                       <h2> <?php echo $cd_title; ?> <span class="badge badge-secondary"> <?php echo $cd_category; ?> </span> </h2> 
                                       
                                       <h1> <?php echo "Rs. ".$cd_price.".00"; ?> </h1>
                                    </div>

                                    <div class="col">
                                       <h2> <?php echo $user_name; ?>  </h2>                                        
                                       <h4> <?php echo $user_nic; ?> </h4>
                                       <h4> <?php echo $user_mobile; ?> </h4>
                                    </div>

                                    <div class="col">
                                        <H5>Return Date</H5>
                                       <h2> <?php echo $returndate; ?>  </h2>                                        
                                      
                                    </div>

                                    <input type="hidden" name="borrowid" value="<?php echo $borrowid; ?>">
                                    <input type="hidden" name="cdid" value="<?php echo $cdid; ?>">
                                    <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                    <input type="hidden" name="cd_price" value="<?php echo $cd_price; ?>">

                                    <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block" name="borrow" >BORROW</button>
                                    </div>
                                </div>
                            </form>
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