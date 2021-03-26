<?php

namespace App\Controller;

use App\Entity\Service;
use App\Service\TimeFormatter;
use App\Repository\AppointmentRepository;
use App\Repository\ServiceRepository;
use App\Repository\BarberRepository;
use App\Repository\AvailabilityRepository;
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

    /**
     * @Route("/calendar", name="appointment_calendar", methods={"GET"})
     * @param AppointmentRepository $appointmentRepository
     * @return Response
     */
    public function calendar(AppointmentRepository $appointmentRepository): Response
    {
        $user = $this->getUser();
        $appointments = $appointmentRepository->findBy(['barber'=>$user]);

        $event = [];

        foreach ($appointments as $appointment) {

            $startDate = $appointment->getDate()->format('Y-m-d');
            $startTime = $appointment->getStartTime()->format('H:i:s');
            $combinedStartDT = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
            $endDate = $appointment->getDate()->format('Y-m-d');
            $endTime = $appointment->getEndTime()->format('H:i:s');
            $combinedEndDT = date('Y-m-d H:i:s', strtotime("$endDate $endTime"));

            //$type = $appointment->getService()->getCategory();

            /*if ($type == 'combos') {
                $color = '#B22222';
            } elseif ($type == 'chewbacca hair cut "autour des cheveux"') {
                $color = '#556B2F';
            } elseif ($type == 'chewbacca beard "autour de la barbe"') {
                $color = '#4682B4';
            }*/

            $event[] = [
                'id'=>$appointment->getId(),
                'title'=>$appointment->getService()->getTitle(),
                'start'=>$combinedStartDT,
                'end'=>$combinedEndDT,
                'extendedProps'=>$appointment->getCustomer()->getFirstName(),
                'barberId'=>$appointment->getBarber()->getFirstName(),
                //'backgroundColor'=>$color,
                'yo'=>$appointment->getService()->getCategory()
            ];

        }

        $data = json_encode($event);
        return $this->render('appointment/calendar.html.twig', compact('data'));
    }
}
