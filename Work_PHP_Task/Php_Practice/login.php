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
$msgErr="";
$emailErr="";
$email=$pass="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $offset=1;
    $msgErr="";
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }

    if (empty($_POST["password"])) {
        $passErr = "Password is required";
      } else {
        $pass = test_input($_POST["password"]);
      }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



if(empty($emailErr)&& empty($passErr) && $offset==1){
// echo "<script>alert('Details Enter Succesfully')</script>";

$servername = "localhost";
$username = "root";
$password = "webkul";
$dbname="PhpTaskDb";

// $conn = new mysqli($servername, $username, $password);
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// $sql = "CREATE DATABASE PhpTaskDb";
// if ($conn->query($sql) === TRUE) {
//     echo "<script>alert('Database created successfully')</script>";
// } else {
//     //   echo "Database already existed <br>";
// }
// $conn->close();



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
        echo "<script>alert('hr')</script>";

$sql = "SELECT * FROM registration WHERE email='$email' AND loginpassword='$pass' ";

$result=mysqli_query($conn,$sql);


if ($result) {
    if(mysqli_num_rows($result)>=1){
        // echo "<script>alert('Login Successfully...')</script>";
        $conn->close();
        ?>
        <meta http-equiv="refresh" content="0; url=http://localhost/html/Work_PHP_Task/PUBLISH_UNPUBLISH_CARD/pubUnpubCard.php" /> 
        <?php
    }
    else if(mysqli_num_rows($result)==0){
            // echo "<script>document.getElementById('msgPara').innerHTML('Login Credential not found please register first..');</script>";
            $msgErr="Login Details Not Found Please Register First..";
               $conn->close();
               ?>
               <!-- <meta http-equiv="refresh" content="0; url=http://localhost/html/Work_PHP_Task/Php_Practice/login.php" />  -->
               <?php
        } else {
             echo "<script>alert('Error: . $sql . '<br>' . $conn->error')</script>";
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
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/jobpost.php" class="link1">POST JOBS</a>
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/register.php" class="link1">REGISTER</a>
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

        <div class="div2 p-2">

            <div class="child3">
                <h3 class="head1">Admin Login</h3>
            </div>

            <p><span class="error req-fd">* required field</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF"]);?>" onsubmit="return cnfLogin()">
            
            <div class="form-content">
            <span class="para1" >E-mail:</span> 
                <span class="error req-fd">*
                    <?php echo $emailErr;?>
                </span>
                <br><input type="text" name="email" value="<?php echo $email;?>" class="inp" >              
                <br>
            </div>

            <div class="form-content">
            <span class="para1" >Password:</span> 
                <span class="error req-fd">*
                <?php echo $passErr;?>
                </span>
                <br><input type="password" name="password" value="" class="inp" >              
                <br>
            </div>

            <div class="form-content">
                <input type="submit" name="submit" value="LOGIN NOW" class="preview bg-warning">
            </div>
            </form>
        </div>
    </div>

    <script>
        function cnfLogin(){
        return confirm("Did you really want to LOGIN ? ");
        }
    </script>
</body>
</html>