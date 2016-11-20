<?php

namespace T4\Bundle\TwigExtensionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('T4TwigExtensionBundle:Default:index.html.twig');
    }
}
