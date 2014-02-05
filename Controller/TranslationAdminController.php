<?php

namespace Asm\TranslationLoaderBundle\Controller;

use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Tools\Pagination\Paginator;

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

        /** @var \Asm\TranslationLoaderBundle\Doctrine\TranslationManager $repository */
        $repository = $this->get('asm_translation_loader.translation_manager');

        if (!empty($locale) || !empty($domain)) {
            if ($locale) {
                $params['transLocale'] = $locale;
            }
            if ($domain) {
                $params['messageDomain'] = $domain;
            }
            $translations = $repository->findTranslationBy($params);
        } else {
            $translations = $repository->findAllTranslations();
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


    /**
     * generate paging
     *
     * @param QueryBuilder $qb
     * @param int $limit
     * @return Paginator
     */
    private function getPaginator($limit=30)
    {
        $page = $this->get('request_stack')
            ->getCurrentRequest()
            ->query
            ->get("page", 1) ;

        $qb = $this->getDoctrine()->
        $qb ->setFirstResult( ( $page-1 ) * $limit)->setMaxResults($limit);
        //$this->getContainer()->get('asm_translation_loader.translation_manager')
        return new Paginator($qb);
    }
}
