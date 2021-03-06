<?php
if(isset($_POST['create_user'])){

  $userFName = escape($_POST['user_firstname']);
  $userLName = escape($_POST['user_lastname']);
  $username = escape($_POST['username']);
  $userEmail = escape($_POST['user_email']);
  $userPassword = escape($_POST['user_password']);
  $userRole = escape($_POST['user_role']);

  if(!empty($username) && !empty($userPassword)){
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $result = $connection->query($query);
    $user = $result->num_rows;
    if($user == 0){
      $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 12));
      $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname,
      user_email, user_role, user_date)";
      $query .= "VALUES('{$username}', '{$userPassword}', '{$userFName}',
      '{$userLName}', '{$userEmail}', '{$userRole}', now())";
      $result = $connection->query($query);
      echo "<p class='bg-success'>User Created.
      <a href='users.php'>View Users</a>
      </p>";
    } else {
    echo "<p class='bg-danger'>User already exists.</p>";
    }
  } else {
    echo "<p class='bg-danger'><i class='fas fa-asterisk'></i>Fields cannot be empty.</p>";
  }
}
 ?>

<form class="" action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" name="user_firstname" class="form-control">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" name="user_lastname" class="form-control">
  </div>

  <!-- <div class="form-group">
    <label for="post_image">User image</label>
    <input type="file" name="user_image">
  </div> -->

  <div class="form-group">
    <label for="username">Username<i class="fas fa-asterisk"></i></label>
    <input type="text" name="username" class="form-control">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" name="user_email" class="form-control">
  </div>

  <div class="form-group">
    <label for="user_password">Password<i class="fas fa-asterisk"></i></label>
    <input type="password" name="user_password" class="form-control">
  </div>

  <div class="form-group">
    <label for="user_role">User Role</label>
    <select name="user_role" class="form-control">
      <option value="subscriber">Select Option</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>

  <div class="form-group">
    <input type="submit" name="create_user" value="Add User" class="btn btn-primary">
  </div>

</form>
