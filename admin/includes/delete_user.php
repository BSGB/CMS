<?php
if(isset($_GET['delete_id'])){
  $deleteId = $_GET['delete_id'];
  $query = "DELETE FROM users WHERE user_id={$deleteId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: users.php");
}
 ?>
