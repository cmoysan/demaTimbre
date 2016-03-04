<?php

/* @MajoraGenerator({"force_generation": true}) */

namespace Dematimbre\Admin\Bundle\MajoraNamespaceBundle\Controller\Auto;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Majora\Bundle\FrameworkExtraBundle\Controller\AdminControllerTrait;
use Majora\Framework\Model\EnablableInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Auto generated controller trait for MajoraEntity entity admin actions.
 *
 * @method render(string $template, array $parameters)
 */
trait MajoraEntityAdminControllerTrait
{
    use AdminControllerTrait;

    /**
     * list all MajoraEntitys.
     *
     * @return Response
     */
    public function listAction()
    {
        return $this->render(
            'DematimbreAdminMajoraNamespaceBundle:MajoraEntity:list.html.twig',
            array('majoraEntityCollection' => $this->container->get('dematimbre.majora_entity.loader')->retrieveAll())
        );
    }

    /**
     * create a new MajoraEntity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->container->get('form.factory')->create(
            $this->container->get('dematimbre.majora_entity.form_type'),
            $majoraEntity = new MajoraEntity(),
            array('intention' => 'creation')
        );

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $this->container->get('dematimbre.majora_entity.domain')->create(
                    $majoraEntity
                );

                return new RedirectResponse($this->container->get('router')->generate(
                    'dematimbre_admin_majora_entity_update', array(
                        'id' => $majoraEntity->getId(),
                    )
                ));
            }
        }

        return $this->render(
            'DematimbreAdminMajoraNamespaceBundle:MajoraEntity:create.html.twig',
            array(
                'form' => $form->createView(),
                'majoraEntity' => $majoraEntity,
            )
        );
    }

    /**
     * update a MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     * @param Request      $request
     *
     * @return Response
     */
    public function updateAction(MajoraEntity $majoraEntity, Request $request)
    {
        $form = $this->container->get('form.factory')->create(
            $this->container->get('dematimbre.majora_entity.form_type'),
            $majoraEntity,
            array('intention' => 'edition')
        );

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->container->get('dematimbre.majora_entity.domain')->edit(
                    $majoraEntity
                );
            }
        }

        return $this->render(
            'DematimbreAdminMajoraNamespaceBundle:MajoraEntity:update.html.twig',
            array(
                'form' => $form->createView(),
                'majoraEntity' => $majoraEntity,
            )
        );
    }

    /**
     * view details of a MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     *
     * @return Response
     */
    public function detailsAction(MajoraEntity $majoraEntity)
    {
        return $this->render(
            'DematimbreAdminMajoraNamespaceBundle:MajoraEntity:details.html.twig',
            array('majoraEntity' => $majoraEntity)
        );
    }

    /**
     * enable or disable a MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     * @param Request      $request
     *
     * @return Response
     */
    public function enableAction(MajoraEntity $majoraEntity, Request $request)
    {
        if (!$majoraEntity instanceof EnablableInterface) {
            throw new NotFoundHttpException('Cannot disabled or enabled a MajoraEntity, it must implement Majora\Framework\Model\EnablableInterface.');
        }
        if (!$request->query->has('enabled')) {
            throw new NotFoundHttpException('Missing "enabled" query parameter');
        }

        $domain = $this->container->get('dematimbre.majora_entity.domain');
        $request->query->get('enabled') ?
            $domain->enable($majoraEntity) :
            $domain->disable($majoraEntity)
        ;

        return new RedirectResponse(
            $request->server->get('HTTP_REFERER') ?:
            $this->container->get('router')->generate(
                'dematimbre_admin_majora_entity_update',
                array('id' => $majoraEntity->getId())
            )
        );
    }

    /**
     * enable a collection of MajoraEntity.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     *
     * @throws NotFoundHttpException
     */
    public function enableCollectionAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $loader = $this->container->get('dematimbre.majora_entity.loader');
            $domain = $this->container->get('dematimbre.majora_entity.domain');

            if (!$ids = (array) $request->request->has('elementIds')) {
                throw new NotFoundHttpException('Missing "elementIds" data.');
            }

            foreach ($ids as $id) {
                if ($element = $loader->retrieve($id)) {
                    if (!$element instanceof EnablableInterface) {
                        throw new NotFoundHttpException('Cannot enable a MajoraEntity, it must implement Majora\Framework\Model\EnablableInterface.');
                    }
                    $domain->enable($element);
                }
            }
        }

        return new RedirectResponse(
            $request->server->get('HTTP_REFERER') ?:
                $this->generateUrl('dematimbre_admin_majora_entity_list')
        );
    }

    /**
     * disable a collection of MajoraEntity.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     *
     * @throws NotFoundHttpException
     */
    public function disableCollectionAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $loader = $this->container->get('dematimbre.majora_entity.loader');
            $domain = $this->container->get('dematimbre.majora_entity.domain');

            if (!$ids = (array) $request->request->get('elementIds')) {
                throw new NotFoundHttpException('Missing "elementIds" data.');
            }

            foreach ($ids as $id) {
                if ($element = $loader->retrieve($id)) {
                    if (!$element instanceof EnablableInterface) {
                        throw new NotFoundHttpException('Cannot disable a MajoraEntity, it must implement Majora\Framework\Model\EnablableInterface.');
                    }
                    $domain->disable($element);
                }
            }
        }

        return new RedirectResponse(
            $request->server->get('HTTP_REFERER') ?:
                $this->generateUrl('dematimbre_admin_majora_entity_list')
        );
    }
}
