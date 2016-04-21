easy-ga
=============
PHP Google Analytics library for quick and easy use

<a href="https://packagist.org/packages/gradosevic/easy-ga">
    <img src="http://img.shields.io/packagist/v/gradosevic/easy-ga.svg?style=flat" style="vertical-align: text-top">
</a>
<a href="https://packagist.org/packages/gradosevic/easy-ga">
    <img src="http://img.shields.io/packagist/dt/gradosevic/easy-ga.svg?style=flat" style="vertical-align: text-top">
</a>

#About
This library was created for people who want to start using Google Analytics with minimum time for setup. 
It is basically a wrapper for [theiconic/php-ga-measurement-protocol](https://github.com/theiconic/php-ga-measurement-protocol) with easy to use objects.

For more information about API please check official documentation:
- [The Iconic API](https://github.com/theiconic/php-ga-measurement-protocol)
- [Working with Measurement Protocol](https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide)
- [Measurement Protocol Parameters Reference](https://developers.google.com/analytics/devguides/collection/protocol/v1/parameters)



#Installation

#####`composer require gradosevic/easy-ga`

##Supported Features
- Send Events
- Send Page Views
- Send Custom Data
- Send Transactions

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

##Sending Page Views
TBD

##Sending Custom Data
TBD

##Sending Transactions
TBD

##Tests
For other examples how to use this library, please look at the tests in the library





