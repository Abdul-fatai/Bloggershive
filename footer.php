<div class="footer col-md-12">
<footer class="text-center">
  <li><a href="privacy.php">Privacy</a></li>
  <li><a href="about.php">About us</a></li>
  <li><a href="about.php">Terms </a></li>
  <li><a href="about.php">Condition</a></li>
  <li><a href="about.php">Advertise</a></li>
  <h4 class="text-right"><img src="img/blog.png" alt="logo" style=" width: 5%; height: 5%;"><b>Bloggershive 2019</b></h4>
</footer>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="css/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">
      var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});


    </script>
  </body>
</html>