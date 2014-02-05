<?php

/**
 * @namespace Asm\TranslationLoaderBundle
 */
namespace Asm\TranslationLoaderBundle;

use Asm\TranslationLoaderBundle\DependencyInjection\Compiler\AddResourcePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class AsmTranslationLoaderBundle
 *
 * @package Asm\TranslationLoaderBundle
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Component\DependencyInjection\ContainerBuilder
 * @uses Symfony\Component\HttpKernel\Bundle\Bundle
 * @uses Asm\TranslationLoaderBundle\DependencyInjection\Compiler\TranslationLoaderPass
 */
class AsmTranslationLoaderBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddResourcePass());
    }
}
