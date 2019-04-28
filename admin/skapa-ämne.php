<?php
include "../header.php";
include '../nav.php';

if(empty($_SESSION['user'])){
  header("Location: login.php");
  die("Skickar vidare till login.php");
}
if(isset($_POST['submit'])){

  $topic_subject = $_POST['topic_subject'];
  $topic_kat = $_POST['topic_kat'];
	$topic_datum = date("Y-m-d H:i:s");
	$topic_av = $_SESSION['user']['first_name'];

//Genererar en random ID för att jag ska få samma på de 2 olika tabellerna vilket gör att jag kan hämta det enkelt och säkert.
  $id = $randomNumber = rand();
  $posts_innehåll = $_POST['posts_innehåll'];

  $query = "INSERT INTO ämne(topic_id, topic_subject, topic_datum, topic_kat, topic_av) VALUES ('$id', '$topic_subject', '$topic_datum', '$topic_kat', '$topic_av')";
  try{
    $stmt = $db->prepare($query);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Det uppstod lite problem när skapandet skulle ske:" . $ex->getMessage());
		var_dump($query);
  }
  $query1 = "INSERT INTO posts(post_id, post_innehåll, post_datum, post_ämne, post_av) VALUES ('$id', '$posts_innehåll', '$topic_datum', '$topic_kat', '$topic_av')";
  try{
    $stmt = $db->prepare($query1);
    $stmt->execute();
  }
  catch(PDOException $ex){
    die("Det uppstod lite problem när skapandet skulle ske:" . $ex->getMessage());
    var_dump($query);
  }
	echo "Inlägget har gjorts!";
}

$query = "SELECT * FROM kategorier";

echo '<form method="post" action="skapa-ämne.php">
									 Ämne: <input type="text" name="topic_subject" />
									 Kategori:';
							 echo '<select name="topic_kat">';
									 foreach ($db->query($query) as $row)
									 {
											 echo '<option value="' . $row['kat_id'] . '">' . $row['kat_namn'] . '</option>';
									 }
							 echo '</select>';

							 echo 'Medelande: <textarea name="posts_innehåll" /></textarea>
									 <input type="submit" name="submit" value="Gör inlägget" />
								</form>';
?>
