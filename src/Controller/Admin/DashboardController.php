<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User; 
use App\Entity\Categorie;
use App\Entity\CodePromo;
use App\Entity\Commande;
use App\Entity\Produit;    

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecommerce Sf');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Site web', 'fa fa-home', 'app_home');
        yield MenuItem::section('Blog');
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Categorie', 'fa fa-file-text', Categorie::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('CodePromo', 'fa fa-tags', CodePromo::class);
        yield MenuItem::linkToCrud('Produits', 'fa fa-user', Produit::class);
    }
}
