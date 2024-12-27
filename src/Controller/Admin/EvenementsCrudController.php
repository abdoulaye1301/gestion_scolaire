<?php

namespace App\Controller\Admin;

use App\Entity\Evenements;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EvenementsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evenements::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Evénements')
            ->setEntityLabelInSingular('Evénement')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des événements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('NomEvenement'),
            TextField::new('Description'),
        ];
    }
}
