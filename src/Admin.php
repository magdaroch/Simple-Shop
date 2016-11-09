

<?php

/*
  CREATE Table Admin(
  idAmdin INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255)NOT NULL UNIQUE,
  email VARCHAR(255)NOT NULL UNIQUE,
  password VARCHAR(255)NOT NULL UNIQUE);
 */

class Admin {

    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($id = -1, $name = '', $email = '', $password = '') {
        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword($password);
    }
    
        public static function LogIn(mysqli $conn, $email,$password){
         $query = "SELECT * FROM Admins WHERE email= '{$email}'";
        $result = $conn->query( $query);
        var_dump($result);
        if($result != false){
            foreach ($result as $row){
                $loggedAdmin = new Admin();
                $loggedAdmin->id = $row['id'];
                $loggedAdmin->email = $row['email'];
                $loggedAdmin->hassedPass = $row['password'];
                if($loggedAdmin->passwordVerify($password)){
                    return $loggedAdmin;
                }
            }
        }
        return false;
    }
    
    public function addAdmin(mysqli $connection){
        if($this->id == -1){
         $query = "INSERT INTO Admin ( idAmdin , name, email, password) ".
                "VALUES ('".$this->idU."','".$this->name."','".$this->email."','".$this->password."')";
            if($connection->query($query)){
                return true;
            }else{
                return false;
            }
        }else{
            $query = "UPDATE Users SET name='".$this->name."',"
                ."surname='".$this->surname."',"
                ."email='".$this->email."',"
                ."password='".$this->password."' "
                ."WHERE idUser=".$this->idUser;
            if($connection->query($query)){
                return true;
            }else{
                return false;
            }
        }

        
    }
            function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setEmail($email) {
        if (preg_match('^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-
]+(\.[a-zA-Z0-9-]{1,})*\.([a-zA-Z]{2,}){1}$', $email)) {

            $this->email = $email;
            return $this;
        }
    }
        public function passwordVerify($password)
    {
        return password_verify($password, $this->hassedPass);
    }

    function setPassword($password,$password2) {
        if($password!=$password2){
            return false;
        }
        if (preg_match('/[a-z]+[A-Z]+[0-9]+/', $password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->password = $password;
            return $this;
        }
    }

}
