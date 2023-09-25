<?php

require_once('database/connection.php');
session_start();

if (!isset($_SESSION['adminid'])) {
    header('Location: index.php');
}

$select_all_cd = "SELECT * FROM `cd` WHERE status = 'Available' ORDER BY id DESC";
$select_all_cd_result = mysqli_query($con, $select_all_cd);


$select_all_users = "SELECT * FROM `user` ORDER BY userid DESC";
$select_all_user_result = mysqli_query($con, $select_all_users);



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
                            <form method="POST" action="borrow-cd-query.php">
                            <span> <strong> BORROW CD - CD and Member Details </strong> </span>
                            
                                <div class="row mt-3">
                                    
                                  
                                    <div class="col">
                                        <select name="cd" id="cd" class="form-control" required>
                                            <option value="">Select CD</option>
                                           
                                            <?php 
                                            while($row_cds = mysqli_fetch_assoc($select_all_cd_result)){
                                                ?>
                                                     <option value="<?php echo $row_cds['id']; ?>"> <?php echo $row_cds['title']; ?> - <?php echo $row_cds['price']; ?> (<?php echo $row_cds['category']; ?>) </option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col">
                                        <select name="user" id="user" class="form-control" required>
                                            <option value="">Select User</option>
                                           
                                            <?php 
                                            while($row_users = mysqli_fetch_assoc($select_all_user_result)){
                                                ?>
                                                     <option value="<?php echo $row_users['userid']; ?>"> <?php echo $row_users['name']; ?> </option>
                                                <?php
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <div class="col">
                                        <input type="date" class="form-control" name="returndate" required>
                                        <small>Select Return Date</small>
                                    </div>

                                    <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block" name="process">Process</button>
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