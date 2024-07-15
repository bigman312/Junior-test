<?php
class Product {
    private $id;
    private $sku;
    private $name;
    private $price;
    private $weight;
    private $sizeMb;
    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $weight, $sizeMb, $height, $width, $length) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->weight = $weight;
        $this->sizeMb = $sizeMb;
        $this->height = $height;
        $this->width = $width;
        $this->length = $length;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getSku() {
        return $this->sku;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getSizeMb() {
        return $this->sizeMb;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function getLength() {
        return $this->length;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function setSizeMb($sizeMb) {
        $this->sizeMb = $sizeMb;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setLength($length) {
        $this->length = $length;
    }
}
?>
