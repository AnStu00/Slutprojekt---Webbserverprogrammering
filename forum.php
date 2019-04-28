<?php
$sidtitel = "Forum";
include 'header.php';
include 'nav.php';
?>
<!-- Första Sektionen -->
<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
  <div class="container">
    <h2>Forum - Kategorier
    </h2>
    <div class="site-breadcrumb">
      <a href="index.php">Hem
      </a> /
      <span>Forum
      </span>
    </div>
  </div>
</section>
<?php
$query = "SELECT kat_id, kat_namn, kat_beskrivning FROM kategorier";
try{
  $result = $db->prepare($query);
  $result->execute();
  $rows = $result->fetchAll();
  $result1 = $db->prepare($query);
  $result1->execute();
  $row_count = $result1->fetchAll(PDO::FETCH_NUM);
}
catch(PDOException $ex){
  die("Kunde inte köra queryn: " . $ex->getMessage());
}
if(!$result)
{
  echo 'Kategorierna kunde inte visas, Testa igen en annan gång :).';
}
else
{
  if($row_count == 0)
  {
    echo 'Finns inga kategorier än.';
  }
else
{
//Tar fram tabellen
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Kategorier
      </th>
      <th scope="col">Kategori Beskrivning
      </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($rows as $row): ?>
    <tr>
      <td>
        <a href="ämne.php?id=<?php echo $row['kat_id'];?>"class="btn registreraknapp">
          <?php echo htmlentities($row['kat_namn'], ENT_QUOTES, 'UTF-8'); ?>
        </a>
      </td>
      <td>
        <?php echo htmlentities($row['kat_beskrivning'], ENT_QUOTES, 'UTF-8'); ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
  }
}
?>
<?php
include 'footer.php';
?>
