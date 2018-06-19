<?php
if(isset($_POST['create_post'])){
  $postTitle = $connection->real_escape_string($_POST['post_title']);
  $postAuthor = $connection->real_escape_string($_POST['post_author']);
  $postCat = $connection->real_escape_string($_POST['post_category']);
  $postStatus = $connection->real_escape_string($_POST['post_status']);

  $postImage = $connection->real_escape_string($_FILES['post_image']['name']);
  $postImageTemp = $_FILES['post_image']['tmp_name'];

  $postTags = $connection->real_escape_string($_POST['post_tags']);
  $postContent = $connection->real_escape_string($_POST['post_content']);

  move_uploaded_file($postImageTemp, "../images/{$postImage}");

  $query = "INSERT INTO posts(post_title, post_author, post_category_id,
    post_status, post_image, post_tags, post_content, post_date, post_views_count) ";
  $query .= "VALUES('{$postTitle}', '{$postAuthor}', '{$postCat}',
  '{$postStatus}', '{$postImage}', '{$postTags}', '{$postContent}', now()), 0";

  $result = $connection->query($query);
  checkQueryExecution($result);
  $lastAddedId = $connection->insert_id;
  echo "<p class='bg-success'>Post Added.
  <a href='../post.php?post_id={$lastAddedId}'>View Post</a>
  or
  <a href='posts.php?source=add_post'>Add More Posts</a>
  </p>";
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
    <input readonly="true" type="text" name="post_author" class="form-control" value="<?php echo $_SESSION['username']; ?>">
  </div>

  <div class="form-group">
    <label for="post_status">Status</label>
    <select class="form-control form-control-sm" name="post_status">
      <option value="draft" selected>Draft</option>
      <option value="published">Published</option>
    </select>
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
    <textarea type="text" name="post_content" class="form-control" cols="30" rows="10" id="body"></textarea>
  </div>

  <div class="form-group">
    <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
  </div>

</form>
<script>
$(document).ready(function() {
  ClassicEditor
      .create( document.querySelector( '#body' ) )
      .catch( error => {
          console.error( error );
      } );
});
</script>
