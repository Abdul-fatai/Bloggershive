<?php
  $active = 'contact';
  include_once 'header2.php';

  if(isset($_SESSION['u_id'])) {
    $username = $_SESSION['u_uid'];
    $email = $_SESSION['u_email'];
  } else {
    $username = '';
    $email = '';
  }
?>
 
<div class="container">
  <div class="mg">
  <form action="includes/contact.inc.php" method="POST" class="form-signin">
    <h1 class="text-center"><b>Contact us</h1>
      <?php  
        if (isset($_GET['contact'])) {
          if ($_GET['contact'] == "success") {
            echo "<p class='text-success text-center'>Thanks for contacting us. we'll get back to you soon!</p>";
          }
        }
      ?>

    <p>
    <label> Full name</label>
    <input type="text" value="<?php echo $username; ?>" name="fullname" class="form-control" placeholder="Firstname">
   </p>
     <p>
    <label>Email</label>
    <input type="email" value="<?php echo $email; ?>" name="email" class="form-control" placeholder="Email">
   </p>
     <p>
    <label>Subject</label>
    <input type="text" name="subject" class="form-control" placeholder="Subject" autocomplete="off">
   </p>
    
    <p>
      <label>Message</label>
      <textarea class="form-control" id="Message" name="message" placeholder="Message" required></textarea>
    </p>

   <button type="submit" name="contact" class="btn btn-primary btn-block">Send Message</button>


  </form>
  </div>
</div>

<?php
  include_once 'footer.php';

?>