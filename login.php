<?php
include 'nav.php';
if(isset($_SESSION['sessData'])){
  $sidtitel = 'Användarsida';
}
else{
  $sidtitel = 'Logga In';
}
include 'header.php';
$felkod = "";
//Om användaren klickar på logga in, då har den knappen namnet "loggain"
if(isset($_POST['loggain'])){

    //Hämtar emailen med POST från forumläret användaren precis skrev in, tar även bort blankrum med trim innan och efter.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;

    //Hämtar användarinformationen med hjälp av emailen som användaren skrivit in.
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);

    //Binder värdet $email
    $stmt->bindValue(':email', $email);

    //Ecviterar och därmed hämtar användarinformationen
    $stmt->execute();

    //Hämtar informationen i en array
    $användare = $stmt->fetch(PDO::FETCH_ASSOC);

    //Om det inte finns någon email
    if($användare === false){
        $felkod = "Det finns ingen användare med den emailen, vänligen försök igen";
    } else{
        //Finns en användare på webbplatsen med den emailen.

        //Kollar om lösenordet användaren skrivit in med det hashade lösenordet i databasen stämmer överens med varandra.
        $lösenord_inskrivet = $_POST['password'];
        $rättlösenord = $användare['password'];
        //Om if satsen stämmer så stämmer lösenordet överens.
      if ($rättlösenord == hash('sha256', $lösenord_inskrivet)){
            //Sparar information i en session så att man kan hämtar information om användaren senare.
            //Valde denna gång att spara ner tiden en användare varit inloggad med, ska använda det till en sak snart.
            $_SESSION['user'] = $användare;
            $_SESSION['logged_in'] = time();

            //Skickas vidare till hem för att sessionen ska uppdateras.
            header('Location: index.php');

        } else{
$felkod = "Lösenordet eller emailen du angav är ej korrekt, vänligen försök igen";
        }
    }

}
			?>
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
                <i class="fas fa-sign-in-alt fa-3x"></i>
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
                                  <p class="text-center font-weight-bold text-danger"><?php echo $felkod; ?></p>
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Skriv in din Email" required>
                                    <small id="emailHelp" class="form-text text-muted">Vi delar inte din email address med någon annan.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lösenord</label>
                                    <input type="password" name="password" class="form-control" placeholder="Skriv in ditt Lösenord" required>
                                </div>
                                <button type="submit" name="loggain" class="btn btn-lg btn-block registreraknapp" value="Logga">Logga In</button>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Har du ingen användare? <a href="register.php">Skapa en användare</a></label>
                                </div>
                            </form>
                            <?php } ?>
        </div>
        <?php
include 'footer.php';
 ?>
