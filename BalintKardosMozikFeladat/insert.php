<?php
    require_once('config.php');
    $Name = $_POST['name'];
    $id = $_POST["id"];
  
    $sqlinsert = "INSERT INTO citys (name, megyeid) VALUES ('$Name' , '$id')";
    if($conn->query($sqlinsert) === TRUE){

    }
?>