<?php

/*
  CREATE TABLE Product(
  idProduct INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255)NOT NULL UNIQUE,
  price DECIMAL NOT NULL,
  descriptions text,
  quantity INT
  );
CREATE TABLE Photo(
idPicture INT NOT NULL AUTO_INCREMENT ,
idProduct INT NOT NULL ,
caption VARCHAR( 255 ) NOT NULL ,
img LONGBLOB NOT NULL ,
PRIMARY KEY ( idpicture ) ,
FOREIGN KEY ( idProduct ) REFERENCES Product( idProduct );
)
 *  
 
 */

class Product {

    public $idProduct;
    public $name;
    public $price;
    public $descriptions;
    public $quantity;

    public function __construct() {
        $this->idSubject = -1;
        $this->name = '';
        $this->price = '';
        $this->descriptions = '';
        $this->quantity = 0;
    }

    public function addProductToTheDB(mysqli $connection) {
        if ($this->id == -1) {
            $query = "INSERT INTO Product(name,price,descriptions,quantity)"
                    . "VALUES('$this->name','$this->price','$this->descriptions','$this->quantity)";
            if ($connection->query($query)) {
                $this->id = $connection->insert_id;
            } else {
                echo 'Wiadomość Blad';
                return false;
            }
        }
    }
    public function loadAllProduct(mysqli $connection){
        $products =[];
        $query = "SELECT * FROM Product";
        $res=$connection->query($query);
        if($res && $res->num_rows>=1){
            foreach ($res as $row){
                 $row = $res->fetch_assoc();
                 $product = new Product();
                 $product->idProduct = $row['idProduct'];
                 $product->name = $row['name'];
                 $product->price=$row['price'];
                 $product->descriptions = $row['descriptions'];
                 $product->quantity = $row['quantity'];
                 $products[]=$product;
                 
                 
            }
            return $products;
        }
    }
    
    public function loadProductById(mysqli $connection, $idSubject){
        $query = "SELECT * FROM Product WHERE idSubject='".$idSubject."'";
        $result = $connection->query($query);
        return $result;
        
    }
    public function loadSProductByName(mysqli $connection, $name){
        $query = "SELECT * FROM Product WHERE name'".$name."'";
        $result = $connection->query($query);
        return $result;
        
    }
      function getName() {
        return $this->name;
    }

    function getPrice() {
        return $this->price;
    }

    function getDescriptions() {
        return $this->descriptions;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function setName($name) {
        $this->name = $name;
        return $this;
    }

    function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    function setDescriptions($descriptions) {
        $this->descriptions = $descriptions;
        return $this;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

}
