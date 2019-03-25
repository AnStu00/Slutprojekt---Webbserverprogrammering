<?php
$sidtitel = 'Ändring av uppgifter';
include 'header.php';
include 'nav.php';
?>
<body>
	<!-- Sid-preloader -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Ändring av uppgifter -->
	<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
		<div class="container">
      <?php if(isset($_SESSION['sessData'])): ?>
        <h2>Ändring av uppgifter</h2>
  			<div class="site-breadcrumb">

  					<a href="index.php">Hem</a> / <a href="login.php">Användarsida</a> / <span>Användarinformation</span>
    <?php else: ?>
      <h2>Inloggningsida</h2>
      <div class="site-breadcrumb">

        <a href="index.php">Hem</a> / <span>Användarinformation</span>
    <?php endif; ?>
			</div>
		</div>
	</section>


	<!-- Användaruppgifter -->
	<section class="domain-search-section sc-about-page">
		<div class="container">
			<div class="section-title">
				<img src="./img/sektions-titel-ikon.png" alt="#">
        <?php if(isset($_SESSION['sessData'])): ?>
          <p>Användaruppgifter</p>
          <h2>Ändring av användaruppgifter</h2>
      <?php else: ?>
        <p>Inloggnigsida</p>
        <h2>Logga In</h2>
      <?php endif; ?>
			</div>

          <?php
              if(!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
                  include 'user.php';
                  $user = new User();
                  $conditions['where'] = array(
                      'id' => $sessData['userID'],
                  );
                  $conditions['return_type'] = 'single';
                  $userData = $user->getRows($conditions);
                }
          ?>
          <h2>Välkommen <?php echo $userData['first_name']; ?>!</h2>
          <div class="container">
              <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
                  <form action="user_account.php" method="post">
                    <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="first_name" class="form-control" id="inputEmail4" placeholder="<?php echo $userData['first_name']; ?>">
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="last_name" class="form-control" id="inputPassword4" placeholder="<?php echo $userData['last_name']; ?>">
              </div>
            </div>
            <div class="form-group">
              <input type="email" name="email"  class="form-control" id="inputAddress" placeholder="<?php echo $userData['email']; ?>">
            </div>
            <div class="form-group">
              <input type="text" name="telefon"  class="form-control" id="inputAddress" placeholder="<?php echo $userData['telefon']; ?>">
            </div>
                          <button type="submit" name="signupSubmit"class="btn btn-lg btn-block registreraknapp">Uppdatera Informationen</button>
                  </form><br>
              </div>
          </div>
      </div>
<?php
include 'footer.php';
 ?>
