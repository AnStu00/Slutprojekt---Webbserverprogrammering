<?php
$sidtitel = "Forum - ";
include 'header.php';
include 'nav.php';
if (isset($_SESSION['user']))
{

$id=$_GET['id'];
$query1 ="SELECT * FROM posts WHERE post_id='$id'";
try{
  $result1 = $db->prepare($query1);
  $result1->execute();
  $rows1 = $result1->fetchAll();
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}
try{
$stmt = $db->query("SELECT post_ämne FROM posts WHERE post_id='$id'");
$kategori = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}
$kategori_id = $kategori['post_ämne'];
try{
$stmt = $db->query("SELECT kat_namn FROM kategorier WHERE kat_id='$kategori_id'");
$kategori = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}
try{
  $stmt = $db->query("SELECT * FROM ämne WHERE topic_id='$id'");
  $topic_subject = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}

//Kommentarer
$query = "SELECT * FROM kommentarer WHERE post_id='$id'";
try{
  $result = $db->prepare($query);
  $result->execute();
  $rows = $result->fetchAll();
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}

if(isset($_POST['submit'])){
  $posts_id = $_POST['id'];
  $posts_innehåll = $_POST['kommentar1'];
  $posts_datum = date("Y-m-d H:i:s");
  $posts_ämne = $kategori_id;
  $posts_av = $_SESSION['user']['first_name'];

  $query = "INSERT INTO kommentarer(post_id, post_innehåll, post_datum, post_ämne, post_av) VALUES ('$posts_id', '$posts_innehåll', '$posts_datum', '$posts_ämne', '$posts_av')";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Kommentaren kunde inte läggas till, återvänd hem och försök igen! Felkod:" . $ex->getMessage());
  }
header('Location: '.$_SERVER['REQUEST_URI']);
}
?>
<!-- Första Sektionen -->
<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
  <div class="container">
    <h2><?php echo $topic_subject['topic_subject']; ?></h2>
    <div class="site-breadcrumb">
      <a href="index.php">Hem</a> / <a href="forum.php">Forum</a> / <span><?php echo $kategori['kat_namn']; ?></span>
    </div>
  </div>
  <button class="btn registreraknapp nere" onclick="window.location.href='admin/skapa-ämne.php'">Redigera Inlägg</button>
</section>

  <div class="card mb-3 wow fadeIn">
      <div class="card-header font-weight-bold">Huvudinlägget</div>

  <?php foreach($rows1 as $row1): ?>
<div class="card-body">
      <div class="row">
          <div class="col-md-2">
              <img src="<?php echo htmlentities($_SESSION['user']['profilbild'], ENT_QUOTES, 'UTF-8'); ?>" class="img img-rounded img-thumbnail" style="max-width: 120px"/>
              <p class="text-secondary text-center"></p>
          </div>
          <div class="col-md-10">
              <p>
                  <strong>  <?php echo htmlentities($row1['post_av'], ENT_QUOTES, 'UTF-8'); ?></a>
              </p>
              <div class="clearfix"></div>
              <p><?php echo htmlentities($row1['post_innehåll'], ENT_QUOTES, 'UTF-8'); ?></p>
          </div>
      </div>
  </div>
    <?php endforeach; ?>
    </div>
</div>

<div class="container" style="max-width: 95vw !important;">
  <div class="card mb-3 wow fadeIn">
      <div class="card-header font-weight-bold">Kommentarer</div>

      <?php foreach($rows as $row): ?>
<div class="card-body">
      <div class="row">
          <div class="col-md-2">
              <img src="<?php echo htmlentities($_SESSION['user']['profilbild'], ENT_QUOTES, 'UTF-8'); ?>" class="img img-rounded img-thumbnail" style="max-width: 120px"/>
              <p class="text-secondary text-center"><?php echo $row['post_datum'];?></p>
          </div>
          <div class="col-md-10">
              <p>
                  <strong><?php echo $row['post_av'];?></strong></a>
              </p>
              <div class="clearfix"></div>
              <p><?php echo $row['post_innehåll'];?></p>
              <p>
              </p>
          </div>
      </div>
  </div>
      <?php endforeach; ?>
    </div>
</div>
<br>
<div class="card mb-3 wow fadeIn">
    <div class="card-header font-weight-bold">Skriv en kommentar</div>
    <div class="card-body">

        <form method="post" action="inlagg.php">
          <input type="hidden" value="<?php echo $id;?>" name="id">
          <p class="font-weight-bold">Du är inloggad som: <?php echo $_SESSION['user']['first_name'];?> <?php echo $_SESSION['user']['last_name'];?> </p>
            <div class="form-group">
                <label for="replyFormComment">Din kommentar</label>
                <input type="text" class="form-control" id="replyFormComment" name="kommentar1" rows="5" required></textarea>
            </div>

            <div class="text-center mt-4">
                <input class="btn registreraknapp btn-md" type="submit" value="Skicka" name="submit"></input>
            </div>
        </form>

    </div>
</div>

<?php
include 'footer.php';
}
else{
  ?>
  Du behöver vara inloggad för att se detta inlägg! Skapa en användare här: <button class="btn registreraknapp" onclick="window.location.href='register.php'">Skapa Användare</button>
  <?php
}
?>
