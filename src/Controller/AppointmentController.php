<?php

namespace App\Controller;

use App\Entity\Service;
use App\Repository\AppointmentRepository;
use App\Repository\ServiceRepository;
use App\Repository\BarberRepository;
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

    /**
     * @Route("/calendar", name="appointment_calendar", methods={"GET"})
     * @param AppointmentRepository $Appointment
     * @return Response
     */
    public function calendar(AppointmentRepository $Appointment): Response
    {
        $user = $this->getUser();
        $appointments = $Appointment->findBy(['barber'=>$user]);

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
                'id'=> $appointment->getId(),
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
