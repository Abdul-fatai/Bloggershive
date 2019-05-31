<?php
  include_once 'header2.php';
  include_once 'includes/dbh.php';

?>

<?php
  if (!isset($_SESSION['u_id'])) {
    header("Location: index.php");
    exit();
  }


  if (!isset($_GET['post_id'])) {
    header("Location: ../index.php");
    exit();
  }else {
    $post_id = $_GET['post_id'];
  }
?>

<div class="container">
  <div class="mg">
  <form class="form-signin" action="includes/post_update.php" method="POST" enctype="multipart/form-data">
    <h1 class="text-center"><b>Update post</h1>
  <?php  

   $sqli= "SELECT * FROM posts WHERE post_id='$post_id'";
   $result = mysqli_query($conn, $sqli);

  if (mysqli_num_rows($result) > 0) {
    while ($rows = mysqli_fetch_assoc($result)) {
     echo "<p>
    <label>Subject</label>
    <input type='text' value='".$rows['subject']."' name='subject' class='form-control' placeholder='Subject' required>
     </p>
     <p>
    <input type='hidden' value='".$post_id."' name='post_id'> 
    <p>
      <label>Content</label>
      <textarea class='form-control' name='message' style='width: 100%; height: 200px;' name='massage'  required >".$rows['content']."</textarea>
    </p>
    ";
    }
  }

?>
   <button type='submit' class='btn btn-primary btn-block' name='update_post'>Update</button>


  </form>
  </div>
</div>

<?php
  include_once 'footer.php';

?>