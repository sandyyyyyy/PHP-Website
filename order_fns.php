<?php
function process_card($card_details) {

  return true;
}

function insert_order($order_details) {

  extract($order_details);

  if((!$ship_name) && (!$ship_address) && (!$ship_city) && (!$ship_state) && (!$ship_zip) && (!$ship_country)) {
    $ship_name = $name;
    $ship_address = $address;
    $ship_city = $city;
    $ship_state = $state;
    $ship_zip = $zip;
    $ship_country = $country;
  }

  $conn = db_connect();

  $conn->autocommit(FALSE);

  $query = "select customerid from customers where
            name = '".$name."' and address = '".$address."'
            and city = '".$city."' and state = '".$state."'
            and zip = '".$zip."' and country = '".$country."'";

  $result = $conn->query($query);

  if($result->num_rows>0) {
    $customer = $result->fetch_object();
    $customerid = $customer->customerid;
  } else {
    $query = "insert into customers values
            ('', '".$name."','".$address."','".$city."','".$state."','".$zip."','".$country."')";
    $result = $conn->query($query);

    if (!$result) {
       return false;
    }
  }

  $customerid = $conn->insert_id;

  $date = date("Y-m-d");

  $query = "insert into orders values
            ('', '".$customerid."', '".$_SESSION['total_price']."', '".$date."', '"."PARTIAL"."',
             '".$ship_name."', '".$ship_address."', '".$ship_city."', '".$ship_state."',
             '".$ship_zip."', '".$ship_country."')";

  $result = $conn->query($query);
  if (!$result) {
    return false;
  }

  $query = "select orderid from orders where
               customerid = '".$customerid."' and
               amount > (".$_SESSION['total_price']."-.001) and
               amount < (".$_SESSION['total_price']."+.001) and
               date = '".$date."' and
               order_status = 'PARTIAL' and
               ship_name = '".$ship_name."' and
               ship_address = '".$ship_address."' and
               ship_city = '".$ship_city."' and
               ship_state = '".$ship_state."' and
               ship_zip = '".$ship_zip."' and
               ship_country = '".$ship_country."'";

  $result = $conn->query($query);

  if($result->num_rows>0) {
    $order = $result->fetch_object();
    $orderid = $order->orderid;
  } else {
    return false;
  }

  foreach($_SESSION['cart'] as $foodID => $quantity) {
    $detail = get_food_details($foodID);
    $query = "delete from order_items where
              orderid = '".$orderid."' and foodID = '".$foodID."'";
    $result = $conn->query($query);
    $query = "insert into order_items values
              ('".$orderid."', '".$foodID."', ".$detail['price'].", $quantity)";
    $result = $conn->query($query);
    if(!$result) {
      return false;
    }
  }

  $conn->commit();
  $conn->autocommit(TRUE);

  return $orderid;
}

?>
