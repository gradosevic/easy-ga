<?php

namespace Gradosevic\EasyGA\Tests;


use Gradosevic\EasyGA\Product;

class ProductTest extends TestCase
{
    public function test_product_to_array()
    {
        $category = 'cinema';
        $brand = 'miramax';
        $coupon = 'GH45GH';
        $name = 'Product 1';
        $position = 2;
        $price = 23.99;
        $quantity = 3;
        $sku = 12335556;
        $variant = 'blue';

        $product = (new Product())
            ->setCategory($category)
            ->setBrand($brand)
            ->setCouponCode($coupon)
            ->setName($name)
            ->setPosition($position)
            ->setPrice($price)
            ->setQuantity($quantity)
            ->setSku($sku)
            ->setVariant($variant);

        $productAsArray = $product->get();

        $this->assertEquals($category, $productAsArray['category']);
        $this->assertEquals($brand, $productAsArray['brand']);
        $this->assertEquals($coupon, $productAsArray['coupon_code']);
        $this->assertEquals($name, $productAsArray['name']);
        $this->assertEquals($position, $productAsArray['position']);
        $this->assertEquals($price, $productAsArray['price']);
        $this->assertEquals($quantity, $productAsArray['quantity']);
        $this->assertEquals($sku, $productAsArray['sku']);
        $this->assertEquals($variant, $productAsArray['variant']);
    }
    public function test_create()
    {
        $sku = 434356;
        $name = 'Blue Hat';
        $product = Product::create($sku, $name);

        $productAsArray = $product->get();

        $this->assertEquals('', $productAsArray['category']);
        $this->assertEquals('', $productAsArray['brand']);
        $this->assertEquals('', $productAsArray['coupon_code']);
        $this->assertEquals($name, $productAsArray['name']);
        $this->assertEquals(1, $productAsArray['position']);
        $this->assertEquals(0, $productAsArray['price']);
        $this->assertEquals(1, $productAsArray['quantity']);
        $this->assertEquals($sku, $productAsArray['sku']);
        $this->assertEquals('', $productAsArray['variant']);
    }
}