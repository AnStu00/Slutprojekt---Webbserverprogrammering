<?php
require '../anslutning/user.php';

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //Om man inte har skrivit in än
    echo '<form method="post" action="">
        Namn på kategori: <input type="text" name="kat_namn" />
        Kategori beskrivning: <textarea name="kat_beskrivning" /></textarea>
        <input type="submit" value="Skapa Kategori" />
     </form>';
   }
else {
//Om man har klickat på skapat kategori!
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
header("location:../forum.php");
?>
