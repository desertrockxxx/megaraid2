
<h3>Normal Query</h3>
<?php
$sql = "SELECT * FROM easytable";
foreach($conn->query($sql) as $row){
    echo "<li>{$row['id']}</li>";
    echo "<li>{$row['title']}</li>";
    echo "<li>{$row['content']}</li>";
}
?>

<h3>Prepstat Query</h3>
<?php
$sql= "SELECT * FROM easytable";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
foreach($result as $row){
    echo "<li>{$row['id']}</li>";
    echo "<li>{$row['title']}</li>";
    echo "<li>{$row['content']}</li>";
}
?>