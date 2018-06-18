<?php include "db.php"; ?>
<?php session_start(); ?>
<?php
if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username = $connection->real_escape_string($username);
  $password = $connection->real_escape_string($password);

  $query = "SELECT * FROM users WHERE username='{$username}' ";
  $result = $connection->query($query);
  if(!$result){
    die("QUERY FAILED" . $connection->error());
  }
  while($row = $result->fetch_array()){
    $dbUserId = $row['user_id'];
    $dbUsername = $row['username'];
    $dbUserPassword = $row['user_password'];
    $dbUserFirstname = $row['user_firstname'];
    $dbUserLastname = $row['user_lastname'];
    $dbUserRole = $row['user_role'];
  }

  $password = crypt($password, $dbUserPassword);

  if ($username === $dbUsername && $password === $dbUserPassword){
    $_SESSION['username'] = $dbUsername;
    $_SESSION['firstname'] = $dbUserFirstname;
    $_SESSION['lastname'] = $dbUserLastname;
    $_SESSION['user_role'] = $dbUserRole;
    header("Location: ../admin");
  } else {
    header("Location: ../index.php");
  }
}
?>
