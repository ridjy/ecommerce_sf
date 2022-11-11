<?php

namespace App\Controller\Admin;

use App\Entity\Citation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CitationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Citation::class;
    }

    /*public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Conference Comment')
            ->setEntityLabelInPlural('Conference Comments')
            ->setSearchFields(['author', 'text', 'email'])
            ->setDefaultSort(['createdAt' => 'DESC'])
        ;
    }*/
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
