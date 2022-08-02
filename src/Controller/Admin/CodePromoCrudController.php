<?php

namespace App\Controller\Admin;

use App\Entity\CodePromo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CodePromoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CodePromo::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
