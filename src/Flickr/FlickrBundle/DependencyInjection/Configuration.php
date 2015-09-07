<?php

namespace Flickr\FlickrBundle\DependencyInjection;

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
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('flickr_flickr');

        $rootNode
            ->children()
                ->scalarNode('flickr_photos')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultValue('https://api.flickr.com/services/rest/?method=flickr.photos.getRecent&api_key=863e1a544ee0c20ccd310e198d783065&per_page=10&format=json&nojsoncallback=1')
                ->end()
            ->end();


        return $treeBuilder;
    }

}
