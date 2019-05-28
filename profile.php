
<?php
  include_once 'header.php';
  include_once 'includes/dbh.php';

?>
<?php

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $num_per_page = 06;
  $start_from = ($page-1)*06;

if (!$_SESSION['u_id']) {
    header("Location: index.php");
    exit();
  }


  if (!isset($_GET['id'])) {
    header("Location: index.php");
  }else {
    $id = $_GET['id'];
  }
?>

<div class='container'>
<?php  

if (isset($_SESSION['u_id'])) {
  $username = $_SESSION['u_id'];
  $sql = "SELECT * FROM users WHERE id='$username'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
}
  

  if (isset($row)) {
    $user_id = $row['id']; 
      echo "
  <div class='row'>
    <div class='col-md-3 profile'>
       <aside>
          <img  class='img-circle' src='profile_imgs/".$row['profile_img']."' alt='profile_img' width='110px' height='100px'>
              <h3><b>".$row['username']."</b><sup style='color: red;'><i> (".$row['status'].")</i></sup></h3>

      
                <form action='includes/profile_update.php' method='POST' enctype='multipart/form-data'>
                    <input type='file'  name='file' class=' btn btn-default col-md-8 ' required>
                      <button type='submit' name='profile_update' class='btn btn-default pull-right'>Update</button>
               </form>
             <br> <br>
        </aside>
  ";

  $user_type = $row['status'];
    if ($user_type != 'Admin') {
      echo "";
    }else {
      echo "<h4><a href='post_approve.php' class=' btn-link'><b>Approve post page</b></a></h4>";
    }
  }


?>
</div>




  <div class="col-md-8">

  <?php 
  if (isset($_SESSION['u_uid'])) {
    $user = $_SESSION['u_uid'];
    $sqli = "SELECT * FROM posts WHERE author = '$user' ORDER BY post_date DESC LIMIT $start_from, $num_per_page";
   $result = mysqli_query($conn, $sqli);
  }
  

if (mysqli_num_rows($result) > 0) {
  while ($rows = mysqli_fetch_assoc($result)) {
    $Status = $rows['status'];
    echo "
  <div class='col-md-6'>
    <div class='cover'>
        <article>
          <a href='article.php?post_id=".$rows['post_id']."&subject=".$rows['subject']."&post_date=".$rows['post_date']."'><h4><b>".$rows['subject']."</h4></a>
       <div class='text-success'>".$Status."</div>
          <small class='pull-left'>".$rows['author']."</small>
            <small class='pull-right'>".$rows['post_date']."</b></small><br>
     
  <div class=' article-text'>".$rows['content']."</div>
        <a href='article.php?post_id=".$rows['post_id']."&subject=".$rows['subject']."&post_date=".$rows['post_date']."' class='btn btn-primary btn-sm'>Read more</a>
          <a href= 'post_edit.php?post_id=".$rows['post_id']."'  class='pull-right btn btn-primary'>Edit post</a><br>
        <label class='label label-default'>Tech</label>
    
    </div>
    </div>
     </article>";
  }
}



?>

<?php  
  $sqli = "SELECT * FROM posts WHERE author='$user'";
  $queryresult = mysqli_query($conn, $sqli);
  $totalrecord = mysqli_num_rows($queryresult);
  $totalpage = ceil($totalrecord/$num_per_page);
    if ($page > 1) {

      echo "
      <ul class='pagination pagination-xs'>
     <li  title='Previous'><a href='profile.php?id=".$id."&page=".($page-1)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>
   </ul>
";
    }
    for ($i=1; $i < $totalpage; $i++) { 
      echo "  </ul>
    <ul class='pagination pagination-xs'>
    <li class=''><a href='profile.php?id=".$id."&page=".$i."' aria-label='Previous'>$i<span aria-hidden='true'></span></a></li>
  </ul>";
    }

    if ($i>$page) {
      echo "
      <ul class='pagination pagination-xs'>
     <li  title='Next'><a href='profile.php?id=".$id."&page=".($page+1)."' aria-label='Previous'><span aria-hidden='true'>&raquo;</span></a></li>
   </ul>
";
    }
 

?>
    

      
   

  </div>
  </div>
</div>

<?php
  include_once 'footer.php';

?>