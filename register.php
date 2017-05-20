<?php
session_start(); 

require_once("header.php");
?>

<div class="container col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h3>Login as User</h3>
            <!--Formular um neue Datensätze hinzuzufügen-->
            <form id="send" method="POST" action="login.php">
            <input id="username" type="text" name="username" placeholder="add new user" required/>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
            <?php
            // INSERT
            // Wenn title und content gesetzt, dann beide in Datenbank einfügen
            if (isset($_POST['username'])){
                // put data in easytable 
                $sql = "INSERT INTO users(username) VALUES (:username)";
                // prepare statement                                      
                $stmt = $conn->prepare($sql);
                // bind parameters                                             
                $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);       
                // execute                                
                $stmt->execute(); 
            }
            ?>
        </div>
    </div>
</div>

<a href="index.php">Home</a>

</body>
</html>

