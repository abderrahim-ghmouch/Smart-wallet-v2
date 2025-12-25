<?php
class Database{
    private $pdo;

    public function __construct()
    {
        $config=require __DIR__ . "/../database.php";
        try{
            $dsn ="mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
        }
        catch(PDOException $e)
        {
            echo $e->getmessage();
        }
    }

    public function getConnection(){
        return $this->pdo;
    }
}    

$obj = new Database();

