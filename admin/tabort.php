<?php
require('../anslutning/user.php');
if(isset($_POST['tabort'])){
  $id = $_POST['tabort'];

  $query = "DELETE FROM users WHERE id = $id";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Det uppstod lite problem när bortagandet skulle ske:" . $ex->getMessage());
  }

}
?>
Användaren är nu bortagen, Du skickas hem om 3 sekunder.
<script type="text/javascript">
setTimeout("window.location = '../index.php'", 3000);
</script>
