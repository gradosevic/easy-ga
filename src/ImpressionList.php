<?php

namespace Gradosevic\EasyGA;


class ImpressionList
{
    protected $product;
    protected $name;
    protected $index;

    /**
     * @param string $name required
     * @param integer $index required
     * @param Product $product required
     */
    public function __construct($name, $index, Product $product)
    {
        $this->name = $name;
        $this->index = $index;
        $this->product = $product;
    }

    public function get()
    {
        return [
            'index' => $this->index,
            'name' => $this->name,
            'product' => $this->product
        ];
    }
}