<?php
require("anslutning/user.php");
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
  if (isset($_SESSION['user']))
  {
    echo '<a href="loggaut.php" class="logout registreraknapp" style="text-decoration:none">Logga ut</a>';
  }
      else
      {
        echo '<a href="./login.php">Logga In</a>';
      }
?>
                </div>
                        <?php if(isset($_SESSION['user'])): ?>
                              <div class="user-panel1">
                            <a href="./usersite.php">Användarsida</a>
                              </div>
                            <?php else: ?>
                                <div class="user-panel1">
                                <a href="register.php" style="text-decoration:none">Registrera</a>
                              </div>
                                <?php endif; ?>
                    <ul class="main-menu">
                        <li><a href="./index.php">Hem</a></li>
                        <li><a href="./handla.php">Webbshop</a></li>
                        <li><a href="./forum.php">Forum</a></li>
                        <li><a href="./kontakt.php">Kontakta Oss</a></li>
                    </ul>
                </div>
        </header>
        <!-- Slut på header-sektionen -->
