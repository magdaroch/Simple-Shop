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

    public function __construct($idProduct = -1, $name = '', $price = '', $descriptions = '', $quantity = 0) {
        $this->setName($name);
        $this->setPrice($price);
        $this->setDescriptions($descriptions);
        $this->setQuantity($quantity);
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

    public static function loadAllProduct(mysqli $connection) {
        $products = [];
        $query = "SELECT * FROM Product";
        $res = $connection->query($query);
        if ($res ) {
            foreach ($res as $row) {
                
                $product = new Product();
                $product->idProduct = $row['idProduct'];
                $product->name = $row['name'];
                $product->price = $row['price'];
                $product->descriptions = $row['descriptions'];
                $product->quantity = $row['quantity'];
                $products[] = $product;
            }
            return $products;
        }
    }

    public static function loadProductById(mysqli $connection,$idProduct) {
        $query = "SELECT * FROM Product WHERE idProduct='" . $idProduct . "'";
         $result = $connection->query($query);
         if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $productToShow = new Product();
            $productToShow->idProduct = $row['idProduct'];
            $productToShow->name=$row['name'];
            $productToShow->price=$row['price'];
            $productToShow->descriptions=$row['descriptions'];
            $productToShow->price=$row['price'];
            return $productToShow;
            
         }
        
        var_dump($result);
        
        return $result;
    }

    public static function loadSProductByName(mysqli $connection, $name) {
        $query = "SELECT * FROM Product WHERE name'" . $name . "'";
        $result = $connection->query($query);
        if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        }
        return $result;
    }
    public function getIdProduct() {
        return $this->idProduct;
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
        if (preg_match('/\w*/', $name)) {
            $this->name = $name;


            return $this;
        }
    }

    function setPrice($price) {
        if (isset($price) && $price > 0) {
            $this->price = $price;
            return $this;
        }
    }

    function setDescriptions($descriptions) {
        if (isset($descriptions) && strlen($descriptions) > 0) {
            $this->descriptions = $descriptions;



            return $this;
        }
    }

    function setQuantity($quantity) {
        if (isset($quantity) && $quantity >= 0) {
            $this->quantity = $quantity;
        }
        return $this;
    }

}
