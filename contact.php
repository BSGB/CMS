
 <?php  include "includes/header.php"; ?>

<?php
$message = "";

if(isset($_POST['submit'])){
  $to = "kontakt.cms.projekt@gmail.com";
  $from = $_POST['email'];
  $subject = escape($_POST['subject']);
  $body = escape($_POST['body']);

  $subject = wordwrap($subject, 70);


  if(!empty($from) && !empty($subject) && !empty($body)){
    mail($to, $subject, "From: " . $from . "\n" . $body);
    $message = "<p class='text-center bg-success'>Thanks for contacting us.</p>";
  } else {
    $message = "<p class='text-center bg-danger'>Fields cannot be empty!</p>";
  }
}

?>

    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>


    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                      <p class="text-center bg-danger"><?php echo $message; ?></p>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
<?php include "includes/footer.php";?>
