<?php

/*
  CREATE TABLE Orders(
  id INT NOT NULL AUTO_INCREMENT ,
  productId INT NOT NULL ,
  quantity INT NOT NULL ,
  STATUS INT NOT NULL ,
  PRIMARY KEY ( id ) ,
  FOREIGN KEY ( productId ) REFERENCES Product( idProduct )
  );
 *  

 */

class Order {

    private $orderId;
    private $productId;
    private $quantity;
    private $status;

    public function __construct($orderId = -1, $productId = -1, $quantity = 0, $status = 0) {

        $this->setProductId($productId);
        $this->setQuantity($quantity);
        $this->setStatus($status);
        $this->orderId = $orderId;
    }

    public function addOrderToTheBD(mysqli $connection) {
        if ($this->orderId == -1) {
            $query = "INSERT INTO `Orders`(`productId` ,`quantity` ,`status`)"
                    . "VALUES('$this->productId','$this->quantity','$this->status'"
                    . ")";


            if ($connection->query($query)) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                echo 'Blad zamówenia';

                return false;
            }
        } elseif ($this->orderId != -1) {
        $query = "UPDATE Orders SET `quantity` = `quantity`, quantity = '$this->quantity' WHERE id = '$this->orderId'";
        var_dump($query);
        
        if ($connection->query($query)) {
                $this->id = $connection->insert_id;

                return true;
            } else {
                echo 'Blad zamówenia';

                return false;
            }
    } {
            
        }
    }

    public static function changeTheStatus(mysqli $connection, $id, $status) {
        $query = "UPDATE Orders SET `status` = `status`, status = '$status' WHERE id = '$id'";


        if ($connection->query($query)) {
            echo 'zaktalizowana status';
            return true;
        } else {
            return false;
        }
    }

    public static function loadALLOrders(mysqli $connection) {
        $orders = [];
        $query = "SELECT* FROM Orders";
        $res = $connection->query($query);
        if ($res) {
            foreach ($res as $row) {
                $orderToShow = new Order();
                $orderToShow->orderId = $row['id'];
                $orderToShow->productId = $row['productId'];
                $orderToShow->quantity = $row['quantity'];
                $orders[] = $orderToShow;
            } return $orders;
        }
    }

    public static function loadOrderByStatus(mmysqli $connection, $status) {
        $query = "SELECT* FROM Orders WHERE status='' $status";
        $result = $connection->query($query);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $orderToShow = new Order();
            $orderToShow->productId = $row['productId'];
            $orderToShow->quantity = $row['quantity'];
            return $orderToShow;
        }
        return NULL;
    }

    public static function loadOrderByProductId(mysqli $connection, $productId) {
        $query = "SELECT* FROM Orders WHERE productId='$productId";
       
        
        $result = $connection->query($query);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $orderToShow = new Order();
            $orderToShow->orderId=$row['id'];
            $orderToShow->productId = $productId;
            $orderToShow->quantity = $row['quantity'];
            return $orderToShow;
        }
        return NULL;
    }
    public static function loadOrderById(mysqli $connection, $orderId) {
        $query = "SELECT* FROM Orders WHERE id='$orderId'";
        var_dump($query);
        $result = $connection->query($query);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $orderToShow = new Order();
            $orderToShow->productId = $row['productId'];
            $orderToShow->quantity = $row['quantity'];
            return $orderToShow;
        }
        return NULL;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
        return $this;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
        }

    public static function delete(mysqli $connetion,$id) {
        if ($id != -1) {
            $query = "DELETE FROM Orders WHERE id ='".$id."'";
            
            
            $results =$connetion->query($query);
            if ($results!= FALSE && $results->num_rows == 1) {
               return  $results->fetch_assoc();
            } else {
                return false;
            }
        }return TRUE;
    }

}
