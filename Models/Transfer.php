-<?php

class transfer
{

    public $amount;

    public $description;
    

    public $date;

    public $category;
    

    public $connection;



    public function __construct($amount,$description,$date,$category)
    {
        $this->amount=$amount;

        $this->description=$description;
        
        $this->date=$date;

        $this->category=$category;

        

        $db=new database();
        $this->connection=$db->getConnection();

    }


public function addTransfer($TABLE){

    if($TABLE == 'incomes'){
       
        $stmt="INSERT INTO incomes (amount,income_description,dateIncomes,category_income) value(?,?,?,?)";
    }   elseif($TABLE == 'expences'){
        $stmt="INSERT INTO expences(amount,expenses_description,dateExpenses,category_expense) value(?,?,?,?)";
    }

    $query=$this->connection->prepare($stmt);

    return $query->execute([$this->amount ,$this->description,$this->date,$this->category]);

}

PUBLIC function getAllTranfer($table)
{

    if($table === 'incomes'){
        $stmt="SELECT i.*, c.namecategory FROM incomes i inner join categories c on i.category_income = c.id";
    }else{
        $stmt="SELECT e.*, c.namecategory FROM expences e inner join categories c on e.category_expense = c.id";
    }

$query=$this->connection->prepare($stmt);

$query->execute();

return $query->fetchAll(PDO::FETCH_ASSOC);

}


public function updateTransfer($TABLE, $id){

    if($TABLE == 'incomes'){
       
        $stmt="UPDATE incomes SET amount = ?, income_description = ?, dateIncomes = ?, category_income = ? where id = ?";
    }   elseif($TABLE == 'expences'){
        $stmt="UPDATE expences SET amount = ?, expenses_description = ?, dateExpenses = ?, category_expense = ? where id = ?";
    }

    $query=$this->connection->prepare($stmt);

    $query->execute([$this->amount ,$this->description,$this->date,$this->category, $id]);

}


public function getall($table)
{

    $stmt="SELECT*FROM $table";

    $query=$this->connection->prepare($stmt);

    $query->execute();

     return $query->fetchAll(PDO::FETCH_ASSOC);

}

public function deleteTransfer($table, $id){

    $stmt="DELETE FROM $table where id = ?";

    $query=$this->connection->prepare($stmt);

    $query->execute([$id]);

}
public function total($table)
{
$stmt="select SUM(amount) from $table ";

$query=$this->connection->prepare($stmt);
$query->execute();


 return $query->fetchColumn();


}

public function filterTransfer($table,$categoryId)
{
    if($table==="incomes"){
        $stmt= "SELECT i.*, c.namecategory FROM incomes i inner join categories c on i.category_income = c.id where category_income = ?";
    }elseif($table==="expences"){
        $stmt= "SELECT e.*, c.namecategory FROM expences e inner join categories c on e.category_expense = c.id where category_expense = ?";
    }

    $query=$this->connection->prepare($stmt);

    $query->execute([$categoryId]);

    return $query->fetchAll(PDO::FETCH_ASSOC);
 }
}







