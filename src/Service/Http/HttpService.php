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

use GuzzleHttp\Client;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
class HttpService implements HttpServiceInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     *
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }
    /**
     * @return Client
     *
     * @throws \RuntimeException
     */
    public function getClient()
    {
        if (null === $this->client) {
            if (false === class_exists('GuzzleHttp\\Client', true)) {
                throw new \RuntimeException(
                      "FTVEN SDK requires GuzzleHttp Client,"
                    . " please consider adding it to your project dependencies"
                    . " or provide an other implementation of the"
                    . " HttpServiceInterface",
                    412
                );
            }
            $this->client = new Client();
        }

        return $this->client;
    }
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
    )
    {
        $request = $this->getClient()->createRequest($method, $url, $options);

        $response = $this->getClient()->send($request);

        return [
            'code'    => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body'    => (string)$response->getBody(),
        ];
    }
}