<?php

/**
  CREATE TABLE Users(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  surname VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
  );
 */
class User {

    protected $idUser;
    protected $name;
    protected $surname;
    protected $email;
    protected $password;

    public function __construct($idUser = -1, $name = '', $surname = '', $email = '', $password = '') {
        $this->setIdUser($idUser);
        $this->setName($name);
        $this->setEmail($surname);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function saveToDB(mysqli $connection) {
        
        if ($this->idUser == -1) {
            $query = "INSERT INTO Users ( name, surname, email, password) " .
                    "VALUES ('" . $this->name . "','" . $this->surname . "','" . $this->email . "','" . $this->password . "')";
          var_dump($query);
            if ($connection->query($query)) {
                 $this->id = $connection->insert_id;
                 
                 
                return true;
            } else {
                return false;
            }
        } else {
            $query = "UPDATE Users SET name='" . $this->name . "',"
                    . "surname='" . $this->surname . "',"
                    . "email='" . $this->email . "',"
                    . "password='" . $this->password . "' "
                    . "WHERE idUser=" . $this->idUser;
            if ($connection->query($query)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function getUserByEmail(mysqli $connection, $email) {
        $email = $connection->real_escape_string($email);
        $query = "SELECT * FROM Users WHERE email='" . $email . "'";
        $res = $connection->query($query);
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            $user = new User($row['id'], $row['email']);
            $user->setPassword($row['password']);



            return $user;
        }
    }

    public static function getUserById(mysqli $connection, $idUser) {
        $email = $connection->real_escape_string($email);
        $query = "SELECT * FROM Users WHERE idUser='" . $idUser . "'";
        $res = $connection->query($query);
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            $user = new User($row['id'], $row['email']);
            $user->setPassword($row['password']);



            return $user;
        }
    }
    
    public static function loging(mysqli $connection, $email, $password) {
        $user = self::getUserByEmail($connection, $email);
                if($user && password_verify($password,  $user->password)){
                    return $user;
                }  else {
                return FALSE;    
                }
    }

    //gettery i settery
    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
        return $this;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname) {
        $this->surname = $surname;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

public function setPassword($newPassword) {
        if (is_string($newPassword) && strlen($newPassword) > 8) {
            $hased = password_hash($newPassword, PASSWORD_BCRYPT);
            $this->password = $hased;
        }
    }

}
