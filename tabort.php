<?php
require 'anslutning/user.php';

if(isset($_POST['tabort'])){
  $person = $_POST['person'];
  var_dump($person);
  $query = "DELETE * FROM users WHERE email = $email";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    echo "hej";
      echo $person;
  }

}
?>
