<?php

$sr=$_GET['id'];
$name=$_GET['name'];
$email=$_GET['email'];
$jobtitle=$_GET['comment'];
$location=$_GET['website'];


// $servername = "localhost";
// $username = "root";
// $password = "webkul";
// $dbname="PhpTaskDb";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// $sql = "INSERT INTO postedjob(username, email, postlocation, jobtitle) VALUES('$name', '$email', '$location', '$jobtitle')";
// if ($conn->query($sql) === TRUE) {
//   echo "<script>alert('Job Published Successfully')</script>";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }
// $conn->close();


$servername = "localhost";
$username = "root";
$password = "webkul";
$dbname="PhpTaskDb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM postedjob WHERE sr='$sr' ";
if ($conn->query($sql) === TRUE) {
  // echo "<script>alert('Old record deleted from temporarypost successfully')</script>";
  ?>
      <meta http-equiv="refresh" content="0; url=http://localhost/html/Work_PHP_Task/PUBLISH_UNPUBLISH_CARD/pubUnpubCard.php" /> 
  <?php

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>