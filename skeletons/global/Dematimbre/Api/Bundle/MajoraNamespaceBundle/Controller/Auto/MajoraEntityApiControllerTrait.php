<?php

/* @MajoraGenerator({"force_generation": true}) */

namespace Dematimbre\Api\Bundle\MajoraNamespaceBundle\Controller\Auto;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for MajoraEntity Rest API.
 *
 * Use EntityManager transactionnal mode for write cases
 *
 * @property ContainerInterface $container
 */
trait MajoraEntityApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * @see ControllerTrait::getSecurityMapping()
     */
    protected function getSecurityMapping()
    {
        return array(
            'fetch' => array('majora_entity_fetch'),
            'read' => array('majora_entity_read'),
            'write' => array('majora_entity_write'),
            'delete' => array('majora_entity_delete'),
        );
    }

    /**
     * Returns a collection of MajoraEntitys.
     *
     * @ApiDoc(
     *    description = "Returns a collection of MajoraEntitys",
     *    tags        = { "stable" = "#0CB24F" },
     *    views       = { "default" },
     *    filters     = {
     *      {"name"="scope", "dataType"="optionnal data scoping"},
     *      {"name"="limit", "dataType"="optionnal resultset limit"},
     *    },
     *    section     = "MajoraEntity",
     *    output      = "Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity",
     *    statusCodes = {
     *        200 = "Returned when successful",
     *        403 = "If method access denied"
     *    }
     * )
     */
    public function cgetAction(Request $request)
    {
        $this->assertIsGrantedOr403('fetch');

        $queryFilters = array_diff_key(
            $request->query->all(),
            array_flip(array('scope', 'limit', 'offset'))
        );

        return $this->createJsonResponse(
            $this->container->get('dematimbre.majora_entity.loader')->retrieveAll(
                $this->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single MajoraEntity by id.
     *
     * @ApiDoc(
     *    description  = "Returns a single MajoraEntity by id",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default", "mobile" },
     *    section      = "MajoraEntity",
     *    output       = "Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity",
     *    requirements = {
     *        { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Requested MajoraEntity id" }
     *    },
     *    statusCodes  = {
     *        200 = "Returned when successful",
     *        404 = "If MajoraEntity not found",
     *        403 = "If method access denied"
     *    }
     * )
     * QueryParam(name="scope", strict=false, requirements="\w*", description="Data scope to use on data serialization")
     */
    public function getAction($id, Request $request)
    {
        $this->assertIsGrantedOr403(
            'read',
            $majoraEntity = $this->retrieveOr404($id, 'dematimbre.majora_entity.loader')
        );

        return $this->createJsonResponse(
            $majoraEntity,
            $request->query->get('scope')
        );
    }

    /**
     * @ApiDoc(
     *    description="Create a new MajoraEntity",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default", "mobile" },
     *    section      = "MajoraEntity",
     *    input        = {
     *        "class" = "Dematimbre\Si\Bundle\MajoraNamespaceBundle\Form\Type\MajoraEntityType",
     *        "name"  = ""
     *    },
     *    output       = "Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity",
     *    statusCodes  = {
     *        201 = "Returned when successful",
     *        400 = "If invalid data",
     *        403 = "If method access denied"
     *    }
     * )
     * QueryParam(name="scope", strict=false, requirements="\w*", description="Data scope to use on data serialization")
     */
    public function postAction(Request $request)
    {
        $this->assertIsGrantedOr403('write');

        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->beginTransaction();

        try {
            $form = $this->container->get('form.factory')->createNamed(
                '',
                'majora_entity',
                $majoraEntity = new MajoraEntity(),
                array(
                    'csrf_protection' => false,
                    'allow_extra_fields' => true,
                    'intention' => 'creation',
                )
            );

            // submit
            $this->assertSubmitedFormIsValid($request, $form);

            // create
            $this->container->get('dematimbre.majora_entity.domain')->create($majoraEntity);

            $entityManager->commit();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }

        return $this->createJsonResponse(
            $majoraEntity,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * @ApiDoc(
     *    description  = "Update MajoraEntity data for given id",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default", "mobile" },
     *    section      = "MajoraEntity",
     *    input        = {
     *        "class"   = "Dematimbre\Si\Bundle\MajoraNamespaceBundle\Form\Type\MajoraEntityType",
     *        "name"    = "",
     *        "options" = { "method" = "PUT" },
     *    },
     *    requirements = {
     *        { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Requested MajoraEntity id" }
     *    },
     *    statusCodes={
     *      204 = "Returned when successful",
     *      404 = "If MajoraEntity not found",
     *      400 = "If invalid data",
     *      403 = "If method access denied"
     *    }
     * )
     */
    public function putAction($id, Request $request)
    {
        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->beginTransaction();

        try {
            $this->assertIsGrantedOr403(
                'write',
                $majoraEntity = $this->retrieveOr404($id, 'dematimbre.majora_entity.loader')
            );

            $form = $this->container->get('form.factory')->createNamed(
                '',
                'majora_entity',
                $majoraEntity,
                array(
                    'method' => $request->getMethod(),
                    'csrf_protection' => false,
                    'allow_extra_fields' => true,
                    'intention' => 'edition',
                )
            );

            // submit
            $this->assertSubmitedFormIsValid($request, $form);

            // edit
            $this->container->get('dematimbre.majora_entity.domain')->edit($majoraEntity);

            $entityManager->commit();

            return $this->createJsonNoContentResponse();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }
    }

    /**
     * @ApiDoc(
     *    description="Deletes MajoraEntity for given id",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default" },
     *    section      = "MajoraEntity",
     *    requirements = {
     *        { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Requested MajoraEntity id" }
     *    },
     *    statusCodes  = {
     *        204 = "Returned when successful",
     *        404 = "If MajoraEntity not found",
     *        403 = "If method access denied"
     *    }
     * )
     */
    public function deleteAction($id)
    {
        $entityManager = $this->container->get('doctrine')->getManager();
        $entityManager->beginTransaction();

        try {
            $this->assertIsGrantedOr403(
                'delete',
                $majoraEntity = $this->retrieveOr404($id, 'dematimbre.majora_entity.loader')
            );

            $this->container->get('dematimbre.majora_entity.domain')
                ->delete($majoraEntity)
            ;

            $entityManager->commit();

            return $this->createJsonNoContentResponse();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }
    }
}
