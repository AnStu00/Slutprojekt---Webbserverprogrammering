<?php
$sidtitel = "Webbshop";
include 'header.php';
include 'nav.php';

$query = "SELECT * FROM produkter";
try{
  $result = $db->prepare($query);
  $result->execute();
  $rows = $result->fetchAll();
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}
 ?>
 <!-- Första Sektionen -->
 <section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
   <div class="container">
     <h2>Mobiltelefoner och tillbehör</h2>
     <div class="site-breadcrumb">
       <a href="index.php">Hem</a> / <span>Webbshop</span>
     </div>
   </div>
 </section>
<br>
<?php
      if (is_array($rows)) {
        foreach ($rows as $row) { ?>

   <div class="row">
   <div class="col">
   	<figure class="card card-product">
   		<div class="img-wrap"><img src="<?php echo htmlentities($row['produkt_bild'], ENT_QUOTES, 'UTF-8'); ?>"></div>
   		<figcaption class="info-wrap">
   				<h4 class="title"><?php echo $row['produkt_namn'];?></h4>
   				<p class="desc"><?php echo ($row['produkt_beskrivning']); ?></p>
   				<div class="rating-wrap">
   					<div class="label-rating">Produkt ID:</div>
   					<div class="label-rating"><?php echo ($row['produkt_id']); ?></div>
   				</div>
   		</figcaption>
   		<div class="bottom-wrap">
        <div class="text-center">
   			<a href="" class="btn btn-sm registreraknapp center">Köp Nu</a>
      </div>
   			<div class="price-wrap h5">
   				<span class="price-new"><?php echo ($row['produkt_pris']); ?></span> <span class="price-old">Kronor</span>
   			</div>
   		</div>
   	</figure>
   </div>
   </div>
<?php }
      } else {
        echo "Hittade inga produkter i databasen.";
      }
      ?>
</div>
 <?php
include 'footer.php';
  ?>
