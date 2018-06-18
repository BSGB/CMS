<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form class="" action="search.php" method="post">
          <div class="input-group">
              <input name="search"type="text" class="form-control">
              <span class="input-group-btn">
                  <button name="submit" class="btn btn-default" type="submit">
                      <span class="glyphicon glyphicon-search"></span>
              </button>
              </span>
          </div>
        </form><!-- search form -->
        <!-- /.input-group -->
    </div>

    <!-- login form -->
    <?php
      if(isset($_SESSION['username'])){
?>
<div class="well">
    <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
      <div class="input-group col-xs-12">
          <a href="includes/logout.php">
            <button type="submit" name="login" class="btn btn-primary col-xs-12">Logout</button>
          </a>
      </div>
</div>
<?php
      } else {
        ?>
        <div class="well">
            <h4>Login</h4>
            <form class="" action="includes/login.php" method="post">
              <div class="form-group">
                  <input name="username"type="text" class="form-control" placeholder="Enter Username">
              </div>
              <div class="input-group">
                  <input name="password"type="password" class="form-control" placeholder="Enter Password">
                  <span class="input-group-btn">
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                  </span>
              </div>
            </form>
        </div>
        <?php
      }
      ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                  <?php
                  $query = "SELECT * FROM categories LIMIT 10";
                  $result = $connection->query($query);

                  while($row = $result->fetch_assoc()){
                    $catId = $row['cat_id'];
                    $catTitle = $row['cat_title'];
                    echo "<li><a href='category.php?cat_id={$catId}'>{$catTitle}</a></li>";
                  }
                   ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
<?php include 'widget.php' ?>

</div>
