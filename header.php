<?php

session_start();
include_once 'includes/dbh.php';
if(!isset($active)) {
  $active = '';
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bloggers hive</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
     <link rel="stylesheet" type="text/css" href="css/posts.css">
     <!-- <link rel="stylesheet" type="text/css" href="css/profile.css"> -->
     <!-- <link rel="stylesheet" type="text/css" href="css/login.css"> -->
     <link rel="stylesheet" type="text/css" href="css/article.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5ce55a597ff0c00012df0e6c&product='inline-share-buttons' async='async'></script>
     

  </head>
  <body>

<!-- Back to top button -->
<a id="button"></a>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <?php 
      if(isset($_SESSION['u_id'])) {
        $user = $_SESSION['u_id'];
        $sql = "SELECT * FROM users WHERE id = '$user'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
      }
      

      if (isset($row)) {
        echo "<a href='profile.php?id=".$row['id']."'><img src='profile_imgs/".$row['profile_img']."?".mt_rand()."' class='img-circle' title='profile' width='50' height= '50'></a>";
      }else{ 
        echo "<a class='navbar-brand' href='index.php'>Bloggers Hive</a>";
      }



      
     
      ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo ($active == 'home') ? 'active' : 'null'; ?>"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li class="<?php echo ($active == 'about_us') ? 'active' : 'null'; ?>"><a href="about.php">About us</a></li>
        <li class="<?php echo ($active == 'contact') ? 'active' : 'null'; ?>"><a href="contact_us.php">Contact us</a></li>
        <li class="<?php echo ($active == 'privacy') ? 'active' : 'null'; ?>"><a href="privacy.php">Privacy</a></li>
      </ul>
     
      
            <?php 
          if (isset($_SESSION['u_id'])) {
            ?>

                <ul class='nav navbar-nav navbar-right'>
                  <li><a href='create_post.php' class='btn btn-link'>Create post</a></li>
                  </ul>
                <form class=' nav navbar-nav navbar-right' action='includes/logout.php'  method='POST'>
                  <input type='submit' class='btn btn-default' name='submit' value='Logout'>
                </form>
            <?php

          } else{
            ?>
           <ul class='nav navbar-nav navbar-right'>
                  <li class="<?php echo ($active == 'login') ? 'active' : 'null'; ?>"><a href='login.php'>Login</a></li>
            </ul>
               <ul class='nav navbar-nav navbar-right'>
                <li class="<?php echo ($active == 'signup') ? 'active' : 'null'; ?>"><a href='signup.php' class='btn btn-default'>Signup</a></li>
            </ul>
          
        <?php  }
        ?>

         

        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>