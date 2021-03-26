<?php

namespace App\Controller;

use App\Entity\Service;
use App\Service\TimeFormatter;
use App\Repository\BarberRepository;
use App\Repository\ServiceRepository;
use App\Repository\AvailabilityRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/appointment")
 */
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
     * @param AvailabilityRepository $availabilityRepository
     * @param BarberRepository $barberRepository
     * @return Response
     */
    public function choiceBarber(Service $service, AvailabilityRepository $availabilityRepository, BarberRepository $barberRepository): Response
    {
        $availabilities = $availabilityRepository->findAllByWeek($service);
        $dispos = [];

        foreach($availabilities as $availability)
        {
            $dispos[] = [
                'id' => $availability->getId(),
                'daysOfWeek' => [ $availability->getDay() ],
                'startTime' => $availability->getStartTime()->format('H:i'),
                'endTime' => $availability->getEndTime()->format('H:i')
            ];
        }

        return $this->render('appointment/reservation.html.twig', [
            'barbers' => $barberRepository->findByService($service),
            'data' => json_encode($dispos)
        ]);
    }
}
