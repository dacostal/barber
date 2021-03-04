<?php

namespace App\Controller;


use App\Entity\Service;
use App\Repository\AppointmentRepository;
use App\Repository\ServiceRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**

     * @Route("/reservation", name="reservation")
     * @param ServiceRepository $serviceRepository
     * @return Response
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('appointment/index.html.twig', [
            'categories' => $serviceRepository->allCategories(),
            'services' => $serviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="reservation_id")
     * @param ServiceRepository $serviceRepository
     * @return Response
     */
    public function choiceBarber($id, ServiceRepository $serviceRepository): Response
    {
        return $this->render('appointment/index.html.twig', [
            'categories' => $serviceRepository->allCategories(),
            'services' => $serviceRepository->findAll(),
        ]);
    }


    /**
     * @Route("/calendar", name="appointment_calendar", methods={"GET"})
     */
    public function calendar(AppointmentRepository $Appointment): Response
    {
        $appointments = $Appointment->findAll();

        foreach($appointments as $appointment) {

            $startDate = $appointment->getDate()->format('Y-m-d');
            $startTime = $appointment->getStartTime()->format('H:i:s');
            $combinedStartDT = date('Y-m-d H:i:s', strtotime("$startDate $startTime"));
            $endDate = $appointment->getDate()->format('Y-m-d');
            $endTime = $appointment->getEndTime()->format('H:i:s');
            $combinedEndDT = date('Y-m-d H:i:s', strtotime("$endDate $endTime"));
            $rdvs[] = [
                'id'=> $appointment->getId(),
                'title'=>$appointment->getService()->getTitle(),
                'start'=>$combinedStartDT,
                'end'=>$combinedEndDT,
                'extendedProps'=>$appointment->getCustomer()->getFirstName(),
                'barberId'=>$appointment->getBarber()->getFirstName(),
            ];

        }
        $data = json_encode($rdvs);
        return $this->render('appointment/calendar.html.twig', compact('data'));
    }


}
