<?php
$sidtitel = "Adminsida";
include 'header.php';
if(isset($_POST['admin'])){
include 'nav.php';
if ($_SESSION['user']['status'] == 1){

  $query = "SELECT id, first_name, last_name, email, telefon, skapad, changed, status FROM users";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Kunde inte hämta alla användare: " . $ex->getMessage());
  }
  $rows = $stmt->fetchAll();
?>
<!-- Första Sektionen -->
<section class="page-top-section set-bg" data-setbg="img/topp-på-sida.jpg">
    <div class="container">
            <h2>Administrationsida</h2>
            <div class="site-breadcrumb">
                <a href="index.php">Hem</a> / <a href="usersite.php">Användarsida</a> / <span>Administrationsida</span>
                    </div>
            </div>
</section>
<!-- Första Sektionens slut -->
<h2>Alla registrerade användare</h2>
<table class="table table-hover">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Förnamn</th>
        <th scope="col">Efternamn</th>
        <th scope="col">Email</th>
        <th scope="col">Telefon</th>
        <th scope="col">Skapad</th>
        <th scope="col">Ändrad</th>
        <th scope="col">Admin</th>
    </tr>
    <?php foreach($rows as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlentities($row['first_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['last_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['telefon'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['skapad'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlentities($row['changed'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php if($row['status'] == 1){echo "Ja";} else{echo "Nej";}; ?></td>
        </tr>
    <?php endforeach; ?>
  </table>
  <h2>Ta bort användare</h2>
  <form action="tabort.php" method="post">
  <div class="form-row align-items-center">
    <div class="col-auto my-1">
      <label class="mr-sm-2">(Om du bekräftar att ta bort en användare, går det ej att ångra!)</label>
      <select class="custom-select mr-sm-2" name="person" value ="<?php $variabel ?>">
        <option selected name="">Välj Användare...</option>
  <?php foreach($rows as $row): ?>
        <option name="person23"><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8');?></option>
        <?php endforeach; ?>
      </select>
    </div>
    </div>
    <div class="col-auto my-1">
      <button type="submit" name="tabort" class="btn registreraknapp">Ta bort användare</button>
    </div>
  </div>
</form>
<?php
include 'footer.php';
}
else{
  echo "Behörighet Saknas";
}
}
 ?>
