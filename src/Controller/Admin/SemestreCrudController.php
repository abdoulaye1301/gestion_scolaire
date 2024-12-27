<?php

namespace App\Controller\Admin;

use App\Entity\Semestre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SemestreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Semestre::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Semestres')
            ->setEntityLabelInSingular('Semestre')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des semestres');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('NomSemestre'),
        ];
    }
}
