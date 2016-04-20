<?php

namespace Gradosevic\EasyGA;


class Event
{
    private $easyAnalytics;

    public function __construct(Analytics $easyAnalytics){
        $this->easyAnalytics = $easyAnalytics;
    }

    public function analytics(){
        return $this->easyAnalytics;
    }

    public function setCategory($category = ''){
        $this->api()->setEventCategory($category);
        return $this;
    }

    public function setAction($action = ''){
        $this->api()->setEventAction($action);
        return $this;
    }

    public function setLabel($label = ''){
        $this->api()->setEventLabel($label);
        return $this;
    }

    public function setValue($value = ''){
        $this->api()->setEventValue($value);
        return $this;
    }

    private function api(){
        return $this->easyAnalytics->api();
    }

    public function send(){
        $this->api()->sendEvent();
    }
}