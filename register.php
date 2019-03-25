<?php
include 'header.php';
include 'nav.php';
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
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
        <!-- Slut på sid-sektionen -->

        <!-- Skapa en användare-sektion -->
        <section class="domain-search-section sc-about-page">
            <div class="container">
                <div class="section-title">
                    <img src="./img/sektions-titel-ikon.png" alt="#">
                    <p>Här nedan skapar du din egna användare</p>
                    <h2>Skapa en användare</h2>
                </div>
            </div>
            <div class="container">
                <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
                    <div class="regisFrm">
                        <form action="user_account.php" method="post">
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
