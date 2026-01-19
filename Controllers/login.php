<?php

require "../Models/User.php";
require "../Models/Database.php";


if($_SERVER["REQUEST_METHOD"] === "POST"){

    $email=$_POST["email"];
    
    $password=$_POST["password"];

    $user = new User();

    if($user->login($email, $password)){
        header("location: /views/dashboard.php");
    }else{
        header("location: /views/login.php");
    }

}

