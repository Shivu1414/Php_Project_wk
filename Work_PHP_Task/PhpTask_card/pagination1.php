<?php
require_once 'connection.php';
$limit=5;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
else{
    $page=1;
}



$offset=($page-1)*$limit;

$query = "SELECT * FROM postedjob ORDER BY sr DESC LIMIT {$offset},{$limit}";
$result = $conn->query($query);  


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

        <div class="container">
            <div class="mini-container p-0">
                <div class="row src-row m-0 p-0">
                    <div class="col-lg-12 p-0 m-0">
                        <nav class="navbar navbar-light bg-nav p-5">
                         <p class="msg-hint1 text-info"><span id="txtHint" ></span></p>
                            <form class="search-form" method="post" action="live-search.php" >
                                <div class="form1"  >
                                    <input class="form-control mr-sm-2 w-75" type="text" id="search" name="srch" autocomplete="off" placeholder="Search"
                                        aria-label="Search" onkeyup="suggestion(this.value)">
                                    <button class="btn btn1 bg-warning btn-outline-success my-2 my-sm-0 text-white p-2" type="submit" name="submit" >SEARCH FOR A JOB</button>
                                </div>
                            </form>
                        </nav>
                    </div>
                </div>


                <p id="tbl-data"></p>

                <div class="row m-0 mt-4 div2">
                    <div class="row-lg-12 p-3 ">

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
                    <?php
                          }
                          $sql1="SELECT * FROM postedjob ";
                          $result1= mysqli_query($conn,$sql1) or die("Query failed.");

                          if(mysqli_num_rows($result1)>0){
                            $total_card=mysqli_num_rows($result1);
                            $total_page=ceil($total_card/$limit);

                            echo '<ul class="pgn-ul">';
                            if($page>1){
                                echo '<li class="pgn-ul pgn-li"><a href="pagination1.php?page='.($page -1).'" class="text-decoration-none text-light">Prev</a></li>';
                            }
                            for($i=1;$i<=$total_page;$i++){
                                if($i==$page){
                                    $active="active";
                                }
                                else{
                                    $active="";
                                }
                                echo '<li class="pgn-ul pgn-li '.$active.'"><a href="pagination1.php?page='.$i.'" class="text-decoration-none text-light">'.$i.'</a></li>';
                            }
                            if($total_page >$page){
                                echo '<li class="pgn-ul pgn-li"><a href="pagination1.php?page='.($page +1).'" class="text-decoration-none text-light">Next</a></li>';
                            }
                            echo '</ul>';
                          }
                    ?>   
                    </div>

                </div>
            </div>
        </div>

    </div>



    <script>
        function suggestion(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function () {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
                xmlhttp.open("GET", "cardSearch.php?q=" + str);
                xmlhttp.send();
            }
        }

        // $("#search").on("keyup",function(){
        //     var srch_term=$(this).val();

        //     $.ajax({
        //         url : "live-search.php",type: "post", data: {search:srch_term},success:function(data){
        //             document.getElementById("tbl-data").innerHTML(data);
        //         } 
        //     });
        // });
    </script>
</body>

</html>
<?php
   $conn->close();
?>