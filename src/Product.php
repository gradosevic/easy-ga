<?php

namespace Gradosevic\EasyGA;

class Product
{
    private $sku = '';
    private $name = '';
    private $brand = '';
    private $category = '';
    private $variant = '';
    private $price = 0;
    private $quantity = 1;
    private $couponCode = 'TEST';
    private $position = 1;

    public function __construct(){

    }

    /**
     * Creates a basic product instance
     * @param $sku
     * @param $name
     * @param $price
     * @param $quantity
     * @return Product
     */
    public static function create($sku, $name, $price = 0, $quantity = 1){
        $instance = new Product();
        $instance->setSku($sku);
        $instance->setName($name);
        $instance->setPrice($price);
        $instance->setQuantity($quantity);
        return $instance;
    }

    //Setters
    public function setSku($value){
        $this->sku = $value;
    }
    public function setName($value){
        $this->name = $value;
    }
    public function setBrand($value){
        $this->brand = $value;
    }
    public function setCategory($value){
        $this->category = $value;
    }
    public function setVariant($value){
        $this->variant = $value;
    }
    public function setPrice($value){
        $this->price = $value;
    }
    public function setQuantity($value){
        $this->quantity = $value;
    }
    public function setCouponCode($value){
        $this->couponCode = $value;
    }
    public function setPosition($value){
        $this->position = $value;
    }

    /**
     * Returns product as array
     * @return array
     */
    public function get(){
        $data = [
            'sku' => $this->sku,
            'name' => $this->name,
            'brand' => $this->brand,
            'category' => $this->category,
            'variant' => $this->variant,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'coupon_code' => $this->couponCode,
            'position' => $this->position,
        ];
        return $data;
    }
}