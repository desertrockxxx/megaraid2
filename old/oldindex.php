
<?php

if(count($_GET) > 0) {
    
    
    
    $id = $_GET['id'];
    $titel = $_GET['titel'];
    $inhalt = $_GET['inhalt'];
    $beitraege = $_GET;
    

if(isset($id, $titel, $inhalt) && !empty($id))
{
    
   
        echo '<tr><td>' . $id . '</td>';
        echo '<td>' . $titel . '</td>';
        echo '<td>' . $inhalt . '</td></tr>';

}   
} else {
    
    ?>
    <html>
<body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<form id="send" method="GET" action="index.php">
<input id="id" type="text" name="id" placeholder="id"/>
<input id="title" type="text" name="titel" placeholder="titel"/>
<input id="content" type="text" name="inhalt" placeholder="inhalt"/>

<input type="submit" value="Bestaetigen"></input>
</form>

<div>
    <table id="out" style="width:100%">
  <tr>
    <th>ID</th>
    <th>Title</th> 
    <th>Content</th>
  </tr>



</table>

</div>

<script type="application/javascript">
    var count = 1;
    
    $("#send").submit(function(ev) {
        
        ev.preventDefault();
    
        var text = "id=" + count + "&titel=" + encodeURIComponent($("#title").val())  +"&inhalt=" + encodeURIComponent($("#content").val());
                    count++;

        $.get("index.php?" + text, function(data) {
            
            $("#out").append(data);
            
            
        });
        
    });
</script>
</body>
</html>

    
    <?php
}





