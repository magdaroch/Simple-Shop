<?php

class Order {

    private $orderId;
    private $productId;
    private $quantity;
    private $status;

    public function __construct($orderId = -1, $productId = -1, $quantity = 0, $status = 0) {
        $this->setProductId($productId);
        $this->setQuantity($quantity);
        $this->setStatus($status);
    }

    public function addOrderTpTheBD(mysqli $connection) {
        if ($this->orderId == -1) {
            $query = "INSERT INTO Order($=productId,quantity)"
                    . "VALUES('$this->productId','$this->quantity'"
                    . ")";
            if ($connection->query($query)) {
                $this->id = $connection->insert_id;

                return true;
            } else {

                return false;
            }
        }
    }

    public static function changeTheStatus(mysqli $connection, $id, $status) {
        $query = "UPDATE Orders SET `status` = `message_date`, status = '$status' WHERE id = '$id'";


        if ($connection->query($query)) {
            echo 'zaktalizowana status';
            return true;
        } else {
            return false;
        }
    }

    public static function loadOrderByStatus(mmysqli $connection, $status) {
        $query = "SELECT* FROM Order WHERE status='' $status";
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

    public static function loadOrderById(mysqli $connection, $orderId) {
        $query = "SELECT* FROM Order WHERE orderId=''$orderId";
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

}
