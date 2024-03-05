<?php

$srch=$_POST["srch"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $srch = test_input($srch);
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// echo "<script>alert('$srch')</script>";


$servername = "localhost"; 
$username = "root"; 
$password = "webkul"; 
$databasename = "PhpTaskDb"; 

$conn = new mysqli($servername, $username, $password, $databasename); 

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

// $query = "SELECT * FROM postedjob WHERE jobtitle='sdt'";
$query ="SELECT * FROM postedjob WHERE jobtitle LIKE '%$srch%'";
$result=mysqli_query($conn,$query);


// $result = $conn->query($query);  
//  if($result){
// $val=mysqli_num_rows($result);
//  $val=print_r($result);
//  }
//  else{
//     $val="error";
//  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted jobs</title>
    <link rel="stylesheet" href="pagination1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</head>

<body class="bod">

    <div class="container-fluid bg-muted p-0">
        <div class="row m-0">
            <div class="col-lg-12 p-0">
                <nav class="navbar nav1 p-0">
                    <div class="div1">
                        <div class="child1">
                            <a class="navbar-brand" href="#">
                                <img src="nav_logo.png" width="200" height="60" class="d-inline-block img align-top"
                                    alt="">
                            </a>
                        </div>

                        <div class="child2">
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/jobpost.php" class="link1">POST A JOB</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>


                <div class="row m-0 mt-4 div2">
                    <div class="row-lg-12 p-3 ">

                    <?php
                    
                          while($row = mysqli_fetch_assoc($result)) { 
                        //   }
                        //   $row["username"]=$val;
                            // $row["username"]="asd";
                            // $row["jobtitle"]="asd";
                            // $row["postlocation"]="asd";
                            // $row["email"]="asd";
                    ?>

                        <div class="row m-3 card1 ">
                            <div class="col-lg-12 d-flex">
                                <div class="col-lg-3 p-2">
                                    <div class="img1 bg-muted"></div>
                                </div>
                                <div class="col-lg-9 pt-3">
                                    <div class="card-content">
                                        <h6 class="card-hd">Job Title for this Awesome post simply goes here</h6>
                                        <p class="card-para m-0">Posted By -
                                        <span class="dt">
                                         <?php echo $row["username"];?>
                                        </span>
                                        </p>
                                        <span class="card-para">Job Title -
                                        <span class="dt">
                                         <?php echo $row["jobtitle"];?>
                                        </span>
                                        </span>
                                        <span class="card-para card-para2">Location -
                                        <span class="dt">
                                         <?php echo $row["postlocation"];?>
                                        </span>
                                        </span>
                                        <br>
                                        <p class="card-para m-0">Contact Email -
                                        <span class="dt">
                                         <?php echo $row["email"];?>
                                        </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                          }
                    ?>   
                    </div>

                </div>
            </div>
        </div>

    </div>

</body>

</html>
<?php
   $conn->close();
?>