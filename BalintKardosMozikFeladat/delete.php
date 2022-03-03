<?php
 require_once('config.php');
 $sql = "DELETE FROM citys WHERE id = '".$_POST["id"]."'"; 
 if(mysqli_query($conn, $sql)) 
 { 
 echo 'Data Deleted Successufully!'; 
 } 
 ?> 