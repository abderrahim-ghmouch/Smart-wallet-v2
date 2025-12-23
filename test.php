<?php
class User {
    public string $name;
    private int $age;
    public string $email;

    public function __construct($n, $a, $e){
        $this->name = $n;
        $this->age = $a;
        $this->email = $e;
    }
}

class Client extends User{
    public int $sold;
}

class Admin extends User {
}

class Author extends User {
} 
