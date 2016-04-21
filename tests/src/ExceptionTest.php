<?php

namespace Gradosevic\EasyGA\Tests;

use Gradosevic\EasyGA\Analytics;

class ExceptionTest extends TestCase
{
    function test_send_simple_exception(){
        Analytics::create($this->config)
            ->exception('An error occurred')
            ->send();
    }
}