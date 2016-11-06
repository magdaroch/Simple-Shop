<?php

class Subject {
    public $idSubject;
    public $name;
    public $price;
    public $descriptions;
    public $quantity;

    public function __construct() {
        $this->idSubject=-1;
        $this->name='';
        $this->price='';
        $this->descriptions='';
        $this->quantity = 0;
        
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
