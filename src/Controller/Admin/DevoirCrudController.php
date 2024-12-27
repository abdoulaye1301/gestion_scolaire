<?php

namespace App\Controller\Admin;

use App\Entity\Devoir;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class DevoirCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Devoir::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Devoirs')
            ->setEntityLabelInSingular('Devoir')
            ->setPaginatorPageSize(20)

            ->setPageTitle('index', 'Administration des devoirs');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex(),
            IntegerField::new('Note'),
            DateField::new('DateDevoir'),
        ];
    }
}
