<?php

namespace Dematimbre\Admin\Bundle\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DematimbreAdminController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render(
            'DematimbreAdminAppBundle:Default:index.html.twig',
            array()
        );
    }
}
