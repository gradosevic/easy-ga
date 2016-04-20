<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 20/04/16
 * Time: 17:50
 */

namespace Gradosevic\EasyGA;


class Purchase extends Base
{
    public function send(){
       /* $this->api()->setProductActionToPurchase();
        $this->analytics->setEventCategory('Checkout')
            ->setEventAction('Purchase')
            // ->setCustomDimension(23, 1)
            // ->setCustomMetric(34,1)
            ->sendEvent();
        $this->api()->sendTransaction();*/
    }
}