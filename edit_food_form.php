<?php

require_once('food_court_fns.php');
session_start();

do_html_header("Edit Food details");

if (check_admin_user()) {

  if ($food = get_food_details($_GET['foodID'])) {
    display_food_form($food);
  }
  else {
    echo "<p>Could not retrieve food details.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");

} 

else {

  echo "<p>You are not authorized to enter the administration area.</p>";

}

do_html_footer();

?>
