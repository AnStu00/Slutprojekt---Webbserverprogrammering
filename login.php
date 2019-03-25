<?php
include 'nav.php';
if(isset($_SESSION['sessData'])){
  $sidtitel = 'Användarsida';
}
else{
  $sidtitel = 'Inloggningsida';
}
include 'header.php';
//Få anslutning till databasen samt startar en session
require "anslutning/user.php";

//Eventuell koll om användaren har skrivit in sina inloggningsuppgifter
$skrivit_email = '';

//Kollar om personen har skrivit in sina inloggningsuppgifter
//Skickas hit när personen klickar på logga in knappen (submit)
if(!empty($_POST)){
  //Denna query hämtar personens uppgifter med deras email
  $query = "SELECT * FROM users WHERE email =:email";
  $query_parameter = array(':email' => $_POST['email']);

try {
  //Exiverar queryn mot databasen
  $stmt = $db ->prepare($query);
  $result = $stmt->execute($query_parameter);
}
catch(PDOException $ex){
  //Eventuell kod för skydd. Kan vara dåligt eftersom getMessage kan göra att attackers får info om min kod...
  die("Kunde inte köra queryn:" . $ex->getMessage());
}

//Denna variabeln kommer kolla om användaren lyckades logga in eller inte
$login_okej = false;
//Hämta användardatan från databasen, om $row är falsk kommer emailen de skrev in inte finnas registerad i databasen
$row = $stmt->fetch();
if($row){
  //Använder lösenordet från databasen.
  //Testar om lösenordet matchar med de hashade lösenordet i databasen
  if ($check_password = hash('sha256', $_POST['password'])){
    $login_okej = true;
  }
}
//Om användaren lyckades logga in (d.v.s $login_okej = true) så skickas användaren vidare till användarsidan
// Annars kommer ett felmedellande och personen får logga in ingen
if ($login_okej){
  unset($row['password']);

//Denna sparar användardatan
//Denna kommer användas varje gång jag behöver kolla om användaren är inloggad eller inte
//Den kommer också användas för att få fram data på klientens Skärm
$_SESSION['user'] = $row;

//Skickas vidare till användarsidan
header('Location: index.php');
die("Skickas till: index.php");
}
else {
  //Skriver ut till användaren att inloggningen misslyckades
  print("Inloggningen misslyckades. <br />");
  var_dump($login_okej);
}
}
			?>
    <!-- Sid-preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Sid-topp-sektionen -->
    <section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
        <div class="container">
            <?php if(isset($_SESSION['sessData'])): ?>
                <h2>Användarsida</h2>
                <div class="site-breadcrumb">

                    <a href="index.php">Hem</a> / <span>Användarsida</span>
                    <?php else: ?>
                        <h2>Inloggningsida</h2>
                        <div class="site-breadcrumb">

                            <a href="index.php">Hem</a> / <span>Inloggningsida</span>
                            <?php endif; ?>
                        </div>
                </div>
    </section>
    <!-- Sid-topp-sektionen -->

    <!-- Användar/Inloggningsida -->
    <section class="domain-search-section sc-about-page">
        <div class="container">
            <div class="section-title">
                <img src="./img/sektions-titel-ikon.png" alt="#">
                <?php if(isset($_SESSION['sessData'])): ?>
                    <p>Användarsida</p>
                    <h2>Uppdatera Användarinformation</h2>
                    <?php else: ?>
                        <p>Inloggnigsida</p>
                        <h2>Logga In</h2>
                        <?php endif; ?>
            </div>

            <?php
          if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
              $user = new User();
              $conditions['where'] = array(
                  'id' => $sessData['userID'],
              );
              $conditions['return_type'] = 'single';
              $userData = $user->getRows($conditions);
          ?>
                <h2>Välkommen <?php echo $userData['first_name']; ?>!</h2>
                <div class="card" style="width: 20rem;">

                    <div class="card-body">
                        <h5 class="card-title">Namn: <?php echo $userData['first_name'].' '.$userData['last_name']; ?></h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Email:
                            <?php echo $userData['email']; ?>
                        </li>
                        <li class="list-group-item">Telefon:
                            <?php echo $userData['telefon']; ?>
                        </li>
                        <li class="list-group-item">Skapad:
                            <?php echo $userData['skapad']; ?>
                        </li>
                        <li class="list-group-item">Ändrad:
                            <?php echo $userData['changed']; ?>
                        </li>
                        <li class="list-group-item">Adminstatus:
                            <?php if($userData['status'] == 0){echo "Ja!!";} else{echo "Nej";}
                if($userData['status'] == 1){?>
                                <form method="post" action="admin.php">
                                    <button type="submit" name="admin" class="btn btn-block registreraknapp">Adminsida</button>
                                </form>
                                <?php
        }
        ?>
                        </li>

                    </ul>
                </div>
                <button type="button" class="btn btn-lg btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Ändra Information</button>
                <?php
//Nedan finns en bootstrap modal som kommer användas inom kort.
?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                                            <input type="text" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Message:</label>
                                            <textarea class="form-control" id="message-text"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Send message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }else{ ?>
                        <h2>Logga in som en användare</h2>
                            <form action="login.php" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Skriv in din Email>
                                    <small id="emailHelp" class="form-text text-muted">Vi delar inte din email address med någon annan.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lösenord</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="">
                                </div>
                                <button type="submit" name="submit" class="btn btn-lg btn-block registreraknapp" value="Logga">Logga In</button>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Har du ingen användare? <a href="register.php">Skapa en användare</a></label>
                                </div>
                            </form>
                            <?php } ?>
        </div>
        <?php
include 'footer.php';
 ?>
