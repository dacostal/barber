<?php

namespace App\Controller;

use App\Entity\Service;
use App\Service\TimeFormatter;
use App\Repository\BarberRepository;
use App\Repository\ServiceRepository;
use App\Repository\AvailabilityRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @param AvailabilityRepository $availabilityRepository
     * @return JsonResponse
     * @throws Exception
     */
    public function choiceBarber(Service $service, BarberRepository $barberRepository, AvailabilityRepository $availabilityRepository): JsonResponse
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

        return new JsonResponse([
                'barbers' => $barberRepository->findByService($service),
                'data' => $dispos
            ], 200
        );
    }
}
