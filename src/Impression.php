<?php

namespace Gradosevic\EasyGA;

class Impression extends Base
{
    protected $lists = [];

    public function setList(ImpressionList $list){
        $this->lists[] = $list;
        return $this;
    }

    /**
     * @var ImpressionList $impressionList
     * @throws \Exception
     */
    public function send(){
        if(sizeof($this->lists) == 0){
            throw new \Exception('Please add at least one impression list to the request.');
        }
        foreach($this->lists as $list){
            $data = $list->get();
            $this->api()->setProductImpressionListName($data['name'], $data['index']);
            $this->api()->addProductImpression($data['product']->getImpression(), $data['index']);
        }
        parent::send();
    }
}