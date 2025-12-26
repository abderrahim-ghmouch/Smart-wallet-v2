<?php

class expense 
{

    protected $amount;

    protected $decsription;

    protected $dateExpense;


    protected $conn;


        public function __construct($amount, $description, $date)
    {

        $this->amount = $amount;
        $this->decsription = $description;
        $this->dateExpense = $date;
        $db = new database();
        $this->conn = $db->getconnection();

    }

     public function create()
    {

        $stmt = "insert into incomes(amount,income_description,dateExpenses)value(?,?,?)";
        $query = $this->conn->prepare($stmt);
        $query->execute([$this->amount, $this->decsription, $this->dateExpense]);

    }

}