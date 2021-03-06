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
                        <?php
                        if(isset($_GET['source'])){
                          $source = $_GET['source'];
                        } else {
                          $source = "";
                        }
                        switch($source){
                          case 'approve_comment':
                          include 'includes/approve_comment.php';
                          break;
                          case 'unapprove_comment':
                          include 'includes/unapprove_comment.php';
                          break;
                          case 'delete_comment':
                          include 'includes/delete_comment.php';
                          break;
                          default:
                          include 'includes/view_all_comments.php';
                        }
                         ?>
                    </div>
                </div>
                <!-- /.row -->

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
