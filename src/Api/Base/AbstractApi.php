<?php

/*
 * This file is part of the SDK COMMON package
 *
 * (c) France Télévisions Editions Numériques <guillaume.postaire@francetv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ftven\Sdk\Api\Base;

use Ftven\Sdk\ApiInterface;
use Ftven\Sdk\SdkInterface;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * @var SdkInterface
     */
    protected $sdk;
    /**
     * @return string
     */
    public function getName()
    {
        return lcfirst(
            preg_replace(
                '/(?<=\\w)(?=[A-Z])/',
                '-$1',
                preg_replace(
                    '/Api$/',
                    '',
                    basename(
                        str_replace('\\', '/', get_class($this))
                    )
                )
            )
        );
    }
    /**
     * @param SdkInterface $sdk
     *
     * @return $this|void
     */
    public function setSdk(SdkInterface $sdk)
    {
        $this->sdk = $sdk;

        return $this;
    }
    /**
     * @return SdkInterface
     *
     * @throws \RuntimeException
     */
    public function getSdk()
    {
        if (null === $this->sdk) {
            throw new \RuntimeException('No SDK set', 500);
        }

        return $this->sdk;
    }

}