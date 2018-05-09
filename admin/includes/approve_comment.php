<?php
if(isset($_GET['approve_id'])){
  $approveId = $_GET['approve_id'];
  $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id={$approveId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: comments.php");
}
 ?>
