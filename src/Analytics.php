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
     *
     * @param string $path required - Starts with /
     * @param $title
     * @param $hostName
     * @param $referrer
     * @return Page
     */
    public function page($path = null, $title = null, $hostName = null, $referrer = null){
        return (new Page($this))
            ->setDocumentPath($path)
            ->setDocumentTitle($title)
            ->setDocumentHostName($hostName)
            ->setDocumentReferrer($referrer);
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
     * @return Transaction
     */
    public function transaction($transactionID = null, $affiliation = null, $revenue = null, $tax = null, $shipping = null, $coupon = null)
    {
        return (new Transaction($this))
            ->setTransactionId($transactionID)
            ->setAffiliation($affiliation)
            ->setRevenue($revenue)
            ->setTax($tax)
            ->setShipping($shipping)
            ->setCouponCode($coupon);
    }

    /**
     * @param string $description
     * @param bool|false $isFatal
     * @return Exception
     */
    public function exception($description, $isFatal = false){
        return (new Exception($this))
            ->setDescription($description)
            ->setIsFatal($isFatal);
    }

    /**
     * @param Page $page
     * @return Impression
     */
    public function impression(Page $page){
        if($page){
            $page->setAnalytics($this);
            $page->setApiData();
        }
        return (new Impression($this));
    }


    public function api()
    {
        return $this->analytics;
    }
}
