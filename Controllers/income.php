<?php

require "../Models/User.php";
require "../Models/Database.php";

if($_SERVER["REQUEST_METHOD"] === "POST")
    {

        $amount=$_POST["amount"];
        $description=$_POST["description"];
        $dateIncome=$_POST["dateIncome"];

        $income = new income($amount,$description,$dateIncome);
    }