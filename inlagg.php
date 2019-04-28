<?php
$sidtitel = "Forum - ";
include 'header.php';
include 'nav.php';

$id=$_GET['id'];
$query ="SELECT * FROM posts WHERE post_id='$id'";

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
    <h2>(Namnet på ämnet)
    </h2>
    <div class="site-breadcrumb">
      <a href="index.php">Hem</a> / <a href="forum.php">Forum</a> / <span>Ämnet (Ska bli rätt snart)</span>
    </div>
  </div>
  <button class="btn registreraknapp nere">Skapa ämne</button>
</section>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Innehåll
      </th>
      <th scope="col">Datum
      </th>
      <th scope="col">Av
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($rows as $row): ?>
    <tr>
      <td>
          <?php echo htmlentities($row['post_innehåll'], ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </td>
      <td>
        <?php echo htmlentities($row['post_datum'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td>
        <?php echo htmlentities($row['post_av'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
include 'footer.php';
?>
