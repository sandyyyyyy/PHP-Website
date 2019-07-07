<?php

require_once('food_court_fns.php');
session_start();

do_html_header("Updating food");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $oldfoodID = $_POST['oldfoodID'];
    $foodID = $_POST['foodID'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(update_food($oldfoodID, $foodID, $name, $author, $catid, $price, $description)) {
      echo "<p>Food was updated.</p>";
    } else {
      echo "<p>Food could not be updated.</p>";
    }
  } else {
    echo "<p>You have not filled out the form.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
