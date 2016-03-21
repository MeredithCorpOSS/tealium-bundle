<?php
/**
 * Copyright (c) 2016.
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:.
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS
 * OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
 * OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace TimeInc\TealiumBundle\Twig;

use TimeInc\Tealium\Tealium;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class TealiumExtension.
 *
 * @author andy.thorne@timeinc.com
 */
class TealiumExtension extends Twig_Extension
{
    /**
     * @var Tealium
     */
    protected $tealium;

    /**
     * TealiumExtension constructor.
     *
     * @param Tealium $tealium
     */
    public function __construct(Tealium $tealium)
    {
        $this->tealium = $tealium;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'IPC_Twig_Extension_Tealium';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction(
                'tealium',
                [$this, 'renderTealium'],
                ['is_safe' => ['js', 'html'], 'needs_environment' => true]
            ),
        ];
    }

    /**
     * Fetch the UDO as a string.
     *
     * @param \Twig_Environment $twig
     *
     * @return string
     */
    public function renderTealium(\Twig_Environment $twig)
    {
        return $twig->render(
            'TimeIncTealiumBundle::tealium.html.twig',
            [
                'tealium_udo_namespace' => $this->tealium->getUdo()->getName(),
                'tealium_udo_data' => (string) $this->tealium->getUdo(),
                'tealium_orginisation' => $this->tealium->getOrganisation(),
                'tealium_app' => $this->tealium->getApp(),
                'tealium_environment' => $this->tealium->getEnvironment(),
            ]
        );
    }
}
