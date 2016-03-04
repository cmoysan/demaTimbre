<?php

/* @MajoraGenerator({"force_generation": true}) */

namespace Dematimbre\Api\Bundle\CustomerBundle\Controller\Auto;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for Person Rest API.
 *
 * Use EntityManager transactionnal mode for write cases
 *
 * @property ContainerInterface $container
 */
trait PersonApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * @see ControllerTrait::getSecurityMapping()
     */
    protected function getSecurityMapping()
    {
        return array(
            'fetch' => array('person_fetch'),
            'read' => array('person_read'),
            'write' => array('person_write'),
            'delete' => array('person_delete'),
        );
    }

    /**
     * Returns a collection of Persons.
     *
     * @ApiDoc(
     *    description = "Returns a collection of Persons",
     *    tags        = { "stable" = "#0CB24F" },
     *    views       = { "default" },
     *    filters     = {
     *      {"name"="scope", "dataType"="optionnal data scoping"},
     *      {"name"="limit", "dataType"="optionnal resultset limit"},
     *    },
     *    section     = "Person",
     *    output      = "Dematimbre\Si\Component\Customer\Entity\Person",
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
            $this->container->get('dematimbre.person.loader')->retrieveAll(
                $this->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single Person by id.
     *
     * @ApiDoc(
     *    description  = "Returns a single Person by id",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default", "mobile" },
     *    section      = "Person",
     *    output       = "Dematimbre\Si\Component\Customer\Entity\Person",
     *    requirements = {
     *        { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Requested Person id" }
     *    },
     *    statusCodes  = {
     *        200 = "Returned when successful",
     *        404 = "If Person not found",
     *        403 = "If method access denied"
     *    }
     * )
     * QueryParam(name="scope", strict=false, requirements="\w*", description="Data scope to use on data serialization")
     */
    public function getAction($id, Request $request)
    {
        $this->assertIsGrantedOr403(
            'read',
            $person = $this->retrieveOr404($id, 'dematimbre.person.loader')
        );

        return $this->createJsonResponse(
            $person,
            $request->query->get('scope')
        );
    }

    /**
     * @ApiDoc(
     *    description="Create a new Person",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default", "mobile" },
     *    section      = "Person",
     *    input        = {
     *        "class" = "Dematimbre\Si\Bundle\CustomerBundle\Form\Type\PersonType",
     *        "name"  = ""
     *    },
     *    output       = "Dematimbre\Si\Component\Customer\Entity\Person",
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
                'person',
                $person = new Person(),
                array(
                    'csrf_protection' => false,
                    'allow_extra_fields' => true,
                    'intention' => 'creation',
                )
            );

            // submit
            $this->assertSubmitedFormIsValid($request, $form);

            // create
            $this->container->get('dematimbre.person.domain')->create($person);

            $entityManager->commit();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }

        return $this->createJsonResponse(
            $person,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * @ApiDoc(
     *    description  = "Update Person data for given id",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default", "mobile" },
     *    section      = "Person",
     *    input        = {
     *        "class"   = "Dematimbre\Si\Bundle\CustomerBundle\Form\Type\PersonType",
     *        "name"    = "",
     *        "options" = { "method" = "PUT" },
     *    },
     *    requirements = {
     *        { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Requested Person id" }
     *    },
     *    statusCodes={
     *      204 = "Returned when successful",
     *      404 = "If Person not found",
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
                $person = $this->retrieveOr404($id, 'dematimbre.person.loader')
            );

            $form = $this->container->get('form.factory')->createNamed(
                '',
                'person',
                $person,
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
            $this->container->get('dematimbre.person.domain')->edit($person);

            $entityManager->commit();

            return $this->createJsonNoContentResponse();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }
    }

    /**
     * @ApiDoc(
     *    description="Deletes Person for given id",
     *    tags         = { "stable" = "#0CB24F" },
     *    views        = { "default" },
     *    section      = "Person",
     *    requirements = {
     *        { "name" = "id", "dataType" = "integer", "requirement" = "\d+", "description" = "Requested Person id" }
     *    },
     *    statusCodes  = {
     *        204 = "Returned when successful",
     *        404 = "If Person not found",
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
                $person = $this->retrieveOr404($id, 'dematimbre.person.loader')
            );

            $this->container->get('dematimbre.person.domain')
                ->delete($person)
            ;

            $entityManager->commit();

            return $this->createJsonNoContentResponse();
        } catch (\Exception $e) {
            $entityManager->rollback();

            throw $e;
        }
    }
}
