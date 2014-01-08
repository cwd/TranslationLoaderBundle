<?php
/**
 * @namespace Asm\TranslationLoaderBundle\DependencyInjection
 */
namespace Asm\TranslationLoaderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * @package Asm\TranslationLoaderBundle\DependencyInjection
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\Config\Definition\Builder\TreeBuilder
 * @uses Symfony\Component\Config\Definition\ConfigurationInterface
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        /** @var \Symfony\Component\Config\Definition\Builder\TreeBuilder $treeBuilder */
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('asm_translation_loader');

        $rootNode
            ->children()
                ->append($this->addLoaderNode())
                ->append($this->addTranslationsNode())
                ->append($this->addDatabaseNode())
                ->append($this->addHistoryNode())
            ->end();
        return $treeBuilder;
    }


    /**
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition|\Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function addLoaderNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('loader');

        $node
            ->canBeEnabled()
            ->children()
                ->booleanNode('enabled')
                    ->defaultFalse()
                    ->info('Enables database loader')
                ->end()
            ->end();

        return $node;
    }


    /**
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition|\Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function addTranslationsNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('translations');

        $node
            ->requiresAtLeastOneElement()
            ->prototype('array')
                ->prototype('scalar')->end()
                ->children()->end()
            ->end();

        return $node;
    }


    /**
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition|\Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function addDatabaseNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('database');

        $node
            ->children()
                ->scalarNode('entity_manager')
                    ->defaultValue('default')
                    ->info('Optional entity manager for separate translations handling.')
                ->end()
            ->end();

        return $node;
    }


    /**
     * @return \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition|\Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function addHistoryNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root('history');

        $node
            ->canBeEnabled()
            ->children()
                ->booleanNode('enabled')
                    ->defaultFalse()
                    ->info('Enables historytracking for translation changes. Uses user id from registered users as reference')
                ->end()
            ->end();

        return $node;
    }
}
