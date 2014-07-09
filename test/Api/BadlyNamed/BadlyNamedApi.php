<?php

/*
 * This file is part of the COMMON LIB package.
 *
 * (c) France Télévisions Editions Numériques <guillaume.postaire@francetv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ftven\Sdk\Api\BadlyNamed;

use Ftven\Sdk\ApiInterface;
use Ftven\Sdk\SdkInterface;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
class BadlyNamedApi implements ApiInterface
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
        return 'anOtherName';
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
     */
    public function getSdk()
    {
        return $this->sdk;
    }
}