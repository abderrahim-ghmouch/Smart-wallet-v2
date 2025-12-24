<?php 
    require_once __DIR__ ."/classes/Database.php";
    $databse = new database("localhost","Smart-wallet","abdo","abdoabdo");
    $pdo = $database->getConnection();