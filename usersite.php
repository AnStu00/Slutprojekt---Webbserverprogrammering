<?php
include("nav.php");
if(empty($_SESSION['user'])){
  header("Location: login.php");
  die("Skickar vidare till login.php");
}
//Denna if satsen kollar om formuläret har skickats
//Om den har det så skickar den vidare det och kör det. Annars kommer formet fortfarande vara uppe.
if (!empty($_POST)) {
  //Kollar om det är en gintlig email address personen skrivit in
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['email']) {
          die("Fel Email struktur");
      }
//Om användaren ändrar sin emailadress, måste vi se till att den emailen inte är tagen
//Denna satsen körs inte om emailen inte ändras
if ($_POST['email'] != $_SESSION['user']['email'] && $_POST['email']) {
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
    //die("Kunde inte körs queryn: " . $ex->getMessage());
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
    if (!empty($_POST['first_name']))
    {
    $first_name = $_POST['first_name'];
    }
       else {
            $first_name = null;
        }

    if (!empty($_POST['last_name']))
      {
      $last_name = $_POST['last_name'];
      }
           else {
                $last_name = null;
            }

            if (!empty($_POST['telefon']))
            {
            $telefon = $_POST['telefon'];
            }
               else {
                    $telefon = null;
                }
    //Sätter datumet för när användaren ändrades senast, en variabel som används för att lägga in det i databasen med UPDATE
  $changed = date("Y-m-d H:i:s");
//Första query parameternas värden
$query_parameter = array(':email' => $_POST['email'],':user_id' => $_SESSION['user']['id'], ':changed' => $changed,);
    //Om användaren ändras sitt lösenord så behöver vi parameter värden för det med
    if ($password !== null) {
        $query_parameter[':password'] = $password;
    }
    if ($first_name !== null) {
        $query_parameter[':first_name'] = $first_name;
    }
    if ($last_name!== null) {
        $query_parameter[':last_name'] = $last_name;
    }
    if ($telefon !== null) {
        $query_parameter[':telefon'] = $telefon;
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
if($first_name !== null){
  $query .= "
      , first_name = :first_name
  ";
}
if($last_name !== null){
  $query .= "
      , last_name = :last_name
  ";
}
if($telefon !== null){
  $query .= "
      , telefon = :telefon
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
  //echo "Ajdå! ";
  //die("Kunde inte köra queryn:" . $ex->getMessage());
  var_dump($query);
}
//Nu har emailadressen ändrats, sparar vi datan i en $_SESSION
 $_SESSION['user']['email'] = $_POST['email'];

//header("Location: index.php");
//die("Skickar vidare till: index.php");
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
<div class="container">
    <h2>Ändra Uppgifter</h2>
    <div class="row">
        <div class="col-sm">
            <form action="usersite.php" method="post">
                <div class="form-group">
                    <label>Förnamn</label>
                    <input type="first_name" name="first_name" class="form-control" placeholder="<?php echo $_SESSION['user']['first_name'];?>">
                    <small class="form-text text-muted">(Lämna tomt om du inte vill ändra ditt förnamn)</small>
                </div>
                <div class="form-group">
                    <label>Efternamn</label>
                    <input type="last_name" name="last_name" class="form-control" placeholder="<?php echo $_SESSION['user']['last_name'];?>">
                    <small class="form-text text-muted">(Lämna tomt om du inte vill ändra ditt efternamn)</small>
                </div>
                <div class="form-group">
                    <label name="">Telefonnummer</label>
                    <input type="telefon" name="telefon" class="form-control" placeholder="<?php echo $_SESSION['user']['telefon'];?>">
                    <small class="form-text text-muted">(Lämna tomt om du inte vill ändra ditt telefonnummer)</small>
                </div>
                <div class="form-group">
                    <label>Skapad:
                        <?php echo $_SESSION['user']['skapad']; ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Ändrad senast:
                        <?php echo $_SESSION['user']['changed']; ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Admin:
                        <?php
          if($_SESSION['user']['status'] == 1){
            echo "Ja";
          }
          else {
            echo "Nej";
          }
          ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Email address</label>
                    <input type="email" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" class="form-control" aria-describedby="emailinformation" placeholder="">
                    <small id="emailinformation" class="form-text text-muted">(Lämna som den är om du inte vill ändra den)</small>
                </div>
                <div class="form-group">
                    <label>Lösenord</label>
                    <input type="password" name="password" class="form-control" aria-describedby="lösenordsinfo" placeholder="Lösenord">
                    <small id="lösenordsinfo" class="form-text text-muted">(Lämna tomt om du inte vill ändra ditt lösenord)</small>
                </div>
                <button type="submit" class="btn registreraknapp">Ändra Information</button>
                <button type="reset" class="btn registreraknapp">Återställ</button>
            </form>
            </ul>
        </div>
        <div class="col-sm">
            På denna användarsida, kan du ändra dina användaruppgifter, om du inte vill ändra alla utan bara vill ändra någon, se till att de andra fälten är tomma.
<?php
if($_SESSION['user']['status'] == 1){
echo '
  <div class="container">
  <div class="row">
  <br>
  Du har adminbehörighet, om du vill se mer detaljerad information. Öppna adminpanelen här:
  <form action="adminsida.php" method="post">
  <button type="submit" name="admin" class="btn registreraknapp">Administrationsida</button>
  </form>
  </div>
  </div>
  ';
}
?>
</div>
</div>
</div>
<?php
include "footer.php";
?>
