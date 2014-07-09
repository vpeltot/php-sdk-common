<?php

/*
 * This file is part of the SDK COMMON package
 *
 * (c) France Télévisions Editions Numériques <guillaume.postaire@francetv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ftven\Sdk\Service\Http;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
interface HttpServiceInterface
{
    /**
     * @param $url   $string
     * @param string $method
     * @param array  $headers
     * @param null   $body
     * @param array  $options
     *
     * @return array
     */
    public function request(
        $url, $method = 'GET', $headers = [], $body = null, $options = []
    );
}