<?php
require_once("header.php");

// get id 
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>

<div class="container col-sm-12">
    <div class="row">
        <!-- Anzeige der gewählten Frage -->
        <div class="col-sm-12">
            <table class="table table-bordered table-striped" style="width:300px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                </tr>
            </thead>
            <tbody>
             <?php
            // SELECT
            $sql= "SELECT * FROM questions WHERE id = $id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $row){
                echo "<tr><td>{$row['id']}</td>";
                echo "<td>{$row['question']}</td>";
                echo "</tr>";
                }
            ?>   
            </tbody>
            </table>
        </div>
        
        <div class="col-sm-6">
        <!--Pro Section-->
        <table class="table table-bordered table-striped" style="width:400px">
            <thead>
                <tr>
                    <th>Vorteile</th>
                    <th>Beweise</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // SELECT
        $sql= "SELECT answer, file_upload FROM answers 
        WHERE mindset = 'Advantage' AND question_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        
        <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>&mindset=Advantage';">Create New Advantage</button>
        
        </div>
        
        
        
        <div class="col-sm-6">
        <!--Contra Section-->
        <table class="table table-bordered table-striped" style="width:400px">
            <thead>
                <tr>
                    <th>Nachteile</th>
                    <th>Beweise</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // SELECT
        $sql= "SELECT answer, file_upload FROM answers 
        WHERE mindset = 'Disadvantage' AND question_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        
        <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>&mindset=Disadvantage';">Create New Disadvantage</button>
        
        </div>
    </div>
    <!-- TEST TEST TEST -->
    <div class="row">
        <div class="col-sm-6">
        <!--Argument Section-->
        <table class="table table-bordered table-striped" style="width:400px">
            <thead>
                <tr>
                    <th>Argument</th>
                    <th>Beweise</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // SELECT
        $sql= "SELECT answer, file_upload FROM answers 
        WHERE mindset = 'Argument' AND question_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        
        <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>&mindset=Argument';">Create New Argument</button>
        
        </div>
        <div class="col-sm-6">
        <!--Counter-argument Section-->
        <table class="table table-bordered table-striped" style="width:400px">
            <thead>
                <tr>
                    <th>Gegenargument</th>
                    <th>Beweise</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // SELECT
        $sql= "SELECT answer, file_upload FROM answers 
        WHERE mindset = 'Counter-argument' AND question_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        
        <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>&mindset=Counter-argument';">Create New Counter-argument</button>
        
        </div>
    </div>
    
    <!-- TEST TEST TEST -->
    <div class="row">
        <div class="col-sm-6">
        <!--Thesis Section-->
        <table class="table table-bordered table-striped" style="width:400px">
            <thead>
                <tr>
                    <th>These</th>
                    <th>Beweise</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // SELECT
        $sql= "SELECT answer, file_upload FROM answers 
        WHERE mindset = 'Thesis' AND question_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        
        <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>&mindset=Thesis';">Create New Thesis</button>
        
        </div>
        <div class="col-sm-6">
        <!--Antithesis Section-->
        <table class="table table-bordered table-striped" style="width:400px">
            <thead>
                <tr>
                    <th>Antithese</th>
                    <th>Beweise</th>
                </tr>
            </thead>
            <tbody>
        <?php
        // SELECT
        $sql= "SELECT answer, file_upload FROM answers 
        WHERE mindset = 'Antithesis' AND question_id = $id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach($result as $row){
            echo "<tr><td>{$row['answer']}</td>";
            echo "<td>{$row['file_upload']}</td>";
            echo "</tr>";
        }
        ?>
            </tbody>
        </table>
        
        <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>&mindset=Antithesis';">Create New Antithesis</button>
        
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-sm-12">
            <!--INNER JOIN Alle Antworten zu der Frage-->
            <h3>All Answers to <?php echo $id;?></h3> 
            <table class="table table-bordered table-striped" style="width:800px">
                <thead>
                    <tr>
                        <th>Antworten</th>
                        <th>Beweise</th>
                        <th>Mindset</th>
                    </tr>
                </thead>
                <tbody>
            <?php
            // SELECT
            $sql= "SELECT questions.question, answer, answers.file_upload, answers.mindset 
            FROM questions INNER JOIN answers ON questions.id = answers.question_id 
            WHERE questions.id = $id ";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            foreach($result as $row){
                echo "<tr><td>{$row['answer']}</td>";
                echo "<td>{$row['file_upload']}</td>";
                echo "<td>{$row['mindset']}</td>";
                echo "</tr>";
            }
            ?>
                </tbody>
            </table>

            <button type="button" class="btn btn-success" onclick="location.href='/create.php?id=<?php echo $id;?>';">Create New Answer</button>
            <button type="button" class="btn btn-primary" onclick="location.href='/';">Create New Question</button>
            <button type="button" class="btn btn-danger" onclick="location.href='/';">Go Back</button>
        </div>
    </div>
</div> 

</body>    
</html>

