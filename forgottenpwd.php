<?php
  include_once 'header2.php';

if (isset($_SESSION['u_id'])) {
  Header("Location: index.php");
}
?> 


<div class="container">
  <div class="bg">
    <h3 class="text-center"><b>Reset your password </h3>
       <p class="text-center">An e-mail will be send to you with instructions on how to reset your password. </p>
          <form action="includes/reset-request.inc.php" method="POST" class="form-signin">
            <p>
              <label> Enter email </label>
                <input type="text" name="email" class="form-control" placeholder="Email address" required autofocus>
            </p>
          <button type="submit" name="reset-request-submit" class="btn btn-primary btn-block">Receive new password by email</button>
  </form>

      <?php
      if (isset($_GET["reset"])) {
        if ($_GET["reset"] == "success") {
          echo "<p class='text-success text-center'>Check your E-mail!</p>";
        }
      }

      ?>
  </div>
</div>

<?php
  include_once 'footer.php';

?>