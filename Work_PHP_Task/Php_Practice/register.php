<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
</head>
<body class="bg-muted">

<?php
$offset=0;
$mssgErr="";
$emailErr=$nameErr=$passErr="";
$email=$name=$pass1=$pass2="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mssgErr="";
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
    if (empty($_POST["pass1"])) {
        $passErr = "Password is required";
      } else {
        $pass1 = test_input($_POST["pass1"]);
      }
    if (empty($_POST["pass2"])) {
        $passErr = "Password is required";
       } else {
        $pass2 = test_input($_POST["pass2"]);
        if($pass1==$pass2){
            $passSuc="Passwords are Correct";
            $passErr="";
          }
          else{
            $passErr="Password are not matched";
          }
          }

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if(empty($emailErr)&& empty($nameErr)&& empty($passErr)&& $offset==1){
// // echo "<script>alert('Details Enter Succesfully')</script>";

$servername = "localhost";
$username = "root";
$password = "webkul";
$dbname="PhpTaskDb";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE DATABASE PhpTaskDb";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Database created successfully')</script>";
} else {
    //   echo "Database already existed <br>";
}
$conn->close();



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "CREATE TABLE registration (
 username VARCHAR(30) NOT NULL, email VARCHAR(50) PRIMARY KEY, loginpassword VARCHAR(50))";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Table registration created successfully')</script>";
} else {
    // echo "Table already Existed <br>";
}
$conn->close();





$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $sql1 = "DELETE FROM registration WHERE email='$email' ";
$sql="SELECT * FROM registration WHERE email='$email' ";
$result=mysqli_query($conn,$sql);


if ($result) {
    if(mysqli_num_rows($result)>=1){
        $msgErr="Mail Already Exist Please Enter Different Mailid..";
        // echo "<script>alert('Email already exist..')</script>";
        $conn->close();
        ?>
        <!-- <meta http-equiv="refresh" content="0; url=http://localhost/html/Work_PHP_Task/Php_Practice/register.php" />  -->
        <?php
    }
    else if(mysqli_num_rows($result)==0){
        // echo "<script>alert('Email not found')</script>";
        $sql = "INSERT INTO registration( username,email, loginpassword) VALUES('$name','$email','$pass1')";
        if ($conn->query($sql) === TRUE) {
            //   echo "<script>alert('Registration Done Successfully')</script>";
            $msgErr="Registration Done Successfully...";
               $conn->close();
               ?>
               <meta http-equiv="refresh" content="5; url=http://localhost/html/Work_PHP_Task/Php_Practice/register.php" /> 
               <?php
        } else {
             echo "<script>alert('Error: . $sql . '<br>' . $conn->error')</script>";
        }
    }
}

$conn->close();

}
$offset=0;
?>

   
    <div class="container-fluid  p-0">
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
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/login.php" class="link1">LOGIN</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="text-center fw-bold">
        <span class="error req-fd msg-div fw-bold">
                    <?php echo $msgErr;?>
                </span>
        </div>

        <div class="div2 p-3">
            <div class="child3">
                <h3 class="head1"> Registration Form</h3>
            </div>
            <p><span class="error req-fd">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>" onsubmit="return cnfRegister()">
            <div class="form-content">
            <span class="para1" >User Name:</span> 
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
            <span class="para1" >Password:</span> 
                <span class="error req-fd">*
                <?php echo $passErr;?><?php echo $passSucc;?>
                </span>
                <br><input type="password" name="pass1" value="" class="inp" >              
                <br>
            </div>

            <div class="form-content">
            <span class="para1" >Confirm Password:</span> 
                <span class="error req-fd">*
                <?php echo $passErr;?><?php echo $passSucc;?>
                </span>
                <br><input type="password" name="pass2" value="" class="inp" >              
                <br>
            </div>

            <div class="form-content">
                <input type="submit" name="submit" value="REGISTER NOW" class="preview bg-warning">
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

        function cnfRegister(){
        return confirm("Did you really want to Register ? ");
        }
    </script>
</body>
</html>