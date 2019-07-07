<?php
  include ('food_court_fns.php');
  
  session_start();
  do_html_header("");
 ?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 30%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-right: 22px;
  float: right
  
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
img {
    display: block;
    margin-left: auto;
    margin-right:auto;
}


</style>
</head>
<body>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for foods.." title="Type in a name">
<br>
<br>
 <link href="styles.css" type="text/css" rel="stylesheet">
     <p style="text-align: center; font-size: 40px;">
	
    <img src="imgs/foodcourt3.jpg" height="60%" width="58%">
	<b>Skip the Line, Order Online</b></p>
	<p style="text-align: center; padding-left: 300px; padding-right:200px; font-size: 20px;" >
	Order online to receive 10% off your next meal and take the spot to your spot.
	Kid's Meals. Bacon Cheddar Burger. Our Famous Burgers. BC's Own Restaurant. 
	Spot Classics. Pastas & Bowls.</p>
    <br><br>
	
	<img  src="imgs/foodcourt.jpg" height="50%" width="58%">
	<p style="text-align: center; font-size: 40px;"><b>Best Food Court in Surrey, BC</b></p>
	<p style="text-align: center; padding-left: 300px; padding-right:200px; font-size: 20px;" >Chowing down at a food court in Surrey is somewhat 
	different compared to the typical North American mall food court; you'll find 
	incredibly unique mom 'n pop stalls serving tasty curries, warming noodle soups,
	creating mouth-watering dumplings, barbecuing meats – you Name it, you'll probably
	find it in Richmond. Each and every food court in Richmond has a hidden treasure
	waiting for you to discover it.
	</p>
	<script>
function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
</body>
</html>

<?php

  if(isset($_SESSION['admin_user'])) {
    display_button("admin.php", "admin-menu", "Admin Menu");
  }
  
  if(isset($_SESSION['user_user'])) {
    display_button("user.php", "user-menu", "User Menu");
  }
  
  do_html_footer();
?>

