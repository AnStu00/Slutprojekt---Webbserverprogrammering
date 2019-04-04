<?php
require '../anslutning/user.php';

if(isset($_POST['submit'])){

  $kat_namn = $_POST['kat_namn'];
  $kat_beskrivning = $_POST['kat_beskrivning'];


  $query = "INSERT INTO kategorier(kat_namn, kat_beskrivning) VALUES ('$kat_namn', '$kat_beskrivning')";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Det uppstod lite problem när skapandet skulle ske:" . $ex->getMessage());
  }
}
echo "Allting lyckades";
?>
