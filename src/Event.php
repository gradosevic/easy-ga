<?php

namespace Gradosevic\EasyGA;


class Event extends Base
{
    private $category;
    private $action;

    public function setCategory($category){
        if($category){
            $this->category = $category;
            $this->api()->setEventCategory($category);
        }
        return $this;
    }

    public function setAction($action){
        if($action){
            $this->action = $action;
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

    /**
     * Sets custom data and ads it to event
     * @param mixed $value Custom data value
     * @param integer $index Custom data index
     * @return $this
     */
    public function setCustomDimension($value, $index){
        $this->api()->setCustomDimension($value, $index);
        return $this;
    }

    public function send(){
        $this->validate();
        $this->api()->sendEvent();
    }

    private function validate(){
        if(!$this->category){
            throw new \Exception('Event category can not be empty');
        }
        if(!$this->action){
            throw new \Exception('Event action can not be empty');
        }
    }
}