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

    /**
     * @param $config tracking_id | Array
     */
    public function __construct($config)
    {
        $defaultOptions = [
            'tracking_id' => '',
            'protocol_version' => 1,
            'client_id' => 1,
            'user_id' => 1,
            'is_async' => true
        ];

        if (!is_array($config)) {
            $defaultOptions['tracking_id'] = $config;
            $config = $defaultOptions;
        } else {
            $config = array_merge($defaultOptions, $config);
        }

        $a = new GA(true);
        $a->setProtocolVersion($config['protocol_version'])
            ->setAsyncRequest($config['is_async'])
            ->setTrackingId($config['tracking_id'])
            ->setUserId($config['user_id'])
            ->setClientId($config['client_id']);

        $this->analytics = $a;
    }

    public static function create($config)
    {
        return new self($config);
    }

    /**
     * @param string $category required
     * @param string $action required
     * @param string $label optional
     * @param mixed $value optional
     * @return Event
     */
    public function event($category = null, $action = null, $label = null, $value = null)
    {
        return (new Event($this))
            ->setCategory($category)
            ->setAction($action)
            ->setLabel($label)
            ->setValue($value);
    }

    /**
     * @param string $transactionID required
     * @param string $affiliation optional
     * @param number $revenue optional
     * @param number $tax optional
     * @param number $shipping optional
     * @param string $coupon optional
     * @return $this
     */
    public function transaction($transactionID, $affiliation = null, $revenue = null, $tax = null, $shipping = null, $coupon = null)
    {
        return (new Transaction($this))
            ->setTransactionId($transactionID)
            ->setAffiliation($affiliation)
            ->setRevenue($revenue)
            ->setTax($tax)
            ->setShipping($shipping)
            ->setCouponCode($coupon);
        return $this;
    }

    public function getAnalytics()
    {
        return $this->analytics;
    }

    public function api()
    {
        return $this->analytics;
    }

    public function setIP($ip)
    {
        $this->analytics->setIpOverride($ip);
        return $this;
    }

    public function setCM($value, $index)
    {
        $this->analytics->setCustomMetric($value, $index);
        return $this;
    }

    public function setCD($value, $index)
    {
        $this->analytics->setCustomDimension($value, $index);
        return $this;
    }

    public function setTransaction($transactionID, $affiliation = '', $revenue = 0, $coupon = '')
    {
        $this->analytics->setTransactionId($transactionID)
            ->setAffiliation($affiliation)
            ->setRevenue($revenue)
            ->setTax(0)
            ->setShipping(0)
            ->setCouponCode($coupon);
        return $this;
    }

    public function setProduct(Product $product)
    {
        $this->analytics->addProduct($product->get());
        return $this;
    }

    public function sendPageView($documentPath)
    {
        $this->analytics->setDocumentPath($documentPath);
        $this->analytics->sendPageview();
        return $this;
    }

    public function sendPurchase()
    {
        $this->analytics->setProductActionToPurchase();
        $this->analytics->setEventCategory('Checkout')
            ->setEventAction('Purchase')
            /* ->setCustomDimension(23, 1)
             ->setCustomMetric(34,1)*/
            ->sendEvent();
    }

    public function sendEvent()
    {

    }

}