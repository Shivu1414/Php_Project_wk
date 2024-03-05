<?php
$q = $_REQUEST["q"];
$hint = "";
$i=0;
$arr=[];

$servername = "localhost"; 
$username = "root"; 
$password = "webkul"; 
$databasename = "PhpTaskDb"; 

$conn = new mysqli($servername, $username, $password, $databasename); 

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

$query = "SELECT * FROM postedjob WHERE jobtitle LIKE '%$q%'";
$result=mysqli_query($conn,$query);
if($result){
        $val=mysqli_num_rows($result);
       while($row = mysqli_fetch_assoc($result)) { 
        $arr[$i]=$row['jobtitle'];
        $i++;
       }  
       $i--; 
    }       
else{
   
}

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($arr as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}
echo $hint === "" ? "Not available": $hint;
?>