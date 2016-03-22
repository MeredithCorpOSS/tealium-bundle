<?php

namespace TimeInc\TealiumBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('time_inc_tealium');

        $rootNode->children()
            ->scalarNode('organisation')->isRequired()->end()
            ->scalarNode('app')->isRequired()->end()
            ->scalarNode('environment')->defaultValue('prod')->end()
            ->arrayNode('udo')
            ->children()
            ->scalarNode('namespace')->defaultValue('utag_data')->end()
            ->arrayNode('defaults')
            ->prototype('variable')->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
