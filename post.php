<?php include 'includes/header.php' ?>

<!-- Navigation -->
<?php include 'includes/navigation.php' ?>

<?php
if(isset($_GET['post_id'])){
  $postId = escape($_GET['post_id']);
  $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$postId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  $query = "SELECT * FROM posts WHERE post_id = {$postId}";
  $result = $connection->query($query);
  checkQueryExecution($result);
  while($row = $result->fetch_assoc()){
    $postTitle = $row['post_title'];
    $postAuthor = $row['post_author'];
    $postDate = $row['post_date'];
    $postImage = $row['post_image'];
    $postContent = $row['post_content'];
}
$postDate = date('l jS F Y', strtotime($postDate));
} else {
  header('Location: index.php');
}
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-8">

            <!-- Blog Post -->

            <!-- Title -->
            <h1><?php echo $postTitle; ?></h1>

            <!-- Author -->
            <p class="lead">
                by <a href="author_posts.php?author=<?php echo $postAuthor;?>"><?php echo $postAuthor; ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><i class="far fa-clock"></i> Posted on <?php echo $postDate; ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p> <?php echo $postContent; ?></p>

            <hr>

            <!-- Blog Comments -->

            <?php
            if(isset($_POST['create_comment'])){
              $commentAuthor = escape($_POST['comment_author']);
              $commentEmail = escape($_POST['comment_email']);
              $commentContent = escape($_POST['comment_content']);

              if(!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent)){
                if(isset($_SESSION['user_role'])){
                  $status = 'approved';
                } else {
                  $status = 'unapproved';
                }
                $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= "VALUES({$postId}, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', '{$status}', now())";
                $result = $connection->query($query);
                checkQueryExecution($result);
              } else {
                echo "<p class='bg-danger'>Fields cannot be empty!</p>";
              }
            }

            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="POST" action="">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <?php
                        if(isset($_SESSION['username'])){
                          echo "<input readonly = 'true' type='text' class='form-control' name='comment_author' value='{$_SESSION['username']}'>";
                        } else {
                          echo "<input type='text' class='form-control' name='comment_author'>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="comment_email">E-mail</label>
                        <?php
                        if(isset($_SESSION['user_email'])){
                          echo "<input readonly = 'true' type='email' class='form-control' name='comment_email' value='{$_SESSION['user_email']}'>";
                        } else {
                          echo "<input type='email' class='form-control' name='comment_email'>";
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="comment_content">Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="create_comment">Add Comment</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id={$postId} AND comment_status='approved'";
            $result = $connection->query($query);
            checkQueryExecution($result);
            while($row = $result->fetch_assoc()){
                $commentAuthor = $row['comment_author'];
                $commentContent = $row['comment_content'];
                $commentDate = $row['comment_date'];
                $commentDate = date('l jS F Y', strtotime($commentDate));
                ?>
                <div class="media">
                    <div class="pull-left" style="font-size:3em;">
                        <i class="fas fa-comment-dots"></i>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $commentAuthor ?>
                            <small><?php echo $commentDate ?></small>
                        </h4>
                        <?php echo $commentContent ?>
                    </div>
                </div>
                <?php }
                ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php' ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include 'includes/footer.php' ?>
