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
                        <div class="col-xs-6">
                          <form class="" action="" method="post">
                            <div class="form-group">
                              <label for="catTitle">Add Category</label>
                              <input class="form-control" type="text" name="catTitle">
                            </div>
                            <div class="form-group">
                              <input class="btn btn-primary" type="submit" name="submitAdd" value="Add Category">
                              <?php insertCategory(); ?>
                            </div>
                          </form>
                          <?php if(isset($_GET['edit'])){
                            $editId = $_GET['edit'];
                            include 'includes/update_category.php';
                          } ?>
                        </div>
                        <div class="col-xs-6">
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                              </tr>
                            </thead>
                            <tbody>
                               <?php fillCategoriesTable(); ?>
                               <?php deleteCategory(); ?>
                            </tbody>
                          </table>
                        </div>

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
