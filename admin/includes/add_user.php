<?php
if(isset($_POST['create_post'])){
  $postTitle = $_POST['post_title'];
  $postAuthor = $_POST['post_author'];
  $postCat = $_POST['post_category'];
  $postStatus = $_POST['post_status'];

  $postImage = $_FILES['post_image']['name'];
  $postImageTemp = $_FILES['post_image']['tmp_name'];

  $postTags = $_POST['post_tags'];
  $postContent = $_POST['post_content'];

  move_uploaded_file($postImageTemp, "../images/{$postImage}");

  $query = "INSERT INTO posts(post_title, post_author, post_category_id,
    post_status, post_image, post_tags, post_content, post_date) ";
  $query .= "VALUES('{$postTitle}', '{$postAuthor}', {$postCat},
  '{$postStatus}', '{$postImage}', '{$postTags}', '{$postContent}', now())";

  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: posts.php");
}
 ?>

<form class="" action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="post_title" class="form-control">
  </div>

  <div class="form-group">
    <label for="post_category">Category</label>
    <select class="form-control form-control-sm" name="post_category">
      <?php
        $query = "SELECT * FROM categories";
        $result = $connection->query($query);
        checkQueryExecution($result);
        while($row = $result->fetch_assoc()){
          $catId = $row['cat_id'];
          $catTitle = $row['cat_title'];
          echo "<option value='{$catId}'>{$catTitle}</option>";
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_author">Author</label>
    <input type="text" name="post_author" class="form-control">
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <input type="text" name="post_status" class="form-control">
  </div>

  <div class="form-group">
    <label for="post_image">Image</label>
    <input type="file" name="post_image">
  </div>

  <div class="form-group">
    <label for="post_tags">Tags</label>
    <input type="text" name="post_tags" class="form-control">
  </div>

  <div class="form-group">
    <label for="post_content">Content</label>
    <textarea type="text" name="post_content" class="form-control" cols="30" rows="10"></textarea>
  </div>

  <div class="form-group">
    <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
  </div>

</form>
