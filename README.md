# Omnipay: Arca (Armenian Card)

**Arca driver for the Omnipay Laravel payment processing library**

[![Latest Stable Version](https://poser.pugx.org/k3rnel/omnipay-arca/v)](https://packagist.org/packages/k3rnel/omnipay-arca) [![Total Downloads](https://poser.pugx.org/k3rnel/omnipay-arca/downloads)](https://packagist.org/packages/k3rnel/omnipay-arca) [![Latest Unstable Version](https://poser.pugx.org/k3rnel/omnipay-arca/v/unstable)](https://packagist.org/packages/k3rnel/omnipay-arca) [![License](https://poser.pugx.org/k3rnel/omnipay-arca/license)](https://packagist.org/packages/k3rnel/omnipay-arca) [![PHP Version Require](https://poser.pugx.org/k3rnel/omnipay-arca/require/php)](https://packagist.org/packages/k3rnel/omnipay-arca)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.5+. This package implements Arca support for Omnipay.

## Installation

Omnipay is installed via [Composer](https://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "k3rnel/omnipay-arca": "dev-master"
    }
}
```

And run composer to update your dependencies:

    composer update

Or you can simply run

    composer require k3rnel/omnipay-arca

## Basic Usage

1. Use Omnipay gateway class:

```php
    use Omnipay\Omnipay;
```

2. Initialize Arca gateway:

```php

    $gateway = Omnipay::create('Arca');
    $gateway->setUsername(env('ARCA_USERNAME'));
    $gateway->setPassword(env('ARCA_PASSWORD'));
    $gateway->setReturnUrl(env('ARCA_RETURN_URL')); // Return url, that should be point to your arca webhook route
    $gateway->setLanguage(\App::getLocale()); // Language
    $gateway->setAmount(10); // Amount to charge
    $gateway->setTransactionId(XXXX); // Transaction ID from your system

```

3. Call purchase, it will automatically redirect to Arca's hosted page

```php

    $purchase = $gateway->purchase()->send();
    $purchase->redirect();

```

4. Create a webhook controller to handle the callback request at your `ARCA_RESULT_URL` and catch the webhook as follows

```php

    $gateway = Omnipay::create('Arca');
    $gateway->setUsername(env('ARCA_USERNAME'));
    $gateway->setPassword(env('ARCA_PASSWORD'));
    
    $purchase = $gateway->completePurchase()->send();
    
    // Do the rest with $purchase and response with 'OK'
    if ($purchase->isSuccessful()) {
        
        // Your logic
        
    }
    
    return new Response('OK');

```

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](https://stackoverflow.com/). Be sure to add the
[omnipay tag](https://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/k3rnel/omnipay-arca/issues),
or better yet, fork the library and submit a pull request.
