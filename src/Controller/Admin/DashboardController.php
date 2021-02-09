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


class DashboardController extends AbstractDashboardController
{


    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $barbers = $this->getDoctrine()->getRepository(Barber::class)->count([]);
        $services = $this->getDoctrine()->getRepository(Service::class)->count([]);
        $appointments = $this->getDoctrine()->getRepository(Appointment::class)->count([]);
        $todayAppointments = $this->getDoctrine()->getRepository(Appointment::class)->findTodayAppointments();
        $thisWeekAppointments = $this->getDoctrine()->getRepository(Appointment::class)->findThisWeekAppointments();
        $chartData = $this->getDoctrine()->getRepository(Appointment::class)->getThisWeekAppointments();
        $todayList = $this->getDoctrine()->getRepository(Appointment::class)->getTodayAppointments();

        $data = [['Day','Appointments']];
        foreach($chartData as $dt)
        {
            $data[] = array(
                $dt['day'], (int)$dt['count']
            );
        }
        $chart = new ColumnChart();
        $chart->getData()->setArrayToDataTable($data);

        $chart->getOptions()->setTitle('RDV de la semaine');
        $chart->getOptions()->getAnnotations()->setAlwaysOutside(False);
        $chart->getOptions()->getAnnotations()->getTextStyle()->setFontSize(14);
        $chart->getOptions()->getAnnotations()->getTextStyle()->setColor('#000');
        $chart->getOptions()->getAnnotations()->getTextStyle()->setAuraColor('none');
        $chart->getOptions()->setWidth(530);
        $chart->getOptions()->setHeight(250);

        return $this->render('admin/main.html.twig',[
           'barbers' => $barbers,
            'services' => $services,
            'appointments' => $appointments,
            'todayAppointments' => $todayAppointments,
            'thisWeekAppointments' =>$thisWeekAppointments,
            'chart' => $chart,
            'todayList' =>$todayList,
     //       'appointmentLast30Days' => $appointmentLast30Days,
      //      'appointmentLast30DaysSum' => array_sum($appointmentLast30Days),
        ]);
    }
/*
    private function getAppointmentLastDays(): array
    {
        $appointmentLast30Days = $this->getDoctrine()->getRepository(Appointment::class)->getAppointmentLastDays();
        $r = [];
        $begin = new \DateTime('-'.$days.' day');
        $end = new \DateTime();

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($begin, $interval, $end);

        foreach ($period as $dt) {
            $r[$dt->format("Y-m-d")] = 0;
        }
        foreach ($appointmentLast30Days as $appointmentLast30Day) {
            $r[$appointmentLast30Day->d] = $appointmentLast30Day->num;
        }

        ksort($r);

        return $r;
    }
*/
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Chewbacca');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Page administration', 'fa fa-home'),

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

            MenuItem::linkToDashboard('Appointment', 'fas fa-archive', Appointment::class),
            //MenuItem::linkToLogout('Logout', 'fa fa-exit'),

        ];

    }


}
