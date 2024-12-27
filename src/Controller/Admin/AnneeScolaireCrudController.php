<?php

namespace App\Controller\Admin;

use App\Entity\AnneeScolaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnneeScolaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AnneeScolaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Années Scolaires')
            ->setEntityLabelInSingular('Année Scolaire')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des année scolaires');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('Annee'),
        ];
    }
}
