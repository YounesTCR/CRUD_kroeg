<?php
// functie: Updating an database cell.
// auteur: Younes Et-Talby

    require_once('functions.php');
    echo "<h1>Edit 'Kroeg'</h1>";
    
    if(isset($_POST) && isset($_POST['edit'])){
        UpdateKroeg($_POST);
    }

    if(isset($_GET['kroegcode'])){
        echo "Selected data cell: <br>";
        $kroegcode = $_GET['kroegcode'];
        $row = GetKroeg($kroegcode);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <form action="#" method="post">
        <input type="number" name="kroegcode" value="<?php echo $_GET['kroegcode']?>" id="0" hidden required><br>
        <label for="1">Naam: </label><input type="text" name="naam" value="<?=$row['naam']?>" id="1" required><br>
        <label for="2">Adres: </label><input type="text" name="adres" value="<?=$row['adres']?>" id="2" required><br>
        <label for="3">Plaats: </label><input type="text" name="plaats" value="<?=$row['plaats']?>" id="3" required><br>
        <br>
        <input type="submit" name="edit" value="Edit" id="edit">
    </form>    

    <a href="crud.php">Return to CRUD</a>
</body>
</html>