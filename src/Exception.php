<?php

namespace Gradosevic\EasyGA;


class Exception extends Base
{
    public function setDescription($description){
        if($description){
            $this->api()->setExceptionDescription($description);
        }
        return $this;
    }

    public function setIsFatal($isFatal){
        if($isFatal){
            $this->api()->setIsExceptionFatal($isFatal);
        }
        return $this;
    }

    public function send(){
        $this->api()->sendException();
    }
}