<?php

namespace Gradosevic\EasyGA;


abstract class Base
{
    protected $easyAnalytics;

    public function __construct(Analytics $easyAnalytics = null){
        $this->easyAnalytics = $easyAnalytics;
    }

    public function analytics(){
        return $this->easyAnalytics;
    }

    public function api(){
        return $this->easyAnalytics? $this->easyAnalytics->api():null;
    }

    protected function setAnalytics($easyAnalytics){
        $this->easyAnalytics = $easyAnalytics;
    }

    protected function send(){
        $this->api()->sendPageview();
    }
}