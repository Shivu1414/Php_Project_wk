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
    <link rel="stylesheet" href="edit.css">
</head>

<body class="bg-muted">
<?php
    $sr=$_GET['id'];
    $name=$_GET['name'];
    $email=$_GET['email'];
    $jobtitle=$_GET['comment'];
    $location=$_GET['website'];



    $offset=0;
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
          
        if (empty($_POST["location"])) {
          $location = "";
        } else {
          $location = test_input($_POST["location"]);
        }
      
        if (empty($_POST["jobtitle"])) {
          $jobtitle = "";
        } else {
          $jobtitle = test_input($_POST["jobtitle"]);
        }
      
      }
      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }


      if(empty($nameErr) && empty($emailErr) && empty($genderErr) && empty($websiteErr) && $offset==1){      
      $servername = "localhost";
      $username = "root";
      $password = "webkul";
      $dbname="PhpTaskDb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql ="UPDATE temporarypost set username='$name', email='$email', postlocation='$location', jobtitle='$jobtitle' WHERE sr='$sr' ";
if ($conn->query($sql) === TRUE) {
  // echo "<script>alert('Record Edited successfully')</script>";
   
?>
    <meta http-equiv="refresh" content="0; url=http://localhost/html/Work_PHP_Task/PhpTask_card/tempcard.php " /> 
<?php

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

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
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/login.php" class="link1">BACK</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>






        <div class="div2 p-3">
            <div class="child3">
            <h3 class="head1">EDIT THE POST</h3>
            </div>
            <p><span class="error req-fd">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>" enctype="multipart/form-data" onsubmit="return editForm()">
                
            <div class="form-content">
            <span class="para1" >Name:</span> 
                <span class="error req-fd">*
                    <?php echo $nameErr;?>
                </span>
                <br><input type="text" name="name" value="<?php echo $name;?>" class="inp">               
                <br>
            </div>
            

            <div class="form-content">
            <span class="para1" >E-mail:</span> 
                <span class="error req-fd">*
                    <?php echo $emailErr;?>
                </span>
                <br><input type="text" name="email" value="<?php echo $email;?>" class="inp">              
                <br>
            </div>

            <div class="form-content">
            <span class="para1" >Location:</span> 
                <br><input type="text" name="location" value="<?php echo $location;?>" class="inp">
                <span class="error">
                    <?php echo $locationErr;?>
                </span>
                <br>
            </div>

            <div class="form-content">
            <span class="para1" >Job Title:</span> 
                <br><textarea name="jobtitle" rows="5" cols="40" class="inp1"><?php echo $jobtitle;?></textarea>
                <br>
            </div>

            <!-- <div class="form-content">
                 <input type="file" name="fileToUpload" id="fileToUpload" value="" class="upload-img bg-success">   
                 <br>        
            </div> -->
            

            <div class="form-content">
                <input type="submit" name="submit" value="PREVIEW POST" class="preview bg-warning">
            </div>
            </form>
        </div>
    </div>

    <script>
      function editForm(){
        return confirm("Do you really want to edit it?");
      }
      </script>
</body>




</html>
