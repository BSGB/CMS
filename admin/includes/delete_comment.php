<?php
if(isset($_GET['delete_id'])){
	$deleteId = $_GET['delete_id'];

	$query = "SELECT comment_post_id FROM comments WHERE comment_id = {$deleteId}";
	$result = $connection->query($query);
	checkQueryExecution($result);
	while($row = $result->fetch_assoc()){
		$postId = $row['comment_post_id'];
	}
	$query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
	$query .= "WHERE post_id = {$postId}";
	$result = $connection->query($query);
	checkQueryExecution($result);

	$query = "DELETE FROM comments WHERE comment_id={$deleteId}";
	$result = $connection->query($query);
	checkQueryExecution($result);
	header("Location: comments.php");
}
?>
