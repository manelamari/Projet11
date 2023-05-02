<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\Category;
use App\Entity\Voiture;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected  $userRepository;
    protected  $voitureRepository;

    public function __construct(UserRepository $userRepository,VoitureRepository $voitureRepository){
        $this->userRepository=$userRepository;
        $this->voitureRepository=$voitureRepository;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            'countuser'=>$this->userRepository->countuser(),
            'countvoiture'=>$this->voitureRepository->countvoiture()
        ]);
       // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet11');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Voitures', 'fas fa-list', Voiture::class);
        yield MenuItem::linkToCrud('Reservation', 'fas fa-list', Booking::class);
    }
}
