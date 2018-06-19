<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>
<?php session_start(); ?>
<?php
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = $connection->real_escape_string($username);
  $password = $connection->real_escape_string($password);

  $query = "SELECT * FROM users WHERE username='{$username}' ";
  $result = $connection->query($query);
  checkQueryExecution($result);
  while($row = $result->fetch_array()){
    $dbUserId = $row['user_id'];
    $dbUsername = $row['username'];
    $dbUserPassword = $row['user_password'];
    $dbUserFirstname = $row['user_firstname'];
    $dbUserLastname = $row['user_lastname'];
    $dbUserRole = $row['user_role'];
    $dbUserEmail = $row['user_email'];
  }

  if (password_verify($password, $dbUserPassword)){
    $_SESSION['username'] = $dbUsername;
    $_SESSION['user_email'] = $dbUserEmail;
    $_SESSION['firstname'] = $dbUserFirstname;
    $_SESSION['lastname'] = $dbUserLastname;
    $_SESSION['user_role'] = $dbUserRole;
    header("Location: ../admin");
  } else {
    header("Location: ../index.php");
  }
}
?>
