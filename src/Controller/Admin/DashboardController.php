<?php

namespace App\Controller\Admin;

use App\Entity\Barber;
use App\Entity\Service;
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

        return $this->render('admin/main.html.twig',[
           'barbers' => $barbers,
            'services' => $services,
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

            //MenuItem::linkToLogout('Logout', 'fa fa-exit'),

        ];

    }




}
