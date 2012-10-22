<?php

namespace Test\ZombieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('TestZombieBundle:Default:index.html.twig', array('name' => $name));
    }
}
