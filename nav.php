<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

    <body>
        <!-- Eventuell pagepreloader -->
        <!-- Header-sektionen -->
        <header class="header-section">
            <a href="./index.php" class="site-logo"><img src="./img/logo.png" alt=""></a>
            <div class="nav-switch">
                <i class="fa fa-bars"></i>
            </div>
            <div class="nav-warp">
                <div class="user-panel">
<?php
  if (isset($_SESSION['sessData']))
  {
    echo '<a href="./login.php">Användarsida</a>';
  }
      else
      {
        echo '<a href="./login.php">Logga In</a>';
      }
?>
                </div>
                        <?php if(isset($_SESSION['sessData'])): ?>
                          <div class="nav-warp">
                              <div class="user-panel">
                            <a href="user_account.php?logoutSubmit=1" class="logout" style="text-decoration:none">Logga ut</a>
                              </div>
                            <?php else: ?>
                                <div class="user-panel">
                                <a href="register.php" style="text-decoration:none">Registrera</a>

                              </div>
                                <?php endif; ?>
                    <ul class="main-menu">
                        <li><a href="./index.php">Hem</a></li>
                        <li><a href="./about.php">Om Oss</a></li>
                        <li><a href="./service.php">Våra Services</a></li>
                        <li><a href="./forum.php">Forum</a></li>
                        <li><a href="./contact.php">Kontakta Oss</a></li>
                    </ul>
                </div>
        </header>
        <!-- Slut på header-sektionen -->
