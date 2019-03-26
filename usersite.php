<?php
include("nav.php");
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
if ($_POST['email'] != $_SESSION['user']['email']) {
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
//Hämtar resultaten om det finns några
}
//Om användaren skriver in ett nytt lösenord, Kommer ej användas senare då verifikation kommer ske via mejl
if (!empty($_POST['password'])) {
       $password = hash('sha256', $_POST['password']);
       for ($round = 0; $round < 65536; $round++) {
           $password = hash('sha256', $password);
       }
   }
   else {
        //Om användaren inte skriver in ett nytt lösenord ska vi självklart inte uppdatera deras gamla
        $password = null;
    }
    //Sätter datumet för när användaren ändrades senast, en variabel som används för att lägga in det i databasen med UPDATE
  $changed = date("Y-m-d H:i:s");
//Första query parameternas värden
$query_parameter = array(':email' => $_POST['email'],':user_id' => $_SESSION['user']['id'], ':changed' => $changed,);
    //Om användaren ändras sitt lösenord så behöver vi parameter värden för det med
    if ($password !== null) {
      $query .= ", password = :password";
   }
    //Uppdaterar tabellerna i database med emailen och ändringsstatus(changed), men körs aldrig för mer värden läggs till nedan
    $query = "
    UPDATE users
    SET
        email = :email,
        changed = :changed
";

//Om användaren uppdaterar sitt lösenord
if($password !== null){
  $query .= "
      , password = :password
  ";
}
//Nu slutförs uppdateringen av quieryn till databasen
//Här ser vi till att endast en användare uppdateras i databasen
$query .= "
       WHERE
           id = :user_id
   ";
try{
  //kör queryn
  $stmt = $db->prepare($query);
  $result = $stmt->execute($query_parameter);
}
catch(PDOException $ex){
  echo "Ajdå! ";
  die("Kunde inte köra queryn:" . $ex->getMessage());
}
//Nu har emailadressen ändrats, sparar vi datan i en $_SESSION
 $_SESSION['user']['email'] = $_POST['email'];

header("Location: index.php");
die("Skickar vidare till: index.php");
}
include("header.php");
?>
<!-- Sid-topp-sektionen -->
<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
    <div class="container">
            <h2>Användarsida</h2>
            <div class="site-breadcrumb">
                <a href="index.php">Hem</a> / <span>Användarsida</span>
                    </div>
            </div>
</section>
<!-- Sid-topp-sektionen -->
<h2>Ändra Uppgifter</h2>
<div class="card" style="width: 20rem;">
<div class="card-body">
<h5 class="card-title">Namn: <?php echo $_SESSION['user']['first_name'];echo $_SESSION['user']['last_name'];?></h5>
</div>
<ul class="list-group list-group-flush">
<li class="list-group-item">Telefon: <?php echo $_SESSION['user']['telefon']; ?></li>
<li class="list-group-item">Skapad: <?php echo $_SESSION['user']['skapad']; ?></li>
<li class="list-group-item">Ändrad: <?php echo $_SESSION['user']['changed']; ?></li>
<li class="list-group-item">Admin: <?php echo $_SESSION['user']['status']; ?></li>
<form action="usersite.php" method="post">
<li class="list-group-item">Email:<br><input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" /></li>
<li class="list-group-item">Lösenord:<br><input type="password" name="password" value="" /><br />
    <i>(Lämna tomt om du inte vill ändra ditt lösenord)</i></li>
  <li class="list-group-item"><input type="submit" value="Uppdatera" />
    <input type="reset" value="Återställ" /></li>
</form>
</ul>
</div>
<?php
include "footer.php";
?>
