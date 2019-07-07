<?php
  include ('food_court_fns.php');
  session_start();
  do_html_header("");

?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      p { text-align: center; }
    </style>
  </head>
  <body>
  <h1 class="title" align="center">Contact us</h1>

	<p>Location: Online Food Court Ltd.</p>
	<p>Address: Internet</p>
	<p>Email: online_food_court@gmail.com</p>
	<p>Store hours: 24/7</p>
	<p>Phone:(604)599-2000</p>

  </body>
</html>
<?php
   if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Admin Menu");
  }
  
  if(isset($_SESSION['user_user'])) {
    display_button("user.php", "user-menu", "User Menu");
  }
    do_html_footer();
?>