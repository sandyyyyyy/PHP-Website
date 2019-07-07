<?php
  include ('food_court_fns.php');
  session_start();
  @$new = $_GET['new'];
do_html_header("Your shopping cart");

 ?>
<html>
  <head>
    <style>
      * { text-align: center; box-sizing: border-box; }
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
      .row { margin: 10px -233px;}
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
		  padding-left: 6%
        background-color: white;
        padding: 10px; 
      /* The "show" class is added to the filtered elements */
      .show { display: block; }
	  
    </style>
	</head>
	<body>

<!-- MAIN (Center website) -->
<div class="main">
<?php

  if($new) {
    if(!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
      $_SESSION['items'] = 0;
      $_SESSION['total_price'] ='0.00';
    }

    if(isset($_SESSION['cart'][$new])) {
      $_SESSION['cart'][$new]++;
    } else {
      $_SESSION['cart'][$new] = 1;
    }

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  if(isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $foodID => $qty) {
      if($_POST[$foodID] == '0') {
        unset($_SESSION['cart'][$foodID]);
      } else {
        $_SESSION['cart'][$foodID] = $_POST[$foodID];
      }
    }

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  

  if(($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    display_cart($_SESSION['cart']);
  } else {
    echo "<p>There are no items in your cart</p><hr/>";
  }
 
  

?>

<div class="row">
    
  



</div>


</div>

</body>
	</html>
<?php
$target = "index.php";

  if($new)   {
    $details =  get_food_details($new);
    if($details['catid']) {
      $target = "show_cat.php?catid=".$details['catid'];
    }
  }
  display_button("food.php", "Continue Shopping");

  display_button("checkout.php", "Go To Checkout");
 do_html_footer();
?>

