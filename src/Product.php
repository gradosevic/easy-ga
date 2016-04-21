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
    private $couponCode = '';
    private $position = 1;

    /**
     * Creates a basic product instance
     * @param $sku
     * @param $name
     * @param $price
     * @param $quantity
     * @return Product
     */
    public static function create($sku, $name, $price = 0, $quantity = 1){
        return (new Product())
        ->setSku($sku)
        ->setName($name)
        ->setPrice($price)
        ->setQuantity($quantity);
    }

    //Setters
    public function setSku($value){
        $this->sku = $value;
            return $this;
    }
    public function setName($value){
        $this->name = $value;
        return $this;
    }
    public function setBrand($value){
        $this->brand = $value;
        return $this;
    }
    public function setCategory($value){
        $this->category = $value;
        return $this;
    }
    public function setVariant($value){
        $this->variant = $value;
        return $this;
    }
    public function setPrice($value){
        $this->price = $value;
        return $this;
    }
    public function setQuantity($value){
        $this->quantity = $value;
        return $this;
    }
    public function setCouponCode($value){
        $this->couponCode = $value;
        return $this;
    }
    public function setPosition($value){
        $this->position = $value;
        return $this;
    }

    /**
     * Returns product as array
     * @return array
     */
    public function get(){
        $data = [
            'price' => $this->price,
            'quantity' => $this->quantity,
            'coupon_code' => $this->couponCode
        ];
        //Extend impression array with additional data
        return array_merge($data, $this->getImpression());
    }

    public function getImpression(){
        $data = [
            'sku' => $this->sku,
            'name' => $this->name,
            'brand' => $this->brand,
            'category' => $this->category,
            'variant' => $this->variant,
            'position' => $this->position,
        ];
        return $data;
    }
}