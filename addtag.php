<?php
  include_once 'header2.php';

?> 
<div class="container">
  <div class="bg">
  <form class="form-signin" action="includes/tag.inc.php" method="POST" >
    <h3>ADD TAG</h3>
    <p>
    <label>Add tag</label>
    <input type="text" name="tag" class="form-control" placeholder="name" required autofocus>
   </p>

   <button type="submit" class="btn btn-primary btn-block" name="submit">Send</button>


  </form>
  </div>
</div>

<?php
  include_once 'footer.php';

?>