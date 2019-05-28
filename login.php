
<?php
  $active = 'login';
  include_once 'header2.php';
  if (isset($_SESSION['u_id'])) {
    header("Location: index.php");
  }
?>

<div class="container">
    <div class="bg">
      <form class="form-signin" action="includes/login.inc.php" method="POST">
       <h2 class="text-center"><b>Login </h2>
   
    <label>Username or Email </label>
    <input type="text" name="username" class="form-control" placeholder="Username or Email">

    <?php
   if (isset($_GET['input'])) {
      if ($_GET['input'] == "empty") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    } 

  if (isset($_GET['uid'])) {
    if ($_GET['uid'] == "incorrectusername") {
        echo "<p class='text-danger'>Incorrect username</p>";
      }
    } 

    ?>
  
     <label>Password</label>
    <input type="Password" name="password" class="form-control" placeholder="Password">

    <?php
    if (isset($_GET['input'])) {
      if ($_GET['input'] == "empty") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    } 
    if (isset($_GET['pwd'])) {
      if ($_GET['pwd'] == "incorrectpwd") {
        echo "<p class='text-danger'>Incorrect password</p>";
      }
    } 

    ?>


   <p class="checkbox text-left"><label><input type="checkbox" name="remember">Remember me</label></p>
   <p class="text-right warning"><a href="forgottenpwd.php">Forgotten passwod</a></p>


   <button type="submit" class="btn btn-primary btn-block" name="submit">Submit</button>
   </form>

   <?php

   if (isset($_GET['newpwd'])) {
      if ($_GET['newpwd'] == "passwordupdated") {
        echo "<p>Your password has been reset!</p>";
      }
    } 




   ?>

   </div>
</div>

<?php
  include_once 'footer.php';

?>