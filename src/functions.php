<?php

use Ftven\Sdk\Sdk;
use Ftven\Sdk\ApiInterface;

/**
 * @param bool $resetSingleton
 *
 * @return Sdk
 */
function ftven_sdk($resetSingleton = false)
{
    static $sdk = null;

    if (null === $sdk || true === $resetSingleton) {
        $sdk = new Sdk();
    }

    return $sdk;
}

/**
 * @param string|null $name
 * @param string|null $method
 *
 * @return ApiInterface|mixed
 *
 * @throws \RuntimeException
 */
function ftven_sdk_api($name = null, $method = null)
{
    if (null === $name) {
        return ftven_sdk()->getAvailableApis();
    }

    $args = func_get_args();
    $name = array_shift($args);
    $api  = ftven_sdk()->getApi($name);

    if (0 === count($args)) {
        return $api;
    }

    $method = array_shift($args);

    if (false === method_exists($api, $method)) {
        throw new \RuntimeException(
            sprintf(
                "Method '%s' does not exist in API '%s'",
                $method,
                $name
            ),
            404
        );
    }

    return call_user_func_array([$api, $method], $args);
}