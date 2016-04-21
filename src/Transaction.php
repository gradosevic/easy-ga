<?php
/**
 * Created by PhpStorm.
 * User: goran
 * Date: 20/04/16
 * Time: 18:03
 */

namespace Gradosevic\EasyGA;


class Transaction extends Base
{
    const ACTION_ADD = 'Add';
    const ACTION_PURCHASE = 'Purchase';
    const ACTION_CHECKOUT = 'Checkout';
    const ACTION_CHECKOUT_OPTION = 'Checkout Option';
    const ACTION_CLICK = 'Click';
    const ACTION_DETAIL = 'Detail';
    const ACTION_REFUND = 'Refund';
    const ACTION_REMOVE = 'Remove';

    public function setTransactionId($transactionID){
        if($transactionID) {
            $this->api()->setTransactionId($transactionID);
        }
        return $this;
    }

    public function setAffiliation($affiliation){
        if($affiliation){
            $this->api()->setAffiliation($affiliation);
        }
        return $this;
    }

    public function setRevenue($revenue){
        if($revenue){
            $this->api()->setRevenue($revenue);
        }
        return $this;
    }

    public function setTax($tax){
        if($tax){
            $this->api()->setTax($tax);
        }
        return $this;
    }

    public function setShipping($shipping){
        if($shipping){
            $this->api()->setShipping($shipping);
        }
        return $this;
    }

    public function setCouponCode($coupon){
        if($coupon){
            $this->api()->setCouponCode($coupon);
        }
        return $this;
    }

    public function setProduct(Product $product){
        if($product){
            $this->api()->addProduct($product->get());
        }
        return $this;
    }

    public function sendAdd(){
        $this->setProductAction(self::ACTION_ADD);
        $this->send();
    }

    public function sendCheckout(){
        $this->setProductAction(self::ACTION_CHECKOUT);
        $this->send();
    }

    public function sendCheckoutOption(){
        $this->setProductAction(self::ACTION_CHECKOUT_OPTION);
        $this->send();
    }

    public function sendClick(){
        $this->setProductAction(self::ACTION_CLICK);
        $this->send();
    }

    public function sendDetail(){
        $this->setProductAction(self::ACTION_DETAIL);
        $this->send();
    }

    public function sendPurchase(){
        $this->setProductAction(self::ACTION_PURCHASE);
        $this->send();
    }

    public function sendRefund(){
        $this->setProductAction(self::ACTION_REFUND);
        $this->send();
    }

    public function sendRemove(){
        $this->setProductAction(self::ACTION_REMOVE);
        $this->send();
    }

    public function sendTransaction(){
        $this->api()->sendTransaction();
    }

    /**
     * @param enum $actionType e.g. use Transaction::ACTION_PURCHASE
     */
    /*public function send($actionType){
        $this->setProductAction($actionType);
        $this->api()->sendTransaction();
    }*/

    private function setProductAction($type){

        //TODO: implement
        //$this->api()->setProductAction($value);
        //$this->api()->setProductActionList($value);

        switch($type){
            case self::ACTION_ADD:
                $this->api()->setProductActionToAdd();
                break;
            case self::ACTION_PURCHASE:
                $this->api()->setProductActionToPurchase();
                break;
            case self::ACTION_CHECKOUT:
                $this->api()->setProductActionToCheckout();
                break;
            case self::ACTION_CHECKOUT_OPTION:
                $this->api()->setProductActionToCheckoutOption();
                break;
            case self::ACTION_CLICK:
                $this->api()->setProductActionToClick();
                break;
            case self::ACTION_DETAIL:
                $this->api()->setProductActionToDetail();
                break;
            case self::ACTION_REFUND:
                $this->api()->setProductActionToRefund();
                break;
            case self::ACTION_REMOVE:
                $this->api()->setProductActionToRemove();
                break;
            default;
        }
    }
}