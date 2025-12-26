<?php
require "../Models/User.php";
require "../Models/Database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $passwordconfirm=$_POST["passwordConfirm"];

    $user= new User($username,$email,$password,$passwordconfirm);

    if($user->signup()){
        header("Location: /index.php");
    }else{
        header("location: /views/signup.php");
    }
}