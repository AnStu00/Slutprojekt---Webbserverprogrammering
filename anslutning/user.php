<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "spacephone";

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

try{
  $db = new PDO("mysql:host={$dbHost};dbname={$dbName};charset=utf8", $dbUsername, $dbPassword, $options);
}
catch (PDOException $ex){
  die("Kunde inte ansluta till databasen: " . $ex->getMessage());
}
//Dessa attributer konfigurerar PDO att få tillbaka data från databasen i assosiativa arrayer.
//Som vi vet betyder detta att de kommer indexeras i strängar, där strängen representerar namnet på kollumnen i databasen.
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//Enligt min research kommer detta blocket att ta bort såkallade "magic quotes"
//Magic quotes är en dålig funktion som togs bort i php 5.4, men vissa äldre versioner kan fortfarande ha det aktiverat.
//Denna kod förebygger att magic quotes skapar problem.
//Hittade massa information om det här: http://php.net/manual/en/security.magicquotes.php
if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    function undo_magic_quotes_gpc(&$array) {
        foreach($array as &$value) {
            if (is_array($value)) {
                undo_magic_quotes_gpc($value);
            }
            else {
                $value = stripslashes($value);
            }
        }
    }
    undo_magic_quotes_gpc($_POST);
    undo_magic_quotes_gpc($_GET);
    undo_magic_quotes_gpc($_COOKIE);
}
//Denna koden säger till klienten(webbläsaren) att UTF-8 ska användas som teckenkodning.
header('Content-Type: text/html; charset=utf-8');

//Startar sessitionen
?>
