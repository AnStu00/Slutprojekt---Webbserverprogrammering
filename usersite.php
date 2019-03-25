<?php
require("anslutning/user.php");

if(empty($_SESSION['user'])){
  header("Location: login.php");
  die("Skickar vidare till login.php");
}
//Denna if satsen kollar om formuläret har skickats
//Om den har det så skickar den vidare det och kör det. Annars kommer formet fortfarande vara uppe.
if (!empty($_POST)){
  //Kollar om det är en gintlig email address personen skrivit in
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die("Felaktigt formulerad email adress");
  }
//Om användaren ändrar sin emailadress, måste vi se till att den emailen inte är tagen
//Denna satsen körs inte om emailen inte ändras
if ($_POST['email'] != $_SESSION['user']['email']){
  $query = "SELECT 1 FROM users WHERE email = :email";
  //Definerar våra query parametrars värden
  $query_parameter = array(':email' => $_POST['email']);
  try{
    //Kör queryn
    $stmt = $db->prepare($query);
           $result = $stmt->execute($query_parameter);
  }
  catch(PDOException $ex){
    //Som tidigare nämt kanske jag använder getMessage
    die("Kunde inte körs queryn: " . $ex->getMessage());
  }
  $row = stmt->fetch();
  if($row){
    die("Denna email address används redan");
  }
}
//Om användaren skriver in ett nytt lösenord, Kommer ej användas senare då verifikation kommer ske via mejl
if (!empty($_POST['password'])) {
       $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
       $password = hash('sha256', $_POST['password'] . $salt);
       for ($round = 0; $round < 65536; $round++) {
           $password = hash('sha256', $password . $salt);
       }
   }
   else {
        //Om användaren inte skriver in ett nytt lösenord ska vi självklart inte uppdatera deras gamla
        $password = null;
    }
//Första query parameternas värden
$query_parameter = array(
        ':email' => $_POST['email'],
        ':user_id' => $_SESSION['id'],
    );
    //Om användaren ändras sitt lösenord så behöver vi parameter värden för det med
    if ($password !== null) {
       $query_parameter[':password'] = $password;
   }
    //Uppdaterar tabellerna i database med emailen, men körs aldrig för mer värden läggs till nedan
    $query = "UPDATE users SET email = :email";

//Om användaren uppdaterar sitt lösenord
if($password !== null){
$query .= ", password = :password";
}
//Nu slutförs uppdateringen av quieryn till databasen
//Här ser vi till att endast en användare uppdateras i databasen
$query .= "WHERE id = :user_id";
try{
  //kör queryn
  $stmt = $db->prepare($query);
  $result = $stmt->execute($query_parameter);
}
catch(PDOException $ex){
  die("Kunde inte köra queryn:" . $ex->getMessage());
}
//Nu har emailadressen ändrats, sparar vi datan i en $_SESSION
$_SESSION['user']['email'] = $_POST['email'];

header("Location: index.php");
die("Skickar vidare till: index.php")
}
$sidtitel "Användarsida";
include "header.php";
include "nav.php";
?>
<h1>Edit Account</h1>
<form action="edit_account.php" method="post">
    Username:
    <br />
    <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>
    <br />
    <br />
    E-Mail Address:
    <br />
    <input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" />
    <br />
    <br />
    Password:
    <br />
    <input type="password" name="password" value="" /><br />
    <i>(leave blank if you do not want to change your password)</i>
    <br /><br />
    <input type="submit" value="Update" />
    <input type="reset" value="Reset" />
</form>
<?php
include "footer.php";
?>
