<?php

namespace Gradosevic\EasyGA\Tests;

use Gradosevic\EasyGA\Analytics;
use Gradosevic\EasyGA\Product;

class TransactionTest extends TestCase
{
    public function test_minimal_purchase()
    {
        $transactionID = 2314;
        Analytics::create($this->config)
            ->transaction($transactionID)
            ->setProduct(Product::create('MINPRODUCT-56471', 'Min Product', 1.99))
            ->sendPurchase();
    }

    public function test_complete_purchase_create_from_constructor()
    {
        $transactionID = 2315;
        $affiliation = 'Affiliate Name';
        $revenue = 456.99;
        $tax = 10.0;
        $shipping = 9.99;
        $coupon = '20OFF';

        Analytics::create($this->config)
            ->transaction($transactionID, $affiliation, $revenue, $tax, $shipping, $coupon)
            ->sendPurchase();
    }

    public function test_complete_purchase_create_from_methods()
    {
        $transactionID = 2316;
        $affiliation = 'Affiliate Name';
        $revenue = 456.99;
        $tax = 10.0;
        $shipping = 9.99;
        $coupon = '20OFF';

        Analytics::create($this->config)
            ->transaction()
            ->setTransactionId($transactionID)
            ->setAffiliation($affiliation)
            ->setRevenue($revenue)
            ->setTax($tax)
            ->setShipping($shipping)
            ->setCouponCode($coupon)
            ->sendPurchase();
    }

    public function test_purchase_with_products()
    {
        $transactionID = 2317;
        $affiliation = '';
        $revenue = 456.99;
        $tax = 10.0;
        $shipping = 9.99;
        $coupon = '20OFF';

        $product1 = Product::create('JACKET-2477', 'Green jacket', 42.99);
        $product2 = Product::create('LNGSHIRT-2982', 'Long shirt', 32.99);

        Analytics::create($this->config)
            ->transaction($transactionID, $affiliation, $revenue, $tax, $shipping, $coupon)
            ->setProduct($product1)
            ->setProduct($product2)
            ->sendPurchase();
    }

    public function test_send_add(){
        $transaction = $this->getTransactionInstance('addproduct-356');
        $transaction->sendAdd();
    }

    public function test_send_click(){
        $transaction = $this->getTransactionInstance('click1234');
        $transaction->sendClick();
    }

    public function test_send_checkout(){
        $transaction = $this->getTransactionInstance('checkout34734');
        $transaction->sendCheckout();
    }

    public function test_send_checkout_option(){
        $transaction = $this->getTransactionInstance('checkout-option-7565');
        $transaction->sendCheckoutOption();
    }

    public function test_send_detail(){
        $transaction = $this->getTransactionInstance('detail-435');
        $transaction->sendDetail();
    }

    public function test_send_refund(){
        $transaction = $this->getTransactionInstance('refund-3564');
        $transaction->sendRefund();
    }

    public function test_send_remove(){
        $transaction = $this->getTransactionInstance('remove-34565');
        $transaction->sendRemove();
    }

    /**
     * @param $transactionID
     * @return Transaction
     */
    private function getTransactionInstance($transactionID){
        $transactionID = $transactionID.'-'.rand(1000, 5000);
        $affiliation = 'Affiliate '. rand(100, 500);
        $revenue = rand(40, 999);
        $tax = rand(1,20);
        $shipping = rand(0, 5);
        $coupon = '10OFF';

        return Analytics::create($this->config)
            ->transaction($transactionID, $affiliation, $revenue, $tax, $shipping, $coupon)
            ->setProduct(Product::create('SHIRT-324', 'Shirt', 22.99));
    }
}