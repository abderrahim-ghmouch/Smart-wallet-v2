<?php

require "../Models/Transfer.php";
require "../Models/Expense.php";
require "../Models/User.php";
require "../Models/Database.php";


if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        
        if(isset($_POST["add"])){
            $amount=$_POST["amount"];
            $description=$_POST["description"];
            $dateIncome=$_POST["date"];
            $category=$_POST["category"];

            

            
            $expense=new expense($amount,$description, $dateIncome,$category) ;
                
            $expense->addTransfer('expences');
            
            header("location:/views/dashboard.php");
        }

        if(isset($_POST["delete"])){
            $id = $_POST["id"];
            $expense = new expense();
            $expense->deleteTransfer('expences', $id);
            header("location:/views/dashboard.php");
        }

        if(isset($_POST["update"])){
            $id=$_POST["id"];
            $amount=$_POST["amount"];
            $description=$_POST["description"];
            $dateIncome=$_POST["date"];
            $category=$_POST["category"];

            

            
            $expense=new expense($amount,$description, $dateIncome,$category) ;

            $expense->updateTransfer('expences',$id);
            
            header("location:/views/dashboard.php");
        }

    }

