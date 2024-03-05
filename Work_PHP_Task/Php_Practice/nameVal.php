<?php
$name = $_REQUEST["name"];


if (empty($name)) {
    $namehint = "Name is required";
  }
  else {
    $name = test_input($name);
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $namehint = "Only letters and white space allowed";
    }
  }



  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  echo $namehint;


?>