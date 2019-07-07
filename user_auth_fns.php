<?php

require_once('db_fns.php');

function login($username, $password) {
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  $result = $conn->query("select * from admin
                         where username='".$username."'
                         and password = sha1('".$password."')");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}

function userlogin($username, $password) {

  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  $result = $conn->query("select * from user
                         where username='".$username."'
                         and password = sha1('".$password."')");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}

function check_admin_user() {

  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}

function check_user() {

  if (isset($_SESSION['user_user'])) {
    return true;
  } else {
    return false;
  }
}

function change_password($username, $old_password, $new_password) {

  if (login($username, $old_password)) {

    if (!($conn = db_connect())) {
      return false;
    }

    $result = $conn->query("update admin
                            set password = sha1('".$new_password."')
                            where username = '".$username."'");
    if (!$result) {
      return false;
    } else {
      return true; 
    }
  } else {
    return false; 
  }
}

function change_userpassword($username, $old_password, $new_password) {

  if (userlogin($username, $old_password)) {

    if (!($conn = db_connect())) {
      return false;
    }

    $result = $conn->query("update user set password = sha1('".$new_password."') where username = '".$username."'");
    if (!$result) {
      return false;
    } else {
      return true;
    }
  } else {
    return false; 
  }
}


?>
