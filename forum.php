<?php
include 'header.php';
include 'nav.php';

$query = "SELECT * FROM kategorier";
$query1 = "SELECT * FROM ämne";
$query2 = "SELECT * FROM poster";
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

<div class="table-responsive-sm">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Kategorier</th>
      <th scope="col">Alla Inlägg</th>
      <th scope="col">Kommentarer</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach ($db->query($query) as $row){
  echo '<tr>';
echo '<td>';
echo $row['kat_namn'];
echo '</td>';
echo '</tr>';
}
foreach ($db->query($query1) as $row){
echo '<td>';
echo $row['topic_subject'];
echo '</td>';
}
?>
  </tbody>
  </table>
</div>
<!-- Första Sektionens slut -->
<?php
include 'footer.php';
?>
