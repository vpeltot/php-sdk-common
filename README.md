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

    <?php

    // ...

    require_once '/path/to/vendor/autoload.php';

    $result = ftven_sdk_api('xyz', 'methodName', 'arg1', 'arg2', '...');


Enjoy !

FTVEN Build Team.