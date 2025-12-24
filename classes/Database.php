<?php
class database{
    private $pdo;

    public function __construct(
        $host,$dbname,$username,$password
    )
    {
        try{
            
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        catch(PDOException $e)
        {
            echo "your connection is failed".$e->getmessage();
        }
    }

    public function getConnection(){
        return $this->pdo;
    }
}    

