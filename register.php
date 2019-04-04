<?php
include 'header.php';
include 'nav.php';

if (!empty($_POST)){

  //Ser till att en gintlig email-adress anges
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    die("Email adressen du angav är inte gintlig");
  }
  $query = "SELECT 1 FROM users WHERE email = :email";
  $query_parameter = array(':email' => $_POST['email']);
  try{
    $stmt = $db->prepare($query);
    $result = $stmt->execute($query_parameter);
  }
  catch(PDOException $ex){
    die("Kunde inte köra queryn: " . $ex->getMessage());
  }
  $row = $stmt->fetch();

  if($row){
    die("Denna emailadress används redan");
  }

   $query = "INSERT INTO users (first_name, last_name, telefon, skapad, changed, password, email, status) VALUES (:first_name, :last_name, :telefon, :skapad, :changed, :password, :email, :status)";

   $password = hash('sha256', $_POST['password']);
   $skapad = date("Y-m-d H:i:s");
   $changed = date("Y-m-d H:i:s");
   $status = '0';
   $query_parameter = array(':first_name' => $_POST['first_name'], ':last_name' => $_POST['last_name'], ':telefon' => $_POST['telefon'], ':skapad' => $skapad, ':changed' => $changed, ':password' => $password, ':email' => $_POST['email'], ':status' => $status);
   try {
       // Exvierar queryn för att skapa användaren, d.v.s lägga in värderna i tabellen
       $stmt = $db->prepare($query);
       $result = $stmt->execute($query_parameter);
   }
   catch(PDOException $ex) {
     die("Kunde inte köra queryn: " . $ex->getMessage());
   }
   echo "
        <script type='text/javascript'>
        alert('Användaren Skapades!');
        window.location.href='login.php';
        </script>";
         die("Skickas vidare till: login.php");
}
?>

    <body>
        <!-- Sid-preloader -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Sid-topp sida -->
        <section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
            <div class="container">
                    <h2>Registrera Användare</h2>
                    <div class="site-breadcrumb">
                        <a href="index.php">Hem</a> / <span>Registrera</span>
                            </div>
                    </div>
        </section>
        <!-- Slut på sid-sektionen -->

        <!-- Skapa en användare-sektion -->
        <section class="domain-search-section sc-about-page">
            <div class="container">
                <div class="section-title">
                    <i class="fas fa-user fa-3x"></i>
                    <p>Här nedan skapar du din egna användare</p>
                    <h2>Skapa en användare</h2>
                </div>
            </div>
            <div class="container">
                    <div class="regisFrm">
                        <form action="register.php" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" name="first_name" class="form-control" id="inputEmail4" placeholder="Förnamn">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="last_name" class="form-control" id="inputPassword4" placeholder="Efternamn">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" id="inputAddress" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="text" name="telefon" class="form-control" id="inputAddress" placeholder="Telefonnummer">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="password" name="password" name="first_name" class="form-control" id="inputEmail4" required="" placeholder="Lösenord">
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="password" name="confirm_password" class="form-control" id="inputPassword4" placeholder="Bekräfta Lösenord">
                                </div>
                                <button type="submit" name="signupSubmit" class="btn registreraknapp">Registrera</button>
                            </div>
                        </form>
                        <br>
                    </div>
            </div>

            <?php
include 'footer.php';
 ?>

                </php>
