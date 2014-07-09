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
class FunctionsTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        ftven_sdk(true);
    }
    /**
     * @group unit
     */
    public function testFunction__functions__exists()
    {
        $this->assertTrue(function_exists('ftven_sdk'));
        $this->assertTrue(function_exists('ftven_sdk_api'));
    }
    /**
     * @group unit
     */
    public function testFunction__ftven_sdk()
    {
        $this->assertInstanceOf('Ftven\\Sdk\\Sdk', ftven_sdk());
    }
    /**
     * @group unit
     */
    public function testFunction__ftven_sdk_api()
    {
        $apiMock = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName', 'setSdk', 'getSdk'], [], '', false);
        $apiMock->expects($this->any())->method('getName')->will($this->returnValue('api-mock'));
        ftven_sdk()->addApi($apiMock);
        $this->assertEquals($apiMock, ftven_sdk_api('api-mock'));
    }
    /**
     * @group unit
     */
    public function testFunction__ftven_sdk_api__with_no_args__returns_list_of_apis()
    {
        $apiMock = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName', 'setSdk', 'getSdk'], [], '', false);
        $apiMock->expects($this->any())->method('getName')->will($this->returnValue('api-mock'));
        ftven_sdk()->addApi($apiMock);
        $this->assertEquals(['api-mock'], ftven_sdk_api());
    }
    /**
     * @group unit
     */
    public function testFunction__ftven_sdk_api__with_method_call()
    {
        $apiMock = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName', 'getValue', 'setSdk', 'getSdk'], [], '', false);
        $apiMock->expects($this->any())->method('getName')->will($this->returnValue('api-mock'));
        $apiMock->expects($this->any())->method('getValue')->will($this->returnValue('theValueHere'));
        ftven_sdk()->addApi($apiMock);
        $this->assertEquals('theValueHere', ftven_sdk_api('api-mock', 'getValue'));
    }
    /**
     * @group unit
     */
    public function testFunction__ftven_sdk_api__for_method_unknown__throw_exception()
    {
        $apiMock = $this->getMock('Ftven\\Sdk\\ApiInterface', ['getName', 'setSdk', 'getSdk'], [], '', false);
        $apiMock->expects($this->any())->method('getName')->will($this->returnValue('api-mock'));
        ftven_sdk()->addApi($apiMock);
        $this->setExpectedException('RuntimeException', "Method 'unknownMethod' does not exist in API 'api-mock'", 404);
        ftven_sdk_api('api-mock', 'unknownMethod');
    }
}