<?php
include 'nav.php';
if(isset($_SESSION['sessData'])){
  $sidtitel = 'Användarsida';
}
else{
  $sidtitel = 'Inloggningsida';
}
include 'header.php';
include 'user.php';
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
        <li class="list-group-item">Email: <?php echo $userData['email']; ?></li>
        <li class="list-group-item">Telefon: <?php echo $userData['telefon']; ?></li>
        <li class="list-group-item">Skapad: <?php echo $userData['skapad']; ?></li>
        <li class="list-group-item">Ändrad: <?php echo $userData['changed']; ?></li>
        <li class="list-group-item">Adminstatus: <?php if($userData['status'] == 1){echo "Ja!";}
                if($userData['status'] == 1){?>
                  <form method="post" action="admin.php">
            <button type="submit" name="admin" class ="btn btn-block registreraknapp">Adminsida</button>
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
          <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>


              <form action="user_account.php" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">Vi delar inte din email address med någon annan.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Lösenord</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Spara Lösenordet</label>
  </div>
  <button type="submit" name="loginSubmit" class="btn btn-lg btn-block registreraknapp">Logga In</button>
    <div class="form-group">
  <label for="exampleInputPassword1">Har du ingen användare? <a href="register.php">Skapa en användare</a></label>
</div>
</form>
          <?php } ?>
      </div>
<?php
include 'footer.php';
 ?>
