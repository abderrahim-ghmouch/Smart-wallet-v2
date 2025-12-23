<?php
$host="localhost";
$dbname="smart-wallet";
$username="abdo";
$password="abdoabdo";
try{

    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
}catch(PDOException $e)
{echo "your connection is failed".$e->getmessage();
}

