<?php
  include_once 'header2.php';
  include_once 'includes/dbh.php';

?>



<div class="container">
  <div class="mg">
  <form class="form-signin" action="includes/create.inc.php" method="POST" enctype="multipart/form-data">
    <h1 class="text-center"><b>Create post</h1>
    <p>
    <label>Subject</label>
    <input type="text" name="subject" class="form-control" placeholder="Subject" required autocomplete="off">
   </p>
     <p>
    <label>Label</label>
      <select name="select" class="form-control">
        <option selected disabled >Choose a label</option>
    <?php 
    $sql = "SELECT * FROM tags";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if ($resultcheck > 0) {
     while ($row = mysqli_fetch_assoc($result)) {
      echo "
         <option>".$row['name']."</option>";
   }
  }
?>
      </select>
   </p>
     <label>Image</label>
    <input type="file" name="file" class="form-control" required="">
   </p>
    <p>
      <label>Content</label>
      <textarea class="form-control" id="Message" style="width: 100%; height: 90px;" name="massage" placeholder="Article" required autocomplete="false"></textarea>
    </p>

   <button type="submit" class="btn btn-primary btn-block" name="submit">Send</button>


  </form>
  </div>
</div>

<?php
  include_once 'footer.php';

?>