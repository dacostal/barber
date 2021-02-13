<?php

namespace App\Controller\Admin;

use App\Entity\Appointment;
use App\Entity\Barber;
use App\Entity\Service;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ColumnChart;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Datetime;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */

    public function index(): Response
    {

        $now =new Datetime();
        $now->setTimezone(new \DateTimeZone('Europe/Paris'));
        $now=date_format($now,"d/m/y");

        $barbers = $this->getDoctrine()->getRepository(Barber::class)->count([]);
        $services = $this->getDoctrine()->getRepository(Service::class)->count([]);
        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->count([]);
        $todayAppointments = $this->getDoctrine()->getRepository(Appointment::class)->findTodayAppointments();
        $thisWeekAppointments = $this->getDoctrine()->getRepository(Appointment::class)->findThisWeekAppointments();
        $chartData = $this->getDoctrine()->getRepository(Appointment::class)->getThisWeekAppointments();
        $chartDataAppointmentBarber = $this->getDoctrine()->getRepository(Appointment::class)->getTodayAppointmentsBarber();
        $todayList = $this->getDoctrine()->getRepository(Appointment::class)->getTodayAppointments();

        $data = [['Day','RDV']];
        foreach($chartData as $dt)
        {
            $data[] = array(
                $dt['day'], (int)$dt['count']
            );
        }
        $chart = new ColumnChart();
        $chart->getData()->setArrayToDataTable($data);
        $chart->getOptions()->getAnnotations()->setAlwaysOutside(False);
        $chart->getOptions()->getAnnotations()->getTextStyle()->setFontSize(14);
        $chart->getOptions()->getAnnotations()->getTextStyle()->setColor('#000');
        $chart->getOptions()->getAnnotations()->getTextStyle()->setAuraColor('none');
        $chart->getOptions()->setWidth(530);
        $chart->getOptions()->setHeight(250);

        $dataToday = [['Name','RDV']];
        foreach($chartDataAppointmentBarber as $dt)
        {
            $dataToday[] = array(
                $dt['name'], (int)$dt['count']
            );
        }
        $chartToday = new ColumnChart();
        $chartToday->getData()->setArrayToDataTable($dataToday);
        $chartToday->getOptions()->getAnnotations()->setAlwaysOutside(False);
        $chartToday->getOptions()->getAnnotations()->getTextStyle()->setFontSize(14);
        $chartToday->getOptions()->getAnnotations()->getTextStyle()->setColor('#000');
        $chartToday->getOptions()->getAnnotations()->getTextStyle()->setAuraColor('none');
        $chartToday->getOptions()->setWidth(530);
        $chartToday->getOptions()->setHeight(250);

        return $this->render('admin/main.html.twig',[
           'barbers' => $barbers,
            'services' => $services,
            'appointments' => $appointments,
            'todayAppointments' => $todayAppointments,
            'thisWeekAppointments' =>$thisWeekAppointments,
            'chart' => $chart,
            'todayList' =>$todayList,
            'chartToday' => $chartToday,
            'now' =>$now,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Chewbacca');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::subMenu('Barber', 'fas fa-user')->setSubItems([

                MenuItem::linkToCrud('All barbers', 'fas fa-archive', Barber::class),
                MenuItem::linkToCrud('Add a barber', 'far fa-plus-square', Barber::class)
                    ->setAction('new'),

            ]),

            MenuItem::subMenu('Service', 'fas fa-cut')->setSubItems([


                MenuItem::linkToCrud('All services', 'fas fa-archive', Service::class),
                MenuItem::linkToCrud('Add a service', 'far fa-plus-square', Service::class)
                    ->setAction('new'),
            ]),


        ];

    }



}
