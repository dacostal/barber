<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ServiceController extends AbstractController
{

    /**
     * @Route("/service", name="service")
     * @param ServiceRepository $serviceRepository
     * @return Response
     */

public function index(ServiceRepository $serviceRepository): Response

    {
        return $this->render('service/index.html.twig', [
            'categories' => $serviceRepository->allCategories(),
            'services' => $serviceRepository->findAll(),
        ]);
    }
}
