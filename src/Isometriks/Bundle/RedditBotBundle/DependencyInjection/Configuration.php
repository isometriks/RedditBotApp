<?php

namespace Isometriks\Bundle\RedditBotBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('isometriks_reddit_bot');

        $rootNode
            ->children()
                ->arrayNode('feeds')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('url')->isRequired()->end()
                            ->scalarNode('subreddit')->isRequired()->end()
                            ->arrayNode('flair')
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('options')
                                ->children()
                                    ->scalarNode('link')->defaultValue('link')->cannotBeEmpty()->end()
                                    ->scalarNode('title')->defaultValue('title')->cannotBeEmpty()->end()
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
