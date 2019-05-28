<?php
$active = 'home';
include_once 'header.php';
include_once 'includes/dbh.php';


  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }

  $num_per_page = 05;
  $start_from = ($page-1)*05;

?>

    <form action="search.php" method="POST" class="container" style="margin-bottom: 20px;">
          <input type="text" name="search"  autocomplete="off" style="width: 57%; height: 48px; border-radius: 5px; outline: none; font-size: 17px;"  placeholder="Search">
        <button type="submit" name="search-field" class="btn btn-default btn-lg">Search</button>
    </form>


  <div class="container">
  <div class="row">
  <div class="col-md-8 col-sm-12">
  <?php
 
  $sql = "SELECT * FROM posts WHERE status='Approved' ORDER BY post_date DESC LIMIT $start_from, $num_per_page";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
       
  <div class='cover'>
    <article>
      <a href='article.php?post_id=<?php echo$row['post_id'] ?>&subject=<?php echo$row['subject'] ?>&post_date=<?php echo$row['post_date'] ?>'><h4><b><?php echo$row['subject'] ?></h4></a>
      <small class='pull-left'><?= $row['author'] ?></small>
      <small class='pull-right'><?= $row['post_date'] ?></b></small><br>
      <div class=' article-text'><?= $row['content'] ?></div>
      <a href='article.php?post_id=<?php echo$row['post_id'] ?>&subject=<?php echo$row['subject'] ?>&post_date=<?php echo$row['post_date'] ?>' class='btn btn-primary btn-sm'>Read more</a><br>

        <label class='label label-default'><?= $row['label'] ?></label>
    </div>
<?php
    }
  }


?>


<?php  
  $sqli = "SELECT * FROM posts WHERE status='Approved'";
  $queryresult = mysqli_query($conn, $sqli);
  $totalrecord = mysqli_num_rows($queryresult);
  $totalpage = ceil($totalrecord/$num_per_page);
    if ($page > 1) {
      echo "<nav aria-label='...'>
      <ul class='pagination pagination-xs'>
     <li  title='Previous'><a href='index.php?page=".($page-1)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>
   </ul>
";
    }
    for ($i=1; $i < $totalpage; $i++) { 
      echo "  </ul>
    <ul class='pagination pagination-xs'>
    <li class=''><a href='index.php?page=".$i."' aria-label='Previous'>$i<span aria-hidden='true'></span></a></li>
  </ul>";
    }

    if ($i>$page) {
      echo "
      <ul class='pagination pagination-xs'>
     <li  title='Next'><a href='index.php?page=".($page+1)."' aria-label='Previous'><span aria-hidden='true'>&raquo;</span></a></li>
   </ul>
";
    }
 

?>
    </article>


  </div>
   
   <div class="col-md-4 profile">
    <div class="Trending">
      <h3 class=" text-danger Trend ">Most Recent</h3>
      <?php   
         $sql = "SELECT * FROM posts WHERE status='approved' ORDER BY post_date DESC LIMIT $num_per_page";
           $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    ?>
       <div class='tren'>
         <h4><a href='article.php?post_id=<?php echo$row['post_id'] ?>&subject=<?php echo$row['subject'] ?>&post_date=<?php echo$row['post_date'] ?>'><b> <?php echo$row['subject'] ?></b></a></h4>
      <p class='pull-right'><?php echo$row['post_date'] ?></p>
     
       </div>
   <?php
    }
  }
 
    ?>
  </div>
  </div>
    <!--  <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%; margin-top: 10px;">
  </div>
  <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%; margin-top: 10px;">
  </div> -->
  </div>
</div>


<?php

include_once 'footer.php';


?>