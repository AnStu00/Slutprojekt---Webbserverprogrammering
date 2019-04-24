<?php
$sidtitel = "Forum";
include 'header.php';
include 'nav.php';

if(isset($_POST[])){



}



$query = "SELECT * FROM kategorier";
$query1 = "SELECT * FROM ämne";
$query2 = "SELECT * FROM posts";
?>
<!-- Första Sektionen -->
<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
    <div class="container">
            <h2>Forum</h2>
            <div class="site-breadcrumb">
                <a href="index.php">Hem</a> / <span>Forum</span>
                    </div>
            </div>
</section>
<h2>Här kommer forumet!</h2>

<a class="item" href="admin/skapa-ämne.php">Skapa ett ämne</a> -
<a class="item" href="admin/skapa-kategori.php">Skapa en kategori</a>
<div class="table-responsive-sm">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Kategorier</th>
      <th scope="col">Beskrivning</th>
      <th scope="col">KategoriID</th>
    </tr>
  </thead>
  <tbody>
  <form method="post" action="forum.php">
<?php
foreach ($db->query($query) as $row){
  echo '<tr>';
echo '<td>';
?>
<input type="submit" class="btn registreraknapp" name="<?php echo $row['kat_id']; ?>" value=<?php echo $row['kat_namn'];?>>
<?php
echo '</form>';
echo '</td>';
echo '<td>';
echo $row['kat_beskrivning'];
echo '</td>';
echo '<td>';
echo $row['kat_id'];
echo '</td>';
echo '</tr>';
}


?>
  </tbody>
  <thead>
    <tr>
      <th scope="col">Tråd</th>
      <th scope="col">Skapad av</th>
      <th scope="col">Passande Kategori ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($db->query($query1) as $row1){
      echo '<tr>';
    echo '<td>';
    echo $row1['topic_subject'];
    echo '</td>';
    echo '<td>';
    echo $row1['topic_av'];
    echo '</td>';
    echo '<td>';
    echo $row1['topic_kat'];
    echo '</td>';
    echo '</tr>';
    }
    ?>
  </tbody>
  <thead>
    <tr>
      <th scope="col">Innehåll i tråden</th>
      <th scope="col">Tid när innehållet skrev</th>
      <th scope="col">Skapad Av</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($db->query($query2) as $row2){
      echo '<tr>';
    echo '<td>';
    echo $row2['post_innehåll'];
    echo '</td>';
    echo '<td>';
    echo $row2['post_datum'];
    echo '</td>';
    echo '<td>';
    echo $row2['post_av'];
    echo '</td>';
    echo '</tr>';
    }
    ?>
  </tbody>
  </table>
</div>

<!-- Första Sektionens slut -->
<?php
include 'footer.php';
?>
