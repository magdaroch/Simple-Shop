

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

    function setPassword($password) {
        if (preg_match('/[a-z]+[A-Z]+[0-9]+/', $password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->password = $password;
            return $this;
        }
    }

}
