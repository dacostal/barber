<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }
  
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }
    
    /**
     * @Route("/service", name="service")
     */
    public function prestation()
    {
        return $this->render('home/prestation.html.twig');
    }
}
