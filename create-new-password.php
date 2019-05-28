<?php
  include_once 'header2.php';

?> 
<div class="container">
  <div class="bg">
        <?php

          $selector = $_GET['selector'];
          $validator = $_GET['validator'];

          if (empty($selector) || empty($validator)) {
            echo "Could not validate your request";
          } else {
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {

              ?>

          <form action="includes/reset-password.inc.php" method="POST" class="form-signin">

            <input type="hidden" name="selector" value="<?php echo $selector;  ?>">
            <input type="hidden" name="validator" value="<?php echo $validator;  ?>">
            <p>
              <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter a new password" required autofocus>
            </p>
            <p>
              <label>Comfirm password</label>
                <input type="password" name="pwd-repeat" class="form-control" placeholder="Repeat a new password" required>
            </p>
               <button type="submit" name="reset-password-submit" class="btn btn-primary btn-block">Reset password</button>
         </form>
      
              <?php
            }
          }

        ?>
          
  </div>
</div>

<?php
  include_once 'footer.php';

?>