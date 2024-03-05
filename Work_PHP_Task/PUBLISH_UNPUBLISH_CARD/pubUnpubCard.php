<?php
   require_once 'pubUnpubConnection.php';

   $query = "SELECT * FROM temporarypost";
   $result = $conn->query($query); 

   $query1 = "SELECT * FROM postedjob";
   $result1 = $conn->query($query1);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posted jobs</title>
    <link rel="stylesheet" href="pubUnpubCard.css">
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
                            <a href="http://localhost/html/Work_PHP_Task/Php_Practice/login.php" class="link1">LOG OUT</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="container">
            <div class="mini-container p-0 pb-5">
                <div class="row src-row m-0 p-0">
                    <div class="col-lg-12 p-0 m-0">
                        <nav class="navbar navbar-light bg-nav p-5">
                            <form class="search-form">
                                <div class="form1">
                                    <input class="form-control mr-sm-2 w-75" type="search" placeholder="Search"
                                        aria-label="Search">
                                    <button class="btn btn1 bg-warning btn-outline-success my-2 my-sm-0 text-white p-2"
                                        type="submit">SEARCH FOR A JOB</button>
                                </div>
                            </form>
                        </nav>
                    </div>
                </div>

                <div class="div3">
                    <div class="btm-para">POSTS UNDER REVIEW</div>
                </div>

                <div class="row m-0 mt-4 div2">
                    <div class="row-lg-12 p-3">

                    <?php
                          while($row = mysqli_fetch_assoc($result)) { 
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
                        
                        <div class="row src-row m-0 p-0">
                        <div class="col-lg-12 p-0 m-0 d-flex">
                        <div class="col-lg-2">
                        <a href="unpubEdit.php?id=<?php echo $row["sr"];?> & name=<?php echo $row["username"];?> & email=<?php echo $row["email"];?> & comment=<?php echo $row["jobtitle"];?> & website=<?php echo $row["postlocation"];?>" class="edit-btn bg-warning" >EDIT POST </a>
                        </div>

                        <div class="col-lg-2">
                        <a href="unpubPublish.php?id=<?php echo $row["sr"];?> & name=<?php echo $row["username"];?> & email=<?php echo $row["email"];?> & comment=<?php echo $row["jobtitle"];?> & website=<?php echo $row["postlocation"];?>" class="pbls-btn bg-warning" onclick="return publishPost()">PUBLISH POST </a>
                        </div>

                        <div class="col-lg-8"></div>

                        </div>
                        </div>
                    <?php
                          }
                    ?>

                    </div>
                </div>




                <div class="div3">
                    <div class="btm-para btm-para2">PUBLISHED POSTS</div>
                </div>

                <div class="row m-0 mt-4 div2 div4">
                    <div class="row-lg-12 p-3">

                    <?php
                          while($row1 = mysqli_fetch_assoc($result1)) { 
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
                                         <?php echo $row1["username"];?>
                                        </span>
                                        </p>
                                        <span class="card-para">Job Title -
                                        <span class="dt">
                                         <?php echo $row1["jobtitle"];?>
                                        </span>
                                        </span>
                                        <span class="card-para card-para2">Location -
                                        <span class="dt">
                                         <?php echo $row1["postlocation"];?>
                                        </span>
                                        </span>
                                        <br>
                                        <p class="card-para m-0">Contact Email -
                                        <span class="dt">
                                         <?php echo $row1["email"];?>
                                        </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row src-row m-0 p-0">
                        <div class="col-lg-12 p-0 m-0 d-flex">
                        <div class="col-lg-2 ">
                        <a href="pubEdit.php?id=<?php echo $row1["sr"];?> & name=<?php echo $row1["username"];?> & email=<?php echo $row1["email"];?> & comment=<?php echo $row1["jobtitle"];?> & website=<?php echo $row1["postlocation"];?>" class="edit-btn bg-warning">EDIT POST </a>
                        </div>

                        <div class="col-lg-2">
                        <a href="pubUnpublish.php?id=<?php echo $row1["sr"];?> & name=<?php echo $row["username"];?> & email=<?php echo $row["email"];?> & comment=<?php echo $row["jobtitle"];?> & website=<?php echo $row["postlocation"];?>" class="pbls-btn unpbls-btn bg-warning" onclick="return cnfUnpublish()">UNPUBLISH POST </a>
                        </div>

                        <div class="col-lg-8"></div>

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

    <script>
    function cnfUnpublish(){
        return confirm("Did You really want to Unpublish it?");
    }
    
    function publishPost(){
        return confirm("Did you want to Publish it?");
    }
</script>   
</body>

</html>
<?php
     $conn->close();
?>