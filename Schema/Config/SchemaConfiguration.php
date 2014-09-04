<?php

namespace Ekyna\Component\Characteristics\Schema\Config;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class SchemaConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('schemas');

        $rootNode
            ->isRequired()
            ->requiresAtLeastOneElement()
            ->useAttributeAsKey('name')
            ->prototype('array')
                ->children()
                    ->scalarNode('title')->isRequired()->end()
                    ->arrayNode('groups')
                        ->isRequired()
                        ->requiresAtLeastOneElement()
                        ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('title')->isRequired()->end()
                                ->arrayNode('characteristics')
                                    ->isRequired()
                                    ->requiresAtLeastOneElement()
                                    ->useAttributeAsKey('name')
                                    ->prototype('array')
                                        ->children()
                                            ->scalarNode('title')->isRequired()->end()
                                            ->scalarNode('type')
                                                ->isRequired()
                                                ->validate()
                                                ->ifNotInArray(array('text', 'number', 'boolean', 'choice'))
                                                ->thenInvalid('Invalid characteristic type "%s".')
                                                ->end()
                                            ->end()
                                            ->arrayNode('parameters')
                                                ->addDefaultsIfNotSet()
                                                ->children()
                                                    ->booleanNode('shared')->defaultFalse()->end()
                                                    ->booleanNode('virtual')->defaultFalse()->end()
                                                    ->scalarNode('format')->defaultvalue("%s")->end()
                                                    ->arrayNode('property_paths')
                                                        ->prototype('scalar')->end()
                                                    ->end()
                                                ->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}