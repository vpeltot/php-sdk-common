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
interface SdkInterface
{
    /**
     * @param ApiInterface $api
     *
     * @return $this
     *
     * @throws \RuntimeException
     */
    public function addApi(ApiInterface $api);
    /**
     * @param string $name
     *
     * @return ApiInterface
     *
     * @throws \RuntimeException
     */
    public function getApi($name);
}