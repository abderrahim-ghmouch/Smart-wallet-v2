<?php 

class User {
    
    private $id;
    private $username;
    private $email;
    private $password;
    private $passwordConfirm;
    private $conn;
    
    
    public function __construct($username = "",$email = "",$password = "",$passwordConfirm = ""){
        $this->username=$username;
        $this->email=$email;
        $this->password=$password;
        $this->passwordConfirm=$passwordConfirm;
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    
    public function passwordMatch()
    {
        if($this->password!=$this->passwordConfirm){
            echo "password is not confirmed";
            exit();
        }
    }
    
    public function isEmpty(){
        if(empty($this->email)||empty($this->username)||empty($this->password)||empty($this->passwordConfirm)){
            exit();
        }
    }
    
    public function signup(){
        
        $this->isEmpty();
        
        $this->passwordMatch();

        $stmt="insert 
                into 
                users(username,email,password) 
                values(?,?,?)";
                $query = $this->conn->prepare($stmt);
                $query->execute([$this->username,$this->email,$this->password]);
                
                return true;
            } 
            
            
            public function login(string $email, string $password){
                
                
                $statement="select * from users where email = ?;";
                $query = $this->conn->prepare($statement);
                $query->execute([$email]);
                
                if($query->rowCount() > 0){
                        $userData = $query->fetch(PDO::FETCH_ASSOC);
                        if($userData["password"] === $password) {
                            session_start();
                            $_SESSION["user_id"] = $userData["id"];
                        }
                    return true;

                } else {
                        return false;
                    }

                }
            
            }
















            
            /*
            login form => email, password
            public function (email, password)
            1- look for the user with the same email.
            2- if there is a match:
    - compare the password in the database with the inputed password (password_verify() if hashed).
    - if there is a match store the user id in the session and redirect the user to the transactions page
    - if there are not the same throw error
3- else thrwo error

*/