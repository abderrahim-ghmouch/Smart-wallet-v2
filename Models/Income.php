<?php

class income
{
    protected $amount;

    protected $description;

    protected $date;

    private $conn;



    public function __construct($amount, $description, $date)
    {

        $this->amount = $amount;
        $this->description = $description;
        $this->date = $date;
        $db = new database();
        $this->conn = $db->getconnection();

    }
    public function create()
    {

        $stmt = "insert into incomes(amount,income_description,dateIncomes)value(?,?,?)";
        $query = $this->conn->prepare($stmt);
        $query->execute([$this->amount, $this->description, $this->date]);

    }

    public function getALL()
    {


        $stmt = $this->conn->query("select * from incomes");

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete()
    {

        $stmt =$this->conn->prepare("delete from incomes where id=? value=?");

        
        $status = $stmt->execute([$id]);

    }





    // public function delete (){

    //     $stmt="delete*from incomes where id=? value"

    // }




}


