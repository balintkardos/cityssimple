<?php
  if( isset( $_POST['x'] ) )
  {
    $name = $_POST['x'];
    require_once('config.php');
    $result2 = $conn->query("SELECT id FROM regions WHERE name LIKE '%$name%'");
    $regionsids = $result2->fetch_all(MYSQLI_ASSOC);
    $id='';
    foreach($regionsids as $regionid) { 
        $id=$regionid['id'];
    }
    
        echo "<h2>Új város:</h2>";
        echo '<input type="text" placeholder="Város neve" id="textbox_id" name="name" >';
        echo '<button class="ins_btn" id="insert" data-id3="'.$regionid['id'].'" style="vertical-align:middle"><span>Felvesz </span></button>';
  }
?>