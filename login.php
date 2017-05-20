<?php
session_start(); //Nicht vergessen
$username = $_POST['username'];
 
if(!isset($username) OR empty($username)) {
   $username = "Gast";
}
 
//Session registieren
$_SESSION['username'] = $username;
 
//Text ausgeben
echo "Hallo $username <br />
<a href=\"logout.php\">Logout</a>";
?>

<a href="index.php">Home</a>
<a href="register.php">Register</a>