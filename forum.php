<?php
//Forumet fungerar inte rikitgt ännu.. tyvärr...
$sidtitel = "Forum";
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
	<!-- P -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- p -->
	<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
		<div class="container">
      <?php if(isset($_SESSION['sessData'])): ?>
        <h2>Forum</h2>
  			<div class="site-breadcrumb">

  				<a href="index.php">Hem</a> / <span>Forum</span>
    <?php else: ?>
      <h2>Forum</h2>
      <div class="site-breadcrumb">

        <a href="index.php">Hem</a> / <span>Forum</span>
    <?php endif; ?>
			</div>
		</div>
	</section>
	<!-- P -->
  <?php if(isset($_SESSION['sessData'])): ?>
<div class="container">
  <div class="row">
    <div class="col-sm">
        <button>Kategorier</button>
      <div class="row-sm">
        Mobiler
      </div>
      <div class="row-sm">
        Support
      </div>
      <div class="row-sm">
        Annat
      </div>
    </div>
    <div class="col-sm">
      Senaste Ämnet
      <div class="row-sm">
        Namn på inlägg
      </div>
    </div>
    <div class="col-sm">
      Senaste kommentaren
      <div class="row-sm">
        Coolt
      </div>
    </div>
  </div>
</div>
<?php else: ?>
  Du måste vara inloggad för att använda Forumet. Logga in här <button class="btn registreraknapp">Logga in</button>
    <?php endif; ?>
<?php
include 'footer.php';
 ?>

</php>
