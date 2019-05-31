<?php
  $active = 'signup';
  include_once 'header2.php';

if (isset($_SESSION['u_id'])) {
  Header("Location: index.php");
}
?>
 
<div class="container">
  <div class="mg">
  <form class="form-signin" action="includes/signup.inc.php" method="POST" enctype="multipart/form-data">
    <h1 class="text-center"><b>Sign up</h1>
       <label> Firstname</label>
    <?php 
      if (isset($_GET['fname'])) {
        $first = $_GET['fname'];
          echo '<input type="text" name="fname" class="form-control" placeholder="Firstname"  value="'.$first.'" autofocus>';
      } else {
        echo '<input type="text" name="fname" class="form-control" placeholder="Firstname" autofocus>';
      }
    ?>
    <?php 
    if (isset($_GET['input'])) {
      if ($_GET['input'] == "emptyfirstname") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    }

    ?>

    
    <label>Lastname</label>
    <?php 
      if (isset($_GET['lname'])) {
        $last = $_GET['lname'];
          echo '<input type="text" name="lname" class="form-control"  value="'.$last.'" placeholder="Lastname">';
      } else {
        echo '<input type="text" name="lname" class="form-control" placeholder="Lastname">';
      }
    ?>
    
    <?php 
    if (isset($_GET['input'])) {
      if ($_GET['input'] == "emptylastname") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    }

    ?>

    <label>Username</label>
     <?php 
      if (isset($_GET['uid'])) {
        $username = $_GET['uid'];
          echo ' <input type="text" name="uid" class="form-control" value="'.$username.'" placeholder="Username">';
      } else {
        echo ' <input type="text" name="uid" class="form-control" placeholder="Username">';
      }
    ?>
   
    <?php 

    if (isset($_GET['input'])) {
      if ($_GET['input'] == "emptyusername") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    }

    if (isset($_GET['username'])) {
      if ($_GET['username'] == "usernametaken") {
        echo "<p class='text-danger'>Username taken</p>";
      }
    }

    ?>
   

    
    <label> Email</label>
    <input type="text" name="email" class="form-control" placeholder="Email">
    <?php 
    if (isset($_GET['input'])) {
      if ($_GET['input'] == "emptyemail") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    }
    if (isset($_GET['email'])) {
      if ($_GET['email'] == "invalidemail") {
        echo "<p class='text-danger'>Email invalid</p>";
      }
    }


    ?>
   
    <p>
    <label>Profile image</label>
    <input type="file" name="file" class="form-control" required="">
   </p>
    
     <label>Password</label>
    <input type="Password" name="pwd" class="form-control" placeholder="Password">
    <?php 
    if (isset($_GET['input'])) {
      if ($_GET['input'] == "emptypwd") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    }


    ?>
   
  
     <label>Comfirm Password</label>
    <input type="Password" name="cpwd" class="form-control" placeholder="Comfirm Password">
    <?php 
    if (isset($_GET['input'])) {
      if ($_GET['input'] == "emptycpwd") {
        echo "<p class='text-danger'>This field is required</p>";
      }
    }

    if (isset($_GET['pwd'])) {
      if ($_GET['pwd'] == "pwdnotmatch") {
        echo "<p class='text-danger'>password didn't match</p>";
      }
    }


    ?>
   
      <p class="text-center">By clicking submit you have agree to our <a href="privacy.php">terms and conditions</a></p>
   <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>


  </form>
  </div>
</div>

<?php
  include_once 'footer.php';

?>