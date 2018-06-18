
 <?php  include "includes/header.php"; ?>

<?php
if(isset($_POST['submit'])){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(!empty($username) && !empty($email) && !empty($password)){
    $username = $connection->real_escape_string($username);
    $email = $connection->real_escape_string($email);
    $password = $connection->real_escape_string($password);

    $query = "SELECT randSalt FROM users";
    $result = $connection->query($query);

    checkQueryExecution($result);

    $row = $result->fetch_assoc();
    $salt = $row['randSalt'];

    $password = crypt($password, $salt);

    $query = "INSERT INTO users (username, user_email, user_password, user_role, user_date) ";
    $query .= "VALUES ('{$username}', '{$email}', '{$password}', 'subscriber', now())";
    $result = $connection->query($query);

    if(!$result){
      die("QUERY FAILED" . $connection->error());
    }
    $message = "<p class='text-center bg-success'>Your registration has been submited.</p>";
  } else {
    $message = "<p class='text-center bg-danger'>Fields cannot be empty!</p>";
  }
} else {
  $message = "";
}
?>

    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                      <p class="text-center bg-danger"><?php echo $message; ?></p>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
<?php include "includes/footer.php";?>
