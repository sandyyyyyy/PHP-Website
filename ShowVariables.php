<?php
function showArray (array $array) {
	foreach($array as $x => $x_value) {
		if (gettype($x_value) == "array"){
			if($x == "GLOBALS"){ }
			elseif ($x == "_SERVER") { }
			elseif ($x == "_REQUEST") { }
			elseif ($x == "_POST") { }
			elseif ($x == "_GET") { }
			elseif ($x == "_ENV") { }
			elseif ($x == "_FILES") { }
			elseif ($x == "_COOKIE") { }
			elseif ($x == "_SESSION") { }
			else {
				echo "Key=" . $x . ", Value=array";
				echo "<br>";
				showArray($x_value);
			}
		}
		else {
			if($x == "GLOBALS"){ }
			elseif ($x == "_SERVER") { }
			elseif ($x == "_REQUEST") { }
			elseif ($x == "_POST") { }
			elseif ($x == "_GET") { }
			elseif ($x == "_ENV") { }
			elseif ($x == "_FILES") { }
			elseif ($x == "_COOKIE") { }
			elseif ($x == "_SESSION") { }
			else {
			echo "Key=" . $x . ", Value=" . $x_value . ", Type=" . GetType($x_value);
			echo "<br>";
			}
		}
	}
}
echo "<h1>User variables</h1>";
showArray($GLOBALS);
echo "<h1>Global Variables</h1>";
echo "<h2>$"."_SERVER</h2>";
showArray($_SERVER);
echo "<h2>$"."_REQUEST</h2>";
showArray($_REQUEST);
echo "<h2>$"."_POST</h2>";
showArray($_POST);
echo "<h2>$"."_GET</h2>";
showArray($_GET);
echo "<h2>$"."_FILES</h2>";
showArray($_FILES);
echo "<h2>$"."_ENV</h2>";
showArray($_ENV);
echo "<h2>$"."_COOKIE</h2>";
showArray($_COOKIE);
echo "<h2>$"."_SESSION</h2>";
if(isset($_SESSION)) {showArray($_SESSION); }
?>


