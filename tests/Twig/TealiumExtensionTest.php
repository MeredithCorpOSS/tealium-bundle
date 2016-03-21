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

namespace Tests\TimeInc\TealiumBundle\Twig;

use TimeInc\Tealium\Tealium;
use TimeInc\Tealium\Udo;
use TimeInc\TealiumBundle\Twig\TealiumExtension;

/**
 * Class TealiumExtensionTest.
 *
 * @author andy.thorne@timeinc.com
 */
class TealiumExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $baseDir;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->baseDir = dirname(dirname(__DIR__)).'/src';
    }

    public function testName()
    {
        $tealium = $this->getTealium();
        $extension = new TealiumExtension($tealium);

        $this->assertEquals('IPC_Twig_Extension_Tealium', $extension->getName());
    }

    public function testRender()
    {
        $tealium = $this->getTealium();
        $extension = new TealiumExtension($tealium);

        $twigLoader = new \Twig_Loader_Array(
            [
                'test.html.twig'                          => '{{ tealium() }}',
                'TimeIncTealiumBundle::tealium.html.twig' => file_get_contents(
                    $this->baseDir.'/Resources/views/tealium.html.twig'
                ),
            ]
        );
        $twig = new \Twig_Environment($twigLoader);
        $twig->addExtension($extension);

        $html = $twig->render('test.html.twig');

        $this->assertContains('var data_object = '.((string)$tealium->getUdo()).';', $html);
        $this->assertContains('//tags.tiqcdn.com/utag/org/app/qa/utag.js', $html);
    }

    /**
     * @return Tealium
     */
    private function getTealium()
    {
        $udo = new Udo(
            'data_object', [
                'site' => 'test_site',
            ]
        );
        $tealium = new Tealium('org', 'app', $udo, Tealium::TEALIUM_QA);

        return $tealium;
    }
}
