<?php

include_once 'header.php';
include_once 'includes/dbh.php';
?>

<?php


    if ($_SESSION['u_status'] != "Admin") {
        header("Location: index.php");
    }


    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    } else {
      $page = 1;
    }

      $num_per_page = 05;
      $start_from = ($page-1)*05;


?>



  <div class="container">
  <div class="row">
  <div class="col-md-8 col-sm-12">

  <?php
  $sql = "SELECT * FROM posts WHERE status='Pending' ORDER BY post_date DESC LIMIT $start_from, $num_per_page";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $post_id = $row['post_id']; 
       echo 
  "<div class='cover'>
    <article>
      <h3><b><a href='article.php?post_id=".$row['post_id']."'>".$row['subject']."</a></b></h3>
      <small class='pull-left'><b>".$row['author']."</small>
      <small class='pull-right'><b>".$row['post_date']."</small><br>
      <div class='article-text lead'>".$row['content']." </div>
      <a href='article.php?post_id=".$row['post_id']."&subject=".$row['subject']."&post_date=".$row['post_date']."' class='btn btn-primary btn-sm'>Read more</a>
      <form action='includes/approve.inc.php' method='POST'>
      <input type='hidden' value='".$post_id."' name='post_id'>
      <button type='submit' name='approve'class='btn btn-success pull-left'>Approve</button>
      </form>
      <form action='includes/decline.inc.php' method='POST'>
      <input type='hidden' value='".$post_id."' name='post_id'>
      <button type='submit'name='decline' class='btn btn-danger pull-right'>Decline</button>
      </form></br><br>
        <label class='label label-default'>".$row['label']."</label>
    </div>
";
    }
  }


?>

    </article>
   <?php  
  $sqli = "SELECT * FROM posts WHERE status='Pending' ";
  $queryresult = mysqli_query($conn, $sqli);
  $totalrecord = mysqli_num_rows($queryresult);
  $totalpage = ceil($totalrecord/$num_per_page);
    if ($page > 1) {
      echo "<nav aria-label='...'>
      <ul class='pagination pagination-xs'>
     <li  title='Previous'><a href='post_approve.php?page=".($page-1)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>
   </ul>
";
    }
    for ($i=1; $i < $totalpage; $i++) { 
      echo "  </ul>
    <ul class='pagination pagination-xs'>
    <li class=''><a href='post_approve.php?page=".$i."' aria-label='Previous'>$i<span aria-hidden='true'></span></a></li>
  </ul>";
    }

    if ($i>$page) {
      echo "
      <ul class='pagination pagination-xs'>
     <li  title='Next'><a href='post_approve.php?page=".($page+1)."' aria-label='Previous'><span aria-hidden='true'>&raquo;</span></a></li>
   </ul>
";
    }
 

?>
  </div>
<!--       <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%; margin-bottom: 10px;">
  </div>
     <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%;">
  </div>
    -->
  </div>
</div>


<?php

include_once 'footer.php';


?>