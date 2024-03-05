<?php
$fileToUpload = $_REQUEST["img"];

    $file_name=$_FILES['fileToUpload']['name'];
    $file_size=$_FILES['fileToUpload']['size'];
    $file_tmp=$_FILES['fileToUpload']['tmp_name'];
    $file_type=$_FILES['fileToUpload']['type'];


    if($file_size>1000){
        $fileHint="Img size is more than 50kb";
    }
  echo $fileHint;

  ?>