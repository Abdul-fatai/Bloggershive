
<?php
  include_once 'header.php';
  include_once 'includes/dbh.php';

?>

<?php  
  if (!isset($_GET['post_id'])) {
    header("Location: index.php");
    exit();
  } else {
    $id = $_GET['post_id'];
  }

if (isset($_SESSION['u_id'])) {
  $username = $_SESSION['u_uid'];
}else {
  $username = '';
}


?>





<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-12">

  <?php 

  $sql = " SELECT * FROM posts WHERE post_id='$id'";
  $result = mysqli_query($conn, $sql);


  if (mysqli_num_rows($result) > 0){
  while ($row = mysqli_fetch_assoc($result)) {


    echo "<div class=' cover'>
    <article>
      <img src='posts_img/".$row['post_img']."' class='img-rounded' width='320px' height='200px'>
      <h3><b>".$row['subject']."</h3>
       <small class='pull-left'>".$row['author']."</small>
      <small class='pull-right'>".$row['post_date']."</b></small><br>
      <div class='lead'>".$row['content']."</div>
    </article>
  
    <p><b>Share this post:</b> </p>
     <div class='sharethis-inline-share-buttons'></div>
      
";
    
  }

}
 
?>
    
  <div id="comments">
  <h3><b>Comments</b></h3>
  <div class="row">
<?php
    $sqli = "SELECT * FROM comments WHERE post_id='$id'";
 $resultCheck = mysqli_query($conn, $sqli);

 if (mysqli_num_rows($resultCheck) > 0) {
   while ($rows = mysqli_fetch_assoc($resultCheck)) {
     echo " <div class='col-md-11'>
      <h4><img src='img/blog.png' class='img-circle' width='50'>".$rows['name']."</h4><p class='text-right' ><sup>".$rows['comment_date']."</sup><p class='comment-text'>".$rows['comment']."<p>
   
    </div>";
   }
 }

 ?>
    
    </div>

  <form class="form-group" action="includes/comment.inc.php" method="POST">
    <h3>Write your comment</h3>
    <p>
      <label></label>
      <input type="text" class="form-control" value="<?php echo $username; ?>" name="name"   placeholder="Full name" required>
    </p>
    
     <p>
      <input type="hidden" class="form-control"  value="<?php echo $id; ?>" name="id">
    </p>
    <p>
      <label>Message</label>
      <textarea class="form-control" name="message" id="Message" placeholder="Message" required></textarea>
    </p>

    <input type="submit" class=" btn btn-primary" name="submit_comment" value="Comment">
  </form>
  </div>
</div>
</div>
<!--     <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%; margin-bottom: 10px;">
  </div>
     <div class="col-md-2 advert img">
        <img src="img/banner.png" style="width: 100%; height: 100%;">
  </div> -->
</div>
</div>

 <?php
  include_once 'footer.php';

?>