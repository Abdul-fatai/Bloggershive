<?php
	include_once 'header.php';
?>


<?php  

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
  <div class="col-md-8">
  	<h2><b>Search page</h2>
 
  
    <?php
    	if (isset($_POST['search-field'])) {
        if (!isset($_POST['search']) || $_POST['search'] == '' || $_POST['search'] == null) {
            header("Location: index.php");
            exit();
          }

        // Error handlers 
        // check for empty field
    		$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);

    		$sql = "SELECT * FROM posts WHERE status='Approved' AND subject LIKE '%$search%' OR label LIKE '%$search%' OR content LIKE '%$search%' OR post_date LIKE '%$search%' OR author LIKE '%$search%'";
    		$result = mysqli_query($conn, $sql);
    		$queryresult = mysqli_num_rows($result);
        echo "<h4>About ".$queryresult." results!</h4>";

    		if ($queryresult > 0) {
    			while ($row = mysqli_fetch_assoc($result)) {
    				?>
    					<div class='cover'>
    					<article>
      				<a href='article.php?post_id=<?php echo$row['post_id'] ?>&subject=<?php echo$row['subject'] ?>&post_date=<?php echo$row['post_date'] ?> '><h4><b><?= $row['subject'] ?></b></h4></a>
      				<small class='pull-left'><b><?= $row['author'] ?></small>
      				<small class='pull-right'><b><?= $row['post_date'] ?></small><br>
     
      			<div class='article-text lead'><?= $row['content'] ?></div><a href='article.php?post_id=<?php echo$row['post_id'] ?>&subject=<?php echo$row['subject'] ?>&post_date=<?php echo$row['post_date'] ?>' class='btn btn-primary btn-sm'>Read more</a><br>
  
       			 <label class='label label-default'><?= $row['label'] ?></label>
      
    		</div>
    				<?php
    			}
    			
    		} else {
    			echo "There are no results matching your search!";
    		}

    	}
      
    ?>
<!-- 
<?php  

  $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
  $sql = "SELECT * FROM posts WHERE status='Approved' AND subject LIKE '%$search%' OR label LIKE '%$search%' OR content LIKE '%$search%' OR post_date LIKE '%$search%' OR author LIKE '%$search%' ";
  $queryresult = mysqli_query($conn, $sql);
  $totalrecord = mysqli_num_rows($queryresult);
  $totalpage = ceil($totalrecord/$num_per_page);
    if ($page > 1) {
      echo "
      <ul class='pagination pagination-md'>
     <li  title='Previous'><a href='search.php?page=".($page-1)."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>
   </ul>
";
    }
    for ($i=1; $i < $totalpage; $i++) { 
      echo "</ul>
    <ul class='pagination pagination-md'>
    <li class='' ><a href='search.php?page=".$i."' aria-label='Previous'>$i<span aria-hidden='true'></span></a></li>
  </ul>";
    }

    if ($i>$page) {
      echo "
      <ul class='pagination pagination-md'>
     <li  title='Next'><a href='search.php?page=".($page+1)."' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>
   </ul>
";
    }
 

?>
 -->

    
    </article>

    
<!--   </div>
  <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%; margin-top: 10px;">
  </div>
  <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%; margin-top: 10px;">
  </div>
 -->
</div>
</div>
</div>
  <?php
  include_once 'footer.php';
  ?>