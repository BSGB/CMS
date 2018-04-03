<?php
if(isset($_GET['delete_id'])){
  $deleteId = $_GET['delete_id'];
  $query = "DELETE FROM posts WHERE post_id={$deleteId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: posts.php");
}
 ?>
