<?php

function do_html_header($title = '') {
  if(isset($_SESSION['items'])) {} 
    else {$_SESSION['items'] = '0';}  
  if(isset($_SESSION['total_price'])) {} 
    else {$_SESSION['total_price'] = '0.00';}  
  if (!$_SESSION['items']) {$_SESSION['items'] = '0';}
  if (!$_SESSION['total_price']) {$_SESSION['total_price'] = '0.00';}
?>

<!-- the head section -->
<head>
    <title>Online Food Court</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<!-- the body section -->
<body>
  <header>
    <div class="htext"><a href="index.php"><img src="imgs/logo.png" alt="Logo" height="20%"/></a><div>

    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <!-- Logout/Register -->
            <?php
            if(isset($_SESSION['admin_user'])){
              display_menu_items('food.php','Food Menu');
              display_menu_items('admin.php','Administration');
              display_menu_items('logout.php', 'LogOut');
            }

            else if(isset($_SESSION['user_user'])) {
              display_menu_items('food.php','Food Menu');
              display_menu_items('show_cart.php','View Cart');
              display_menu_items('user.php','Setting');
              display_menu_items('userlogout.php', 'LogOut');
              display_menu_items('contact.php', 'Contact Us');
            }


            else{
              display_menu_items('food.php','Food Menu');
			  display_menu_items('show_cart.php','View Cart');
              display_menu_items('userregister.php','Register');
              display_menu_items('userlogin.php', 'Log In');
              display_menu_items('contact.php', 'Contact Us');
            }?>
        </ul>
    </div>
	
  
  </header>

  

<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
?>
<br>
<br>
<hr>
  </body>
  </html>
  <p style="text-align: center;">
  <img class="image" src="imgs/payment.png" alt="payment" height="8%" >
  </p>
  <hr>
  <br>
  <p2><center>&copy; Online Food Court Ltd.</center></p2></br>
  <p3><center>Contact Us.<a href="mailto:online_food_court@gmail.com">online_food_court@gmail.com</a>.</center></p3>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h1><?php echo $heading; ?></h1>
<?php
}

function do_html_URL($url, $name) {
?>
  <p style="text-align: center; font-family: Arial; font-size: 20px; font-weight: bold; text-decoration: none;"><a href="<?php echo $url; ?>"><?php echo $name; ?></a></p>
<?php
}
function do_html_URL_Image($url, $name) {
?>
  <p><a href="<?php echo $url; ?>">

    <img src="imgs/<?php echo $name; ?>.png" alt="<?php echo $name; ?>" style="width:100%"><?php echo $name; ?></a></p>
<?php
}

function display_categories($cat_array) {
  if (!is_array($cat_array)) {
     echo "<p>No categories currently available</p>";
     return;
  }
  foreach ($cat_array as $row)  {
    echo "<div class='column show'>";
    echo "<div class='content'>";

    $url = "show_cat.php?catid=".$row['catid'];
    $name = $row['catname'];
    do_html_URL_Image($url, $name);

    echo "</div>";
    echo "</div>";
  }
}

function display_foods($food_array) {

  if (!is_array($food_array)) {
    echo "<p>No foods currently available in this category</p>";
  }
  else {
    foreach ($food_array as $row) {
      $url = "show_food.php?foodID=".$row['foodID'];
      echo "<div class='column show'>";
      echo "<div class='content'>";
      echo "<p>";
      if (@file_exists("imgs/".$row['foodID'].".png")) {
        $name = "<img src=\"imgs/".$row['foodID'].".png\"
                  style=\"width:100%\"/>";
        do_html_url($url, $name);
      } else {
        echo "&nbsp;";
      }
      $name = $row['name'];
      do_html_url($url, $name);
      echo "</p>";
      echo "</div>";
      echo "</div>";
    }
  }

  echo "<hr />";
}

function display_food_details($food) {

  if (is_array($food)) {
    echo "<table><tr>";

    if (@file_exists("images/".$food['foodID'].".jpg"))  {
      $size = GetImageSize("images/".$food['foodID'].".jpg");
      if(($size[0] > 0) && ($size[1] > 0)) {
        echo "<td1><img src=\"images/".$food['foodID'].".jpg\"
              style=\"border: 1px solid black\"/></td1>";
      }
    }
    echo "<td1><ul>";
    echo "<li><strong>Store:</strong> ";
    echo $food['author'];
    echo "</li><li><strong>Price:</strong> ";
    echo number_format($food['price'], 2);
    echo "</li><li><strong>Description:</strong> ";
    echo $food['description'];
    echo "</li></ul></td1></tr></table>";
  } else {
    echo "<p>The details of this food cannot be displayed at this time.</p>";
  }
  echo "<hr />";
}

function display_checkout_form() {

?>
  <br />
  <table border="0" width="100%" cellspacing="0" align="center">
  <form action="purchase.php" method="post">
  <tr><th colspan="2" bgcolor="#cce6ff">Your Details</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr><th colspan="2" bgcolor="#cce6ff">Shipping Address (leave blank if as above)</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="ship_address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="ship_city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="ship_state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="ship_zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="ship_country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p><strong>Please press Purchase to confirm
         your purchase, or Continue Shopping to add or remove items.</strong></p>
     
	 <?php display_form_button("purchase", "Purchase These Items"); ?>
    </td>
	
	
	
	
	
	
  </tr>
  </form>
  </table><hr />
<?php
}

function display_shipping($shipping) {

?>
  <table border="0" width="100%" cellspacing="0" align="center">
  <br>
  <tr><td align="left">Shipping</td>
      <td align="right"> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor="#cce6ff" align="left">TOTAL INCLUDING SHIPPING</th>
      <th bgcolor="#cce6ff" align="right">$ <?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

function display_card_form($name) {

?>
  <table border="0" width="100%" cellspacing="0" align="center">
  <form action="process.php" method="post">
  <tr><th colspan="2" bgcolor="#cce6ff">Credit Card Details</th></tr>
  <tr>
    <td>Type</td>
    <td><select name="card_type">
        <option value="VISA">VISA</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        </select>
    </td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="card_number" value="" maxlength="16" size="40"></td>
  </tr>
  <tr>
    <td>AMEX code (if required)</td>
    <td><input type="text" name="amex_code" value="" maxlength="4" size="4"></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td>Month
       <select name="card_month">
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       </select>
       Year
       <select name="card_year">
       <?php
       for ($y = date("Y"); $y < date("Y") + 10; $y++) {
         echo "<option value=\"".$y."\">".$y."</option>";
       }
       ?>
       </select>
  </tr>
  <tr>
    <td>Name on Card</td>
    <td><input type="text" name="card_name" value = "<?php echo $name; ?>" maxlength="40" size="40"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <p><strong>Please press Purchase to confirm your purchase, or Continue Shopping to
      add or remove items</strong></p>
     <?php display_form_button('purchase', 'Purchase These Items'); ?>
    </td>
  </tr>
  </table>
<?php
}

function display_cart($cart, $change = true, $images = 1) {

   echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\" align=\"center\">
         <form action=\"show_cart.php\" method=\"post\">
         <tr><th colspan=\"".(1 + $images)."\" bgcolor=\"#cce6ff\">Item</th>
         <th bgcolor=\"#cce6ff\">Price</th>
         <th bgcolor=\"#cce6ff\">Quantity</th>
         <th bgcolor=\"#cce6ff\">Total</th>
         </tr>";

  foreach ($cart as $foodID => $qty)  {
    $food = get_food_details($foodID);
    echo "<tr>";
    if($images == true) {
      echo "<td align=\"left\">";
      if (file_exists("images/".$foodID.".jpg")) {
         $size = GetImageSize("images/".$foodID.".jpg");
         if(($size[0] > 0) && ($size[1] > 0)) {
           echo "<img src=\"images/".$foodID.".jpg\"
                  style=\"border: 1px solid black\"
                  width=\"".($size[0]/3)."\"
                  height=\"".($size[1]/3)."\"/>";
         }
      } else {
         echo "&nbsp;";
      }
      echo "</td>";
    }
    echo "<td align=\"left\">
          <a href=\"show_food.php?foodID=".$foodID."\">".$food['name']."</a>
          by ".$food['author']."</td>
          <td align=\"center\">\$".number_format($food['price'], 2)."</td>
          <td align=\"center\">";

    if ($change == true) {
      echo "<input type=\"text\" name=\"".$foodID."\" value=\"".$qty."\" size=\"3\">";
    } else {
      echo $qty;
    }
    echo "</td><td align=\"center\">\$".number_format($food['price']*$qty,2)."</td></tr>\n";
  }

  echo "<tr>
        <th colspan=\"".(2+$images)."\" bgcolor=\"#FFFFFF\">&nbsp;</td>
        <th align=\"center\" bgcolor=\"#FFFFFF\">".$_SESSION['items']."</th>
        <th align=\"center\" bgcolor=\"#FFFFFF\">
            \$".number_format($_SESSION['total_price'], 2)."
        </th>
        </tr>";

  if($change == true) {
    echo "<tr>
          <td colspan=\"".(2+$images)."\">&nbsp;</td>
          <td align=\"center\">
             <input type=\"hidden\" name=\"save\" value=\"true\"/>
             <input type=\"image\" src=\"imgs/save_change.gif\"
                    border=\"0\" alt=\"Save Changes\"/>
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  echo "</form></table>";
}

function display_login_form() {
?>
 
 <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles2.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
	
		 <form method="post" action="admin.php">
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title" align="center">Administration</h1>
	               		<hr />
	               	</div>
	            </div> 
                    <div class="main-login main-center">
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="username" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="passwd" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>


						<div class="form-group ">
							<input type="submit" value="Log in" align="center"/>
						</div>
						
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	</form>
	<br>
	<br><br><br>
<?php
}

function display_register_form(){
	?>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles2.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
	
		<form action="register.php" method="post">
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title" align="center">Register</h1>
	               		<hr />
	               	</div>
	            </div> 
				<div class="main-login main-center">
					<form class="form-horizontal" method="post" action="#">
						
							
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="username" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="confirm" id="confirm"  placeholder="Confirm your Password"/>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<input type="submit" value="Register"/>
						</div>
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	</form>
	<br>
	<br><br><br>

	<?php

}

function display_userlogin_form() {
?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles2.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
	
		 <form method="post" action="user.php">
		<div class="container">
			<div class="row main">
				<div class="panel-heading">
	               <div class="panel-title text-center">
	               		<h1 class="title" align="center">Login</h1>
	               		<hr />
	               	</div>
	            </div> 
                    <div class="main-login main-center">
						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Username</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="username" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="passwd" id="password"  placeholder="Enter your Password"/>
								</div>
							</div>
						</div>


						<div class="form-group ">
							<input type="submit" value="Log in" align="center"/>
						</div>

            <div class="login-register">
                    <a href="login.php">Admin Login Here</a>
            </div>
						
					</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	</form>
	<br>
	<br><br><br>

<?php
}

function display_admin_menu() {
?>
<br />
<p><a href="index.php">Go to main site</a></p>
<p><a href="insert_category_form.php">Add a new category</a></p>
<p><a href="insert_food_form.php">Add a new food</a></p>
<p><a href="change_password_form.php">Change admin password</a></p>
<?php
}

function display_user_menu() {
?>
<br />
<p><a href="index.php">Go to main site</a></p>
<p><a href="show_cart.php">View your cart</a></p>
<p><a href="change_userpassword_form.php">Change user password</a></p>
<p><a href="userlogout.php">Logout</a></p>
<?php
}

function display_menu_items($target, $menu_item) {
  echo "<li><a href=\"".$target."\">$menu_item</a></li>";
}


function display_form_button($image, $alt) {
  echo "<div align=\"center\"><input type=\"image\"
          src=\"imgs/buy.png\"
          alt=\"".$alt."\" border=\"0\" height=\"50\"
          width=\"135\"/></div>";
}

function display_button($target, $menu_item) {
  echo "<div align=\"center\"><a href=\"".$target."\">
          $menu_item</a></div>";
}

?>


