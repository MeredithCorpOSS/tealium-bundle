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

use Symfony\Component\Config\Definition\Processor;
use TimeInc\TealiumBundle\DependencyInjection\Configuration;

/**
 * Class ConfigurationTest.
 *
 * @author andy.thorne@timeinc.com
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testOrganisationRequired()
    {
        $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

        $config = new Configuration();
        $processor = new Processor();

        $processor->processConfiguration(
            $config,
            [
                [
                    'app' => 'test_app',
                ],
            ]
        );
    }

    public function testAppRequired()
    {
        $this->setExpectedException('Symfony\Component\Config\Definition\Exception\InvalidConfigurationException');

        $config = new Configuration();
        $processor = new Processor();

        $processor->processConfiguration(
            $config,
            [
                [
                    'organisation' => 'test_org',
                ],
            ]
        );
    }
}
