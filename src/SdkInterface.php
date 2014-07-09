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

use Ftven\Sdk\Service\Http\HttpServiceInterface;

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

    /**
     * @return HttpServiceInterface
     */
    public function getHttpService();
    /**
     * @param HttpServiceInterface $httpService
     *
     * @return $this
     */
    public function setHttpService(HttpServiceInterface $httpService);
    /**
     * @param mixed  $credentials
     * @param string $type
     *
     * @return $this
     */
    public function setIdentity($credentials, $type = 'default');
    /**
     * @param string $type
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public function getIdentity($type = 'default');
    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasIdentity($type = 'default');
    /**
     * @param string $env
     * @param string $type
     *
     * @return $this
     */
    public function setEnvironment($env, $type = 'default');
    /**
     * @param string $type
     *
     * @return string
     */
    public function getEnvironment($type = 'default');
    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasEnvironment($type = 'default');
}