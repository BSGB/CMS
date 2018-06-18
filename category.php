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
                    <small>By Category</small>
                </h1>

                <!-- POSTS -->
                <?php
                if(isset($_GET['cat_id'])){
                  $postCat = $_GET['cat_id'];

                  $query = "SELECT * FROM posts WHERE post_category_id = {$postCat} ORDER BY post_id DESC";
                  $result = $connection->query($query);
                  checkQueryExecution($result);

                  if($result->num_rows == 0){
                    echo "<h2>NO RESULTS</h2>";
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
                      <a href="post.php?post_id=<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                  </h2>
                  <p class="lead">
                      by <a href="index.php"><?php echo $postAuthor; ?></a>
                  </p>
                  <p><span class="glyphicon glyphicon-time"></span> <?php echo $postDate; ?></p>
                  <hr>
                  <a href="post.php?post_id=<?php echo $postId; ?>">
                    <img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
                  </a>
                  <hr>
                  <p><?php echo substr($postContent, 0, 200) . "[...]"; ?></p>
                  <a class="btn btn-primary" href="post.php?post_id=<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                  <hr>
                <?php }
              }
            }
            ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
<?php include 'includes/sidebar.php' ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include 'includes/footer.php' ?>
