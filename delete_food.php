<?php

require_once('food_court_fns.php');
session_start();

do_html_header("Deleting food");

if (check_admin_user()) {
  if (isset($_POST['foodID'])) {
    $foodID = $_POST['foodID'];
    if(delete_food($foodID)) {
      echo "<p>food ".$foodID." was deleted.</p>";
    } else {
      echo "<p>food ".$foodID." could not be deleted.</p>";
    }
  } else {
    echo "<p>We need an foodID to delete a food.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
