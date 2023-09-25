<?php

require_once('database/connection.php');
session_start();

if (!isset($_SESSION['adminid'])) {
    header('Location: index.php');
}

$select_all_cd = "SELECT * FROM `cd` ORDER BY id DESC";
$select_all_cd_result = mysqli_query($con, $select_all_cd);
$count_all_cd = mysqli_num_rows($select_all_cd_result);


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

    <title>CD LIBRARY - Add new cd</title>
  </head>
  <body>

    <div class="container d-flex h-100">
        <div class="row align-self-center w-100">
            <div class="col-10 mx-auto">
               
            <div class="card ">
                    <div class="card-header">
                        <a class="btn btn-info btn-sm" href="dashboard.php" role="button"> Back </a> 
                        <span>Add new cd</span>
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
                            <form method="POST" action="add-cd-query.php">
                            <span> <strong> ADD NEW CD - CD Details </strong> </span>
                            
                                <div class="row mt-3">
                                    
                                    <div class="col">
                                    <input type="text" class="form-control" name="title" placeholder="Title">
                                    </div>
                                    <div class="col">
                                    <input type="text" class="form-control" name="author" placeholder="Author">
                                    </div>
                                    <div class="col">
                                    <input type="text" class="form-control" name="fee" placeholder="Fee">
                                    </div>
                                    <div class="col">
                                   <select name="category" id="category" class="form-control">
                                       <option value="Movie">Movie</option>
                                       <option value="Song">Song</option>
                                       <option value="Song">Documentry Video</option>
                                       <option value="Song">Old Song</option>
                                   </select>
                                    </div>
                                    <div class="col">
                                    <button type="submit" class="btn btn-primary btn-block" name="adduser">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      
                      </div>

                      <div class="row mt-4">

                        <div class="col-12">

                            <table class="table" >
                                <thead class="thead-dark">
                                    <tr>                               
                                        <th scope="col">Ttile</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Fee</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($count_all_cd > 0){
                                        while($row_all_cd = mysqli_fetch_assoc($select_all_cd_result)){
                                            ?>
                                            <tr>                                   
                                                <td><?php echo $row_all_cd['title']; ?></td>
                                                <td><?php echo $row_all_cd['author']; ?></td>
                                                <td><?php echo "Rs. ".$row_all_cd['price'].".00"; ?></td>
                                                <td><?php echo $row_all_cd['category']; ?></td>
                                                <td><?php echo $row_all_cd['status']; ?></td>
                                                
                                                <td align="center"> <a class="btn btn-danger btn-sm" href="delete-cd.php?id=<?php echo $row_all_cd['id']; ?>" role="button">X</a> </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
                                  
                                </tbody>
                            </table>

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