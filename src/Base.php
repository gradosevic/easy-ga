<?php

namespace Gradosevic\EasyGA;


abstract class Base
{
    private $easyAnalytics;

    public function __construct(Analytics $easyAnalytics){
        $this->easyAnalytics = $easyAnalytics;
    }

    public function analytics(){
        return $this->easyAnalytics;
    }

    public function api(){
        return $this->easyAnalytics->api();
    }

    public function send(){
        $this->api()->sendPageview();
    }
}