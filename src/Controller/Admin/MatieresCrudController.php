<?php

namespace App\Controller\Admin;

use App\Entity\Matieres;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class MatieresCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matieres::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Matieres')
            ->setEntityLabelInSingular('Matiere')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des matieres');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            TextField::new('NomMatiere'),
            IntegerField::new('CoefMatiere'),
        ];
    }
}
