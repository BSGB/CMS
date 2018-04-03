<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Category</th>
      <th>Title</th>
      <th>Author</th>
      <th>Date</th>
      <th>Image</th>
      <th>Status</th>
      <th>Tags</th>
      <th>Comment Count</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "SELECT * FROM posts";
    $result = $connection->query($query);
    checkQueryExecution($result);
    while($row = $result->fetch_assoc()){
      $postId = $row['post_id'];
      $postCat = $row['post_category_id'];
      $postTitle = $row['post_title'];
      $postAuthor = $row['post_author'];
      $postDate = $row['post_date'];
      $postImage = $row['post_image'];
      $postStatus = $row['post_status'];
      $postTags = $row['post_tags'];
      $postCount = $row['post_comment_count'];

      $query_bis = "SELECT * FROM categories WHERE cat_id = {$postCat}";
      $result_bis = $connection->query($query_bis);
      checkQueryExecution($result_bis);
      while($row_bis = $result_bis->fetch_assoc()){
        $postCat = $row_bis['cat_title'];
      }

      echo "<tr>";
      echo "<td>{$postId}</td>";

      echo "<td>{$postCat}</td>";
      echo "<td>{$postTitle}</td>";
      echo "<td>{$postAuthor}</td>";
      echo "<td>{$postDate}</td>";
      echo "<td><img class='img-responsive' src='../images/{$postImage}' alt=''></td>";
      echo "<td>{$postStatus}</td>";
      echo "<td>{$postTags}</td>";
      echo "<td>{$postCount}</td>";
      echo "<td><a href='posts.php?source=delete_post&delete_id={$postId}'>Delete</a></td>";
      echo "<td><a href='posts.php?source=edit_post&edit_id={$postId}'>Edit</a></td>";
      echo "</tr>";
    }
     ?>
  </tbody>
</table>
