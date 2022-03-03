<?php
  if( isset( $_POST['name'] ) )
  {
    $name = $_POST['name'];
    require_once('config.php');
    $result2 = $conn->query("SELECT id FROM regions WHERE name LIKE '%$name%'");
    $regionsids = $result2->fetch_all(MYSQLI_ASSOC);
    $id='';
    foreach($regionsids as $regionid) { 
        $id=$regionid['id'];
    }
    $result = $conn->query("SELECT * FROM citys WHERE '$id' = megyeid ");
    $citynames = $result->fetch_all(MYSQLI_ASSOC);
    foreach($citynames as $cityname) {
        echo "<div class='city'>";
        echo '<p class="editcity" data-id1="'.$cityname['id'].'"contenteditable>'.$cityname['name'].'</p>';
        echo '<button class="del_btn" type="button" name="delete_btn" data-id3="'.$cityname['id'].'" data-id4="'.$cityname['megyeid'].'" id="delete">Törlés</button>';
        echo '<button class="edit_btn" type="button" name="edit_btn" data-id4="'.$cityname['megyeid'].'" id="edit">Szekr</button>';
        echo '<button class="cancel_btn" type="button" name="cancel_btn"  data-id4="'.$cityname['megyeid'].'" id="cancel">Mégse</button>';
        echo "</div>";
    }
  }
?>