<?php

namespace Gradosevic\EasyGA;


class Event extends Base
{
    public function setCategory($category){
        if($category){
            $this->api()->setEventCategory($category);
        }
        return $this;
    }

    public function setAction($action){
        if($action){
            $this->api()->setEventAction($action);
        }
        return $this;
    }

    public function setLabel($label){
        if($label){
            $this->api()->setEventLabel($label);
        }
        return $this;
    }

    public function setValue($value){
        if($value){
            $this->api()->setEventValue($value);
        }
        return $this;
    }

    public function send(){
        $this->api()->sendEvent();
    }
}