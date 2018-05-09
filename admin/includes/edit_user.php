<?php
if(isset($_GET['edit_id'])){
  $editId = $_GET['edit_id'];
  $query = "SELECT * FROM posts WHERE post_id = {$editId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  while($row = $result->fetch_assoc()){
    $postTitle = $row['post_title'];
    $postAuthor = $row['post_author'];
    $postCat = $row['post_category_id'];
    $postStatus = $row['post_status'];

    $postImage = $row['post_image'];

    $postTags = $row['post_tags'];
    $postContent = $row['post_content'];
    $postCount = $row['post_comment_count'];
  }
}

if(isset($_POST['update_post'])){
  $postTitle = $_POST['post_title'];
  $postAuthor = $_POST['post_author'];
  $postCat = $_POST['post_category'];
  $postStatus = $_POST['post_status'];

  if(!empty($_FILES['post_image']['name'])) {
    $postImage = $_FILES['post_image']['name'];
    $postImageTemp = $_FILES['post_image']['tmp_name'];
    move_uploaded_file($postImageTemp, "../images/{$postImage}");
  }

  $postTags = $_POST['post_tags'];
  $postContent = $_POST['post_content'];

  $query = "UPDATE posts SET ";
  $query .= "post_title = '{$postTitle}', ";
  $query .= "post_author = '{$postAuthor}', ";
  $query .= "post_category_id = '{$postCat}', ";
  $query .= "post_status = '{$postStatus}', ";
  $query .= "post_image = '{$postImage}', ";
  $query .= "post_tags = '{$postTags}', ";
  $query .= "post_content = '{$postContent}' ";
  $query .= "WHERE post_id = {$editId}";

  $result = $connection->query($query);
  checkQueryExecution($result);
  header("Location: posts.php");
}
 ?>

<form class="" action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="post_title" class="form-control" value="<?php echo $postTitle; ?>">
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
          if($catId == $postCat){
            echo "<option value='{$catId}' selected>{$catTitle}</option>";
          } else {
            echo "<option value='{$catId}'>{$catTitle}</option>";
          }
        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="post_author">Author</label>
    <input type="text" name="post_author" class="form-control" value="<?php echo $postAuthor; ?>">
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <input type="text" name="post_status" class="form-control" value="<?php echo $postStatus; ?>">
  </div>

  <div class="form-group">
    <label for="post_image">Image</label>
    <div>
      <img src="../images/<?php echo $postImage; ?>" alt="">
    </div>
    <input type="file" name="post_image">

  </div>

  <div class="form-group">
    <label for="post_tags">Tags</label>
    <input type="text" name="post_tags" class="form-control" value="<?php echo $postTags; ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Content</label>
    <textarea type="text" name="post_content" class="form-control" cols="30" rows="10"><?php echo $postContent; ?></textarea>
  </div>

  <div class="form-group">
    <input type="submit" name="update_post" value="Update Post" class="btn btn-primary">
  </div>

</form>
