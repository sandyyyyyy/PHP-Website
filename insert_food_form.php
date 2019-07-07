<?php

require_once('food_court_fns.php');
session_start();

do_html_header("Add a food");
if (check_admin_user()) {
  display_food_form();
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorized to enter the administration area.</p>";
}
do_html_footer();

?>
