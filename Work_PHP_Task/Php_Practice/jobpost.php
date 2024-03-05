<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="signup.css">
</head>

<body class="bg-muted">
  
<?php
$offset=0;
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $jobtitle = $location = "";
$imgErr="*Image size should be less than 50kb";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    $offset=1;
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $location = test_input($_POST["website"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $jobtitle = test_input($_POST["comment"]);
  }

  if(isset($_FILES['fileToUpload'])){
    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];

    if($file_size>50000){
      $imgErr="Img size is more than 50kb";
    }
    else{
      $imgErr="";
      move_uploaded_file($file_tmp,"upload-images/".$file_name);
    }  
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if(empty($nameErr) && empty($emailErr) && empty($genderErr) && empty($websiteErr) && empty($imgErr) && $offset==1){

$servername = "localhost";
$username = "root";
$password = "webkul";
$dbname="PhpTaskDb";


// Create Database PhpTaskDb..............
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE PhpTaskDb";
if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Database created successfully')</script>";
} else {
  // echo "<script>alert('Database already existed')</script>";
}
$conn->close();




// Create Table For the PostJob................
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE temporarypost (
sr INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(30) NOT NULL, email VARCHAR(50), postlocation VARCHAR(50), jobtitle varchar(80))";
if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Table temporarypost created successfully')</script>";
} else {
  // echo "<script>alert('Table already Existed')</script>";
}
$conn->close();




$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO temporarypost(username, email, postlocation, jobtitle) VALUES('$name', '$email', '$location', '$jobtitle')";
if ($conn->query($sql) === TRUE) {
  // echo "<script> confirm('Data Saved')</script>";
  ?>
    <meta http-equiv="refresh" content="0; url=http://localhost/html/Work_PHP_Task/PhpTask_card/tempcard.php " /> 
  <?php
} else {
  echo "<script>alert('Error: . $sql . '<br>' . $conn->error')</script>";
}
$conn->close();
$offset=0;
}

?>




    <div class="container-fluid bg-muted p-0">
        <div class="row m-0">
            <div class="col-lg-12 p-0">
                <nav class="navbar nav1 ">
                    <div class="div1">
                        <div class="child1">
                            <a class="navbar-brand" href="#">
                                <img src="nav_logo.png" width="300" height="100" class="d-inline-block img align-top"
                                    alt="">
                            </a>
                        </div>

                        <div class="child2">
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/login.php" class="link1">Login</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>






        <div class="div2 p-3">
            <div class="child3">
            <h3 class="head1">POST A JOB</h3>
            </div>
            <p><span class="error req-fd">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>" enctype="multipart/form-data" onsubmit="return cnfForm()">
                
            <div class="form-content">
            <span class="para1" >Name:</span> 
                <span class="error req-fd" id="nameHint">*
                    <?php echo $nameErr;?>
                </span>
                <br><input type="text" name="name" value="<?php echo $name;?>" class="inp" onkeyup="suggestionName(this.value)">               
                <br>
            </div>
            

            <div class="form-content">
            <span class="para1" >E-mail:</span> 
                <span class="error req-fd" id="emailHint">*
                    <?php echo $emailErr;?>
                </span>
                <br><input type="text" name="email" value="<?php echo $email;?>" class="inp" onkeyup="suggestionEmail(this.value)">              
                <br>
            </div>

            <div class="form-content">
            <span class="para1" >Location:</span> 
            <span class="error req-fd" id="locationHint">
                    <?php echo $websiteErr;?>
                </span>
                <br><input type="text" name="website" value="<?php echo $website;?>" class="inp" onkeyup="suggestionLocation(this.value)">
                <br>
            </div>

            <div class="form-content">
            <span class="para1" >Job Title:</span> 
            <span class="error req-fd" id="titleHint">
                    <?php echo $websiteErr;?>
                </span>
                <br><textarea name="comment" rows="5" cols="40" class="inp1" onkeyup="suggestionTitle(this.value)"><?php echo $comment;?></textarea>
                <br>
            </div>
            

            <div class="form-content">
            <span class="error req-fd" id="imgHint">
                    <?php echo $imgErr;?>
                </span>
                <br>
                 <input type="file" name="fileToUpload" id="fileToUpload" value="" class="upload-img bg-success" onkeyup="suggestionImg(this.value)">   
                 <br>        
            </div>
            

            <div class="form-content">
                <input type="submit" name="submit" value="PREVIEW POST" class="preview bg-warning">
            </div>
            </form>
        </div>
    </div>

<script>
        function suggestionName(str) {
            str=str.trim();
            if (str.length == 0) {
                document.getElementById("nameHint").innerHTML = " Field is required";
                return;
            } else {
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function () {
                    document.getElementById("nameHint").innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "nameVal.php?name=" + str);
                xmlhttp.send();
            }
        }

        function suggestionEmail(str) {
            str=str.trim();
            if (str.length == 0) {
                document.getElementById("emailHint").innerHTML = " Field is required";
                return;
            } else {
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function () {
                    document.getElementById("emailHint").innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "emailVal.php?email=" + str);
                xmlhttp.send();
            }
        }

        function suggestionLocation(str) {
            str=str.trim();
            if (str.length == 0) {
                document.getElementById("locationHint").innerHTML = " Field is required";
                return;
            } 
            else{
              document.getElementById("locationHint").innerHTML = "";
                return;
            }
        }
        function suggestionTitle(str) {
            str=str.trim();
            if (str.length == 0) {
                document.getElementById("titleHint").innerHTML = " Field is required";
                return;
            } 
            else{
              document.getElementById("titleHint").innerHTML = "";
              return;
            }
        }

        // function suggestionImg(str) {
        //     str=str.trim();
        //     if (str.length == 0) {
        //         document.getElementById("imgHint").innerHTML = " Field is required";
        //         return;
        //     } else {
        //         const xmlhttp = new XMLHttpRequest();
        //         xmlhttp.onload = function () {
        //             document.getElementById("imgHint").innerHTML = this.responseText;
        //         }
        //         xmlhttp.open("GET", "imgVal.php?img=" + str);
        //         xmlhttp.send();
        //     }
        // }


    function cnfForm(){
      return confirm("Do you really want to Post it?");
    }
</script>
</body>




</html>
