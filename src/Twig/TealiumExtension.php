<?php

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
