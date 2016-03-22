<?php

namespace TimeInc\TealiumBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class TimeIncTealiumExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $tealiumDefinition = $container->findDefinition('timeinc.tealium');
        $tealiumDefinition->setArguments(
            [
                $config['organisation'],
                $config['app'],
                new Reference('timeinc.tealium.udo'),
                $config['environment'],
            ]
        );

        $udoDefinition = $container->findDefinition('timeinc.tealium.udo');
        $udoDefinition->setArguments(
            [
                $config['udo']['namespace'],
                $config['udo']['defaults'],
            ]
        );
    }
}
