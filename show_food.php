<?php
  include ('food_court_fns.php');
  session_start();
  $foodID = $_GET['foodID'];

  $food = get_food_details($foodID);
  do_html_header($food['name']);
 
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
        margin: auto;
		padding-left: 6%;}
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
	  .
      
    </style>
	<br><br><br><br>
  </head>
<body>


<!-- MAIN (Center website) -->
<div class="main">
<hr>
<?php

display_food_details($food);
$target = "index.php";
  if($food['catid']) {
    $target = "show_cat.php?catid=".$food['catid'];
 }

  if(check_admin_user()) {
    display_button("edit_food_form.php?foodID=".$foodID, "edit-item", "Edit Item");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button($target, "continue", "Continue");
  }
  else {
    display_button(   "show_cart.php?new=".$foodID,
                      "Add [".$food['name']."] To My Shopping Cart");
    display_button($target, "Continue Shopping");
  }
?>
</div>

</body>
</html>

<?php

  do_html_footer();
?>