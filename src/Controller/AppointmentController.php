<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\BarberRepository;

use App\Repository\ServiceRepository;
use App\Service\TimeFormatter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     * @param ServiceRepository $serviceRepository
     * @param TimeFormatter $formatter
     * @return Response
     */
    public function index(ServiceRepository $serviceRepository, TimeFormatter $formatter): Response
    {
        return $this->render('appointment/index.html.twig', [
            'categories' => $serviceRepository->allCategories(),
            'services' => $serviceRepository->findAll(),
            'formatter' => $formatter,
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="reservation_id")
     * @param Service $service
     * @param BarberRepository $barberRepository
     * @return Response
     */
    public function choiceBarber(Service $service, BarberRepository $barberRepository): Response
    {
        return $this->render('appointment/reservation.html.twig', [
            'barbers' => $barberRepository->findByService($service),
        ]);
    }
}
