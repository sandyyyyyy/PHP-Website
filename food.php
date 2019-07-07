<?php
  include ('food_court_fns.php');
  
  session_start();
  do_html_header("");
 
      
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

<!-- MAIN (Center website) -->
<div class="main">

<h1>Category</h1>
<hr>
<div class="row">

    <?php
      $category_array = get_categories();
      display_categories($category_array);
    ?>
</div>


</div>

</body>
</html>
 
<?php
  
  // if logged in as admin, show add, delete, edit cat links
  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Admin Menu");
  }
  
  if(isset($_SESSION['user_user'])) {
    display_button("user.php", "user-menu", "User Menu");
  }
  
  do_html_footer();
?>