PHP SDK COMMON
==============

[![Build Status](https://travis-ci.org/francetv/php-sdk-common.svg?branch=master)](https://travis-ci.org/francetv/php-sdk-common)

PHP SDK COMMON provide foundation for the native PHP API SDK for consuming FTVEN APIs.

## Usage

Add the dependency in your composer.json :

    ...
    "require": {
        ...
        "ftven/sdk-common": "1.*"
    }

Then update your dependency :

    $ ./composer.phar update ftven/sdk-common

Then you can use it directly in your scripts :

    <?php

    // ...

    require_once '/path/to/vendor/autoload.php';

    $sdk = new Ftven\Sdk\Sdk();

    $result = $sdk->getApi('xyz')->myApiMethod();

    // ...

As an alternative, you can use functions :

    $result = ftven_sdk_api('xyz', 'methodName', 'arg1', 'arg2', '...');

By default, API are autoloaded from the Ftven\Sdk\Api namespace, but you can add extra namespaces :

    $sdk = new Ftven\Sdk\Sdk(['My\\Other\\Namespace']);

    $sdk->getApi('xyz')->...

Some APIs require that you set identities before using them :

    $sdk->setIdentity(['login' => 'me', 'pass' => 'mypass']);

    ...

Depending on the APIs you use, multiple identities are supported (only one per APIs) :

    $sdk->setIdentity([...], 'identityType1');
    $sdk->setIdentity([...], 'identityType2');

By default, API calls are directed to 'prod' environment, but you can change to an other environment :

    $sdk->setEnvironment('preprod');

Depending on the APIs you use, multiple environments are supported (only one per APIs) :

    $sdk->setEnvironment('preprod', 'api1');
    $sdk->setEnvironment('prod'); // fallback

Enjoy !

FTVEN Build Team.
