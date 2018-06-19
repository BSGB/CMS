<?php
if(isset($_GET['edit_id'])){
  $editId = $connection->real_escape_string($_GET['edit_id']);
  $query = "SELECT * FROM users WHERE user_id = '{$editId}'";
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

  if(isset($_POST['update_user'])){
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
        $query .= "WHERE user_id = {$editId}";

        $result = $connection->query($query);
        checkQueryExecution($result);
        echo "<p class='bg-success'>User Updated.
        <a href='users.php'>View Users</a></p>";
      } else {
        $query = "UPDATE users SET ";
        $query .= "username = '{$usernameBis}', ";
        $query .= "user_firstname = '{$userFName}', ";
        $query .= "user_lastname = '{$userLName}', ";
        $query .= "user_email = '{$userEmail}' ";
        $query .= "WHERE user_id = {$editId}";

        $result = $connection->query($query);
        checkQueryExecution($result);
        echo "<p class='bg-success'>User Updated.
        <a href='users.php'>View Users</a></p>";
      }
    } else {
      echo "<p class='bg-danger'><i class='fas fa-asterisk'></i>Fields cannot be empty.</p>";
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
     <label for="username"><i class='fas fa-asterisk'></i>Username</label>
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
    <input type="submit" name="update_user" value="Edit User" class="btn btn-primary">
  </div>
</form>
