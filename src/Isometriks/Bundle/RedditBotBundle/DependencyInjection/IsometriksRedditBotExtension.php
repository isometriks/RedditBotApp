<?php

namespace Isometriks\Bundle\RedditBotBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class IsometriksRedditBotExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Load Services
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        foreach ($config as $key => $value) {
            $container->setParameter(sprintf('isometriks_reddit.%s', $key), $value);
        }

        $feeds = array();

        foreach ($config['feeds'] as $feed) {
            $feeds[] = new Definition\FeedDefinition($feed['url'], $feed['subreddit'], $feed['flair'], $feed['options']);
        }

        $managerDefinition = $container->getDefinition('isometriks_reddit_bot.feed_manager');
        $managerDefinition->replaceArgument(1, $feeds);
    }
}
