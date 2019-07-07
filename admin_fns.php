<?php

function display_category_form($category = '') {

  $edit = is_array($category);
?>
  <form method="post" action="<?php echo $edit ? 'edit_category.php' : 'insert_category.php'; ?>">
  <table border="0" align="center">
  <tr>
    <td>Category Name:</td>
    <td><input type="text" name="catname" size="40" maxlength="40"
          value="<?php echo $edit ? $category['catname'] : ''; ?>" /></td>
   </tr>
  <tr>
    <td <?php if (!$edit) { echo "colspan=2";} ?> align="center">
      <?php
         if ($edit) {
            echo "<input type=\"hidden\" name=\"catid\" value=\"".$category['catid']."\" />";
         }
      ?>
      <input type="submit"
       value="<?php echo $edit ? 'Update' : 'Add'; ?> Category" /></form>
     </td>
     <?php
        if ($edit) {
          echo "<td>
                <form method=\"post\" action=\"delete_category.php\">
                <input type=\"hidden\" name=\"catid\" value=\"".$category['catid']."\" />
                <input type=\"submit\" value=\"Delete category\" />
                </form></td>";
       }
     ?>
  </tr>
  </table>
<?php
}

function display_food_form($food = '') {
  $edit = is_array($food);
?>
  <form method="post" action="<?php echo $edit ? 'edit_food.php' : 'insert_food.php';?>">
  <table border="0"align="center">
  <tr>
    <td>Food ID:</td>
    <td><input type="text" name="foodID"
         value="<?php echo $edit ? $food['foodID'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Food Name:</td>
    <td><input type="text" name="name"
         value="<?php echo $edit ? $food['name'] : ''; ?>" /></td>
  </tr>
  <tr>
    <td>Food Author:</td>
    <td><input type="text" name="author"
         value="<?php echo $edit ? $food['author'] : ''; ?>" /></td>
   </tr>
   <tr>
      <td>Category:</td>
      <td><select name="catid">
      <?php
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat) {
               echo "<option value=\"".$thiscat['catid']."\"";
               if (($edit) && ($thiscat['catid'] == $food['catid'])) {
                   echo " selected";
               }
               echo ">".$thiscat['catname']."</option>";
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo $edit ? $food['price'] : ''; ?>" /></td>
   </tr>
   <tr>
     <td>Description:</td>
     <td><textarea rows="3" cols="50"
          name="description"><?php echo $edit ? $food['description'] : ''; ?></textarea></td>
    </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             echo "<input type=\"hidden\" name=\"oldfoodID\"
                    value=\"".$food['foodID']."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Food" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_food.php\">
                   <input type=\"hidden\" name=\"foodID\"
                    value=\"".$food['foodID']."\" />
                   <input type=\"submit\" value=\"Delete food\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}

function display_password_form() {
?>
   <br />
   <form action="change_password.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc" align="center">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Change password">
   </td></tr>
   </table>
   <br />
<?php
}

function insert_category($catname) {
   $conn = db_connect();

   $query = "select *
             from categories
             where catname='".$catname."'";
   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   $query = "insert into categories values
            ('', '".$catname."')";
   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_food($foodID, $name, $author, $catid, $price, $description) {

   $conn = db_connect();

   $query = "select *
             from foods
             where foodID='".$foodID."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   $query = "insert into foods values
            ('".$foodID."', '".$author."', '".$name."',
             '".$catid."', '".$price."', '".$description."')";

   $result = $conn->query($query);
   if (!$result) {
    echo "<p>$foodID, $author, $name, $catid, $price, $description HERE!!!!!!!!!!!!!!!!!!!!!!!!!!!!</p>";
     return false;
   } else {
     return true;
   }
}

function update_category($catid, $catname) {

   $conn = db_connect();

   $query = "update categories
             set catname='".$catname."'
             where catid='".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_food($oldfoodID, $foodID, $name, $author, $catid,
                     $price, $description) {
   $conn = db_connect();

   $query = "update foods
             set foodID= '".$foodID."',
             name = '".$name."',
             author = '".$author."',
             catid = '".$catid."',
             price = '".$price."',
             description = '".$description."'
             where foodID = '".$oldfoodID."'";

   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function delete_category($catid) {

   $conn = db_connect();

   $query = "select *
             from foods
             where catid='".$catid."'";

   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
     return false;
   }

   $query = "delete from categories
             where catid='".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function delete_food($foodID) {

   $conn = db_connect();

   $query = "delete from foods
             where foodID='".$foodID."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

?>
