easy-ga
=============
PHP Google Analytics library for quick and easy use

<a href="https://packagist.org/packages/gradosevic/easy-ga">
    <img src="http://img.shields.io/packagist/v/gradosevic/easy-ga.svg?style=flat" style="vertical-align: text-top">
</a>
<a href="https://packagist.org/packages/gradosevic/easy-ga">
    <img src="https://img.shields.io/github/tag/gradosevic/easy-ga.svg?style=flat" style="vertical-align: text-top">
</a>
<a href="https://packagist.org/packages/gradosevic/easy-ga">
    <img src="http://img.shields.io/packagist/dt/gradosevic/easy-ga.svg?style=flat" style="vertical-align: text-top">
</a>
<a href="https://packagist.org/packages/gradosevic/easy-ga">
    <img src="https://img.shields.io/github/issues/gradosevic/easy-ga.svg?style=flat" style="vertical-align: text-top">
</a>

#About
This library was created for people who want to start using Google Analytics Measurement Protocol with minimum time for setup.
It is basically a wrapper for [theiconic/php-ga-measurement-protocol](https://github.com/theiconic/php-ga-measurement-protocol) with easy to use objects.

For more information about API please check:
- [The Iconic API](https://github.com/theiconic/php-ga-measurement-protocol)
- [Working with Measurement Protocol](https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide)
- [Measurement Protocol Parameter Reference](https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters)



#Installation

#####`composer require gradosevic/easy-ga`

##Supported Features
- Send Events
- Send Page Views
- Send Custom Data
- Send Transactions
- Send Exceptions

##Configuration

####Minimal

```php
$config = [
  'tracking_id' => 'UA-XXXXXXXX-1'
];
```
or 

```php
$config = 'UA-XXXXXXXX-1';
```

####Default 
```php
$config = [
    'tracking_id' => '',
    'protocol_version' => 1,
    'client_id' => 1,
    'user_id' => 1,
    'is_async' => true
];
```

##Sending Events

####Send simple event
```php
use Gradosevic\EasyGA\Analytics;

Analytics::create($config)
    ->event('Simple Event Group', 'Simple Event Action')
    ->send();
```
that's it!

####Send complete event using constructor
```php
Analytics::create($config)
    ->event('Event Constructor', 'Event Constr-Action', 'Event Constr-Label', 45)
    ->send();
```

####Send complete event using Event class methods
```php
Analytics::create($config)
    ->event()
    ->setCategory('Event Methods')
    ->setAction('Event Methods-Action')
    ->setLabel('Event Methods-Label')
    ->setValue(11)
    ->send();
```

##Sending Page Views

####Minimal
```php
Analytics::create($config)
    ->page('/simple/page/view', 'Simple Page View')
    ->send();
```

####Complete
```php
$path = '/document/page/from/methods';
$title = 'Page Complete From Methods';
$hostname = 'mydomain.com';
$referrer = 'myblog.com';

Analytics::create($config)
    ->page()
    ->setDocumentPath($path)
    ->setDocumentTitle($title)
    ->setDocumentHostName($hostname)
    ->setDocumentReferrer($referrer)
    ->send();
```

##Sending Custom Data
To send custom data we need to define it in Google Analytics first:
- Log in to Google Analytics
- Go to Admin tab
- Select Account
- In property column click on **Custom Definitions**->**Custom Dimensions**
- Click on +New Custom Dimension, give it a name, scope -> Hit and make sure it's active
- Click Create
- Remember index (it will be used in Easy GA)
- Click on **Custom Definitions**->**Custom Metrics**
- Click on +New Custom Dimension, give it a name, scope -> Hit, Type -> Integer, make sure it's active
- Click Create
- We have created custom dimension with index 1. Repeat the process for new data


```php
Analytics::create($config)
    ->event()
    ->setCategory('Custom Data')
    ->setAction('Custom Data Action')
    ->setLabel('Sent Custom Values')
    ->setCustomDimension('custom value a', 1) // Index is 1
    ->setCustomDimension('custom value b', 2) // Index is 2
    ->setValue(9) // Event value
    ->send();
```

To read custom data:

- Go to **Reporting -> Behaviour -> Events -> Overview**
- Click on Event Actions
- Click on action with custom data: "Custom Data Action" (in our example)
- Click on Secondary Dimension dropdown
- Choose Custom Dimensions -> [your_custom_dimension_name]
- Number of hits with custom data should appear in the table

##Sending Transactions

####Minimal
```php
use Gradosevic\EasyGA\Analytics;
use Gradosevic\EasyGA\Product;

Analytics::create($config)
    ->transaction('TransactionID-2342541')
    ->setProduct(Product::create('MINPRODUCT-56471', 'Min Product', 1.99))
    ->sendPurchase();
```

####Complete
```php
$transactionID = 2315;
$affiliation = 'Affiliate Name';
$revenue = 456.99;
$tax = 10.0;
$shipping = 9.99;
$coupon = '20OFF';

Analytics::create($config)
    ->transaction($transactionID, $affiliation, $revenue, $tax, $shipping, $coupon)
    ->sendPurchase();
```

####Looping through products (example)
In case you need to loop throug products, you should unchain Easy GA like this:
```php
$products = array(); //Load your products
$transaction = Analytics::create($config)->transaction('2384287');

foreach($products as $product){
    $transaction->setProduct(Product::create($product['sku'], $product['name'], $product['price']))
}

$transaction->sendPurchase();
```

####Product properties
Product has following properties:
- category
- brand
- coupon
- name
- position
- price
- quantity
- sku
- variant

To set all product's properties, create new product object and use setter methods:

```php
$product = (new Product())
    ->setCategory('Product category')
    ->setBrand('Product brand')
     // ...
    ->setVariant($variant);
```

**To read transactions:**
- Wait for about 10 minutes or less to see the data
- Go to **Reporting -> Conversions -> E-commerce -> Overview**
- Click on time filter on right (Hourly, Day) and Revenue Sources below to see the data
- Click on other options under E-commerce to see other reports
- Important: Sometimes the data is not shown and you need to click on some filters to show it (time filters or links below)

##Sending Exceptions
```php
Analytics::create($config)
    ->exception('IOException')
    ->send();
```
To show custom exceptions in Dashboard please follow [this tutorial](http://stackoverflow.com/questions/21718481/report-for-exceptions-from-google-analytics-analytics-js-exception-tracking):

##Advanced: Access to All API Methods
Easy GA objects provide simplest possible set of data to send to GA. If you need to set more data, you can always access underlying library API and all it's methods, simple by using `api()` method whenever you need it in code.
**Example**: Use Easy GA for required data and add other data from API:

```php
Analytics::create($config)
            // Using Easy GA Event constructor to pass data
            ->event('Advanced Event Group', 'Advanced Event Action')

            // Using Easy GA class methods
            ->setLabel('Event wcd label')

            // The moment when we switch to API
            ->api()

            // Using API method
            ->setDocumentReferrer('referrer.com')

            // Using API method
            ->setDocumentPath('/event/document/path')

            // Important: We can not use Easy GA send() method any more.
            // We have to use API send method now.
            ->sendEvent();
```

##Tests
For other examples how to use this library, please look at the tests in the library

## License

Easy GA is licensed under the [MIT license](http://opensource.org/licenses/MIT)

Author: [Goran Radosevic](https://github.com/gradosevic)





