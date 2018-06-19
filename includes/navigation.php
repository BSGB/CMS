<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Home Page</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <?php
              if(isset($_SESSION['username'])){pokeActive();}
              $query = "SELECT * FROM categories LIMIT 5";
              $result = $connection->query($query);

              while($row = $result->fetch_assoc()){
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];
                echo "<li><a href='category.php?cat_id={$catId}'>{$catTitle}</a></li>";
              }
               ?>
               <li>
                   <a href="registration.php">Register</a>
               </li>

               <li>
                   <a href="contact.php">Contact</a>
               </li>
                <li>
                    <a href="admin/index.php">Admin</a>
                </li>


                <?php
                if(isset($_SESSION['user_role'])){
                  if(isset($_GET['post_id']) && $_SESSION['user_role'] == 'admin'){
                    echo "<li>
                    <a href='admin/posts.php?source=edit_post&edit_id={$_GET['post_id']}'>Edit Post</a>
                    </li>";
                  }
                }
                 ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
