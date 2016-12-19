<?php

namespace ROY\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ROYPlatformBundle:Default:index.html.twig');
    }
}
