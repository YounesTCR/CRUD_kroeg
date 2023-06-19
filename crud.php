<?php
// functie: CRUD Systeem
// auteur: Younes Et-Talby

include 'functions.php';

echo "<h1>CRUD KROEG</h1>";

echo "<form method='post' action='insert_kroeg.php'> 
      <button name='btn_insert'>Insert New Kroeg</button></form>";

CrudKroegen();
?>