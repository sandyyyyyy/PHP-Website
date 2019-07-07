<?php
require_once('food_court_fns.php');
session_start();

?>
<html>
  <head>
    <style>
      * { text-align: center; box-sizing: border-box;}
      body {
		
        background-color: #FFFFFF;
        
		
        font-family: Arial;}
      /* Center website */
      .main {
        max-width: 1000px;
        margin: auto;}
      h1 {
        font-size: 50px;
        word-break: break-all;}
      .row { margin: 10px -16px;}
      /* Add padding BETWEEN each column */
      .row,.row > .column {padding: 8px;}/* Create three equal columns that floats next to each other */
      .column {
        float: left;
        width: 33.33%;
        display: none; /* Hide all elements by default */}
      /* Clear floats after rows */ 
      .row:after {
        content: "";
        display: table;
        clear: both;}
      /* Content */
      .content {
        background-color: white;
        padding: 10px;}
      /* The "show" class is added to the filtered elements */
      .show { display: block;}
	  .main {	  
   	     padding-left: 6%;
	  }
    </style>
	</head>
	</html>
<?php
if (($_POST['username']) && ($_POST['passwd'])) {

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if (userlogin($username, $passwd)) {
      $_SESSION['user_user'] = $username;

   } else {
      do_html_header("");
      echo "<p>You could not be logged in.<br/>
            You must be logged in to view this page.</p>";
      do_html_url('userlogin.php', 'Login');
      do_html_footer();
      exit;
    }
}

do_html_header("");
if (check_user()) {
  display_user_menu();
} else {
  echo "<p>You are not authorized to enter the user area.</p>";
}
do_html_footer();

?>
