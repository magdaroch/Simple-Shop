<?php

class ShopingItems {

    private $id;
    private $userId;
    private $idOrder;
    private $adress;
    private $price;
    static $deliveryCost = 10;

    public function __construct($id = -1, $userId = -1, $idOrder = -1, $adress = '', $price = 0) {
        $this->setIdOrder($idOrder);
        $this->setUserId($userId);

        $this->setAdress($adress);
        $this->setPrice($price);
    }

    public function addShopingItems(mysqli $connection) {
        if (($this->id == -1)) {
            $query = "INSERT INTO ShopinegItems(idOrder,userId,adress,price,deliveryCost)"
                    . "VALUES('$this->idOrder','$this->userId','$this->adress','$this->price','$this->$deliveryCost')";

            if ($connection->query($query)) {
                $this->id = $connection->insert_id;
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $query = "UPDATE ShopinegItems"
                    . "SET idOrder='$this->idOrder' ,userId='$this->userId',adress='$this->adress' ,price='$this->price',deliveryCost='$this->$deliveryCost'"
                    . "WHERE id= $this->id";
            if ($connection->query($query)) {
                return TRUE;
            } else {
                return false;
            }
        }
    }

    static public function loadShopingItemsByID(mysqli $connection, $id) {
        $query = "SELECT * FROM ShopinegItem WHERE userId =" . $connection->real_escape_string($id) . '"';
        $lists = [];
        $res = $connection->query($query);
        if ($res) {
            foreach ($res as $row) {
                $row = $res->fetch_assoc();
                $list = new ShopingItems();
                $list->id = $row['id'];
                $list->idOrder = $row['odresId'];
                $list->adress = $row['adress'];
                $list->price = $row['price'];
                $list->userId = $row['userId'];
                $lists[] = $list;
            }return $lists;
        } else {
            return NULL;
        }
    }

    static public function loadShopingItemsByUSerID(mysqli $connection, $id) {
        $query = "SELECT * FROM ShopinegItem WHERE id =" . $connection->real_escape_string($id) . '"';
        $lists = [];
        $res = $connection->query($query);
        if ($res) {
            foreach ($res as $row) {
                $row = $res->fetch_assoc();
                $list = new ShopingItems();
                $list->id = $row['id'];
                $list->idOrder = $row['odresId'];
                $list->adress = $row['adress'];
                $list->price = $row['price'];
                $list->userId = $row['userId'];

                $lists[] = $list;
            }return $lists;
        } else {
            return NULL;
        }
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getIdOrder() {
        return $this->idOrder;
    }

    public function getAdress() {
        return $this->adress;
    }

    public function getPrice() {
        return $this->price;
    }

    public static function getDeliveryCost() {
        return self::$deliveryCost;
    }

    public function setIdOrder($idOrder) {
        $this->idOrder = $idOrder;
        return $this;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public static function setDeliveryCost($deliveryCost) {
        self::$deliveryCost = $deliveryCost;
        return self;
    }

}
