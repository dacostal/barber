<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ServiceController
 * @package App\Controller
 * @Route("/Service", name="Service_")
 */


class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index(): Response
    {

        $service = $this->getDoctrine()->getRepository(Service::class)->findBy([],['id' => 'asc']);
        return $this->render('service/index.html.twig', compact('service'));
    }




}
