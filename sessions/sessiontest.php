<?php
session_start();

$_SESSION['name'] = "Sinan"; 

$name = $_SESSION['name'];

echo $name;


// Überprüfen ob Sessionid schon gibt
if (!isset($_SESSION['visited'])) {
   echo "Du hast diese Seite noch nicht besucht";
   $_SESSION['visited'] = true;
} else {
   echo "Du hast diese Seite zuvor schon aufgerufen";
}


// Überprüfen ob eingeloggt 
if (isset($_SESSION['username'])) {
   echo "Herzlich Willkommen ".$_SESSION['username'];
} else {
   echo "Bitte erst einloggen";
}

// Alle Sessionids löschen
session_destroy();

// Eine einzige Sessionid lösen
unset($_SESSION['name']);

?>
<html>
<body>
<a href="seite1.php">Seite1</a> und <a href="seite2.php">Seite2</a>
</body>
</html>