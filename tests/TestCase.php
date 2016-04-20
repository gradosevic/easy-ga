<?php

namespace Gradosevic\EasyGA\Tests;

/**
 * Base test class
 * Class TestCase
 * @package Gradosevic\EasyGA
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $config;

    protected function setUp() {
        $this->config = Config::get();
    }
}