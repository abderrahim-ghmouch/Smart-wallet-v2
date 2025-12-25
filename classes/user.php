<?php 

class user {

    private $id;
    private $username;
    private $email;
    private $password;
    private $passwordConfirm;
    private $conn;
    
    
    public function __construct($username,$email,$password,$passwordConfirm)

    {
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
        $this->passwordConfirm=$passwordConfirm;

}
public function establishConnection($connection){

    $this->conn=$connection;
}
public function passwordMatch()
{
    if($this->password!=$this->passwordConfirm){
        echo "password is not confirmed";
        exit();
    }
}

public function isEmpty(){
if(empty($this->email)||empty($this->username)||empty($this->password)||empty($this->passwordConfirm))
{
    exit();
}
}
public function signup(user $abdo){

    $stmt="insert 
            into 
            users(username,email,password) 
            values(?,?,?)";
    $query = $this->conn->prepare($stmt);
    $query->execute([$abdo->username,$abdo->email,$abdo->password]);
} 


}

