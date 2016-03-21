<?php
/**
 * Copyright (c) 2016.
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace Tests\TimeInc\TealiumBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use TimeInc\Tealium\Tealium;
use TimeInc\Tealium\Udo;
use TimeInc\TealiumBundle\DependencyInjection\TimeIncTealiumExtension;

/**
 * Class TimeIncTealiumExtensionTest.
 *
 * @author andy.thorne@timeinc.com
 */
class TimeIncTealiumExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $containerBuilder = new ContainerBuilder();

        $extension = new TimeIncTealiumExtension();

        $configs = [];
        $configs[] = [
            'organisation' => 'org',
            'app'          => 'app',
            'environment'  => Tealium::TEALIUM_DEV,
            'udo'          => [
                'namespace' => 'data',
            ],
        ];
        $extension->load($configs, $containerBuilder);

        $this->assertTrue($containerBuilder->hasDefinition('timeinc.tealium'));
        $this->assertTrue($containerBuilder->hasDefinition('timeinc.tealium.udo'));

        $containerBuilder->compile();

        /** @var Tealium $tealium */
        $tealium = $containerBuilder->get('timeinc.tealium');
        /** @var Udo $udo */
        $udo = $containerBuilder->get('timeinc.tealium.udo');

        $this->assertInstanceOf('TimeInc\Tealium\Tealium', $tealium);
        $this->assertInstanceOf('TimeInc\Tealium\Udo', $udo);
        $this->assertInstanceOf('TimeInc\Tealium\Udo', $tealium->getUdo());
        $this->assertSame($udo, $tealium->getUdo());

        $this->assertEquals('org', $tealium->getOrganisation());
        $this->assertEquals('app', $tealium->getApp());
        $this->assertEquals(Tealium::TEALIUM_DEV, $tealium->getEnvironment());

        $this->assertEquals('data', $udo->getName());
    }
}
