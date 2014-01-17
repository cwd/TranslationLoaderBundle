<?php
/**
 * @namespace Asm\TranslationLoaderBundle
 */
namespace Asm\TranslationLoaderBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Asm\TranslationLoaderBundle\DependencyInjection\Compiler\TranslationLoaderPass;

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
     * @param ContainerBuilder $container
     */
/*    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $configs = $container->getExtensionConfig('asm_translation_loader');
        print_r($configs);
        // if our translations are enabled
        if (true == $container->getParameter('asm_translation_loader.loader.enabled', false))
        {
            $container->addCompilerPass(new TranslationLoaderPass());
        }
    }*/
}
