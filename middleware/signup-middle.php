<?php
require "../classes/user.php";
require "../classes/Database.php";

$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];
$passwordconfirm=$_POST["passwordConfirm"];

$pdo = new Database();

$user=new user($username,$email,$password,$passwordconfirm);
$user->establishConnection($pdo->getConnection());

if($user->signup($user)){
    header("Location: ../views/index.php");
}

?>