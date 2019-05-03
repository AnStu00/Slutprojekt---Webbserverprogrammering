<!-- Footer top sektionen -->
<section class="footer-top-section text-white spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="footer-widget about-widget">
          <img src="./img/logo.png" alt="logo">
          <p>Detta är en webbplats jag André Sturesson har gjort som slutprojekt i kursen Webbserverprogrammering 1 på Teknikums gymnasieskola 2019 under mitt tredje och sista år i grundskolan.</p>
          <div class="fw-social social">
            <a href="https://www.instagram.com/andre_sturesson/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/andre.sturesson.9"><i class="fab fa-facebook-f"></i></a>
            <a href="https://github.com/AnStu00/Slutprojekt---Webbserverprogrammering"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-snapchat"></i></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="footer-widget">
          <h4 class="fw-title">Navigering</h4>
          <div class="row">
            <div class="col-sm-8">
              <ul>
                <li><a href="">Hem</a></li>
                <li><a href="">Om Oss</a></li>
                <li><a href="">Webbshop</a></li>
                <li><a href="">Forum</a></li>
                <li><a href="">Kontakta Oss</a></li>
                <li><a href="">Ett Inlägg i forumet jag gillar</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4  col-md-6">
        <div class="footer-widget">
          <h4 class="fw-title">Senaste inläggen i forumet</h4>
          <div class="fw-latest-post-widget">
            <?php
            $query ="SELECT * FROM ämne ORDER BY topic_datum DESC";
            try{
              $result = $db->prepare($query);
              $result->execute();
              $rows = $result->fetchAll();
            }
            catch(PDOException $ex){
              die("Kunde inte köra queryn: " . $ex->getMessage());
            }
            //en liten räknare
            $i=0;
            //Denna loop loopar igenom dom 4 senaste inläggen sorterat efter topic_datum (se ovan)
            //Tack varje räknaren i if satsen så vet den när den gått igenom loopen 4 gånger.
            //Du kan även klicka på inlägget och kommer då till rätt inlägget eftersom idn på länken blir samma id som inlägget har.
  foreach($rows as $row){
    ?>
    <div class="lp-item">
      <div class="lp-content">
        <a href="inlagg.php?id=<?php echo $row['topic_id'];?>"><h6><?php echo $row['topic_subject'];?></h6></a>
        <span><?php echo $row['topic_datum'];?></span>
      </div>
    </div>

    <?php
  //för att jag vill stoppa foreach loopen efter 3 iterations, eftersom jag inte vill se alla inlägg här.
  $i++;
  if($i==4) break;
  }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Slut på footer top-sektionen -->
<!-- Footer sektionen -->
<footer class="footer-section">
  <div class="container">
    <div class="copyright">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Denna webbsidan gjordes med <i class="fas fa-heart" aria-hidden="true"></i> av <a href="André Sturesson" target="_blank">André Sturesson</a>
</div>
  </div>
</footer>
<!-- Slut på footer topp sektionen -->
<!--====== Javascripts och Jquery ======-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/circle-progress.min.js"></script>
<script src="js/main.js"></script>

</body>
