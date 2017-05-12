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
                    <th>Title</th>
        
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
    </div>
    <div class="row">
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
        WHERE mindset = 'Pro' AND question_id = $id";
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
        </div>
        <div class="col-sm-6">
        <!--Contra Section-->
        <table class="table table-bordered" style="width:400px">
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
        WHERE mindset = 'Contra' AND question_id = $id";
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

