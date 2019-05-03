<?php
$sidtitel = "Forum - ";
include 'header.php';
include 'nav.php';

$id=$_GET['id'];
$query ="SELECT * FROM ämne WHERE topic_kat='$id'";

try{
  $result = $db->prepare($query);
  $result->execute();
  $rows = $result->fetchAll();
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}

try{
$stmt = $db->query("SELECT kat_namn FROM kategorier WHERE kat_id='$id'");
$kategori = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}
?>
<!-- Första Sektionen -->
<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
  <div class="container">
    <h2>Alla Inlägg i <?php echo htmlentities($kategori['kat_namn'], ENT_QUOTES, 'UTF-8'); ?>
    </h2>
    <div class="site-breadcrumb">
      <a href="index.php">Hem</a> / <a href="forum.php">Kategorier</a> / <span><?php echo $kategori['kat_namn']; ?></span>
    </div>
  </div>
  <button class="btn registreraknapp nere" onclick="window.location.href='admin/skapa-ämne.php'">Skapa ämne</button>
</section>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Ämnen
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
        <a href="inlagg.php?id=<?php echo $row['topic_id'];?>"class="btn registreraknapp">
          <?php echo htmlentities($row['topic_subject'], ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </td>
      <td>
        <?php echo htmlentities($row['topic_datum'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
      <td>
        <?php echo htmlentities($row['topic_av'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
include 'footer.php';
?>
