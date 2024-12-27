<?php

namespace App\Controller\Admin;

use App\Entity\Composition;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CompositionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Composition::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Compositions')
            ->setEntityLabelInSingular('Composition')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des Compositions');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            IntegerField::new('Note'),
            DateField::new('DateComposition'),
        ];
    }
}
