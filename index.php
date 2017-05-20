<?php
require_once("header.php");
?>

<!-- Sessions Test-->
<?php
$username = $_POST['username'];
 
if(!isset($username) OR empty($username)) {
   $username = "Gast";
}
 
//Session registieren
$_SESSION['username'] = $username;
 
//Text ausgeben
echo "Hallo $username <br />
<a href='logout.php'>Logout</a>  <br />
<a href='index.php'>Home</a>  <br />
<a href='register.php'>Register</a>";
?>


<!-- Sessions Test Ende-->

 
<div class="container col-sm-12">
    <div class="row">
        <div class="col-sm-12">
            <h3>Questions</h3>
            <!--Formular um neue Fragen hinzuzufügen-->
            <form id="send" method="POST" action="index.php">
            <input id="question" type="text" name="question" placeholder="add new question" required/>
            <select style="width:150px" class="form-control" id="categorie_id" name="categorie_id">
            <?php
                // SELECT from categorie die id und categorie name gebe als foreach aus
                $sql= "SELECT id, categorie FROM categories";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach($result as $row){
                    echo "<option value='{$row['id']}'>{$row['categorie']}</option>";
                }
            ?>
            </select>
            <button type="submit" class="btn btn-primary">Create New Question</button>
            </form>
            
            <?php
            // INSERT
            // Wenn title und content gesetzt, dann beide in Datenbank einfügen
            if (isset($_POST['question']) && isset($_POST['categorie_id'])){
                // put data in questions 
                $sql = "INSERT INTO questions (question, categorie_id) VALUES (:question, :categorie_id)";
                // prepare statement                                      
                $stmt = $conn->prepare($sql);
                // bind parameters                                             
                $stmt->bindParam(':question', $_POST['question'], PDO::PARAM_STR);  
                $stmt->bindParam(':categorie_id', $_POST['categorie_id'], PDO::PARAM_STR); 
                // execute                                
                $stmt->execute(); 
                
                echo "Frage erfolgreich erstellt";
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Tabelle um Datensätze anzuzeigen-->
            <table class="table table-bordered table-striped" style="width:800px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Categorie</th>
                    <th>Read</th>
                    <th>Update</th>
                    <th>Delete</th>
                    <th>Wiki</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SELECT sortiert ausgeben nach id
                $sql= "SELECT questions.id, questions.question, categories.categorie FROM questions
                INNER JOIN categories ON questions.categorie_id = categories.id
                ORDER BY questions.id ASC";
                // SELECT table1.column1, table2.column2...
                // FROM table1
                // INNER JOIN table2
                // ON table1.common_field = table2.common_field;
                
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach($result as $row){
                    echo "<tr><td>{$row['id']}</td>";
                    echo "<td> {$row['question']}</td>";
                    echo "<td> {$row['categorie']}</td>";
                    // Lesen von Datensätzen
                    echo "<td><a href='read.php?id={$row['id']}'>read</a></td>";
                    // Link der zu update.php führt und id von Beitrag dranhängt
                    echo "<td><a href='update.php?id={$row['id']}'>o</a></td>";
                    // führt zu index.php und hängt id an delete an
                    echo "<td><a href='?delete={$row['id']}'>x</a></td>";
                    echo "<td><a href='https://de.wikipedia.org/wiki/{$row['question']}' target='_blank'>wiki</a></td>";
                    echo "</tr>";
                }
            
                // wenn delete=id gesetzt, dann löschen
                if(isset($_GET['delete']) &&
                    !empty($_GET['delete'])){
                    // nimm die delete=id
                    $delID = $_GET['delete'];
                    // DELETE
                    $sql = "DELETE FROM questions WHERE id = $delID";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $_GET['delete'], PDO::PARAM_INT);   
                    $stmt->execute();
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h3>Categories</h3>
            <!--Formular um neue Kategorien hinzuzufügen-->
            <form id="send" method="POST" action="index.php">
            <input id="categorie" type="text" name="categorie" placeholder="add new categorie" required/>
            <button type="submit" class="btn btn-primary">Create New Categorie</button>
            </form>
            
            <?php
            // INSERT
            // Wenn categorie gesetzt, dann beide in Datenbank einfügen
            if (isset($_POST['categorie'])){
                // put data in easytable 
                $sql = "INSERT INTO categories(categorie) VALUES (:categorie)";
                // prepare statement                                      
                $stmt = $conn->prepare($sql);
                // bind parameters                                             
                $stmt->bindParam(':categorie', $_POST['categorie'], PDO::PARAM_STR);       
                // execute                                
                $stmt->execute(); 
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <!-- Categorie Tabelle Datensätze anzuzeigen-->
            <table class="table table-bordered table-striped" style="width:800px">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categories</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SELECT
                $sql= "SELECT * FROM categories";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();
                foreach($result as $row){
                    echo "<tr><td>{$row['id']}</td>";
                    echo "<td> {$row['categorie']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            
            <button class="btn btn-info" data-toggle="collapse" data-target="#mindsetinfo">Mindset Info</button>
            <div id="mindsetinfo" class="collapse">
            <ul>
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] positiver Aspekt oder Effekt einer Sache
                [2] im Mannschaftssport eine bestimmte Situation zugunsten einer beteiligten Mannschaft
                [3] Tennis: Spielstand nach einem Punkt, der nach einem Einstand (40:40) erzielt wurde
                Herkunft:
                Bildung aus Präposition vor und Nomen Teil</pre>
                ">Vorteil / Advantage</a></li>
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] eine negative oder unerwünschte Folge oder ein negativer Nebeneffekt, 
                zum Beispiel einer Lösung, eines Vorgehens, einer Überlegung
                Herkunft:
                im 15. Jahrhundert aus dem länger bestehenden Wort Vorteil entstanden.[1]
                ">Nachteil / Disadvantage</a></li>

                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] eine Aussage oder eine Kette von Schlussfolgerungen, 
                die zur Begründung einer anderen Aussage (oder Behauptung) herangezogen wird
                [2] Linguistik: in der Rektions-Bindungs-Theorie Ausdrücke/Ergänzungen, 
                die eine Theta-Rolle, eine bestimmte semantische Funktion, ausüben
                [3] Mathematik: unabhängige Veränderliche einer Funktion
                Herkunft:
                mittelhochdeutsch argument von lateinisch argumentum → la zu arguere → la[1]
                ">Argument</a></li>
                
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] Argument gegen ein anderes, gegen etwas
                Herkunft:
                Determinativkompositum aus gegen und Argument
                ">Gegenargument / Counter-argument</a></li>
                
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] eine noch nicht bewiesene Behauptung
                Herkunft:
                griechisch θέσις (thésis) → grc: „aufgestellter Satz, Behauptung“ 
                [Quellen fehlen]
                ">These / Thesis</a></li>
                
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] Gegenbehauptung; einer These entgegengestellte These
                [2] Rhetorik: Teil einer Redefigur, in der ein Gegensatz besonders betont wird
                Herkunft:
                griech. ἀντίθεσις (antíthesis) „Gegensatz“
                ">Antithese / Antithesis</a></li>
                
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] Chemie: der Aufbau einer komplizierten chemischen Verbindung aus einfachen Bestandteilen
                [2] Philosophie: Verbindung zweier gegensätzlicher Begriffe oder Aussagen (These und Antithese) zu einer höheren Einheit
                [3] Philosophie: die so gewonnene Einheit selber
                [4] Aufbau, Verbindung von verschiedenen Teilen zu einem Ganzen
                Herkunft:
                im 17. Jahrhundert von lateinisch synthesis → la ins französisch synthèse → fr übernommen[1]
                im 18. Jahrhundert von spätlateinisch synthesis → la entlehnt, 
                das auf griechisch σύνθεσις (sýnthesis) → grc „die Zusammensetzung, 
                Zusammenfassung, Verknüpfung“ zurückgeht[2]; zu: griechisch συντιθέναι 
                (syntithénai) → grc „zusammensetzen, zusammenstellen, zusammenfügen“; abgeleitet aus: σύν (sýn) → 
                grc „zusammen“ und τιθέναι (tithénai) → grc „setzen, stellen, legen“ [3][4]
                ">Synthese / Synthesis</a></li>
                
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] Wissenschaft: unbewiesene (wissenschaftliche) Annahme, die noch eines Beweises bedarf
                [2] allgemein: bloße Annahme, Behauptung ohne Beleg
                Abkürzungen:
                Hyp.
                Herkunft:
                im 18. Jahrhundert von mittellateinisch hypothesis → la „Annahme“ entlehnt, 
                das auf griechisch ὑπόϑεσις (hypóthesis) → grc zurückgeht[1]
                ">Hypothese / Hypothesis</a></li>
                
                
                <li><a href="#" data-toggle="tooltip" title="
                Bedeutungen:
                [1] etwas Tatsächliches, Verifiziertes
                Herkunft:
                Entlehnt aus lateinisch factum → la „das Geschehene, 
                Handlung, Tat“, gebildet zu facere → la „machen, tun“[1]
                Synonyme:
                [1] Tatsache, Fakt; veraltend: Fakta
                ">Faktum / Fact</a></li>
            </ul>

            </div>
            <p>Advantage, Disadvantage, Argument, Counter-argument, Thesis, Antithesis, Hypothesis & Fact </p>
            <p>Quellen: <a href="https://de.wiktionary.org/wiki/" target="_blank">Wiktionary</a></p>
        </div>
    </div>
</div>

</body>    
</html>
