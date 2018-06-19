<?php
if(isset($_GET['delete_id']) && isset($_SESSION['user_role'])){
  if($_SESSION['user_role'] == 'admin'){
    $deleteId = $connection->real_escape_string($_GET['delete_id']);
    $query = "DELETE FROM users WHERE user_id={$deleteId}";
    $result = $connection->query($query);
    checkQueryExecution($result);
    header("Location: users.php");
  }
}
 ?>
