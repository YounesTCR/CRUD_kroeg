<?php
// functie: Updating an database cell.
// auteur: Younes Et-Talby

    require_once('functions.php');
    echo "<h1>Insert 'Kroeg'</h1>";
    
    if(isset($_POST) && isset($_POST['insert'])){
        CreateKroeg($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert 'Kroeg'</title>
    </head>
    <body>
        <form action="#" method="post">
            <input type="number" name="kroegcode" id="#" hidden><br>
            <label for="1">Kroeg naam: </label><input type="text" name="kroegnaam" value="" id="1" required><br>
            <label for="2">Adres: </label><input type="text" name="adres" value="" id="2" required><br>
            <label for="3">Plaats: </label><input type="text" name="plaats" value="" id="3" required><br><br>
            <br><input type="submit" name="insert" value="Insert" id="insert">
        </form>
    <a href="crud.php">Return to CRUD</a>
    </body>
</html>