<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="page-header">
        Posts
        <small>All Posts</small>
      </h1>

      <!-- POSTS -->
      <?php
      $perPage = 3;
      if(isset($_GET['page'])){
        $pageNumber = $_GET['page'];
      } else {
        $pageNumber = "";
      }

      if($pageNumber == "" || $pageNumber == 1){
        $page1 = 0;
      } else {
        $page1 = ($pageNumber * $perPage) - $perPage;
      }
      $query = "SELECT * FROM posts ";
      $query .= "WHERE post_status = 'published' ";
      $result = $connection->query($query);
      checkQueryExecution($result);
      $count = $result->num_rows;

      $count = ceil($count / $perPage);

      $query = "SELECT * FROM posts ";
      $query .= "WHERE post_status = 'published' ";
      $query .= "ORDER BY post_id DESC ";
      $query .= "LIMIT {$page1}, $perPage";
      $result = $connection->query($query);
      checkQueryExecution($result);
      if($result->num_rows == 0){
        echo "<h2>NO POSTS</h2>";
      } else {
        while($row = $result->fetch_assoc()){
          $postId = $row['post_id'];
          $postTitle = $row['post_title'];
          $postAuthor = $row['post_author'];
          $postDate = $row['post_date'];
          $postImage = $row['post_image'];
          $postContent = $row['post_content'];
      ?>
      <h2>
        <a href="post.php?post_id=<?php echo $postId; ?>"><?php echo $postTitle ?></a>
      </h2>
      <p class="lead">
        by <a href="author_posts.php?author=<?php echo $postAuthor;?>"><?php echo $postAuthor; ?></a>
      </p>
      <p><i class="far fa-clock"></i> <?php echo $postDate; ?></p>
      <hr>
      <a href="post.php?post_id=<?php echo $postId; ?>">
        <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
      </a>
      <hr>
      <p><?php echo substr($postContent, 0, 200) . "[...]"; ?></p>
      <a class="btn btn-primary" href="post.php?post_id=<?php echo $postId; ?>">Read More
        <i class="fas fa-angle-right"></i>
      </a>

      <hr>
      <?php }
    }?>

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include 'includes/sidebar.php' ?>

  </div>
  <!-- /.row -->
  <ul class="pager">
    <?php
      for($i = 1; $i <= $count; $i++){
        if($pageNumber == "" && $i == 1){
          echo "<li><a class='link_active' href='index.php?page=1'>1</a></li>";
        } else if($i == $pageNumber){
          echo "<li><a class='link_active' href='index.php?page={$i}'>{$i}</a></li>";
        } else {
          echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
        }
      }
    ?>
  </ul>
  <hr>

  <?php include 'includes/footer.php' ?>
