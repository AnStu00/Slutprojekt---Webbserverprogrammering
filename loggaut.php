<?php
//Anslutning samt sessionstart
require("anslutning/user.php");
//Vill bevara lite data, vill endast ta bort userdata d.v.s användardatan
unset($_SESSION['user']);
//Annars tar vi bort alla sessionsvariablar
$_SESSION= array();

//Tar inte bara bort sessionen utan även cookies
//Hittade detta online
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
//Tar sedan bort sessitionen
session_destroy();
header("Location: index.php");
die("Skickas vidare till: index.php");
?>
