<?php
   require_once 'tempConnection.php';

   $query = "SELECT * FROM temporarypost";
   $result = $conn->query($query); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted jobs</title>
    <link rel="stylesheet" href="tempcard.css">
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
                                <img src="nav_logo.png" width="200" height="80" class="d-inline-block img align-top"
                                    alt="">
                            </a>
                        </div>

                        <div class="child2">
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/jobpost.php" class="link1">Back</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="mini-container p-0">

                <div class="row m-0 mt-4 div2">
                    <div class="row-lg-12 p-3">

                    <?php
                          while($row = mysqli_fetch_assoc($result)) { 
                    ?>

                    <div class="row src-row m-0 p-0">
                    <div class="col-lg-12 p-0 m-0 d-flex">
                        <div class="col-lg-8"></div>

                        <div class="col-lg-2 p-2">
                        <a href="edit.php?id=<?php echo $row["sr"];?> & name=<?php echo $row["username"];?> & email=<?php echo $row["email"];?> & comment=<?php echo $row["jobtitle"];?> & website=<?php echo $row["postlocation"];?>" class="edit-btn bg-warning">EDIT POST </a>
                        </div>

                        <div class="col-lg-2 p-2">
                        <a href="publish.php?id=<?php echo $row["sr"];?> & name=<?php echo $row["username"];?> & email=<?php echo $row["email"];?> & comment=<?php echo $row["jobtitle"];?> & website=<?php echo $row["postlocation"];?>" class="pbls-btn bg-warning" onclick="return publishPost()">PUBLISH POST </a>
                        </div>

                    </div>
                    </div>
                        
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

                <div class="div3">
                    <div class="btm-para">You can edit your post only here before publishing it.</div>
                </div>
            </div>
        </div>

    </div>


<script>
    function publishPost(){
        return confirm("Do you want to Publish it?");
    }
</script>    

</body>

</html>
<?php
     $conn->close();
?>