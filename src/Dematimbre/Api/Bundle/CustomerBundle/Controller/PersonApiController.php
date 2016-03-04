<?php

namespace Dematimbre\Api\Bundle\CustomerBundle\Controller;

use Dematimbre\Api\Bundle\AppBundle\Controller\DematimbreApiController;
use Dematimbre\Api\Bundle\CustomerBundle\Controller\Auto\PersonApiControllerTrait;

/**
 * Controller for Person entity Api actions.
 *
 * Auto generated methods :
 *
 * @method cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @method getAction($id, Request $request)
 * @method postAction(Request $request)
 * @method putAction($id, Request $request)
 * @method deleteAction($id)
 */
class PersonApiController extends DematimbreApiController
{
    use PersonApiControllerTrait;
}
