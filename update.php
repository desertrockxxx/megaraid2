<?php
require_once("header.php");

// get id 
$id = $_GET['id'];
?>


<div class="container col-sm-12">
    <div class="row">
        <div class="col-sm-12">
        <form id="send" method="POST" action="update.php?id=<?php echo $id;?>">
            <?php
            // SELECT
            $sql= "SELECT question FROM questions WHERE id=$id";
            // prepare statements
            $stmt = $conn->prepare($sql);
            // execute
            $stmt->execute();
            // show in form's placeholder
            $result = $stmt->fetchAll();
            foreach($result as $row){
                // fügt question und contetnt in die placeholder rein
                echo "<input type='text' name='question' placeholder='{$row['question']}'/>";
            }
            ?>
            <button type="submit" class="btn btn-success">Speichern</button>
            <button type="button" class="btn btn-danger" onclick="location.href='/';">Go Back</button>
            
        </form>
        
        <?php
        // UPDATE
        // wenn question und content gesetzt, dann updaten in Datenbank
        if (isset($_POST['question']) && !empty($_POST['question'])){
            $sql = "UPDATE questions SET question = :question WHERE id=$id";
            // prepare statements
            $stmt = $conn->prepare($sql);  
            // bind parameters
            $stmt->bindParam(':question', $_POST['question'], PDO::PARAM_STR);       
            // execute
            $stmt->execute(); 
            
            echo "Fragetitel zu " . $id . " geaendert";
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>