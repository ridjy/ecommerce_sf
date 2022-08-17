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
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Component\Security\Core\User\UserInterface;  

class DashboardController extends AbstractDashboardController
{
    /**
     * 
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        return $this->render('admin/page_custom.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecommerce Sf');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Site web', 'fa fa-shopping-bag', 'app_home');
        yield MenuItem::section('Blog');
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class);
        yield MenuItem::section('Boutique');
        yield MenuItem::linkToCrud('Categorie', 'fa fa-file-text', Categorie::class);
        yield MenuItem::linkToCrud('Produits', 'fa fa-database', Produit::class);
        yield MenuItem::linkToCrud('CodePromo', 'fa fa-code', CodePromo::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getUserName())
            // use this method if you don't want to display the name of the user
            ->displayUserName(true)

            // you can return an URL with the avatar image
            ->setAvatarUrl('https://...')
            // use this method if you don't want to display the user image
            ->displayUserAvatar(false)
            // you can also pass an email address to use gravatar's service
            ->setGravatarEmail($user->getEmail())

            // you can use any type of menu item, except submenus
            ->addMenuItems([
                MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
                MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
            ]);
    }
}
