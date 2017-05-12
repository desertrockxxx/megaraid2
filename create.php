<?php
require_once("header.php");

// get id 
$id = $_GET['id'];
?>

<div class="container col-sm-12">
    <div class="row">
        <div class="col-sm-12">
        <!--Frage neue Antworten hinzuzufügen-->
        <form id="send" method="POST" action="create.php?id=<?php echo $id;?>">
        <div>
            <input id="answer" type="text" name="answer" placeholder="new answer"/>
        </div>
        <div>
            <input id="file_upload" type="text" name="file_upload" placeholder="new file_upload"/>
        </div>
        <div>
            <select class="form-control" id="sel1" name="mindset" style="width:175px">
                <option>Advantage</option>
                <option>Disadvantage</option>
                <option>Argument</option>
                <option>Counter-argument</option>
                <option>Thesis</option>
                <option>Antithesis</option>
            </select>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Create New Answer</button>
            <button type="button" onclick="location.href='/read.php?id=<?php echo $id;?>';" 
                class="btn btn-danger">Go Back to Question 10</button>
        </div>
        </form>
        
        
        <?php
        // INSERT
        // Wenn answer und file_upload gesetzt, dann beide in Tabelle answer einfügen
        
        if(isset($_POST['answer']) && !empty($_POST['answer']) &&
            isset($_POST['file_upload']) && !empty($_POST['file_upload']) &&
            isset($_POST['mindset']) && !empty($_POST['mindset']))
            {
            // put data in answers 
            $sql = "INSERT INTO answers(answer, file_upload, mindset, question_id) VALUES (:answer, :file_upload, :mindset, :question_id)";
            // prepare statement                                      
            $stmt = $conn->prepare($sql);
            // bind parameters                                             
            $stmt->bindParam(':answer', $_POST['answer'], PDO::PARAM_STR);       
            $stmt->bindParam(':file_upload', $_POST['file_upload'], PDO::PARAM_STR);
            $stmt->bindParam(':mindset', $_POST['mindset'], PDO::PARAM_STR); 
            $stmt->bindParam(':question_id', $id, PDO::PARAM_STR); 
            // execute                                
            $stmt->execute();
        
            echo "Antwort erstellt zu " . $id . "!";
        }
        ?>
        </div>
    </div> 
</div>
        
</body>
</html>
