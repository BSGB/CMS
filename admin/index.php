<?php include 'includes/admin_header.php' ?>
    <div id="wrapper">

        <!-- Navigation -->
<?php include 'includes/admin_navigation.php' ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin

                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
<div class="row">
<div class="col-lg-3 col-md-6">
 <div class="panel panel-primary">
     <div class="panel-heading">
         <div class="row">
             <div class="col-xs-3">
                 <i class="fa fa-file-text fa-5x"></i>
             </div>
             <div class="col-xs-9 text-right">
               <?php
               $query = "SELECT * FROM posts";
               $result = $connection->query($query);
               $numberOfPosts = $result->num_rows;
               ?>
           <div class='huge'><?php echo $numberOfPosts; ?></div>
                 <div>Posts</div>
             </div>
         </div>
     </div>
     <a href="posts.php">
         <div class="panel-footer">
             <span class="pull-left">View Details</span>
             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
             <div class="clearfix"></div>
         </div>
     </a>
 </div>
</div>
<div class="col-lg-3 col-md-6">
 <div class="panel panel-green">
     <div class="panel-heading">
         <div class="row">
             <div class="col-xs-3">
                 <i class="fa fa-comments fa-5x"></i>
             </div>
             <div class="col-xs-9 text-right">
               <?php
               $query = "SELECT * FROM comments";
               $result = $connection->query($query);
               $numberOfComments = $result->num_rows;
               ?>
              <div class='huge'><?php echo $numberOfComments; ?></div>
               <div>Comments</div>
             </div>
         </div>
     </div>
     <a href="comments.php">
         <div class="panel-footer">
             <span class="pull-left">View Details</span>
             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
             <div class="clearfix"></div>
         </div>
     </a>
 </div>
</div>
<div class="col-lg-3 col-md-6">
 <div class="panel panel-yellow">
     <div class="panel-heading">
         <div class="row">
             <div class="col-xs-3">
                 <i class="fa fa-user fa-5x"></i>
             </div>
             <div class="col-xs-9 text-right">
               <?php
               $query = "SELECT * FROM users";
               $result = $connection->query($query);
               $numberOfUsers = $result->num_rows;
               ?>
             <div class='huge'><?php echo $numberOfUsers; ?></div>
                 <div> Users</div>
             </div>
         </div>
     </div>
     <a href="users.php">
         <div class="panel-footer">
             <span class="pull-left">View Details</span>
             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
             <div class="clearfix"></div>
         </div>
     </a>
 </div>
</div>
<div class="col-lg-3 col-md-6">
 <div class="panel panel-red">
     <div class="panel-heading">
         <div class="row">
             <div class="col-xs-3">
                 <i class="fa fa-list fa-5x"></i>
             </div>
             <div class="col-xs-9 text-right">
               <?php
               $query = "SELECT * FROM categories";
               $result = $connection->query($query);
               $numberOfCategories = $result->num_rows;
               ?>
                 <div class='huge'><?php echo $numberOfCategories;?></div>
                  <div>Categories</div>
             </div>
         </div>
     </div>
     <a href="categories.php">
         <div class="panel-footer">
             <span class="pull-left">View Details</span>
             <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
             <div class="clearfix"></div>
         </div>
     </a>
 </div>
</div>
</div>
         <!-- /.row -->
         <?php
         $query = "SELECT * FROM posts WHERE post_status = 'draft'";
         $result = $connection->query($query);
         $numberOfDraftPosts = $result->num_rows;

         $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
         $result = $connection->query($query);
         $numberOfUnapprovedComments = $result->num_rows;

         $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
         $result = $connection->query($query);
         $numberOfSubscribers = $result->num_rows;
         ?>
        <div class="row">
           <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Data', 'Count'],

      <?php
      $elementText = ['Active Post', 'Draft Posts', 'Approved Comments',
      'Unapproved Comments', 'Admins', 'Subscribers', 'Categories'];
      $elementCount = [$numberOfPosts - $numberOfDraftPosts,
      $numberOfDraftPosts, $numberOfComments - $numberOfUnapprovedComments,
      $numberOfUnapprovedComments, $numberOfUsers - $numberOfSubscribers,
      $numberOfSubscribers, $numberOfCategories];

      for($i = 0; $i < count($elementText); $i++){
        echo "['{$elementText[$i]}'" . ", " . "{$elementCount[$i]}],";
      }
      ?>
    ]);

    var options = {
      chart: {
        title: '',
        subtitle: '',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
 <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
         </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<?php include 'includes/admin_footer.php' ?>
