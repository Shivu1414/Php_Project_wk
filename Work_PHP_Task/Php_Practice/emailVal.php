<?php
$email = $_REQUEST["email"];

if (empty($email)) {
    $emailhint = "Email is required";
  }
  else {
    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailhint = "Invalid email format";
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  echo $emailhint;

?>