<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppointmentController extends AbstractController
{
    /**
     * @Route("/appointment", name="appointment")
     */
    public function index(): Response
    {

        $todayAppointments = $this->getDoctrine()->getRepository(Appointment::class)->findTodayAppointments();
        return $this->render('admin/main.html.twig',[
            'todayAppointments' => $todayAppointments,
        ]);
    }

}
