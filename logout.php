<?php
session_start();
session_destroy();
echo "Logout erfolgreich <br />
<a href='index.php'>Home</a>  <br />
<a href='register.php'>Register</a>";
?>

