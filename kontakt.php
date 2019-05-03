<?php
$sidtitel = "Kontakta Oss";
include 'header.php';
include 'nav.php';
 ?>
 <!-- Första Sektionen -->
 <section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
   <div class="container">
     <h2>Var vi befinner oss</h2>
     <div class="site-breadcrumb">
       <a href="index.php">Hem</a> / <span>Kontakta Oss</span>
     </div>
   </div>
 </section>

 <div class="row" id="kontakt">
 <div class="container mt-5" >


     <div class="row" style="height:550px;">
       <div class="col-md-6 maps" >
          <iframe src="https://maps.google.com/maps?q=teknikum&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
       </div>
       <div class="col-md-6">
         <h2 class="text-uppercase mt-3 font-weight-bold">Kontakta Oss</h2>
         <form action="">
           <div class="row">
             <div class="col-lg-6">
               <div class="form-group">
                 <input type="text" class="form-control mt-2" placeholder="Namn" required>
               </div>
             </div>
             <div class="col-lg-6">
               <div class="form-group">
                 <input type="text" class="form-control mt-2" placeholder="Ämne" required>
               </div>
             </div>
             <div class="col-lg-6">
               <div class="form-group">
                 <input type="email" class="form-control mt-2" placeholder="Email" required>
               </div>
             </div>
             <div class="col-lg-6">
               <div class="form-group">
                 <input type="number" class="form-control mt-2" placeholder="Telefon" required>
               </div>
             </div>
             <div class="col-12">
               <div class="form-group">
                 <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Vad vill du säga?" rows="3" required></textarea>
               </div>
             </div>
             <div class="col-12">
             <div class="form-group">
               <div class="form-check">
                 <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                 <label class="form-check-label" for="invalidCheck2">
                   Har du en SpacePhone?
                 </label>
               </div>
             </div>
             </div>
             <div class="col-12">
               <button class="btn registreraknapp" type="submit">Skicka</button>
             </div>
           </div>
         </form>
         <h2 class="text-uppercase mt-4 font-weight-bold">Var vi finns?</h2>

         <i class="fas fa-phone mt-3"></i> <a href="tel:+">(+43) 0735357617</a><br>
         <i class="fa fa-envelope mt-3"></i> <a href="">anst00001@utb.vaxjo.se</a><br>
         <i class="fas fa-globe mt-3"></i> Teknikum skola, Växjö<br>
       </div>

     </div>
 </div>
 </div>
<?php
include 'footer.php';
?>
