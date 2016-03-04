<?php

/* @MajoraGenerator({"force_generation": true}) */

namespace Dematimbre\Admin\Bundle\CustomerBundle\Controller\Auto;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Majora\Bundle\FrameworkExtraBundle\Controller\AdminControllerTrait;
use Majora\Framework\Model\EnablableInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Auto generated controller trait for Person entity admin actions.
 *
 * @method render(string $template, array $parameters)
 */
trait PersonAdminControllerTrait
{
    use AdminControllerTrait;

    /**
     * list all Persons.
     *
     * @return Response
     */
    public function listAction()
    {
        return $this->render(
            'DematimbreAdminCustomerBundle:Person:list.html.twig',
            array('personCollection' => $this->container->get('dematimbre.person.loader')->retrieveAll())
        );
    }

    /**
     * create a new Person.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request)
    {
        $form = $this->container->get('form.factory')->create(
            $this->container->get('dematimbre.person.form_type'),
            $person = new Person(),
            array('intention' => 'creation')
        );

        if ($request->getMethod() == 'POST') {
            $form->submit($request);
            if ($form->isValid()) {
                $this->container->get('dematimbre.person.domain')->create(
                    $person
                );

                return new RedirectResponse($this->container->get('router')->generate(
                    'dematimbre_admin_person_update', array(
                        'id' => $person->getId(),
                    )
                ));
            }
        }

        return $this->render(
            'DematimbreAdminCustomerBundle:Person:create.html.twig',
            array(
                'form' => $form->createView(),
                'person' => $person,
            )
        );
    }

    /**
     * update a Person.
     *
     * @param Person $person
     * @param Request      $request
     *
     * @return Response
     */
    public function updateAction(Person $person, Request $request)
    {
        $form = $this->container->get('form.factory')->create(
            $this->container->get('dematimbre.person.form_type'),
            $person,
            array('intention' => 'edition')
        );

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->container->get('dematimbre.person.domain')->edit(
                    $person
                );
            }
        }

        return $this->render(
            'DematimbreAdminCustomerBundle:Person:update.html.twig',
            array(
                'form' => $form->createView(),
                'person' => $person,
            )
        );
    }

    /**
     * view details of a Person.
     *
     * @param Person $person
     *
     * @return Response
     */
    public function detailsAction(Person $person)
    {
        return $this->render(
            'DematimbreAdminCustomerBundle:Person:details.html.twig',
            array('person' => $person)
        );
    }

    /**
     * enable or disable a Person.
     *
     * @param Person $person
     * @param Request      $request
     *
     * @return Response
     */
    public function enableAction(Person $person, Request $request)
    {
        if (!$person instanceof EnablableInterface) {
            throw new NotFoundHttpException('Cannot disabled or enabled a Person, it must implement Majora\Framework\Model\EnablableInterface.');
        }
        if (!$request->query->has('enabled')) {
            throw new NotFoundHttpException('Missing "enabled" query parameter');
        }

        $domain = $this->container->get('dematimbre.person.domain');
        $request->query->get('enabled') ?
            $domain->enable($person) :
            $domain->disable($person)
        ;

        return new RedirectResponse(
            $request->server->get('HTTP_REFERER') ?:
            $this->container->get('router')->generate(
                'dematimbre_admin_person_update',
                array('id' => $person->getId())
            )
        );
    }

    /**
     * enable a collection of Person.
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
            $loader = $this->container->get('dematimbre.person.loader');
            $domain = $this->container->get('dematimbre.person.domain');

            if (!$ids = (array) $request->request->has('elementIds')) {
                throw new NotFoundHttpException('Missing "elementIds" data.');
            }

            foreach ($ids as $id) {
                if ($element = $loader->retrieve($id)) {
                    if (!$element instanceof EnablableInterface) {
                        throw new NotFoundHttpException('Cannot enable a Person, it must implement Majora\Framework\Model\EnablableInterface.');
                    }
                    $domain->enable($element);
                }
            }
        }

        return new RedirectResponse(
            $request->server->get('HTTP_REFERER') ?:
                $this->generateUrl('dematimbre_admin_person_list')
        );
    }

    /**
     * disable a collection of Person.
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
            $loader = $this->container->get('dematimbre.person.loader');
            $domain = $this->container->get('dematimbre.person.domain');

            if (!$ids = (array) $request->request->get('elementIds')) {
                throw new NotFoundHttpException('Missing "elementIds" data.');
            }

            foreach ($ids as $id) {
                if ($element = $loader->retrieve($id)) {
                    if (!$element instanceof EnablableInterface) {
                        throw new NotFoundHttpException('Cannot disable a Person, it must implement Majora\Framework\Model\EnablableInterface.');
                    }
                    $domain->disable($element);
                }
            }
        }

        return new RedirectResponse(
            $request->server->get('HTTP_REFERER') ?:
                $this->generateUrl('dematimbre_admin_person_list')
        );
    }
}
