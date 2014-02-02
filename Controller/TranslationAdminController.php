<?php

namespace Asm\TranslationLoaderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TranslationAdminController
 *
 * @package Asm\TranslationLoaderBundle\Controller
 * @author marc aschmann <maschmann@gmail.com>
 * @uses Symfony\Bundle\FrameworkBundle\Controller\Controller
 */
class TranslationAdminController extends Controller
{
    /**
     * default page
     *
     * @param string $domain
     * @param string $locale
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($domain=null, $locale=null)
    {
        //$page = $this->getRequest()->query->get("page", 1) ;
        //$qb ->setFirstResult( ( $page-1 ) * $limit)->setMaxResults($limit) ;

        $repository = $this->get('doctrine')
            ->getManager($this->container->getParameter('asm_translation_loader.database.entity_manager'))
            ->getRepository('AsmTranslationLoaderBundle:Translation');

        if (!empty($locale) || !empty($domain)) {
            if ($locale) {
                $params['transLocale'] = $locale;
            }
            if ($domain) {
                $params['messageDomain'] = $domain;
            }
            $translations = $repository->findBy($params);
        } else {
            $translations = $repository->findAll();
        }

        return $this->render(
            'AsmTranslationLoaderBundle:TranslationAdmin:show.html.twig',
            array(
                'translations' => $translations,
            )
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction()
    {
        return $this->render(
            'AsmTranslationLoaderBundle:TranslationAdmin:create.html.twig',
            array()
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction()
    {
        return $this->render(
            'AsmTranslationLoaderBundle:TranslationAdmin:edit.html.twig',
            array()
        );
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction()
    {
        return $this->render(
            'AsmTranslationLoaderBundle:TranslationAdmin:delete.html.twig',
            array()
        );
    }
}
