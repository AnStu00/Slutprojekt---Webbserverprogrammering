<?php
$sidtitel = "Adminsida";
include 'header.php';
if(isset($_POST['admin'])){

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "spacephone";

  // Skapa anslutning
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Kolla anslutning
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

?>
<table class="table table-hover">
    <thead>
        <tr class="">
            <th>Id</th>
            <th>Namn</th>
            <th>Telefon</th>
            <th>Skapad</th>
            <th>Ändrad</th>
            <th>Admin</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $sql = "SELECT * FROM users ORDER by id";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['first_name'].$row['last_name']."</td>";
            echo "<td>".$row['telefon']."</td>";
            echo "<td>".$row['skapad']."</td>";
            echo "<td>".$row['changed']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "</tr>";
        }
      }
        ?>
    </tbody>
</table>

<form>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Ta bort Användare</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <?php
      var_dump($result);
      echo "hej!";
      $sql = "SELECT * FROM users ORDER by id";
      $result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result))
{
  echo "<option>".$row[first_name].$row[last_name]."</option>";
}
      ?>
    </select>
  </div>
   <button type="submit" class="btn registreraknapp" onsubmit="return confirm('Är du säker på att du vill ta bort användaren?');">Ta bort användare</button>
    <input type="submit" name="completeYes" value="" />
</form>


<?php
}
else{
  echo "Behörighet Saknas";
}
 ?>
