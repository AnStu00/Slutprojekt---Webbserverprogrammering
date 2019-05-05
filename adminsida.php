<?php
$sidtitel = "Adminsida";
include 'header.php';
if(isset($_POST['admin'])){
include 'nav.php';
if ($_SESSION['user']['status'] == 0){

  $rows = [];
  $query = "SELECT id, first_name, last_name, email, telefon, skapad, changed, status FROM users";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }

  catch(PDOException $ex){
    die("Kunde inte hämta alla användare: " . $ex->getMessage());
  }
  $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  $igenomloopat = 0;
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
        <th scope="col">Ta Bort Användare</th>
        <th scope="col">Ändra Användare</th>
    </tr>
    <?php foreach($result as $row => $rs):
          $rows [] = $rs;
    ?>
        <tr>
            <td><?php echo $rows[$igenomloopat]['id']; ?></td>
            <td><?php echo htmlentities($rows[$igenomloopat]['first_name'], ENT_QUOTES, 'UTF-8');?></td>
            <td><?php echo htmlentities($rows[$igenomloopat]['last_name'], ENT_QUOTES, 'UTF-8');?></td>
            <td><?php echo htmlentities($rows[$igenomloopat]['email'], ENT_QUOTES, 'UTF-8');?></td>
            <td><?php echo htmlentities($rows[$igenomloopat]['telefon'], ENT_QUOTES, 'UTF-8');?></td>
            <td><?php echo htmlentities($rows[$igenomloopat]['skapad'], ENT_QUOTES, 'UTF-8');?></td>
            <td><?php echo htmlentities($rows[$igenomloopat]['changed'], ENT_QUOTES, 'UTF-8');?></td>
            <td><?php if($rows[$igenomloopat]['status'] == 1){echo "Ja";} else{echo "Nej";}; ?></td>
            <form action="admin/tabort.php" method="post">
            <td><button type="submit" name="tabort" value="<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn registreraknapp">Ta Bort Användare</button></td>
          </form>
          <form action="change.php" method="post">
          <td>
            <button type="button" class="btn registreraknapp" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Ändra Användare</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ändra användarinformation för <?php echo htmlentities($row['first_name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="admin/change.php" method="post">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Förnamn</label>
                        <input type="text" class="form-control" value="<?php echo htmlentities($rows[$igenomloopat]['first_name'], ENT_QUOTES, 'UTF-8');?>">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Efternamn</label>
                        <input type="text" class="form-control" value="<?php echo htmlentities($rows[$igenomloopat]['last_name'], ENT_QUOTES, 'UTF-8');?>">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Telefon</label>
                        <input type="text" class="form-control" value="<?php echo htmlentities($rows[$igenomloopat]['telefon'], ENT_QUOTES, 'UTF-8');?>">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email</label>
                        <input type="text" class="form-control" value="<?php echo htmlentities($rows[$igenomloopat]['email'], ENT_QUOTES, 'UTF-8');?>">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">ID</label>
                        <input type="text" class="form-control" value="<?php echo htmlentities($rows[$igenomloopat]['id'], ENT_QUOTES, 'UTF-8');?>">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Adminstatus</label>
                        <input type="text" class="form-control" value="<?php echo htmlentities($rows[$igenomloopat]['status'], ENT_QUOTES, 'UTF-8');?>">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
                    <button type="submit" name="submit" class="btn registreraknapp">Ändra Information</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </form>
        </tr>
        <?php $igenomloopat++;?>
    <?php endforeach; ?>
  </table>
  <h2>Lägg till kategori i forumet</h2>
  <form method="post" action="admin/skapa-kategori.php">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Namn</label>
    <div class="col-sm-10">
      <input type="kat_namn" name="kat_namn" class="form-control" id="inputEmail3" placeholder="Kategori">
    </div>
  </div>
  <div class="form-group">
      <label for="exampleFormControlTextarea1">Kategoriens Detaljer</label>
        <div class="col-sm-10">
      <textarea class="form-control" name="kat_beskrivning" id="exampleFormControlTextarea1"></textarea>
    </div>
    </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Lägg till</button>
    </div>
  </div>
</form>

<?php
include 'footer.php';
}
else{
  header ('Location: index.php');
}
}
 ?>
