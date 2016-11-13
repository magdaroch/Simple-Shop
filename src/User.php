<?php
/**
 * Created by PhpStorm.
 * User: Magda
 * Date: 2016-11-06
 * Time: 12:32
 */
class User {
    protected $idUser;
    protected $name;
    protected $surname;
    protected $email;
    protected $password;
    public function __construct($idUser=-1,$name='',$surname='',$email='',$password='')
    {
        $this->setIdUser($idUser);
        $this->setName($name);
        $this->setEmail($surname);
        $this->setEmail($email);
        $this->setPassword($password);
    }
    public function saveToDB(mysqli $connection){
        $query = '';
        if($this->idUser == -1){
            $query = "INSERT INTO Users (idUser, name, surname, email, password) ".
                "VALUES ('".$this->idUser."','".$this->name."','".$this->surname."','".$this->email."','".$this->password."')";
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
    public static function getUserByEmail(mysqli $connection,$email)
    {
        $email = $connection->real_escape_string($email);
        $query = "SELECT * FROM Users WHERE email='" . $email . "'";
        $res = $connection->query($query);
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            $user = new User($row['idUser'], $row['email']);
            $user->setPassword($row['password']);



            return $user;
        }
    }
    public static function getUserById(mysqli $connection,$idUser)
    {
        $email = $connection->real_escape_string($email);
        $query = "SELECT * FROM Users WHERE idUser='" . $idUser. "'";
        $res = $connection->query($query);
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            $user = new User($row['idUser'], $row['email']);
            $user->setPassword($row['password']);



            return $user;
        }
    }
    //gettery i settery
    public function getIdUser()
    {
        return $this->idUser;
    }
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function getSurname()
    {
        return $this->surname;
    }
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}