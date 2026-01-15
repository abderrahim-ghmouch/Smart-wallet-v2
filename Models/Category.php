<?php
class category
{
    public $name;
    public $connection;

    public function __construct($name = "")
    {
        $this->name = $name;

        $db = new database();
        $this->connection = $db->getConnection();

    }
    public function getAll()
    {
        $stmt = "SELECT * FROM categories";
        $query = $this->connection->prepare($stmt);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}