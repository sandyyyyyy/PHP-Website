<?php
  include ('food_court_fns.php');

  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);

  do_html_header($name);
    
      if(!isset($_SESSION['admin_user'])) {
        echo  "<p style='text-align:right'>Total Items = ".$_SESSION['items']."</p>";
      }
      
      if(!isset($_SESSION['admin_user'])) {
        echo "<p style='text-align:right'>Total Price = $".number_format($_SESSION['total_price'],2)."</p>";
      }
      
?>
<html>
  <head>
    <style>
      * { text-align: center; box-sizing: border-box;}
      body {
        background-color: #FFFFFF;
        padding: 20px;
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
        width: 25%;
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
	  
    </style>
	
  </head>
<body>
  <div class="main">
  
  <div class="row">
  <br>
    <?php
          $food_array = get_foods($catid);
          display_foods($food_array);
    ?>
  </div>
  </div>
</body>
</html>
<?php
  if(isset($_SESSION['admin_user'])) {
    display_button("index.php", "continue", "Continue Shopping");
    display_button("admin.php", "admin-menu", "Admin Menu");
    display_button("edit_category_form.php?catid=".$catid,
                   "edit-category", "Edit Category");
  } else {
    display_button("index.php", "Continue Shopping");
  }

  do_html_footer();
?>