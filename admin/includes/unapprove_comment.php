<?php
if(isset($_GET['unapprove_id'])){
  $unapproveId = $_GET['unapprove_id'];
  $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id={$unapproveId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: comments.php");
}
 ?>
