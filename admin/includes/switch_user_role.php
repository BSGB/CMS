<?php
if(isset($_GET['switch_id'])){
  $switchId = $_GET['switch_id'];
  $query = "SELECT user_role from users WHERE user_id = '{$switchId}'";
  $result = $connection->query($query);
  checkQueryExecution($result);

  while($row = $result->fetch_assoc()){
    $oldRole = $row['user_role'];
  }
  $newRole = $oldRole == 'admin' ? 'subscriber' : 'admin';

  $query = "UPDATE users SET ";
  $query .= "user_role = '{$newRole}' ";
  $query .= "WHERE user_id = '{$switchId}'";
  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: users.php");
}
 ?>
