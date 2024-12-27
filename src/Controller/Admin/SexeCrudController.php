<?php

namespace App\Controller\Admin;

use App\Entity\Sexe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SexeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Sexe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Sexes')
            ->setEntityLabelInSingular('Sexe')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des Sexes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('NomSexe'),
        ];
    }
}
