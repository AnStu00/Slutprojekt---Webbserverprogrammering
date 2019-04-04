<?php
require 'anslutning/user.php';
if($_POST['submit']){
  $id = $_POST['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $telefon = $_POST['telefon'];
  $email = $_POST['email'];
  $status = $_POST['status'];


  $query = "UPDATE users SET first_name = $first_name, last_name = $last_name, telefon=$telefon, email = $email, status = $status WHERE id = $id";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Det uppstod lite problem när uppdateringen skulle ske:" . $ex->getMessage());
  }

}
?>
Användaren är nu uppdaterad.
