<?php

/*
 * This file is part of the COMMON LIB package.
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
class SdkTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @group unit
     */
    public function testConstruct()
    {
        $sdk = new Sdk();

        $this->assertTrue(method_exists($sdk, 'getApi'));
    }
    /**
     * @group unit
     */
    public function testGetApiForUnknownApiThrowException()
    {
        $sdk = new Sdk();

        $this->setExpectedException('RuntimeException', "Unknown API with name 'unknown'", 404);

        $sdk->getApi('unknown');
    }
    /**
     * @group unit
     */
    public function testAddApiEffectivelyRegistersApi()
    {
        $sdk = new Sdk();

        $apiMock = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName', 'getValue'], [], '', false);
        $apiMock->expects($this->any())->method('getName')->will($this->returnValue('mock-api'));
        $apiMock->expects($this->once())->method('getValue')->will($this->returnValue('theValue'));

        $sdk->addApi($apiMock);

        $this->assertTrue($sdk->hasApi('mock-api'));
        $this->assertEquals('theValue', $sdk->getApi('mock-api')->getValue());
    }
    /**
     * @group unit
     */
    public function testAddApiForApiWithSameNameAlreadyAddedThrowException()
    {
        $sdk = new Sdk();

        $apiMock = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName', 'getValue'], [], '', false);
        $apiMock->expects($this->any())->method('getName')->will($this->returnValue('mock-api'));

        $apiMock2 = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName'], [], '', false);
        $apiMock2->expects($this->any())->method('getName')->will($this->returnValue('mock-api'));

        $this->setExpectedException('RuntimeException', "API with name 'mock-api' already added", 500);

        $sdk->addApi($apiMock);
        $sdk->addApi($apiMock2);
    }
}