<?php
session_start();

$_SESSION['name'] = "Sinan1"; 

$name = $_SESSION['name'];

echo $name;
?>
<html>
<body>
<a href="sessiontest.php">sessiontest</a> und <a href="seite2.php">Seite2</a>

</body>
</html>