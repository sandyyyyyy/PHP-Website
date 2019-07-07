<?php
  include ('food_court_fns.php');
  
  session_start();
  do_html_header("");
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
	  .row{font-size: 30px;}
    </style>
  </head>
  <body>
  <div class="main">
<?php

  if(($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    display_cart($_SESSION['cart'], false, 0);
    display_checkout_form();
  } else {
    echo "<p>There are no items in your cart</p>";
  }

  display_button("show_cart.php", "Continue Shopping");
?>
 </div>
</body>
</html>
<?php
  do_html_footer();
?>
