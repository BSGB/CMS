<?php
if(isset($_POST['checkBoxArray'])){
  foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
    $bulkOption = $_POST['bulk_option'];
    switch($bulkOption){
      case "published":
      $query = "UPDATE posts SET post_status = '{$bulkOption}' WHERE post_id={$checkBoxValue}";
      $result = $connection->query($query);
      checkQueryExecution($result);
      break;
      case "draft":
      $query = "UPDATE posts SET post_status = '{$bulkOption}' WHERE post_id={$checkBoxValue}";
      $result = $connection->query($query);
      checkQueryExecution($result);
      break;
      case "delete":
      $query = "DELETE from posts WHERE post_id={$checkBoxValue}";
      $result = $connection->query($query);
      checkQueryExecution($result);
      break;
      default:
      echo "<p class='bg-danger'>Choose Option!</p>";
      break;
    }
  }
}
?>
<form class="" action="" method="post">
<table class="table table-bordered table-hover">

<div class="bulkContainer">
  <div id="bulkOptionsContainer" class="col-xs-4">
    <select class="form-control" name="bulk_option">
      <option value="">Select Option</option>
      <option value="published">Publish</option>
      <option value="draft">Draft</option>
      <option value="delete">Delete</option>
    </select>
  </div>

  <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
  </div>
</div>
  <thead>
    <tr>
      <th><input type="checkbox" name="" value="" id="selectAllBoxes"></th>
      <th>Id</th>
      <th>Category</th>
      <th>Title</th>
      <th>Author</th>
      <th>Date</th>
      <th>Image</th>
      <th>Status</th>
      <th>Tags</th>
      <th>Comments Count</th>
      <th>Views Count</th>
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
      $postViewsCount = $row['post_views_count'];

      $query_bis = "SELECT * FROM categories WHERE cat_id = {$postCat}";
      $result_bis = $connection->query($query_bis);
      checkQueryExecution($result_bis);
      while($row_bis = $result_bis->fetch_assoc()){
        $postCat = $row_bis['cat_title'];
      }

      echo "<tr>";
      ?>
      <td>
        <input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value="<?php echo $postId; ?>">
      </td>
      <?php
      echo "<td>{$postId}</td>";

      echo "<td>{$postCat}</td>";
      echo "<td><a href='../post.php?post_id={$postId}'>{$postTitle}<a/></td>";
      echo "<td>{$postAuthor}</td>";
      echo "<td>{$postDate}</td>";
      echo "<td><img class='img-responsive' src='../images/{$postImage}' alt=''></td>";
      echo "<td>{$postStatus}</td>";
      echo "<td>{$postTags}</td>";

      $query = "SELECT * FROM comments WHERE comment_post_id = {$postId}";
      $postComments = $connection->query($query);
      $postCount = $postComments->num_rows;

      echo "<td><a href='post_comments.php?id={$postId}'>{$postCount}</a></td>";
      echo "<td>{$postViewsCount}</td>";
      echo "<td><a href='posts.php?source=delete_post&delete_id={$postId}'>Delete</a></td>";
      echo "<td><a href='posts.php?source=edit_post&edit_id={$postId}'>Edit</a></td>";
      echo "</tr>";
    }
     ?>
  </tbody>
</table>
</form>
