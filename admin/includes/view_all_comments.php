<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>In Response To</th>
      <th>Author</th>
      <th>Content</th>
      <th>Email</th>
      <th>Status</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM comments";
    $result = $connection->query($query);
    checkQueryExecution($result);
    while($row = $result->fetch_assoc()){
      $commentId = $row['comment_id'];
      $commentPostId = $row['comment_post_id'];
      $commentAuthor = $row['comment_author'];
      $commentEmail = $row['comment_email'];
      $commentContent = $row['comment_content'];
      $commentStatus = $row['comment_status'];
      $commentDate = $row['comment_date'];

      $query_bis = "SELECT * FROM posts WHERE post_id = {$commentPostId}";
      $result_bis = $connection->query($query_bis);
      checkQueryExecution($result_bis);
      while($row_bis = $result_bis->fetch_assoc()){
        $commentPost = $row_bis['post_title'];
      }

      echo "<tr>";
      echo "<td>{$commentId}</td>";
      echo "<td><a href='../post.php?post_id={$commentPostId}'>{$commentPost}</a></td>";
      echo "<td>{$commentAuthor}</td>";
      echo "<td>{$commentContent}</td>";
      echo "<td>{$commentEmail}</td>";
      echo "<td>{$commentStatus}</td>";
      echo "<td>{$commentDate}</td>";
      echo "<td><a href='comments.php?source=approve_comment&approve_id={$commentId}'>Approve</a></td>";
      echo "<td><a href='comments.php?source=unapprove_comment&unapprove_id={$commentId}'>Unapprove</a></td>";
      echo "<td><a href='comments.php?source=delete_comment&delete_id={$commentId}'>Delete</a></td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
