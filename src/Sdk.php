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

use Ftven\Sdk\Service\Http\HttpService;
use Ftven\Sdk\Service\Http\HttpServiceInterface;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
class Sdk implements SdkInterface
{
    /**
     * @var array
     */
    protected $identities = [];
    /**
     * @var array
     */
    protected $environments = [];
    /**
     * @var ApiInterface[]
     */
    protected $apis = [];
    /**
     * @var string[]
     */
    protected $autoloadNamespaces = [];
    /**
     * @var HttpServiceInterface
     */
    protected $httpService;
    /**
     * @param string[] $autoloadNamespaces api class autoload namespaces
     */
    public function __construct(array $autoloadNamespaces = [])
    {
        $this->setAutoloadNamespaces(
            array_merge(
                $autoloadNamespaces,
                [sprintf('%s\\Api', __NAMESPACE__)]
            )
        );
    }
    /**
     * @param HttpServiceInterface $httpService
     *
     * @return $this
     */
    public function setHttpService(HttpServiceInterface $httpService)
    {
        $this->httpService = $httpService;

        return $this;
    }
    /**
     * @return HttpServiceInterface
     */
    public function getHttpService()
    {
        if (null === $this->httpService) {
            $this->httpService = new HttpService();
        }

        return $this->httpService;
    }
    /**
     * @param string[] $autoloadNamespaces
     *
     * @return $this
     */
    public function setAutoloadNamespaces(array $autoloadNamespaces)
    {
        $this->autoloadNamespaces = $autoloadNamespaces;

        return $this;
    }
    /**
     * @return string[]
     */
    public function getAutoloadNamespaces()
    {
        return $this->autoloadNamespaces;
    }
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

        $api->setSdk($this);

        $this->apis[$api->getName()] = $api;

        return $this;
    }
    /**
     * @return string[]
     */
    public function getAvailableApis()
    {
        $apiNames = array_keys($this->apis);

        sort($apiNames);

        return $apiNames;
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
            $this->autoloadApi($name);
        }

        return $this->apis[$name];
    }
    /**
     * @param string $name
     *
     * @return $this
     *
     * @throws \RuntimeException
     */
    protected function autoloadApi($name)
    {
        $className = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));

        foreach($this->getAutoloadNamespaces() as $namespace) {
            $class = sprintf(
                '%s\\%s\\%sApi',
                $namespace,
                $className,
                $className
            );

            if (false === class_exists($class, true)) {
                continue;
            }

            $api = new $class;

            if (!($api instanceof ApiInterface)) {
                continue;
            }

            if ($name !== $api->getName()) {
                continue;
            }

            return $this->addApi($api);
        }

        throw new \RuntimeException(
            sprintf("Unknown API with name '%s'", $name),
            404
        );
    }
    /**
     * @param mixed  $credentials
     * @param string $type
     *
     * @return $this
     */
    public function setIdentity($credentials, $type = 'default')
    {
        $this->identities[$type] = $credentials;
    }
    /**
     * @param string $type
     *
     * @return mixed
     */
    public function getIdentity($type = 'default')
    {
        if (false === $this->hasIdentity($type)) {
            if ('default' !== $type) {
                if (false === $this->hasIdentity('default')) {
                    return null;
                }

                return $this->hasIdentity('default');
            }

            return null;
        }

        return $this->identities[$type];
    }
    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasIdentity($type = 'default')
    {
        return true === isset($this->identities[$type]);
    }
    /**
     * @param string $env
     * @param string $type
     *
     * @return $this
     */
    public function setEnvironment($env, $type = 'default')
    {
        $this->environments[$type] = $env;

        return $this;
    }
    /**
     * @param string $type
     *
     * @return string
     */
    public function getEnvironment($type = 'default')
    {
        if (false === $this->hasEnvironment($type)) {
            if ('default' !== $type) {
                if (false === $this->hasEnvironment('default')) {
                    return 'prod';
                }

                return $this->hasEnvironment('default');
            }

            return 'prod';
        }

        return $this->environments[$type];
    }
    /**
     * @param string $type
     *
     * @return bool
     */
    public function hasEnvironment($type = 'default')
    {
        return true === isset($this->environments[$type]);
    }
}