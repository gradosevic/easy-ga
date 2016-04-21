<?php

namespace Gradosevic\EasyGA\Tests;

use Gradosevic\EasyGA\Analytics;
use Gradosevic\EasyGA\ImpressionList;
use Gradosevic\EasyGA\Page;
use Gradosevic\EasyGA\Product;

class ImpressionTest extends TestCase
{
    //TODO: Make it work
    function test_send_products_impression(){
        $page = (new Page())
            ->setDocumentPath('/products/product-1-2')
            ->setDocumentTitle('Product 1 & 2 Page');

        $product1 = Product::create(5346, 'product 1', 45);
        $product2 = Product::create(5347, 'product 2', 47);

        $list1 = new ImpressionList('list 1', 1, $product1);
        $list2 = new ImpressionList('list 2', 2, $product2);

        Analytics::create($this->config)
            ->impression($page)
            ->setList($list1)
            ->setList($list2)
            ->send();
    }
}