<?php

/*
 * This file is part of the COMMON LIB package.
 *
 * (c) France Télévisions Editions Numériques <guillaume.postaire@francetv.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ftven\Sdk\Api\Test;

use Ftven\Sdk\ApiInterface;
use Ftven\Sdk\SdkInterface;

/**
 * @author Olivier Hoareau <olivier@phppro.fr>
 */
class TestApi implements ApiInterface
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
        return 'test';
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
    /**
     * @param int $number
     *
     * @return int
     */
    public function computeDouble($number)
    {
        return 2 * $number;
    }
}