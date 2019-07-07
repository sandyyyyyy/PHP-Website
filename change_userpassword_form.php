<?php
 require_once('food_court_fns.php');
 session_start();
 do_html_header("");
 check_user();

 display_userpassword_form();
?>
<html>
 <p7 style="text-align:center;"> <?php
 
 do_html_url("user.php", "Back to menu");
 ?> </p7>
 <br><br><br>
 <hr>
 
 </html>
 
 
 <?php
 
 do_html_footer();
?>