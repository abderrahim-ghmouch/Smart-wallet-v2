<?php

require "../Models/Transfer.php";
require "../Models/Income.php";
require "../Models/User.php";
require "../Models/Database.php";



if($_SERVER["REQUEST_METHOD"] === "POST"){
        
    if(isset($_POST['add'])){
        $amount=$_POST["amount"];
        $description=$_POST["description"];
        $dateIncome=$_POST["date"];
        $category=$_POST["category"];

            

            
        $income=new income($amount,$description, $dateIncome,$category) ;
            
        $income->addTransfer('incomes');
        
        header("location:/views/dashboard.php");
    }

    if(isset($_POST["delete"])){
        $id = $_POST["id"];
        $income = new income();
        $income->deleteTransfer('incomes', $id);
        header("location:/views/dashboard.php");
    }

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $amount=$_POST["amount"];
        $description=$_POST["description"];
        $dateIncome=$_POST["date"];
        $category=$_POST["category"];

        
        $income=new income($amount,$description, $dateIncome,$category) ;

        $income->updateTransfer('incomes', $id);
        
        header("location:/views/dashboard.php");
    }

}