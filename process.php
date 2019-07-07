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
        }
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
  include ('food_court_fns.php');
  session_start();

  do_html_header('Checkout');

  $card_type = $_POST['card_type'];
  $card_number = $_POST['card_number'];
  $card_month = $_POST['card_month'];
  $card_year = $_POST['card_year'];
  $card_name = $_POST['card_name'];

  if(($_SESSION['cart']) && ($card_type) && ($card_number) &&
     ($card_month) && ($card_year) && ($card_name)) {
    display_cart($_SESSION['cart'], false, 0);

    display_shipping(calculate_shipping_cost());

    if(process_card($_POST)) {
      session_destroy();
      echo "<p>Thank you for shopping with us. Your order has been placed.</p>";
      display_button("index.php", "continue-shopping", "Continue Shopping");
    } else {
      echo "<p>Could not process your card. Please contact the card issuer or try again.</p>";
      display_button("purchase.php", "back", "Back");
    }
  } else {
    echo "<p>You did not fill in all the fields, please try again.</p><hr />";
    display_button("purchase.php", "back", "Back");
  }

  do_html_footer();
?>
