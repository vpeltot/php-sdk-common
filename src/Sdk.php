<?php

/*
 * This file is part of the SDK COMMON package
 *
 * (c) France Télévisions Editions Numériques <guillaume.postaire@francetv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ftven\Sdk;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
class Sdk implements SdkInterface
{
    /**
     * @var ApiInterface[]
     */
    protected $apis = [];
    /**
     * @param ApiInterface $api
     *
     * @return $this
     *
     * @throws \RuntimeException
     */
    public function addApi(ApiInterface $api)
    {
        if (true === $this->hasApi($api->getName())) {
            throw new \RuntimeException(
                sprintf("API with name '%s' already added", $api->getName()),
                500
            );
        }

        $this->apis[$api->getName()] = $api;

        return $this;
    }
    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasApi($name)
    {
        return true === isset($this->apis[$name]);
    }
    /**
     * @param string $name
     *
     * @return ApiInterface
     *
     * @throws \RuntimeException
     */
    public function getApi($name)
    {
        if (false === $this->hasApi($name)) {
            throw new \RuntimeException(
                sprintf("Unknown API with name '%s'", $name),
                404
            );
        }

        return $this->apis[$name];
    }
}