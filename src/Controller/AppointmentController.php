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
        $events = $Appointment->findAll();
        dd($events);
        return $this->render('appointment/calendar.html.twig');
    }


}
