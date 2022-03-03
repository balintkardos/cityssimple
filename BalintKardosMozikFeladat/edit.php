<?php
 require_once('config.php');
 $id = $_POST["id"]; 
 $name = $_POST["name"]; 
 $column_name = $_POST["column_name"]; 
 $sql = "UPDATE citys SET name = '$name' WHERE id='$id'"; 
 if(mysqli_query($conn, $sql)) 
 { 
 echo 'Data Updated'; 
 } 
 ?> 