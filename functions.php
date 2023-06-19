<?php
// functie: Algemene functies voor 'crud.php'.
// auteur: Younes Et-Talby

 function ConnectDb(){
    $servername = "localhost";
    $username = "Younes";
    $password = "";
    $dbname = "bieren";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function GetData($table){
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM $table");
    $query->execute();
    $result = $query->fetchAll();   
    return $result;
}

function GetKroeg($kroegcode){
    $conn = ConnectDb();
    $query = $conn->prepare("SELECT * FROM kroeg WHERE kroegcode = $kroegcode");
    $query->execute();
    $result = $query->fetch();
    return $result;
}

function OvzKroegen(){
    $result = GetData("kroeg");
    PrintTable($result);
}

function OvzBrouwers(){
   $result = GetData("brouwer");
   PrintTable($result);  
}

function PrintTableTest($result){
   $table = "<table border = 1px>";
   foreach ($result as $row) {
       echo "<br> rij:";

       foreach ($row as  $value) {
           echo "kolom" . "$value";
       }          
   }
}

function BrouwerOpties(){
    $result = GetData("kroeg");

    foreach($result as &$data){
        echo'<option value="'.$data['brouwcode'].'">'.$data['naam'].'</option>';            
    }
}

// Function 'PrintTable' print een HTML-table met data uit $result.
function PrintTable($result){
    $table = "<table border = 1px>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }

    foreach ($result as $row) {  
        $table .= "<tr>";
        
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        $table .= "</tr>";
    }
    $table.= "</table>";
    echo $table;
}

// Function 'CrudKroegen' shows the table of kroegen.
function CrudKroegen(){
    $result = GetData("kroeg");
    PrintCrudKroeg($result);
}



// Function 'CreateKroeg' allows the user to create a new kroeg.
function CreateKroeg($row){
    echo '<h3> Insert row. </h3>';
    echo '<br>';
    try {
        $conn = ConnectDb();

        $kroegcode = $_POST['kroegcode'];
        $naam = $_POST['kroegnaam'];
        $adres = $_POST['adres'];
        $plaats = $_POST['plaats'];
        
        $sql = "INSERT INTO `kroeg` 
        (`kroegcode`, `naam`, `adres`, `plaats`) 
        VALUES ('$kroegcode', '$naam', '$adres', '$plaats')";

        $query = $conn->prepare($sql);
        $query->execute();
    } 
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

function PrintCrudKroeg($result){
    $table = "<table border = 1px>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th bgcolor=gray>" . $header . "</th>";   
    }

    foreach ($result as $row) {
        
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";
        }
        
        $table .= "<td>". 
            "<form method='post' action='update_kroeg.php?kroegcode=$row[kroegcode]' >       
                    <button name='btn_edit'>Edit</button>	 
            </form>" . "</td>";

        $table .= "<td>". 
        "<form method='post' action='delete_kroeg.php?kroegcode=$row[kroegcode]' >       
                <button name='btn_del'>Delete</button>	 
        </form>" . "</td>";
    }
    $table.= "</table>";

    echo $table;
}

// Function 'UpdateKroeg' allows the user to update an existing kroeg data.
function UpdateKroeg($row){
    echo '<h3> Update row. </h3>';
    echo '<br>';
    try {
        $conn = ConnectDb();
        $sql = "UPDATE `kroeg` 
                SET 
                    `naam` = '$row[naam]', 
                    `adres` = '$row[adres]', 
                    `plaats` = '$row[plaats]' 
                WHERE `kroeg`.`kroegcode` = $row[kroegcode]";
        $query = $conn->prepare($sql);
        $query->execute();
    } 
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

function DeleteKroeg($kroegcode){
    echo 'Deleted row. <br>';
    try {
        $conn = ConnectDb();
        $sql = "DELETE FROM kroeg WHERE `kroeg`.`kroegcode` = :kroegcode";
        $query = $conn->prepare($sql);
        $query->bindParam(':kroegcode', $kroegcode);
        $query->execute();
    } 
    catch(PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
}

?>