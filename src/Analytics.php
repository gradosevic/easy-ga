<?php

namespace Gradosevic\EasyGA;
/**
 * Class Analytics
 * @package Gradosevic\EasyGA
 */
use TheIconic\Tracking\GoogleAnalytics\Analytics as GA;

class Analytics
{
    private $analytics;

    public function __construct($userID = ''){
        $this->analytics = new GA(true);
        $this->analytics->setProtocolVersion('1')
            ->setAsyncRequest(true)
            ->setTrackingId(env('GOOGLE_ANALYTICS_ID'))
            ->setUserId($userID)

            //TODO: Use different value for client id
            ->setClientId($userID);
    }

    public static function create($userId){
        return new Analytics($userId);
    }

    public function getAnalytics(){
        return $this->analytics;
    }

    public function setIP($ip){
        $this->analytics->setIpOverride($ip);
        return $this;
    }

    public function setCM($value, $index){
        $this->analytics->setCustomMetric($value, $index);
        return $this;
    }

    public function setCD($value, $index){
        $this->analytics->setCustomDimension($value, $index);
        return $this;
    }

    public function setTransaction($transactionID, $affiliation = '', $revenue = 0, $coupon = ''){
        $this->analytics->setTransactionId($transactionID)
            ->setAffiliation($affiliation)
            ->setRevenue($revenue)
            ->setTax(0)
            ->setShipping(0)
            ->setCouponCode($coupon);
        return $this;
    }
    public function setProduct(Product $product){
        $this->analytics->addProduct($product->get());
        return $this;
    }

    public function sendPageView($documentPath){
        $this->analytics->setDocumentPath($documentPath);
        $this->analytics->sendPageview();
        return $this;
    }

    public function sendPurchase(){
        $this->analytics->setProductActionToPurchase();
        $this->analytics->setEventCategory('Checkout')
            ->setEventAction('Purchase')
            /* ->setCustomDimension(23, 1)
             ->setCustomMetric(34,1)*/
            ->sendEvent();
    }

    public function sendEvent(){

    }

}