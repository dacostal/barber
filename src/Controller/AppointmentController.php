<?php

namespace App\Controller;

use DateTime;
use App\Entity\Service;

use App\Service\TimeFormatter;
use App\Repository\BarberRepository;
use App\Repository\ServiceRepository;
use App\Repository\AvailabilityRepository;
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
     * @return Response
     */
    public function choiceBarber(Service $service, BarberRepository $barberRepository, AvailabilityRepository $availabilityRepository, TimeFormatter $formatter): Response
    {
        $availabilities = $availabilityRepository->findAllByWeek($service);
        $dispos = [];
        foreach ($availabilities as $availability)
        {
            
            $s = new DateTime("19-03-2021".$availability->getStartTime()->format('H:i:s'));
            $e = new DateTime("19-03-2021".$availability->getEndTime()->format('H:i:s'));
            $dispos[] = ['id' => $availability->getId(),
                       'title' =>$formatter->format($availability->getStartTime()->format('H:i:s')),
                       'startTime'=>$s,
                       'endTime'=>$e,
                        ];
                        
                        break;
        }
        
        $data = json_encode($dispos);
        return $this->render('appointment/reservation.html.twig', [
            'barbers' => $barberRepository->findByService($service),
            'data'=>$data
        ]);
    }
}
