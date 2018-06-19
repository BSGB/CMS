<?php include 'includes/admin_header.php' ?>
    <div id="wrapper">

        <!-- Navigation -->
<?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                        <?php
                        if(isset($_SESSION['username'])){
                          $username = $_SESSION['username'];

                          $query = "SELECT * FROM users WHERE username = '{$username}'";
                          $result = $connection->query($query);
                          checkQueryExecution($result);

                          while($row = $result->fetch_assoc()){
                            $username = $row['username'];
                            $userPassword = $row['user_password'];
                            $userFName = $row['user_firstname'];
                            $userLName = $row['user_lastname'];
                            $userEmail = $row['user_email'];
                            $userRole = $row['user_role'];
                          }

                        if(isset($_POST['update_profile'])){
                          $usernameBis = $_POST['username'];
                          $userPassword = $_POST['user_password'];
                          $userFName = $_POST['user_firstname'];
                          $userLName = $_POST['user_lastname'];
                          $userEmail = $_POST['user_email'];

                          if(!empty($usernameBis)){
                            if(!empty($userPassword)){
                              $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 12));

                              $query = "UPDATE users SET ";
                              $query .= "username = '{$usernameBis}', ";
                              $query .= "user_password = '{$userPassword}', ";
                              $query .= "user_firstname = '{$userFName}', ";
                              $query .= "user_lastname = '{$userLName}', ";
                              $query .= "user_email = '{$userEmail}' ";
                              $query .= "WHERE username = '{$username}'";

                              $result = $connection->query($query);
                              checkQueryExecution($result);
                              echo "<p class='bg-success'>Profile Updated.</p>";
                            } else {
                              $query = "UPDATE users SET ";
                              $query .= "username = '{$usernameBis}', ";
                              $query .= "user_firstname = '{$userFName}', ";
                              $query .= "user_lastname = '{$userLName}', ";
                              $query .= "user_email = '{$userEmail}' ";
                              $query .= "WHERE username = '{$username}'";

                              $result = $connection->query($query);
                              checkQueryExecution($result);
                              echo "<p class='bg-success'>Profile Updated.</p>";
                            }
                          } else {
                            echo "<p class='bg-danger'>Username cannot be empty.</p>";
                          }
                        }
                      } else {
                          header('Location: index.php');
                        }
                        ?>
                        <form class="" action="" method="post" enctype="multipart/form-data">

                          <div class="form-group">
                            <label for="user_firstname">Firstname</label>
                            <input type="text" name="user_firstname" class="form-control" value="<?php echo $userFName; ?>">
                          </div>

                          <div class="form-group">
                            <label for="user_lastname">Lastname</label>
                            <input type="text" name="user_lastname" class="form-control" value="<?php echo $userLName; ?>">
                          </div>

                          <!-- <div class="form-group">
                            <label for="post_image">User image</label>
                            <input type="file" name="user_image">
                          </div> -->

                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                          </div>

                          <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" name="user_email" class="form-control" value="<?php echo $userEmail; ?>">
                          </div>

                          <div class="form-group">
                            <label for="user_password">Password</label>
                            <input autocomplete="off" type="password" name="user_password" class="form-control">
                          </div>

                         <div class="form-group">
                           <input type="submit" name="update_profile" value="Update Profile" class="btn btn-primary">
                         </div>
                       </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<?php include 'includes/admin_footer.php' ?>
